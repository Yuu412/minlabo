<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Univ_data;
use App\Prefecture_image;
use Validator;

class RetunivController extends Controller
{
  //入力：県名
  //出力：渡された県名に属する大学データ
  public function ret_univ(Request $request)
  {
      $rules = [
          'pref_name' => 'required|between:3,4',
      ];

      $messages = [
          'pref_name.between' => '都道府県を選択してください。',
      ];

      $validator = Validator::make($request->all(), $rules, $messages);

      if ($validator->fails()) {
          return redirect('/add')
              ->withErrors($validator)
              ->withInput();
      }

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

      $token = $request->input('token');

      $prefecture_id = Prefecture_image::where('prefecture_name', $request->input('pref_name'))->value('id');
      $prefecture_univ_data = Univ_data::orderBy('created_at', 'asc')->where('prefecture_id', $prefecture_id)->get();

      return view('add2', [
          'prefecture_univ_data' => $prefecture_univ_data,
          'faculty_lib_array' => $faculty_lib_array,
          'faculty_sci_array' => $faculty_sci_array,
          'token' => $token,
      ]);
  }
}
