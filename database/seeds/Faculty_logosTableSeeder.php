<?php

use Illuminate\Database\Seeder;

class Faculty_logosTableSeeder extends Seeder
{
    public function run()
    {
        $facultyArray = [
          //文系
          '文学部' => "literature.png",
          '教育学部' => "education.png",
          '経済学部' => "economics.png",
          '経営学部' => "economics.png",
          '商学部' => "economics.png",
          '社会学部' => "social.png",
          '法学部' => "law.png",
          '外国語学部' => "foreign.png",
          "国際学部"  => "foreign.png",
          "体育学部" => "pe.png",
          "福祉学部" => "other.png",
          "芸術学部" => "other.png",
          "観光学部" => "other.png",
          '神学部' => "other.png",
          '総合政策学部' => "other.png",
          '音楽学部' => "other.png",
          'その他(文系)' => "other.png",

          //理系
          '理学部' => "science.png",
          '工学部' => "engineering.png",
          '理工学部' => "engineering.png",
          '情報学部' => "information.png",
          '農学部' => "agriculture.png",
          '医学部' => "doctor.png",
          '看護学部' => "doctor.png",
          '薬学部' => "pharmacy.png",
          '歯学部' => "tooth.png",
          '建築学部' => "other.png",
          '海洋学部' => "other.png",
          'スポーツ健康科学部' => "other.png",
          '芸術工学部' => "other.png",
          '生命科学部' => "other.png",
          'その他(理系)' => "other.png",
        ];

        $humanitiesArray = [
            "文学部", "教育学部", "経済学部", "経営学部", "商学部",
            "社会学部", "法学部", "外国語学部", "国際学部", "体育学部",
            "福祉学部", "芸術学部", "観光学部", "神学部", "総合政策学部",
            "音楽学部", "その他(文系)"
        ];

        $humanitiesOrSciences = ["理系","文系"];

        foreach ($facultyArray as $key => $faculty_img_name)
        {
          $fucultyFlag = 0;
          $fucultyFlag = in_array($key, $humanitiesArray);

          DB::table('faculty_logos')->insert([
            [
              'faculty_name'     => $key,
              'humanities_or_sciences' => $humanitiesOrSciences[$fucultyFlag],
              'faculty_filename' => $faculty_img_name,
              'created_at'   => new DateTime(),
              'updated_at'   => new DateTime(),
            ],
          ]);
        }
    }
}
