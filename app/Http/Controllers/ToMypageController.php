<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Univ_data;
use App\Laboratory;
use App\lab_evaluation;
use App\Faculty_logo;
use App\Prefecture_image;
use App\Department;
use Validator;
use Auth;

class ToMypageController extends Controller
{
  //マイページへ
  public function to_mypage()
  {
      $userID = Auth::user()->id;
      $faculty_logos = faculty_logo::orderBy('created_at', 'asc')->get();
      $evaluations_collection = collect([]);   //研究室のデータを一括してこの配列に入れる
      $lab_evaluations = lab_evaluation::where('user_id', $userID)->get();

      foreach ($lab_evaluations as $lab_evaluation) {
        /*=====研究室ごとの平均評価計算部===========*/
        $lab_name = Laboratory::find($lab_evaluation->lab_id)->lab_name;
        $univ_name = Univ_data::find($lab_evaluation->univ_id)->univ_name;
        $latest_evaluation = lab_evaluation::where('user_id', $userID)->first();

        //===32文字以上を･･･に置き換える関数=====
        $comment = $lab_evaluation->content;
        $limit = 50;

        if(mb_strlen($comment) > $limit) {
          $title = mb_substr($comment,0,$limit);
          $comment = "$title ... ";
        }

        $evaluations_collection = $evaluations_collection->concat([
          [
            'id' => $lab_evaluation->id,
            'lab_name' => $lab_name,
            'univ_name' => $univ_name,

            'all_average' => round($lab_evaluation->all_average, 2),
            'prof_average' => round($lab_evaluation->prof_average, 2),
            'job_average' => round($lab_evaluation->job_average, 2),
            'lab_average' => round($lab_evaluation->lab_average, 2),
            'other_average' => round($lab_evaluation->other_average, 2),
            'all_stars' => round($lab_evaluation->all_average*2, 0) / 2,
            'prof_stars' => round($lab_evaluation->prof_average*2, 0) / 2,
            'job_stars' => round($lab_evaluation->job_average*2, 0) / 2,
            'lab_stars' => round($lab_evaluation->lab_average*2, 0) / 2,
            'other_stars' => round($lab_evaluation->other_average*2, 0) / 2,
            'latest_evaluation' => $latest_evaluation,
            'comment' => $comment,
            'created_at' => $lab_evaluation->created_at,
          ],
        ]);
      }

      $user_datas = lab_evaluation::where('user_id', Auth::user()->id)->get();
      $laboratories = Laboratory::orderBy('created_at', 'asc')->get();
      return view('mypage', [
          'evaluations_collection' => $evaluations_collection,
          'user_datas' => $user_datas,

          'tmp' => $lab_evaluations,
      ]);
  }
}
