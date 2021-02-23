<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Laboratory;
use App\lab_evaluation;

class LabEvaluationController extends Controller
{
  //各研究室の評価詳細ページへ
  public function to_lab_evaluation_details($lab_evaluation_details)
  {
      $lab_evaluation = lab_evaluation::find($lab_evaluation_details);
      $evaluation_stars = [
        'all_stars' => round($lab_evaluation->all_average*2, 0) / 2,
        'prof_stars' => round($lab_evaluation->prof_average*2, 0) / 2,
        'job_stars' => round($lab_evaluation->job_average*2, 0) / 2,
        'lab_stars' => round($lab_evaluation->lab_average*2, 0) / 2,
        'other_stars' => round($lab_evaluation->other_average*2, 0) / 2,
      ];

      $laboratory = Laboratory::find($lab_evaluation->lab_id);
      $lab_name = $laboratory->lab_name;
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
              "課外活動の頻度(例：勉強会・イベント)" => "lab_event",
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

      //各配列をまとめる配列
      $evaluation_array = [
          '教授について' => $prof_array,
          '就活について' => $jobhunt_array,
          '研究室について' => $lab_array,
          'その他' => $other_array
      ];

      /*各項目のタイトルにあたる配列*/
      $eachtitle_array = ["教授について", "就活について", "研究室について", "その他"];

      return view('lab_evaluation_details', [
          'lab_evaluation_details' => $lab_evaluation_details,
          'lab_evaluation' => $lab_evaluation,
          'evaluation_stars' => $evaluation_stars,
          'lab_name' => $lab_name,
          'evaluation_array' => $evaluation_array,
          'eachtitle_array' => $eachtitle_array,
      ]);
  }
}
