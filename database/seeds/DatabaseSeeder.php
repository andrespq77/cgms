<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call([
             UsersTableSeeder::class,
             ProvinceTableSeeder::class,
             UniversityTableSeeder::class,
             CategoryTableSeeder::class,
             CoursetypeTableSeeder::class
         ]);
    }
}
