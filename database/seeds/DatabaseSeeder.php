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
        Fac_logosTableSeeder::class,
        Pre_imagesTableSeeder::class,
      ]);
    }
}
