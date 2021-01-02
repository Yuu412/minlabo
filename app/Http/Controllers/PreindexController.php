<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Univ_data;
use App\lab_evaluation;
use App\Prefecture_image;

class PreindexController extends Controller
{
    //ログインしていないときのトップページに移す処理
    public function preindex()
    {
        $prefectures_array = [
            "北海道・東北" => [
              "北海道", "青森県", "秋田県", "山形県", "岩手県", "宮城県", "福島県"
            ],
            "関東・中部" => [
              "東京都", "神奈川県", "埼玉県", "千葉県", "栃木県", "茨城県", "群馬県", "愛知県",
              "岐阜県", "静岡県", "三重県", "新潟県", "山梨県", "長野県", "石川県", "富山県", "福井県"
            ],
            "近畿" => [
              "大阪府", "兵庫県", "京都府", "滋賀県", "奈良県", "和歌山県"
            ],
            "中国・四国" => [
              "岡山県", "広島県", "鳥取県", "島根県", "山口県", "香川県", "徳島県", "愛媛県", "高知県"
            ],
            "九州" => [
              "福岡県", "佐賀県", "長崎県", "熊本県", "大分県", "宮崎県", "鹿児島県", "沖縄県"
            ],
        ];

        $areas = [
            ["name" => "北海道・東北", "count" => 0],
            ["name" => "関東・中部", "count" => 0],
            ["name" => "近畿", "count" => 0],
            ["name" => "中国・四国", "count" => 0],
            ["name" => "九州", "count" => 0],
        ];

        $tmp = [];
        $university_ids = lab_evaluation::get('univ_id');
        foreach ($university_ids as $university_id) {
            $prefecture_id = Univ_data::find($university_id->univ_id)->prefecture_id;
            $area_name = Prefecture_image::find($prefecture_id)->area_name;
            array_push($tmp, $area_name);

            if(is_null($area_name)) continue;

            foreach ($areas as $area) {
              if(strcmp($area['name'], $area_name) == 0)  {
                $index = array_search($area_name, array_column($areas, "name"));
                $areas[$index]['count']++;
              }
            }
        }

        return view('top', [
          'areas' => $areas,
          'tmp' => $tmp,
        ]);
    }
}
