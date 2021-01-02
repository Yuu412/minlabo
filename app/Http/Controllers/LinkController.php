<?php

/*
===============================================================
===認証していないアカウントがアクセスできるページへの処理=======
===============================================================
*/

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Univ_data;
use App\Laboratory;
use App\lab_evaluation;
use App\Faculty_logo;
use App\Prefecture_image;
use Validator;
use Auth;

class LinkController extends Controller
{
    //トップページに戻る
    public function to_index()
    {
        return view('laboratories');
    }

    //研究室の追加ページ１へ
    public function to_add(){
      $token = uniqid(rand(100, 999));
      $all_prefectures = [
              "北海道", "青森県", "秋田県", "山形県", "岩手県", "宮城県", "福島県",
              "東京都", "神奈川県", "埼玉県", "千葉県", "栃木県", "茨城県", "群馬県",
              "愛知県", "岐阜県", "静岡県", "三重県", "新潟県", "山梨県", "長野県", "石川県", "富山県", "福井県",
              "大阪府", "兵庫県", "京都府", "滋賀県", "奈良県", "和歌山県",
              "岡山県", "広島県", "鳥取県", "島根県", "山口県", "香川県", "徳島県", "愛媛県", "高知県",
              "福岡県", "佐賀県", "長崎県", "熊本県", "大分県", "宮崎県", "鹿児島県", "沖縄県",
      ];
      return view('add',[
        'token' => $token,
        'all_prefectures' => $all_prefectures,
      ]);
    }

    //QRコードから研究室の追加ページ１へ
    public function qr_to_add($qr_token){
      $token = $qr_token;
      $all_prefectures = [
              "北海道", "青森県", "秋田県", "山形県", "岩手県", "宮城県", "福島県",
              "東京都", "神奈川県", "埼玉県", "千葉県", "栃木県", "茨城県", "群馬県",
              "愛知県", "岐阜県", "静岡県", "三重県", "新潟県", "山梨県", "長野県", "石川県", "富山県", "福井県",
              "大阪府", "兵庫県", "京都府", "滋賀県", "奈良県", "和歌山県",
              "岡山県", "広島県", "鳥取県", "島根県", "山口県", "香川県", "徳島県", "愛媛県", "高知県",
              "福岡県", "佐賀県", "長崎県", "熊本県", "大分県", "宮崎県", "鹿児島県", "沖縄県",
      ];

      return view('add',[
        'token' => $token,
        'all_prefectures' => $all_prefectures,
      ]);
    }

    //研究室の評価を追加するページへ
    public function to_add_evaluation($lab_details_univ, $lab_details_lab)
    {
        $lab_details = [$lab_details_univ, $lab_details_lab];

        $lab_evaluation = lab_evaluation::find($lab_details[0]);
        $laboratory = Laboratory::where('lab_univ', $lab_details[0])->where('lab_name', $lab_details[1])->first();

        $token = uniqid(rand(100, 999));

        $faculty_lib_array = [
            "文学部", "教育学部", "経済学部", "経営学部", "商学部",
            "社会学部", "法学部", "外国語学部", "国際学部", "体育学部",
            "福祉学部", "芸術学部", "観光学部", "神学部", "総合政策学部",
            "音楽学部", "文系その他"
        ];
        $faculty_sci_array = [
            "理学部", "工学部", "理工学部", "情報学部", "農学部", "医学部",
            "看護学部", "薬学部", "歯学部", "建築学部", "海洋学部",
            "スポーツ健康科学部", "芸術工学部", "生命科学部", "理系その他"
        ];

        $lib = in_array($laboratory->lab_faculty, $faculty_lib_array);
        $sci = in_array($laboratory->lab_faculty, $faculty_sci_array);

        if ($lib) {
            $prof_array = [
                "面倒見の良さ" => "prof_care",
                "熱意を持って接してくれる" => "prof_friendly",
                "就活イベント・選考会参加への理解" => "prof_jobhunt",
                "学外での人脈" => "prof_network",
                "教授の社会経験（人事経験など）" => "prof_experience"
            ];
            $jobhunt_array = [
                "大手に強いか" => "job_major",
                "就活に対するサポート（面札対策とかes添削）" => "job_small",
                "就活に十分な時間を充てられるか" => "job_jobhunt",
                "企業へのコネ・推薦" => "job_recommendation",
                "就活で活かせるスキルが身につくか" => "job_reserch"
            ];
            $lab_array = [
                "拘束時間の満足度" => "lab_restraint",
                "課外活動の頻度" => "lab_free",
                "研究テーマの設定の自由度" => "lab_advice",
                "ゼミのみの頻度" => "lab_event",
                "プライべートの交流" => "lab_communication",
                "ゼミ・研究室の人気度" => "lab_popularity"
            ];
            $other_array = [
                "英語を使用する頻度" => "other_skill",
                "講義形式" => "other_fac",
                "ゼミ･研究室選択の満足度" => "other_regret",
                "国際的な活動の頻度" => "other_international",
                "男女比の割合" => "other_gender",
            ];
        } else {
            $prof_array = [
                "面倒見の良さ" => "prof_care",
                "熱意を持って接してくれる" => "prof_friendly",
                "就活イベント・選考会参加への理解" => "prof_jobhunt",
                "学外での人脈" => "prof_network",
                "教授の社会人経験(人事経験など)" => "prof_experience"
            ];
            $jobhunt_array = [
                "大手に強いか" => "job_major",
                "中小・ベンチャーに強いか" => "job_small",
                "就活に十分な時間を充てられる" => "job_jobhunt",
                "企業へのコネ・推薦" => "job_recommendation",
                "研究内容が就活で活かせそうか" => "job_reserch"
            ];
            $lab_array = [
                "拘束時間の満足度" => "lab_restraint",
                "課外活動の頻度(例：勉強会・イベント)" => "lab_event",
                "研究テーマ設定の自由度" => "lab_free",
                "研究に関する上回生からのアドバイス" => "lab_advice",
                "メンバー間の仲の良さ" => "lab_communication",
                "ゼミ・研究室の人気度" => "lab_popularity"
            ];
            $other_array = [
                "スキル・専門性が身に付く" => "other_skill",
                "ゼミ・研究室の設備の充実度" => "other_fac",
                "ゼミ・研究室選択の後悔" => "other_regret",
                "国際的な活動の頻度" => "other_international",
                "男女比の割合" => "other_gender"
            ];
        }

        //各配列をまとめる配列
        $evaluation_array = [
            '教授について' => $prof_array,
            '就活について' => $jobhunt_array,
            '研究室について' => $lab_array,
            'その他' => $other_array
        ];

        /*各項目のタイトルにあたる配列*/
        $eachtitle_array = ["教授について", "就活について", "研究室について", "その他"];

        return view('add_evaluation', [
            'token' => $token,
            'lab_details' => $lab_details,
            'lab_evaluation' => $lab_evaluation,
            'evaluation_array' => $evaluation_array,
            'eachtitle_array' => $eachtitle_array
        ]);
    }

}
