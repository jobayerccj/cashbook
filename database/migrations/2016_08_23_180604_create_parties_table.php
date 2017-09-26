<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_parties', function (Blueprint $table) {
            $table->increments('party_id');
            $table->string('party_name',255);
            $table->string('party_email',255);
            $table->string('party_phone',255);
            $table->text('party_address');
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
        Schema::table('tbl_parties', function (Blueprint $table) {
            Schema::drop('tbl_parties');
        });
    }
}
