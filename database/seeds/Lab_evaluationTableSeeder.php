<?php

use Illuminate\Database\Seeder;

class Lab_evaluationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $content_array = [
        "大体月に1度くらいで何かしらのイベント（飲み会など）があると思うとイメージしやすい。お金がかかるのと、私的には多すぎるのがダメなところ。 （研究室旅行に関しては教授以外先生、生徒は全く乗り気でない。というのも、一泊二日で3万近くかかり、しかも無難な観光が多くつまらないからだ）",
        "研究をしたいときは行い、したくないときはだらだらしている。このようなスタイルがまかり通る研究室であるため、良く言えば自由、悪く言えば不真面目だ。 もっと真面目に、熱心に研究に取り組んでいるのかなと思ったら、一部の賢い人に大半の生徒がぶら下がってるだけのスタイルである。 （賢い先生および先輩に何したらいいか聞きまくってそれを自分の意見かの如く発表する研究室生がおおすぎ）。 まあ、これはどこの研究室や会社でもそうなのかもしれないが、桑畑研究室は特に見かけ上偉く見せる傾向にあると私は思う（教授譲り）",
        "報告会は研究室全体の前で行うが、形式上は指導教授への研究状況の報告なので教授とのやりとりとなる。 雑誌会も研究室全体の前で行い、自分の研究テーマに関連する論文についてスライドを作って紹介する。 発表後指導教員、学生からの質問に答える形で一人当たり計約25～45分程。",
        "午前中：メールの確認やその日行うことの整理、実験、M1は講義に出席、各自昼休憩、午後：実験の続き、データの整理、夕方から報告会や雑誌会が行われる、18時以降に帰宅になるがその日によってバラバラではある",
        "セミナーはPowerPointで資料を作成し、15-20分で発表する。その後、教員と学生から質問を受ける。土日祝は休み。報告会前などに実験、資料作成など行うために出勤することもあり、年に数回出勤する。研究室内での飲み会が2ヶ月に1回ほどある。研究室旅行は8月に1泊2日でバス旅行に行く。",
        "知能工学研究室と謳っているが、研究テーマは何でもあり。学生のやりたいという気持ちが一番に尊重されており、テーマの選び方によってはプログラミングスキルが乏しくても何とかなる。テーマ与えられるの待ちの学生には苦しい研究室。 自由に自分のやりたいことをのびのびやりたい学生には最高の環境。セミナーは教授の雰囲気もあり和やかだが、研究への指摘内容は鋭く、回答が難しいことが多い。集まる学生は比較的優秀。",
        "定期的に飲み会が開かれる。院試合格祝いや歓送迎会など、理由が有れば飲む。また、花見などを学生が企画することも多い。イベントの開催も自由な雰囲気。就活のアドバンテージは、研究室というより、航空宇宙工学専攻が航空宇宙関連のメーカー(三菱重工、IHI、三菱電機など)とよく繋がっており、推薦枠が多い。",
      ];

      for ($i = 0; $i < 1000; $i++)
      {
          $count = $i % 25;
          $random_date = [rand(2017, 2019), rand(1, 12), rand(1,31)];

          if(!checkdate($random_date[1], $random_date[2], $random_date[0])){
            $random_date = [rand(2017, 2019), rand(1, 12), 1];
          }

          $univ_id = 43 * ($count + 1);
          if($univ_id > 1076){
            $univ_id = $univ_id % 1075;
          }

          if($univ_id == 0){
            $univ_id++;
          }

          $data = [
            'lab_id'       => $count+1,
            'univ_id'       => $univ_id,
            'user_id'        =>  rand(1, 300),
            'prof_care' => rand(1.0, 5.0),
            'prof_friendly' => rand(1.0, 5.0),
            'prof_jobhunt' => rand(1.0, 5.0),
            'prof_network' => rand(1.0, 5.0),
            'prof_experience' => rand(1.0, 5.0),
            'job_major' => rand(1.0, 5.0),
            'job_small' => rand(1.0, 5.0),
            'job_jobhunt' => rand(1.0, 5.0),
            'job_recommendation' => rand(1.0, 5.0),
            'job_reserch' => rand(1.0, 5.0),
            'lab_restraint' => rand(1.0, 5.0),
            'lab_event' => rand(1.0, 5.0),
            'lab_free' => rand(1.0, 5.0),
            'lab_advice' => rand(1.0, 5.0),
            'lab_communication' => rand(1.0, 5.0),
            'lab_popularity' => rand(1.0, 5.0),
            'other_skill' => rand(1.0, 5.0),
            'other_fac' => rand(1.0, 5.0),
            'other_regret' => rand(1.0, 5.0),
            'other_international' => rand(1.0, 5.0),
            'other_gender' => rand(1.0, 5.0),
            'terms' => "",
            'content' => $content_array[rand(0,6)],
            'objobtype' => "1、4、18",
            'token' => str_random(15),
            'created_at'     => new DateTime($random_date[0].'-'.$random_date[1].'-'.$random_date[2]),
            'updated_at'     => new DateTime($random_date[0].'-'.$random_date[1].'-'.$random_date[2]),
          ];
          // その数値を元に計算をして追加する
          $data['prof_average'] = (
              $data['prof_care']
              + $data['prof_friendly']
              + $data['prof_jobhunt']
              + $data['prof_network']
              + $data['prof_experience']
          ) / 5.0;

          $data['job_average'] = (
              $data['job_major']
              + $data['job_small']
              + $data['job_jobhunt']
              + $data['job_recommendation']
              + $data['job_reserch']
          ) / 5.0;

          $data['lab_average'] = (
              $data['lab_event']
              + $data['lab_free']
              + $data['lab_advice']
              + $data['lab_communication']
              + $data['lab_popularity']
          ) / 6.0;

          $data['other_average'] = (
              $data['other_skill']
              + $data['other_fac']
              + $data['other_regret']
              + $data['other_international']
              + $data['other_gender']
          ) / 5.0;

          $data['all_average'] = (
              $data['prof_average']
              + $data['job_average']
              + $data['lab_average']
              + $data['other_average']
          ) / 5.0;

          DB::table('lab_evaluation')->insert([$data]);
        }

    }
}
