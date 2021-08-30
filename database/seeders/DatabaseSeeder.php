<?php

namespace Database\Seeders;

use App\Eloquent\Enums\AccountTypeEnum;
use App\Eloquent\Enums\UnitEnum;
use App\Models\Account;
use App\Models\Branch;
use App\Models\Position;
use App\Models\Product;
use Feadbox\Tags\Models\Tag;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        setting([
            'app.locale' => 'tr',
            'app.timezone' => 'Europe/Istanbul',
        ]);

        Account::create([
            'name' => 'Ana Kasa',
            'account_type' => AccountTypeEnum::Safe,
            'is_default' => true
        ]);

        Account::create([
            'name' => 'TIP',
            'account_type' => AccountTypeEnum::Tip,
        ]);

        // $this->call(TestSeeder::class);
    }
}
