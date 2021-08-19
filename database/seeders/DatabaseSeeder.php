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

        Position::create(['name' => 'Garson', 'default_price' => 3500]);
        Position::create(['name' => 'Komi', 'default_price' => 2500]);

        Branch::create(['name' => 'Fatih']);
        Branch::create(['name' => 'Sefaköy']);

        $manav = Tag::create(['name' => 'Manav', 'collection' => 'product']);
        Tag::create(['name' => 'Rutin', 'collection' => 'product']);

        $domates = Product::create(['title' => 'Domates', 'unit' => UnitEnum::KG]);

        $domates->tags()->attach($manav);

        Account::create(['name' => 'Ana Kasa', 'account_type' => AccountTypeEnum::Safe]);
        Account::create(['name' => 'İtimat Yoğurt', 'account_type' => AccountTypeEnum::Account]);
    }
}
