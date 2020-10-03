<?php

use Illuminate\Database\Seeder;

class Faculty_logosTableSeeder extends Seeder
{
    public function run()
    {
        $faculty_array = [
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

        foreach ($faculty_array as $key => $faculty_img_name)
        {
          DB::table('faculty_logos')->insert([
            [
              'faculty_name'     => $key,
              'faculty_logo'     => $faculty_img_name,
              'created_at'   => new DateTime(),
              'updated_at'   => new DateTime(),
            ],
          ]);
        }
    }
}
