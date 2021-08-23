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

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Position::create(['name' => 'Garson', 'default_price' => 3500]);
        Position::create(['name' => 'Komi', 'default_price' => 2500]);

        $fatih = Branch::create(['name' => 'Fatih']);
        $sefakoy = Branch::create(['name' => 'Sefaköy']);

        $account = new Account([
            'name' => $fatih->name,
            'account_type' => AccountTypeEnum::Branch,
        ]);
        $account->accountable()->associate($fatih);
        $account->save();

        $account = new Account([
            'name' => $sefakoy->name,
            'account_type' => AccountTypeEnum::Branch,
        ]);
        $account->accountable()->associate($sefakoy);
        $account->save();

        $manav = Tag::create(['name' => 'Manav', 'collection' => 'product']);
        Tag::create(['name' => 'Rutin', 'collection' => 'product']);

        $itimat = Account::create(['name' => 'İtimat Yoğurt', 'account_type' => AccountTypeEnum::Account]);

        $domates = Product::create(['title' => 'Domates', 'unit' => UnitEnum::KG]);

        $domates->tags()->attach($manav);
        $domates->accounts()->attach($itimat);
    }
}
