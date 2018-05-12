<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*$this->call([
          //LanguageTableSeeder::class,
          UsersTableSeeder::class
        ]);*/

        //create dummy data for cashflow
        $faker = Faker::create();
        foreach (range(1,100) as $index) {

            DB::table('cashflow')->insert([
                'name' => $faker->sentence(6, true),
                'description' => $faker->text,
                'flow_type' => $faker->randomElement(array ('1','2')),
                'amount' => $faker->numberBetween(1000, 9000),
                'created_at' => $faker->dateTimeThisYear('now', 'UTC') 
            ]);
        }
    }
}