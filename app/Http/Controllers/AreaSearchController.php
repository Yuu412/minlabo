<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Univ_data;
use App\lab_evaluation;
use App\Prefecture_image;
use App\Laboratory;
use App\Faculty_logo;

class AreaSearchController extends Controller
{
  public function area_search($prefecture_name)
  {
      $categories = [
          [
              'name' => '総合評価',
              'key' => 'all_average'
          ],
          [
              'name' => '教授',
              'key' => 'prof_average'
          ],
          [
              'name' => '就活',
              'key' => 'job_average'
          ],
          [
              'name' => '雰囲気',
              'key' => 'lab_average'
          ],
          [
              'name' => 'その他',
              'key' => 'other_average'
          ],
      ];

      //検索された文字列をprefecture_nameカラムに含む大学名の一覧を取得
      $prefecture_id = Prefecture_image::where('prefecture_name', $prefecture_name)->first('id')->id;
      $university_id = Univ_data::where('prefecture_id', $prefecture_id)->get('id');
      $tmp = $university_id;

      //検索条件に当てはまる大学の研究室評価の平均値を取得
      $average_evaluations = lab_evaluation::selectRaw('univ_id, AVG(all_average) as all_average, AVG(prof_average) as prof_average, AVG(job_average) as job_average, AVG(lab_average) as lab_average, AVG(other_average) as other_average')->whereIn('univ_id', $university_id)->groupBy('univ_id')->get()->toArray();

      //大学ごとに評価を取得
      $universities = array_map(
          function ($average_evaluation) use ($categories) {
              $university_name = Univ_data::find($average_evaluation['univ_id'])->univ_name;

              //note: ここで改めてクエリを発行しているが、$average_evaluationsを取得するときに同時に取得した方がデータベースへのアクセスが1回で済むのでいいかも。
              //新着口コミを取得
              $latest_evaluation = lab_evaluation::latest()->where('univ_id', $average_evaluation['univ_id'])->first()->toArray();
              $laboratory_id = $latest_evaluation['lab_id'];
              $laboratory_data = Laboratory::find($laboratory_id);
              $laboratory_name = $laboratory_data->lab_name;
              $faculty_name = Faculty_logo::find($laboratory_data->faculty_id)->faculty_name;

              return [
                  'name' => $university_name,
                  'averageTotalEvaluation' => [
                      'category' => $categories[0]['name'],
                      'value' => round($average_evaluation[$categories[0]['key']], 2)
                  ],
                  'averageEvaluations' => array_map(function ($category) use ($average_evaluation) {
                      return [
                          'category' => $category['name'],
                          'value' => round($average_evaluation[$category['key']], 2)
                      ];
                  }, array_slice($categories, 1)),
                  'latestEvaluation' => [
                      'laboratoryName' => $laboratory_name,
                      'facultyName' => $faculty_name,
                      'evaluationValues' =>
                          array_map(function ($category) use ($latest_evaluation) {
                              return [
                                  'category' => $category['name'],
                                  'value' => round($latest_evaluation[$category['key']], 2)
                              ];
                          }, $categories),
                  ]
              ];
          }, $average_evaluations);
      return view('area_search_result', [
          'prefectureName' => $prefecture_name,
          'universities' => $universities,

          'tmp' => $tmp,
      ]);
  }

}
