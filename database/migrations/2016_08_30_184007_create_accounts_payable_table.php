<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsPayableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_accounts_payables', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('party_id');
            $table->integer('accounts_credited');
            $table->date('expected_payments_date');
            $table->float('total_amount');
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tbl_accounts_payables');
    }
}
