<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Laboratory;
use App\lab_evaluation;
use App\Faculty_logo;
use App\Univ_data;

class UnivController extends Controller
{
  //各大学の研究室一覧ページへ
  public function to_univ($univ_name)
  {
      $count1 = $count2 = 0;
      $average_item_jp = ["総合評価", "教授", "就活", "研究室", "その他"];
      $univ_id = Univ_data::where('univ_name', $univ_name)->first('id');
      $laboratories = Laboratory::orderBy('created_at', 'asc')->where('univ_id', $univ_id)->get();

      /*=== 学部ロゴ画像 設定部=========================*/
      $faculty_logos = Faculty_logo::orderBy('created_at', 'asc')->get();

      $lab_evaluations = lab_evaluation::orderBy('created_at', 'asc')->where('univ_id', $univ_id)->get();
      $lab_name = array();
      $array_average = array();
      $average_item = ['all_average', 'prof_average', 'job_average', 'lab_average', 'other_average'];

      /*=====研究室ごとの平均評価計算部===========*/
      $count = 0;
      foreach ($lab_evaluations as $lab_evaluation) {
          if ($count == 0) {
              $lab_name[$count] = $lab_evaluation->lab_name;
              for ($n = 0; $n < 5; $n++) {
                  $tmp = $average_item[$n];
                  $array_average[$count][$n] = $lab_evaluation->$tmp;
              }
              $count++;
          } else {
              $frag = 0;
              for ($i = 0; $i < $count; $i++) {
                  if ($lab_name[$i] == $lab_evaluation->lab_name) {
                      $frag = 1;
                      for ($n = 0; $n < 5; $n++) {
                          $tmp = $average_item[$n];
                          $array_average[$i][$n] = ($array_average[$i][$n] + $lab_evaluation->$tmp);
                      }
                      break;
                  }
              }
              if ($frag == 0) {
                  $lab_name[$count] = $lab_evaluation->lab_name;
              }
              for ($n = 0; $n < 5; $n++) {
                  $tmp = $average_item[$n];
                  $array_average[$count][$n] = $lab_evaluation->$tmp;
              }
              $count++;
          }
      }

      /*======= 各研究室の評価の個数を求める ==============*/
      $num = 0;
      $array_count_evaluations = array();
      while (!empty($lab_name[$num])) {
          $array_count_evaluations[] = lab_evaluation::orderBy('created_at', 'asc')->where('lab_name', $lab_name[$num])->where('lab_univ', $univ_name)->count();
          $num++;
      }

      // 各平均値を各研究室の評価の数で割る
      for ($i = $num - 1; $i >= 0; $i--) {
          for ($n = 0; $n < 5; $n++) {
              $tmp = $average_item[$n];
              $array_average[$i][$n] = number_format(round($array_average[$i][$n] / $array_count_evaluations[$i], 2), 2);
          }
      }


      /*=====最新口コミ　生成部===========*/
      $array_latest_evaluation = array();

      //lab_evaluationの中からカラムを指定して、そのカラム内の値の重複を取り除いてデータを取得する方法
      $array_lab_id_once = lab_evaluation::where('univ_id', $univ_id)->select('lab_id')->distinct()->get();

      //=================================
      //たぶんここからの処理に問題あり
      //=================================
      foreach ($array_lab_id_once as $lab_id_once) {
          $each_latest_lab_name = lab_evaluation::latest()
              ->where('univ_id', $univ_id)
              ->where('lab_id', $lab_id_once->lab_id)
              ->first();
          array_push($array_latest_evaluation, $each_latest_lab_name);
      }

      /*===== return 部 ======*/
      return view('univ_name', [
          'count1' => $count1, 'count2' => $count2,
          'average_item_jp' => $average_item_jp,

          'faculty_logos' => $faculty_logos,
          'array_count_evaluations' => $array_count_evaluations,
          'lab_name' => $lab_name,
          'array_average' => $array_average,

          'univ_name' => $univ_name,
          'laboratories' => $laboratories,

          'lab_evaluations' => $lab_evaluations,

          'array_latest_evaluation' => $array_latest_evaluation,
      ]);
  }
}
