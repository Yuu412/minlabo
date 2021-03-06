<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Laboratory;
use App\Univ_data;
use App\lab_evaluation;
use App\Faculty_logo;
use App\Department;
use Validator;
use Auth;

class LabAdditionController extends Controller
{
  //処理：研究室情報を追加
  //遷移先：研究室の評価を記入するページ
  public function add_evaluation(Request $request)
  {
      /*研究室を判別するための"研究室名"と"研究室の所属大学"*/
      $lab_details = [$request->lab_univ, $request->lab_name];
      $token = $request->token;

      $query = Laboratory::query();

      $rules = [
          'lab_univ' => 'required|min:3',
          'lab_faculty' => 'required|min:3|max:32',
          'lab_department' => 'required|min:3|max:32',
          'lab_name' => 'required|min:3|max:32',
      ];
      $messages = [
          'lab_univ.required' => '大学名を選択してください。',
          'lab_univ.min' => '大学名を選択してください。',
          'lab_faculty.required' => '学部を入力して下さい。（例:工学部）',
          'lab_faculty.min' => '1学部を正しく入力してください。（例:工学部）',
          'lab_faculty.max' => '名前は32文字以内で入力してください。',
          'lab_department.required' => '学科を入力してください。（例:情報系学科）',
          'lab_department.min' => '学科を正しく入力してください。（例:情報系学科）',
          'lab_department.max' => '名前は32文字以内で入力してください。',
          'lab_name.required' => 'ゼミ・研究室名を入力してください。（例:佐藤研究室）',
          'lab_name.min' => 'ゼミ・研究室名を正しく入力してください。（例:佐藤研究室）',
          'lab_name.max' => 'ゼミ・研究室名は32文字以内で入力してください。',
      ];
      $validator = Validator::make($request->all(), $rules, $messages);

      if($request->lab_faculty == "その他(文系)" || $request->lab_faculty == "その他(理系)"){
        if($request->lab_faculty == "その他(文系)"){
          $rule_faculty = [
            'new_lib_faculty' => 'required|min:3|max:32',
          ];
          $message_faculty = [
            'new_lib_faculty.required' => '2学部を入力して下さい。（例:工学部）',
            'new_lib_faculty.min' => '学部を正しく入力してください。（例:工学部）',
            'new_lib_faculty.max' => '名前は32文字以内で入力してください。',
          ];
        }
        else if($request->lab_faculty == "その他(理系)"){
          $rule_faculty = [
            'new_sci_faculty' => 'required|min:3|max:32',
          ];
          $message_faculty = [
            'new_sci_faculty.required' => '3学部を入力して下さい。（例:工学部）',
            'new_sci_faculty.min' => '学部を正しく入力してください。（例:工学部）',
            'new_sci_faculty.max' => '名前は32文字以内で入力してください。',
          ];
        }
        $validator = Validator::make($request->all(), $rule_faculty, $message_faculty);


//TODO：文理それぞれのその他が入力されていたとき、それぞれの学部データを作成する
//もし、既存のデータだったらそこに割当て次へ

        if(!is_null($request->new_lib_faculty)){
          if(Faculty_logo::where('faculty_name', $request->new_lib_faculty)->first() == NULL){
            $faculty_logo = new Faculty_logo;
            $faculty_logo->faculty_name = $request->new_lib_faculty;
            $faculty_logo->humanities_or_sciences = "文系";
            $faculty_logo->faculty_filename = "other.png";
            $faculty_logo->save();
          }
          $selected_faculty = $request->new_lib_faculty;
        }
        else if(!is_null($request->new_sci_faculty)){
          if(Faculty_logo::where('faculty_name', $request->new_sci_faculty)->first() == NULL){
            $faculty_logo = new Faculty_logo;
            $faculty_logo->faculty_name = $request->new_sci_faculty;
            $faculty_logo->humanities_or_sciences = "理系";
            $faculty_logo->faculty_filename = "other.png";
            $faculty_logo->save();
          }
          $selected_faculty = $request->new_sci_faculty;
        }
      }else{
        $selected_faculty = $request->faculty_name;
      }

      //TODO :: roleが2だったときは、url('add/'.email_token)に移す。
      if ($validator->fails()) {
          return redirect('/add')
              ->withErrors($validator)
              ->withInput();
      }

      $univ_id = Univ_data::where('univ_name', $request->lab_univ)->first();
      if(!is_null($univ_id)){
        $already_data = Laboratory::where('univ_id', $univ_id->id)->where('lab_name', $request->lab_name)->exists();
      }
      else{
        $already_data = FALSE;
      }
      //対象の研究室が登録されていなかった場合
      if ($already_data == FALSE) {
          $faculty_id = Faculty_logo::where('faculty_name', $request->lab_faculty)->first();
          $department_id = Department::where('department_name', $request->lab_department)->first();
          if(is_null($department_id)){
            $department = new Department;
            $department->department_name = $request->lab_department;
            $department->save();

            $department_id = Department::where('department_name', $request->lab_department)->first();
          }

          $today = date("Y/m/d");  //現在時刻の取得

          //未登録のユーザー（From:メール）の場合，$tokenにはemail_tokenが入っている.
          $is_unregistered = User::where('email_verify_token', $request->token)->first();
          if(isset($is_unregistered)){
            $user_token = $is_unregistered;
          }
          else{
            $user_token = User::where('token', $request->token)->first();
          }

          if (isset($user_token)) {
              $token_flag = 1;
          } else {
              $token_flag = 0;
          }

          $laboratories = new Laboratory;
          $laboratories->lab_name = $request->lab_name;
          $laboratories->univ_id = $univ_id->id;
          $laboratories->faculty_id = $faculty_id->id;
          $laboratories->department_id = $department_id->id;
          $laboratories->save();
      }

      $faculty_lib_detas = Faculty_logo::where('humanities_or_sciences', '文系')->select('faculty_name')->get();
      $faculty_lib_array = array();
      foreach ($faculty_lib_detas as $faculty_lib_data) {
        echo $faculty_lib_data->name;
        array_push($faculty_lib_array, $faculty_lib_data->faculty_name);
      }

      $faculty_sci_detas = Faculty_logo::where('humanities_or_sciences', '理系')->select('faculty_name')->get();
      $faculty_sci_array = array();
      foreach ($faculty_sci_detas as $faculty_sci_data) {
        array_push($faculty_sci_array, $faculty_sci_data->faculty_name);
      }

      $lib = in_array($request->new_lib_faculty, $faculty_lib_array);
      $sci = in_array($request->new_sci_faculty, $faculty_sci_array);
      
      /*=====↓↓　共通部分　↓↓=======*/
      $lab_evaluation = lab_evaluation::find($lab_details[0]);
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
              "就活に対するサポート（面接対策・es添削）" => "job_small",
              "就活に十分な時間を充てられるか" => "job_jobhunt",
              "企業へのコネ・推薦" => "job_recommendation",
              "就活で活かせるスキルが身につくか" => "job_reserch"
          ];
          $lab_array = [
              "拘束時間の満足度" => "lab_restraint",
              "課外活動の頻度" => "lab_free",
              "研究テーマの設定の自由度" => "lab_advice",
              "ゼミ飲みの頻度" => "lab_event",
              "プライべートの交流" => "lab_communication",
              "ゼミ・研究室の人気度" => "lab_popularity"
          ];
          $other_array = [
              "英語を使用する頻度" => "other_skill",
              "講義形式(1:授業, 5:ディスカッション)" => "other_fac",
              "ゼミ･研究室選択の満足度" => "other_regret",
              "国際的な活動の頻度" => "other_international",
              "女子の多さ(1:少, 5:多)" => "other_gender",
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
              "課外活動の頻度(例：勉強会)" => "lab_event",
              "研究テーマ設定の自由度" => "lab_free",
              "研究に関する上回生からのアドバイス" => "lab_advice",
              "メンバー間の仲の良さ" => "lab_communication",
              "ゼミ・研究室の人気度" => "lab_popularity"
          ];
          $other_array = [
              "スキル・専門性が身に付く" => "other_skill",
              "ゼミ・研究室の設備の充実度" => "other_fac",
              "ゼミ・研究室選択の満足度" => "other_regret",
              "国際的な活動の頻度" => "other_international",
              "女子の多さ(1:少, 5:多)" => "other_gender"
          ];
      }

      $jobtype_array = [
        "メーカー" => [
          "食品", "農林・水産", "住宅・建設", "インテリア", "繊維・化学・薬品", "化粧品",
          "鉄鋼・金属", "電子・電気機器", "自動車", "印刷", "スポーツ", "その他メーカー"
        ],
        "商社" => [
          "総合商社", "専門商社"
        ],
        "小売" => [
          "百貨店・スーパー", "コンビニ", "その他小売"
        ],
        "広告・出版・マスコミ" => [
          "放送", "新聞・出版", "広告"
        ],
        "サービス・インフラ" => [
          "不動産", "鉄道・航空・運輸・物流", "電力・ガス・エネルギー",
          "旅行・ホテル", "医療", "アミューズメント", "人材・教育", "その他サービス"
        ],
        "金融" => [
          "銀行・証券", "クレジット", "保険", "その他金融"
        ],
        "ソフトウェア・通信" => [
          "ソフトウェア", "インターネット", "通信"
        ],
        "官公庁" => [
          "官公庁", "公社・団体"
        ],
      ];

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
          'lab_details' => $lab_details,
          'lab_evaluation' => $lab_evaluation,
          'evaluation_array' => $evaluation_array,
          'eachtitle_array' => $eachtitle_array,
          'token' => $token,
          'jobtype_array' => $jobtype_array
      ]);
  }
}
