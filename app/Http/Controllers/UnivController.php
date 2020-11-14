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
      $univ_id = Univ_data::where('univ_name', $univ_name)->first('id');
      $laboratories = Laboratory::orderBy('created_at', 'asc')->where('univ_id', $univ_id->id)->get();

      //研究室のデータを一括してこの配列に入れる
      $laboratories_collection = collect([]);

      $faculty_logos = Faculty_logo::get();
      $univ_data = Univ_data::get();
      foreach ($laboratories as $laboratory) {
        $faculty_data = $faculty_logos[$laboratory->faculty_id - 1];
        $univ_name = $univ_data[$laboratory->univ_id - 1]->univ_name;

        /*=====研究室ごとの平均評価計算部===========*/
        $lab_evaluations = lab_evaluation::where('lab_id', $laboratory->id)->where('univ_id', $laboratory->univ_id)->get();

        $laboratories_collection = $laboratories_collection->concat([
          [
            'lab_name' => $laboratory->lab_name,
            'faculty_name' => $faculty_data->faculty_name,
            'faculty_filename' => $faculty_data->faculty_filename,
            'all_average' => round($lab_evaluations->avg('all_average'), 2),
            'prof_average' => round($lab_evaluations->avg('prof_average'), 2),
            'job_average' => round($lab_evaluations->avg('job_average'), 2),
            'lab_average' => round($lab_evaluations->avg('lab_average'), 2),
            'other_average' => round($lab_evaluations->avg('other_average'), 2),
            'latest_evaluation' => $latest_evaluation = lab_evaluation::latest()->first()
          ],
        ]);
      }
      /*===== return 部 ======*/
      return view('univ_name', [
          'laboratories_collection' => $laboratories_collection,
          'laboratories' => $laboratories,
          'univ_name' => $univ_name,
      ]);
  }
}
