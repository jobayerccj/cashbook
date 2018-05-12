<?php

use Illuminate\Database\Seeder;

class LanguageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('languages')->insert([
          'name' => 'English',
          'code' => 'en',
          'script' => 'Latn',
          'regional' => 'en_GB',
          'native' => 'English'
      ]);
    }
}
