<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Wallet;
use App\Models\WalletType;
use App\Models\User;

class WalletSeeder extends Seeder
{
    public function run()
    {
        // Create some wallet types
        $walletTypes = [
            ['name' => 'Savings', 'minimum_balance' => 100, 'monthly_interest_rate' => 1.5],
            ['name' => 'Current', 'minimum_balance' => 50, 'monthly_interest_rate' => 0.5],
        ];

        foreach ($walletTypes as $type) {
            WalletType::create($type);
        }

        // Create users
        $users = User::factory()->count(10)->create();

        // Assign wallets to users
        foreach ($users as $user) {
            Wallet::create([
                'user_id' => $user->id,
                'wallet_type_id' => WalletType::inRandomOrder()->first()->id,
                'name' => $user->name . "'s Wallet",
                'balance' => rand(10000, 100000),
            ]);
        }
    }
}
