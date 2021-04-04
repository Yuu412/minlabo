<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
      $this->call([
/* 公開時にはコメントアウト
        Lab_evaluationTableSeeder::class,
        LaboratoriesTableSeeder::class,
        DepartmentTableSeeder::class,
        UsersTableSeeder::class,
*/
        UsersTableSeeder::class,  
        Univ_dataTableSeeder::class,
        Prefecture_imagesTableSeeder::class,
        Faculty_logosTableSeeder::class,
        Lab_evaluationTableSeeder::class,
     ]);
    }
}
