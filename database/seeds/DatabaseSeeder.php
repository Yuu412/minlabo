<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
      $this->call([
       UsersTableSeeder::class,
       LaboratoriesTableSeeder::class,
       Lab_evaluationTableSeeder::class,
       Univ_dataTableSeeder::class,
       Faculty_logosTableSeeder::class,
       Prefecture_imagesTableSeeder::class,
     ]);
    }
}
