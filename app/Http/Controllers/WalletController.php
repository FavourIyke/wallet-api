<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wallet;

class WalletController extends Controller
{
    public function index()
    {
        $wallets = Wallet::with('walletType', 'user')->get();
        return response()->json([
            'status' => true,
            'message' => 'Wallets retrieved successfully.',
            'data' => $wallets,
        ]);
    }

    public function show(Wallet $wallet)
    {
        $wallet->load('walletType', 'user');
        return response()->json([
            'status' => true,
            'message' => 'Wallet details retrieved successfully.',
            'data' => $wallet,
        ]);
    }

    public function showTransferOptions()
    {
        $wallets = Wallet::with('walletType', 'user')->get();
        return response()->json([
            'status' => true,
            'message' => 'Wallet transfer options retrieved successfully.',
            'data' => $wallets,
        ]);
    }

    public function transfer(Request $request)
    {
        $validated = $request->validate([
            'from_wallet_id' => 'required|exists:wallets,id',
            'to_wallet_id' => 'required|exists:wallets,id|different:from_wallet_id',
            'amount' => 'required|numeric|min:0.01',
        ]);

        $fromWallet = Wallet::findOrFail($validated['from_wallet_id']);
        $toWallet = Wallet::findOrFail($validated['to_wallet_id']);

        if ($fromWallet->balance < $validated['amount']) {
            return response()->json([
                'status' => false,
                'message' => 'Insufficient funds in the sender\'s wallet.',
            ], 400);
        }

        \DB::beginTransaction();

        try {
            $fromWallet->balance -= $validated['amount'];
            $fromWallet->save();

            $toWallet->balance += $validated['amount'];
            $toWallet->save();

            \DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Transfer successful.',
            ]);
        } catch (\Exception $e) {
            \DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'An error occurred during the transfer.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
