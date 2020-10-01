<?php

use Illuminate\Database\Seeder;

class Fac_logosTableSeeder extends Seeder
{
    public function run()
    {
<<<<<<< Updated upstream
        $fac_array = [
=======
        $faculty_array = [
>>>>>>> Stashed changes
          '法学部' => "law.png",
          '経済学部' => "economics.png",
          '文学部' => "literature.png",
          '教育学部' => "education.png",
          '外国語学部' => "foreign.png",
          '理学部' => "science.png",
          '工学部' => "engineering.png",
          '農学部' => "agriculture.png",
          '医学部' => "doctor.png",
          '薬学部' => "pharmacy.png",
          'その他' => "other.png",
        ];

<<<<<<< Updated upstream
        foreach ($fac_array as $key => $fac_imgname)
=======
        foreach ($faculty_array as $key => $faculty_img_name)
>>>>>>> Stashed changes
        {
          DB::table('fac_logos')->insert([
            [
              'fac_name'     => $key,
<<<<<<< Updated upstream
              'fac_logo'     => $fac_imgname,
=======
              'fac_logo'     => $faculty_img_name,
>>>>>>> Stashed changes
              'created_at'   => new DateTime(),
              'updated_at'   => new DateTime(),
            ],
          ]);
        }
    }
}
