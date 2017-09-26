<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsTitleTable extends Migration
{
    /**
     * Run the migrations.
     * For creating tbl_accounts
     * This table stores accounts titles and accounts type
     * @return void
     */
    public function up()
    {
        //
        Schema::create('tbl_accounts',function(Blueprint $table){
        	$table->increments('accounts_id');
        	$table->string('accounts_title',250);
        	$table->integer('accounts_type')->comment('1=assets 2=liabilities 3=income 4=expense 5=owner');
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
        //
        Schema::drop('tbl_accounts');
    }
}
