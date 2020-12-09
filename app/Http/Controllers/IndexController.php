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
                $faculties[$i]["faculty_names"][$j]["image"] = $faculty_logos[$index]->faculty_filename;
            }
        }

        //研究室の評価を取得
        $lab_evaluations = lab_evaluation::orderBy("updated_at", "desc")->get();

        //研究室の情報を取得
        $laboratories = Laboratory::get();

        //大学の情報を取得
        $universities = Univ_data::get();

        //研究室の新着口コミのデータを作成
        $new_evaluations = [];
        foreach (array_slice($lab_evaluations->toArray(), 0, 5) as $lab_evaluation) {
            $id = $lab_evaluation['id'];

            $laboratory_data  = Laboratory::find($lab_evaluation['lab_id']);
            $university_data  = Univ_data::find($lab_evaluation['univ_id']);

           $laboratory_name =  $laboratory_data->lab_name;
           $university_name =  $university_data->univ_name;
            //研究室の学部を取得
            $faculty_name = "";
            foreach ($laboratories as $laboratory) {
                if ($laboratory->lab_name === $laboratory_name && $laboratory->lab_univ === $university_name) {
                    $faculty_name = $laboratory->lab_faculty;
                }
            }

            //研究室の県を取得
            $prefecture_id = $university_data->prefecture_id;
            $prefecture_name = Prefecture_image::find($prefecture_id)->prefecture_name;

            //県の画像を取得
            $index = array_search($prefecture_name, array_column($prefecture_images->toArray(), "prefecture_name"));
            $prefecture_image = $prefecture_images[$index]->prefecture_filename;

            //研究室の評価を取得
            $evaluation_items = [
                "professor" => $lab_evaluation['prof_average'],
                "job" => $lab_evaluation['job_average'],
                "atmosphere" => $lab_evaluation['lab_average'],
                "other" => $lab_evaluation['other_average']
            ];

            $new_evaluations[] = [
                "id" => $id,
                "prefecture_image" => $prefecture_image,
                "laboratory_name" => $laboratory_name,
                "university_name" => $university_name,
                "faculty_name" => $faculty_name,
                "evaluation_items" => $evaluation_items
            ];
        }

        //高評価(all_averageが高い)の研究室を取得
        $sort = [];
        foreach ($lab_evaluations as $key => $value) {
            $sort[$key] = $value["all_average"];
        }
        $high_evaluate_laboratories = $lab_evaluations->toArray();
        array_multisort($sort, SORT_DESC, $high_evaluate_laboratories);

        //高評価の研究室の口コミデータを作成
        $high_evaluations = [];
        foreach (array_slice($high_evaluate_laboratories, 0, 5) as $lab_evaluation) {
            $id = $lab_evaluation['id'];

            $laboratory_data  = Laboratory::find($lab_evaluation['lab_id']);
            $university_data  = Univ_data::find($lab_evaluation['univ_id']);

            $laboratory_name =  $laboratory_data->lab_name;
            $university_name =  $university_data->univ_name;

            //研究室の学部を取得
            $faculty_name = "";
            foreach ($laboratories as $laboratory) {
                if ($laboratory->lab_name === $laboratory_name && $laboratory->lab_univ === $university_name) {
                    $faculty_name = $laboratory->lab_faculty;
                }
            }

            //研究室の県を取得
            $prefecture_id = $university_data->prefecture_id;
            $prefecture_name = Prefecture_image::find($prefecture_id)->prefecture_name;

            //県の画像を取得
            $index = array_search($prefecture_name, array_column($prefecture_images->toArray(), "prefecture_name"));
            $prefecture_image = $prefecture_images[$index]->prefecture_filename;

            //研究室の評価を取得
            $evaluation_items = [
                "professor" => $lab_evaluation['prof_average'],
                "job" => $lab_evaluation['job_average'],
                "atmosphere" => $lab_evaluation['lab_average'],
                "other" => $lab_evaluation['other_average']
            ];

            $high_evaluations[] = [
                "id" => $id,
                "prefecture_name" => $prefecture_name,
                "prefecture_image" => $prefecture_image,
                "laboratory_name" => $laboratory_name,
                "university_name" =>  $university_name,
                "faculty_name" => $faculty_name,
                "evaluation_items" => $evaluation_items
            ];
        }

        $tmp = 1;
        return view('laboratories', [
            'main_prefectures' => $main_prefectures,
            'all_prefectures' => $all_prefectures,
            'faculties' => $faculties,
            'new_evaluations' => $new_evaluations,
            'high_evaluations' => $high_evaluations,

            'tmp' => $tmp,
        ]);
    }
}
