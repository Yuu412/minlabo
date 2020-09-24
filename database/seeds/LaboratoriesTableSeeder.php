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
      $univ_array = [
        "東京大学","山形大学","北海道大学","徳島大学","島根大学",
        "岡山大学","鳥取大学","新潟大学","熊本大学","佐賀大学",
        "神戸大学","大阪大学","京都大学","関西大学","慶應大学",
        "岡山理科大学","香川大学","愛媛大学","高知大学","広島大学",
        "東北大学","近畿大学","九州大学","早稲田大学","甲南大学",
      ];

      $fac_array = [
        "工学部","理学部","医学部","薬学部","環境理工学部",
        "文学部","経済学部","経営学部","法学部","GDP学部",
        "看護学部","理工学部","国際教養学部","国際学部","理学部",
        "文学部","経済学部","経営学部","法学部","GDP学部",
        "工学部","理学部","医学部","薬学部","環境理工学部",
      ];

      $department_array = [
        "物理学科","数学科","情報系学科","土木工学科","電気工学科",
        "化学科","医学科","機械システム系学科","天文学科","情報系学科",
        "英語学科","ドイツ語学科","教養学科","国際法学科","政治学科",
        "経営学科","マーケティング学科","商学科","法学科","政治学科",
        "英語学科","ドイツ語学科","教養学科","土木工学科","電気工学科",
      ];

      $lab_array = [
        "佐藤研究室","谷口研究室","田中研究室","神戸研究室","中田研究室",
        "斎藤研究室","神谷研究室","見城研究室","南波研究室","梶崎研究室",
        "服部研究室","坂口研究室","田口研究室","高橋研究室","清水研究室",
        "新見研究室","南澤研究室","東山研究室","手塚研究室","多田研究室",
        "古賀研究室","六条研究室","灰田研究室","馬場研究室","田中研究室",
      ];

      for ($i = 0; $i < 50; $i++)
      {
        $count = $i;
        if($count > 24){
          $count = $count % 24;
        }

        $random_date = [rand(2017, 2019), rand(1, 12), rand(1,31)];

        DB::table('laboratories')->insert([
          [
            'user_id'        =>  rand(1, 19),
            'lab_univ'       => $univ_array[$count],
            'lab_faculty'    => $fac_array[$count],
            'lab_department' => $department_array[$count],
            'lab_name'       => $lab_array[$count],
            'add_time'       => new DateTime($random_date[0].'-'.$random_date[1].'-'.$random_date[2]),
            'created_at'     => new DateTime($random_date[0].'-'.$random_date[1].'-'.$random_date[2]),
            'updated_at'     => new DateTime($random_date[0].'-'.$random_date[1].'-'.$random_date[2]),
          ],
        ]);
      }
    }
}
