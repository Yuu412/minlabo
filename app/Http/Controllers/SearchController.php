<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\lab_evaluation;
use App\Faculty_logo;
use App\Laboratory;
use App\Univ_data;
use App\Department;

class SearchController extends Controller
{
  //ログイン認証後にのみ表示
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function search(Request $request)
  {
    #キーワード受け取り
    $keyword = $request->input('keyword');
    $laboratories = Laboratory::latest()->where('lab_name', 'like', '%' . $keyword . '%')->get();


    if(empty($laboratories[0])){
      return view('search_result', [
          'keyword' => $keyword,
          'laboratories' => $laboratories,
      ]);
    }

    //研究室のデータを一括してこの配列に入れる
    $laboratories_collection = collect([]);

    $faculty_logos = Faculty_logo::get();
    $univ_data = Univ_data::get();
    $department_data = Department::get();
    foreach ($laboratories as $laboratory) {
      //echo $laboratory;
      $faculty_data = $faculty_logos[$laboratory->faculty_id - 1];

      $univ_name = $univ_data[$laboratory->univ_id - 1]->univ_name;
      $department_name = $department_data[$laboratory->department_id - 1]->department_name;

      /*=====研究室ごとの平均評価計算部===========*/
      $lab_evaluations = lab_evaluation::where('lab_id', $laboratory->id)->where('univ_id', $laboratory->univ_id)->get();
      $latest_evaluation = lab_evaluation::where('lab_id', $laboratory->id)->where('univ_id', $laboratory->univ_id)->latest()->first();
      echo $latest_evaluation;
      $laboratories_collection = $laboratories_collection->concat([
        [
          'lab_name' => $laboratory->lab_name,
          'univ_name' => $univ_name,
          'department_name' => $department_name,
          'faculty_name' => $faculty_data->faculty_name,
          'faculty_filename' => $faculty_data->faculty_filename,
          'all_average' => round($lab_evaluations->avg('all_average'), 2),
          'all_stars' => round($lab_evaluations->avg('all_average')*2, 0) / 2,
          'prof_average' => round($lab_evaluations->avg('prof_average'), 2),
          'prof_stars' => round($lab_evaluations->avg('prof_average')*2, 0) / 2,
          'job_average' => round($lab_evaluations->avg('job_average'), 2),
          'job_stars' => round($lab_evaluations->avg('job_average')*2, 0) / 2,
          'lab_average' => round($lab_evaluations->avg('lab_average'), 2),
          'lab_stars' => round($lab_evaluations->avg('lab_average')*2, 0) / 2,
          'other_average' => round($lab_evaluations->avg('other_average'), 2),
          'other_stars' => round($lab_evaluations->avg('other_average')*2, 0) / 2,
          'latest_evaluation' => $latest_evaluation,
          'latest_all_stars' => round($latest_evaluation->all_average*2, 0) / 2,
          'latest_prof_stars' => round($latest_evaluation->prof_average*2, 0) / 2,
          'latest_job_stars' => round($latest_evaluation->job_average*2, 0) / 2,
          'latest_lab_stars' => round($latest_evaluation->lab_average*2, 0) / 2,
          'latest_other_stars' => round($latest_evaluation->other_average*2, 0) / 2,
        ],
      ]);
    }
    $hits = count($laboratories_collection);

    return view('search_result', [
        'keyword' => $keyword,
        'laboratories_collection' => $laboratories_collection,
        'laboratories' => $laboratories,
        'univ_name' => $univ_name,
        'hits' => $hits,
    ]);
  }
}
