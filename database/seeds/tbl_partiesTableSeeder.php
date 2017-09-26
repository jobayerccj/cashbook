<?php

use Illuminate\Database\Seeder;

class tbl_partiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_parties')->insert([
            'party_name' => str_random(10),
            'party_email' => str_random(10).'@gmail.com',
            'party_address' => str_random(30),
        ]);
    }
}
