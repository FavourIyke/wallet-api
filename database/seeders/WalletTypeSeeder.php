<?php

namespace Database\Seeders;

use App\Models\WalletType;
use Illuminate\Database\Seeder;

class WalletTypeSeeder extends Seeder
{
    public function run()
    {
        WalletType::create(['name' => 'Savings', 'minimum_balance' => 100.00, 'monthly_interest_rate' => 1.5]);
        WalletType::create(['name' => 'Current', 'minimum_balance' => 0.00, 'monthly_interest_rate' => 0.5]);
    }
}
