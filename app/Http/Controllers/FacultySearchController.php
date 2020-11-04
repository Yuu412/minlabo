<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Laboratory;
use App\lab_evaluation;
use App\Faculty_logo;
use Validator;
use Auth;

class FacultySearchController extends Controller
{
  /*======== 学部ごとに探すページ =================*/
  public function faculty_result($faculty)
  {
      $keyword = $faculty;
      $faculty_logos = faculty_logo::orderBy('created_at', 'asc')->get();

      $average_item_jp = ["総合評価", "教授", "就活", "研究室", "その他"];

      $data = array();

      if ($keyword == "その他") {
          $faculty_ids = faculty_logo::where('faculty_filename', "other.png")->get('id');
      } else {
          $faculty_ids = faculty_logo::where('faculty_name', $faculty)->get('id');
      }

      $laboratories = [];
      foreach ($faculty_ids as $faculty_id) {
        $laboratory = Laboratory::where('faculty_id', $faculty_id->id)->get();
        $faculty_filename = faculty_logo::find($faculty_id->id);
        foreach ($laboratory as $lab) {
          $laboratories[] = [$lab, $faculty_filename];
        }
      }
        if(is_null($laboratories)){
          $isLab = 0;
        } else {
          $isLab = 1;
        }

      if ($isLab != 0) {
          /*=====研究室ごとの平均・最新口コミ評価計算部===========*/
          $average_item = ['all_average', 'prof_average', 'job_average', 'lab_average', 'other_average'];

          //”○○”学部で絞った研究室情報(laboratories)から、１つずつとりだし、それに対応するlab_evaluationを取り出す
          foreach ($laboratories as $laboratory) {
              $count = lab_evaluation::where('lab_id', $laboratory[0]->id)->where('univ_id', $laboratory[0]->univ_id)->count();

              if ($count > 1) {
                  for ($n = 0; $n < 5; $n++) {
                      //平均口コミ
                      $array_average[$laboratory[0]->id][$n] = lab_evaluation::where('univ_id', $laboratory[0]->univ_id)
                          ->where('lab_id', $laboratory[0]->id)
                          ->avg($average_item[$n]);
                      //最新口コミ
                      $array_latest_evaluation[$laboratory[0]->id] = lab_evaluation::latest()
                          ->where('univ_id', $laboratory[0]->univ_id)
                          ->where('lab_id', $laboratory[0]->id)
                          ->first();
                  }
              } else if ($count == 1) {
                  $tmp_evaluation = lab_evaluation::where('lab_univ', $laboratory[0]->lab_univ)->where('lab_name', $laboratory[0]->lab_name)->first();
                  for ($n = 0; $n < 5; $n++) {
                      $tmp = $average_item[$n];
                      //平均口コミ
                      $array_average[$laboratory[0]->id][$n] = $tmp_evaluation->$tmp;
                      //最新口コミ
                      $array_latest_evaluation[$laboratory[0]->id] = $tmp_evaluation;
                  }
              }
              else{
                $laboratories = [];
                return view('faculty_result', [
                    'keyword' => $keyword,
                    'laboratories' => $laboratories,
                ]);
              }
          }
          return view('faculty_result', [
              'keyword' => $keyword,
              'laboratories' => $laboratories,
              'faculty_logos' => $faculty_logos,
              'average_item_jp' => $average_item_jp,
              'faculty' => $faculty,
              'array_average' => $array_average,
              'array_latest_evaluation' => $array_latest_evaluation,
          ]);
      }
      else   //該当データなしの場合
      {
          return view('faculty_result', [
              'keyword' => $keyword,
              'laboratories' => $laboratories,


          ]);
      }
  }
}
