<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    public function run()
    {
<<<<<<< Updated upstream
        $univ_array = [
          "東京大学","山形大学","北海道大学","徳島大学","島根大学","東北大学",
          "岡山大学","鳥取大学","新潟大学","熊本大学","佐賀大学","九州大学",
          "神戸大学","大阪大学","京都大学","関西大学","慶應大学","早稲田大学",
          "岡山理科大学","香川大学","愛媛大学","高知大学","広島大学","近畿大学",
        ];

        $fac_array = [
          "工学部","理学部","医学部","薬学部","環境理工学部","看護学部","理工学部",
          "文学部","経済学部","経営学部","法学部","GDP学部","国際教養学部","国際コミュニケーション学部",
        ];

        $department_array = [
          "物理学科","数学科","情報系学科","土木工学科","電気工学科","化学科","医学科","機械システム系学科","天文学科",
          "英語学科","ドイツ語学科","教養学科","国際法学科","政治学科","経営学科","マーケティング学科","商学科","法学科",
        ];
=======
>>>>>>> Stashed changes

        for ($i = 1; $i < 21; $i++)
        {
          $random_date = [rand(2017, 2019), rand(1, 12), rand(1,31)];

<<<<<<< Updated upstream
          if(checkdate($random_date[1], $random_date[2], $random_date[0])){
=======
          if(!checkdate($random_date[1], $random_date[2], $random_date[0])){
>>>>>>> Stashed changes
            $random_date = [rand(2017, 2019), rand(1, 12), 1];
          }

          DB::table('users')->insert([
              [
                  'email'              => $i.'wakabayashi@example.com',
                  'password'           => Hash::make('password'),
                  'role'               => 10,
<<<<<<< Updated upstream
                  'univ_name'          => $univ_array[rand(0, 23)],
                  'faculty_name'       => $fac_array[rand(0, 13)],
                  'department_name'    => $department_array[rand(0, 17)],
=======
>>>>>>> Stashed changes
                  'created_at'         => new DateTime($random_date[0].'-'.$random_date[1].'-'.$random_date[2]),
                  'updated_at'         => new DateTime($random_date[0].'-'.$random_date[1].'-'.$random_date[2]),
                  'token'              => str_random(15),
                  'email_verify_token' => str_random(15),
                  'status'             => 1,
              ],
          ]);
      }
<<<<<<< Updated upstream
      DB::table('users')->insert([
          [
              'email'              => 'test@test.com',
              'password'           => '$2y$10$1ACnaJ4/E1oO8V7alQ1uqOH/Al/plPDW4aok6a6UrK5Q9bBqtG/vi',
              'role'               => 10,
              'univ_name'          => $univ_array[rand(0, 23)],
              'faculty_name'       => $fac_array[rand(0, 13)],
              'department_name'    => $department_array[rand(0, 17)],
=======
      //テストユーザーの作成
      DB::table('users')->insert([
          [
              'email'              => 'test@test.com',
              'password'           => Hash::make('password'),
              'role'               => 10,
>>>>>>> Stashed changes
              'created_at'         => new DateTime(),
              'updated_at'         => new DateTime(),
              'token'              => str_random(15),
              'email_verify_token' => str_random(15),
              'status'             => 1,
          ],
      ]);
    }
}
