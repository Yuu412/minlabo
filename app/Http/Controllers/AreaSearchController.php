<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Laboratory;
use App\Univ_data;
use App\lab_evaluation;
use App\Prefecture_image;
use App\Faculty_logo;

class AreaSearchController extends Controller
{
  public function area_search($prefecture_name)
  {
      //検索された文字列をprefecture_nameカラムに含む大学名の一覧を取得
      $prefecture_id = Prefecture_image::where('prefecture_name', $prefecture_name)->first()->id;
      $universities_id = Univ_data::where('prefecture_id', $prefecture_id)->get('id');

      //検索条件に当てはまる大学の研究室評価の平均値を取得
      //$average_evaluations = lab_evaluation::selectRaw('univ_id, AVG(all_average) as all_average, AVG(prof_average) as prof_average, AVG(job_average) as job_average, AVG(lab_average) as lab_average, AVG(other_average) as other_average')->whereIn('univ_id', $universities_id)->groupBy('univ_id')->get()->toArray();

      //大学ごとに評価を取得
      $universities_collection = collect([]);
      foreach ($universities_id as $university_id) {
        $univ_id = $university_id->id;
        $univ_name = Univ_data::find($univ_id)->univ_name;
        $evaluation_data = lab_evaluation::where('univ_id', $univ_id);
        if($evaluation_data->count() == 0) continue;
        $univ_evaluations = $evaluation_data->get();
        $latest_evaluation = $evaluation_data->first();

        $universities_collection = $universities_collection->concat([
          [
            'univ_name' => $univ_name,
            'all_average' => round($univ_evaluations->avg('all_average'), 2),
            'all_stars' => round($univ_evaluations->avg('all_average')*2, 0) / 2,
            'prof_average' => round($univ_evaluations->avg('prof_average'), 2),
            'prof_stars' => round($univ_evaluations->avg('prof_average')*2, 0) / 2,
            'job_average' => round($univ_evaluations->avg('job_average'), 2),
            'job_stars' => round($univ_evaluations->avg('job_average')*2, 0) / 2,
            'lab_average' => round($univ_evaluations->avg('lab_average'), 2),
            'lab_stars' => round($univ_evaluations->avg('lab_average')*2, 0) / 2,
            'other_average' => round($univ_evaluations->avg('other_average'), 2),
            'other_stars' => round($univ_evaluations->avg('other_average')*2, 0) / 2,
            'latest_evaluation' => $latest_evaluation,
            'latest_all_stars' => round($latest_evaluation->all_average*2, 0) / 2,
            'latest_prof_stars' => round($latest_evaluation->prof_average*2, 0) / 2,
            'latest_job_stars' => round($latest_evaluation->job_average*2, 0) / 2,
            'latest_lab_stars' => round($latest_evaluation->lab_average*2, 0) / 2,
            'latest_other_stars' => round($latest_evaluation->other_average*2, 0) / 2,
          ],
        ]);
      }

      $hits = count($universities_collection);
      return view('area_search_result', [
        'universities_collection' => $universities_collection,
        'prefecture_name' => $prefecture_name,
        'universities_id' => $universities_id,
        'hits' => $hits
      ]);
  }

}
