<?php

/*
======================================================
===認証済みアカウントがアクセスできるページへの処理=======
======================================================
*/

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\User;
use App\Laboratory;
use App\Univ_data;
use App\lab_evaluation;
use App\Faculty_logo;
use App\Prefecture_image;
use Validator;
use Auth;

class LabController extends Controller
{
    //ログイン認証後にのみ表示
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    //研究室情報を追加する
    public function store(Request $request)
    {

        $query = Laboratory::query();

        $validator = Validator::make($request->all(), [
            'lab_univ' => 'required|min:3|max:16',
            'lab_faculty' => 'required|min:3|max:32',
            'lab_department' => 'required|min:3|max:32',
            'lab_name' => 'required|min:3|max:32|unique:laboratories,lab_name,NULL,lab_univ,lab_univ,' . $request->input('lab_univ')
            //'lab_department'と'lab_name'の2つのカラムを1つとしてユニークとする方法
            //とりあえず'lab_department'は一旦uniqueチェックせず、'lab_name'の方で「'lab_department'が$request->input('lab_univ')、
            //かつその中で'lab_univ'がunique」というチェックをすればよい
        ]);
        //バリテーション:エラー
        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withError($validator);
        }

        //研究室のDBにデータを格納
        //Eloquentモデル (=MySQL記述なしにデータベース管理をしてくれる)
        $today = date("Y/m/d");  //現在時刻の取得

        $laboratories = new Laboratory;
        $laboratories->user_id = Auth::user()->id;
        $laboratories->lab_univ = $request->lab_univ;
        $laboratories->lab_faculty = $request->lab_faculty;
        $laboratories->lab_department = $request->lab_department;
        $laboratories->lab_name = $request->lab_name;
        $laboratories->add_time = $today;
        $laboratories->save();
        return redirect('/');
    }

    //研究室追加画面へ移動
    public function mv_add()
    {
        $all_prefectures = [
            "北海道", "青森県", "秋田県", "山形県", "岩手県", "宮城県", "福島県",
            "東京都", "神奈川県", "埼玉県", "千葉県", "栃木県", "茨城県", "群馬県",
            "愛知県", "岐阜県", "静岡県", "三重県", "新潟県", "山梨県", "長野県", "石川県", "富山県", "福井県",
            "大阪府", "兵庫県", "京都府", "滋賀県", "奈良県", "和歌山県",
            "岡山県", "広島県", "鳥取県", "島根県", "山口県", "香川県", "徳島県", "愛媛県", "高知県",
            "福岡県", "佐賀県", "長崎県", "熊本県", "大分県", "宮崎県", "鹿児島県", "沖縄県",
        ];
        return view('add', [
            'all_prefectures' => $all_prefectures,
        ]);
    }

    //更新画面へ移動
    public function mv_update($lab_evaluation_id)
    {

        $lab_evaluation = lab_evaluation::where('id', $lab_evaluation_id)->first();

        $laboratory = Laboratory::where('lab_univ', $lab_evaluation->lab_univ)->where('lab_name', $lab_evaluation->lab_name)->first();

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

        return view('labedit', [
            'lab_evaluation' => $lab_evaluation,
            'evaluation_array' => $evaluation_array,
            'eachtitle_array' => $eachtitle_array
        ]);
    }

    //更新処理
    public function update(Request $request)
    {
        $rules = [
            'content' => 'required|min:50',
        ];

        $messages = [
            'content.required' => '口コミを入力してください。',
            'content.min' => '50文字以上で入力してください。',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        $userID = Auth::user()->id;
        if ($validator->fails()) {
            return redirect('/mypage/' . $userID)
                ->withErrors($validator)
                ->withInput();
        }

        //研究室のDBにデータを格納
        //Eloquentモデル (=MySQL記述なしにデータベース管理をしてくれる)
        $today = date("Y-m-d");   //現在時刻の取得

        $lab_evaluation = lab_evaluation::where('id', $request->id);
        $lab_evaluation->user_id = Auth::user()->id;
        $lab_evaluation->lab_name = $request->lab_name;
        $lab_evaluation->lab_univ = $request->lab_univ;

        //研究室の口コミの編集
        if (isset($request->objobtype)) {
            $tmp = $request->objobtype;
        } else {
            $tmp = "";
        }
        \DB::table('lab_evaluation')->where('id', $request->id)->update([
            /*教授について*/
            'prof_care' => $request->prof_care,
            'prof_friendly' => $request->prof_friendly,
            'prof_jobhunt' => $request->prof_jobhunt,
            'prof_network' => $request->prof_network,
            'prof_experience' => $request->prof_experience,
            'prof_average' => ($request->prof_friendly + $request->prof_care + $request->prof_jobhunt +
                    $request->prof_network + $request->prof_experience) / 5.0,
            /*就活について*/
            'job_major' => $request->job_major,
            'job_small' => $request->job_small,
            'job_jobhunt' => $request->job_jobhunt,
            'job_recommendation' => $request->job_recommendation,
            'job_reserch' => $request->job_reserch,
            'job_average' => ($request->job_major + $request->job_small + $request->job_jobhunt +
                    $request->job_recommendation + $request->job_reserch) / 5.0,
            /*研究室について*/
            'lab_restraint' => $request->lab_restraint,
            'lab_event' => $request->lab_event,
            'lab_free' => $request->lab_free,
            'lab_advice' => $request->lab_advice,
            'lab_communication' => $request->lab_communication,
            'lab_popularity' => $request->lab_popularity,
            'lab_average' => ($request->lab_restraint + $request->lab_event + $request->lab_free +
                    $request->lab_advice + $request->lab_communication + $request->lab_popularity) / 6.0,
            /*その他*/
            'other_skill' => $request->other_skill,
            'other_fac' => $request->other_fac,
            'other_regret' => $request->other_regret,
            'other_international' => $request->other_international,
            'other_gender' => $request->other_gender,
            'other_average' => ($request->other_skill + $request->other_fac + $request->other_regret +
                    $request->other_international + $request->other_gender) / 5.0,
            /*他*/
            'all_average' => (
                    ($request->prof_friendly + $request->prof_care + $request->prof_jobhunt + $request->prof_network + $request->prof_experience) / 5.0
                    + ($request->job_major + $request->job_small + $request->job_jobhunt + $request->job_recommendation + $request->job_reserch) / 5.0
                    + ($request->lab_restraint + $request->lab_event + $request->lab_free + $request->lab_advice + $request->lab_communication + $request->lab_popularity) / 6.0
                    + ($request->other_skill + $request->other_fac + $request->other_regret + $request->other_international + $request->other_gender) / 5.0
                ) / 4.0,

            'objobtype' => $tmp,
            'content' => $request->content,

            'add_time' => $today,

        ]);
        return redirect(url('mypage'));
    }

    //削除処理
    public function delete(lab_evaluation $lab_evaluation_id)
    {
        $user = Auth::user();
        $lab_evaluation_id->delete();
        return redirect(url('mypage/' . $user->name));
    }

    //トークンによる口コミ投稿
    public function add_review($token)
    {

        return view('labedit', [
            'lab_evaluation' => $lab_evaluation,
            'evaluation_array' => $evaluation_array,
        ]);

    }
}
