<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Laboratory;
use App\lab_evaluation;
use App\Univ_data;

class ToLabDetailsController extends Controller
{
  //各研究室の詳細ページへ
  public function to_lab_details($lab_details_univ, $lab_details_lab){
    $univ_name = $lab_details_univ;
    $univ_id = Univ_data::where('univ_name', $univ_name)->first('id')->id;
    $lab_name = $lab_details_lab;
    $lab_id = Laboratory::where('lab_name', $lab_name)->where('univ_id', $univ_id)->first('id')->id;

    $lab_evaluations = lab_evaluation::where('lab_id', $lab_id)->where('univ_id', $univ_id)->latest()->get();

    //口コミのデータを一括してこの配列に入れる
    $evaluations_collection = collect([]);
    foreach ($lab_evaluations as $lab_evaluation) {
      //===32文字以上を･･･に置き換える関数=====
      $comment = $lab_evaluation->content;
      $limit = 50;

      if(mb_strlen($comment) > $limit) {
        $title = mb_substr($comment,0,$limit);
        $comment = "$title ... ";
      }
      //====================================
      $evaluations_collection = $evaluations_collection->concat([
        [
          'id' => $lab_evaluation->id,
          'all_average' => $lab_evaluation->all_average,
          'all_stars' => round($lab_evaluation->all_average * 2, 0) / 2,
          'prof_average' => $lab_evaluation->prof_average,
          'prof_stars' => round($lab_evaluation->prof_average * 2, 0) / 2,
          'job_average' => $lab_evaluation->job_average,
          'job_stars' => round($lab_evaluation->job_average * 2, 0) / 2,
          'lab_average' => $lab_evaluation->lab_average,
          'lab_stars' => round($lab_evaluation->lab_average * 2, 0) / 2,
          'other_average' => $lab_evaluation->other_average,
          'other_stars' => round($lab_evaluation->other_average * 2, 0) / 2,
          'comment' => $comment,
          'created_at' => $lab_evaluation->created_at,
        ],
      ]);
    }
    $hits = count($evaluations_collection);

    $flag = 1;
    return view('lab_details',[
      'evaluations_collection' => $evaluations_collection,
      'univ_name' => $univ_name,
      'lab_name' => $lab_name,
      'hits' => $hits,
      'flag' => $flag,
    ]);
  }
}
