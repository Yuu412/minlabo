<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Laboratory;
use App\lab_evaluation;
use App\Faculty_logo;
use App\Univ_data;
use App\Department;
use Validator;
use Auth;

class FacultySearchController extends Controller
{
  /*======== 学部ごとに探すページ =================*/
  public function faculty_result($faculty_name)
  {
      $faculty_logos = faculty_logo::orderBy('created_at', 'asc')->get();

      if ($faculty_name == "その他") {
          $faculty_data = faculty_logo::where('faculty_filename', "other.png")->first();
          $faculty_id = $faculty_data->id;
      } else {
          $faculty_data = faculty_logo::where('faculty_name', $faculty_name)->first();
          $faculty_id = $faculty_data->id;
      }
      $laboratories = Laboratory::where('faculty_id', $faculty_id)->get();

      //研究室のデータを一括してこの配列に入れる
      $laboratories_collection = collect([]);

      foreach ($laboratories as $laboratory) {
        /*=====研究室ごとの平均評価計算部===========*/
        $univ_name = Univ_data::find($laboratory->univ_id)->univ_name;
        $department_name = Department::find($laboratory->department_id)->department_name;
        $lab_evaluations = lab_evaluation::where('lab_id', $laboratory->id)->where('univ_id', $laboratory->univ_id)->get();
        $latest_evaluation = lab_evaluation::where('lab_id', $laboratory->id)->where('univ_id', $laboratory->univ_id)->first();

        $laboratories_collection = $laboratories_collection->concat([
          [
            'lab_name' => $laboratory->lab_name,
            'univ_name' => $univ_name,
            'department_name' => $department_name,
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
          ],
        ]);
      }
      return view('faculty_result', [
        'faculty_name' => $faculty_name,
        'faculty_filename' => $faculty_data->faculty_filename,
        'laboratories_collection' => $laboratories_collection,
      ]);
    }
}
