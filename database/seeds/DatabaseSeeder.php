<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
      $this->call([
        Lab_evaluationTableSeeder::class,
        LaboratoriesTableSeeder::class,
        Univ_dataTableSeeder::class,
        Prefecture_imagesTableSeeder::class,
        Faculty_logosTableSeeder::class,
        DepartmentTableSeeder::class,
        UsersTableSeeder::class,
     ]);
    }
}
