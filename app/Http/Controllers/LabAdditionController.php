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
  //遷移先：研究室の評価を追加するページ
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
          'lab_faculty.min' => '学部を正しく入力してください。（例:工学部）',
          'lab_faculty.max' => '名前は32文字以内で入力してください。',
          'lab_department.required' => '学科を入力してください。（例:情報系学科）',
          'lab_department.min' => '学科を正しく入力してください。（例:情報系学科）',
          'lab_department.max' => '名前は32文字以内で入力してください。',
          'lab_name.required' => 'ゼミ・研究室名を入力してください。（例:佐藤研究室）',
          'lab_name.min' => 'ゼミ・研究室名を正しく入力してください。（例:佐藤研究室）',
          'lab_name.max' => 'ゼミ・研究室名は32文字以内で入力してください。',
      ];

      $validator = Validator::make($request->all(), $rules, $messages);

      if ($validator->fails()) {
          return redirect('/add')
              ->withErrors($validator)
              ->withInput();
      }

      $univ_id = Univ_data::where('univ_name', $request->lab_univ)->first();
      $already_data = Laboratory::where('univ_id', $univ_id->id)->where('lab_name', $request->lab_name)->exists();

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

          $user_token = User::where('token', $request->token)->first();
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

      $lib = in_array($request->lab_faculty, $faculty_lib_array);
      $sci = in_array($request->lab_faculty, $faculty_sci_array);

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
          'lab_details' => $lab_details,
          'lab_evaluation' => $lab_evaluation,
          'evaluation_array' => $evaluation_array,
          'eachtitle_array' => $eachtitle_array,
          'token' => $token,
      ]);
  }
}
