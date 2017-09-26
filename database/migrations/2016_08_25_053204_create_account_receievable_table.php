<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountReceievableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_accounts_receievables',function(Blueprint $table){
            $table->increments('id');
            $table->integer('party_id');
            $table->integer('accounts_debited');
            $table->date('expected_receieving_date');
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
        Schema::drop('tbl_accounts_receievables');
    }
}
