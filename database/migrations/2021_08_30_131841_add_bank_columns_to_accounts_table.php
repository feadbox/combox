<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBankColumnsToAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accounts', function (Blueprint $table) {
            $table->string('bank_account_name')->nullable()->after('phone');
            $table->string('bank_account_iban')->nullable()->after('bank_account_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('accounts', function (Blueprint $table) {
            $table->dropColumn('bank_account_name');
            $table->dropColumn('bank_account_iban');
        });
    }
}
