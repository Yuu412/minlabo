<?php

use Illuminate\Database\Seeder;

class LaboratoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $lab_array = [
        "佐藤研究室","谷口研究室","田中研究室","神戸研究室","中田研究室",
        "斎藤研究室","神谷研究室","見城研究室","南波研究室","梶崎研究室",
        "服部研究室","坂口研究室","田口研究室","高橋研究室","清水研究室",
        "新見研究室","南澤研究室","東山研究室","手塚研究室","多田研究室",
        "古賀研究室","六条研究室","灰田研究室","馬場研究室","田中研究室",
      ];

      for ($i = 0; $i < 25; $i++)
      {
        $random_date = [rand(2017, 2019), rand(1, 12), rand(1,31)];

        if(!checkdate($random_date[1], $random_date[2], $random_date[0])){
          $random_date = [rand(2017, 2019), rand(1, 12), 1];
        }

        $univ_id = 43 * ($i + 1);

        DB::table('laboratories')->insert([
          [
            'lab_name'       => $lab_array[$i],
            'univ_id'       => $univ_id,
            'faculty_id'    => rand(1,29),
            'department_id' => rand(1,30),
            'created_at'     => new DateTime($random_date[0].'-'.$random_date[1].'-'.$random_date[2]),
            'updated_at'     => new DateTime($random_date[0].'-'.$random_date[1].'-'.$random_date[2]),
          ],
        ]);
      }
    }
}
