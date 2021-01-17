<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Laboratory;
use App\Univ_data;
use App\lab_evaluation;
use App\Faculty_logo;
use App\Prefecture_image;
use Auth;

class IndexController extends Controller
{
    //ログイン認証後にのみ表示
    public function __construct()
    {
        $this->middleware('auth');
    }

    //研究室一覧表示
    public function index()
    {
      //県の画像を取得
      $prefecture_images = Prefecture_image::get();

      //メインの県名を定義し、その画像名を取得
      $main_prefectures = [
          ["name" => "東京都"],
          ["name" => "大阪府"],
          ["name" => "愛知県"],
          ["name" => "神奈川県"],
          ["name" => "京都府"],
          ["name" => "福岡県"],
      ];
      for ($i = 0; $i < count($main_prefectures); $i++) {
          $main_prefecture = $main_prefectures[$i];
          $index = array_search($main_prefecture["name"], array_column($prefecture_images->toArray(), "prefecture_name"));
          $main_prefectures[$i]["image"] = $prefecture_images[$index]->prefecture_filename;
      }

      //全県名を定義
      $all_prefectures = [
          [
              "category" => "北海道・東北",
              "prefectures" => ["北海道", "青森県", "秋田県", "山形県", "岩手県", "宮城県", "福島県"]
          ],
          [
              "category" => "関東",
              "prefectures" => ["東京都", "神奈川県", "埼玉県", "千葉県", "栃木県", "茨城県", "群馬県"]
          ],
          [
              "category" => "中部",
              "prefectures" => ["愛知県", "岐阜県", "静岡県", "三重県", "新潟県", "山梨県", "長野県", "石川県", "富山県", "福井県"]
          ],
          [
              "category" => "関西",
              "prefectures" => ["大阪府", "兵庫県", "京都府", "滋賀県", "奈良県", "和歌山県"]
          ],
          [
              "category" => "中国・四国",
              "prefectures" => ["岡山県", "広島県", "鳥取県", "島根県", "山口県", "香川県", "徳島県", "愛媛県", "高知県"]
          ],
          [
              "category" => "九州・沖縄",
              "prefectures" => ["福岡県", "佐賀県", "長崎県", "熊本県", "大分県", "宮崎県", "鹿児島県", "沖縄県"]
          ],
      ];

      //学部のロゴを取得
      $faculty_logos = Faculty_logo::get();

      //学部名を定義し、そのロゴ画像を取得
      $faculties = [
          [
              "category" => "文系学部",
              "faculty_names" => [
                  ["name" => "法学部"],
                  ["name" => "経済学部"],
                  ["name" => "文学部"],
                  ["name" => "教育学部"],
                  ["name" => "外国語学部"],
                  ["name" => "その他"]
              ]
          ],
          [
              "category" => "理系学部",
              "faculty_names" => [
                  ["name" => "理学部"],
                  ["name" => "工学部"],
                  ["name" => "農学部"],
                  ["name" => "医学部"],
                  ["name" => "薬学部"],
                  ["name" => "その他"]
              ]
          ],
      ];
      for ($i = 0; $i < count($faculties); $i++) {
          $faculty_names = $faculties[$i]["faculty_names"];
          for ($j = 0; $j < count($faculty_names); $j++) {
              $faculty = $faculty_names[$j];
              $index = array_search($faculty["name"], array_column($faculty_logos->toArray(), "faculty_name"));
              if($faculty["name"] == "その他"){
                $index = array_search("その他(文系)", array_column($faculty_logos->toArray(), "faculty_name"));
              }
                $faculties[$i]["faculty_names"][$j]["image"] = $faculty_logos[$index]->faculty_filename;
          }
      }

      /* ↓↓ 新着口コミ ↓↓ */
      $latest_evaluation_collection = collect([]);
      $latest_evaluations = lab_evaluation::latest()->take(5)->get();
      foreach ($latest_evaluations as $lab_evaluation) {
        $laboratory = Laboratory::find($lab_evaluation->lab_id);
        $university = Univ_data::find($lab_evaluation->univ_id);

        $univ_name = $university->univ_name;
        $prefecture_image = Prefecture_image::find($university->prefecture_id)->prefecture_filename;
        $faculty_name = Faculty_logo::find($laboratory->faculty_id)->faculty_name;
        $lab_name = $laboratory->lab_name;

        $latest_evaluation_collection = $latest_evaluation_collection->concat([
          [
            'univ_name' => $univ_name,
            'prefecture_image' => $prefecture_image,
            'faculty_name' => $faculty_name,
            'lab_name' => $lab_name,
            'prof_stars' => round($lab_evaluation->prof_average*2, 0) / 2,
            'job_stars' => round($lab_evaluation->job_average*2, 0) / 2,
            'lab_stars' => round($lab_evaluation->lab_average*2, 0) / 2,
            'other_stars' => round($lab_evaluation->other_average*2, 0) / 2,
          ],
        ]);
      }

      /* ↓↓ 総合評価ランキング ↓↓ */
      $ranking_evaluation_collection = collect([]);
      $ranking_evaluations = lab_evaluation::groupby('lab_id')->orderBy('all_average', 'desc')->take(5)->get();
      foreach ($ranking_evaluations as $lab_evaluation) {
        $laboratory = Laboratory::find($lab_evaluation->lab_id);
        $university = Univ_data::find($lab_evaluation->univ_id);

        $univ_name = $university->univ_name;
        $prefecture_image = Prefecture_image::find($university->prefecture_id)->prefecture_filename;
        $faculty_name = Faculty_logo::find($laboratory->faculty_id)->faculty_name;
        $lab_name = $laboratory->lab_name;

        $ranking_evaluation_collection = $ranking_evaluation_collection->concat([
          [
            'univ_name' => $univ_name,
            'prefecture_image' => $prefecture_image,
            'faculty_name' => $faculty_name,
            'lab_name' => $lab_name,
            'prof_stars' => round($lab_evaluation->where('lab_id', $lab_evaluation->lab_id)->avg('prof_average')*2, 0) / 2,
            'job_stars' => round($lab_evaluation->where('lab_id', $lab_evaluation->lab_id)->avg('job_average')*2, 0) / 2,
            'lab_stars' => round($lab_evaluation->where('lab_id', $lab_evaluation->lab_id)->avg('lab_average')*2, 0) / 2,
            'other_stars' => round($lab_evaluation->where('lab_id', $lab_evaluation->lab_id)->avg('other_average')*2, 0) / 2,
            'all_average' => round($lab_evaluation->where('lab_id', $lab_evaluation->lab_id)->avg('all_average')*2, 0) / 2,
          ],
        ]);
      }

      return view('laboratories',[
        'main_prefectures' => $main_prefectures,
        'all_prefectures' => $all_prefectures,
        'faculties' => $faculties,
        'ranking_evaluation_collection' => $ranking_evaluation_collection,
        'latest_evaluation_collection' => $latest_evaluation_collection,

      ]);
    }
}
