<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\lab_evaluation;
use App\Univ_data;
use App\Laboratory;
use Auth;

use Validator;

class StoreEvaluationController extends Controller
{
  //研究室の評価を追加する。
  public function store_evaluation(Request $request)
  {
      $rules = [
          'content' => 'required|min:50',
      ];
      $messages = [
          'content.required' => '口コミを入力してください。',
          'content.min' => '口コミを50文字以上入力してください。',
      ];
      $validator = Validator::make($request->all(), $rules, $messages);

      if ($validator->fails()) {
          return redirect('/add')
              ->withErrors($validator)
              ->withInput();
      }

      $univ_id = Univ_data::where('univ_name', $request->lab_univ)->first();
      $lab_id  = Laboratory::where('lab_name', $request->lab_name)->where('univ_id', $univ_id->id)->first();

      //未登録のユーザー（From:メール）の場合，$tokenにはemail_tokenが入っている.
      $is_unregistered = User::where('email_verify_token', $request->token)->first();
      if(isset($is_unregistered)){
        $user_token = $is_unregistered;
      } else{
        $user_token = User::where('token', $request->token)->first();
      }

      if (isset($user_token)) {
          $token_flag = 1;
      } else {
          $token_flag = 0;
      }

      //研究室のDBにデータを格納
      //Eloquentモデル (=MySQL記述なしにデータベース管理をしてくれる)
      $today = date("Y/m/d");  //現在時刻の取得

      $lab_evaluation = new lab_evaluation;

      //QRコードからの口コミ追加の場合Userテーブルからtokenが等しいものを検索してそのユーザーIDを登録
      //サイト内からの登録の場合その人自身のIDをユーザーIDとして登録
      if ($token_flag == 1) {
          $lab_evaluation->user_id = $user_token->id;
      } else {
          $lab_evaluation->user_id = Auth::user()->id;
      }

       $lab_evaluation->lab_id = $lab_id->id;
       $lab_evaluation->univ_id = $univ_id->id;

       /*教授について*/
       $lab_evaluation->prof_care = $request->prof_care;
       $lab_evaluation->prof_friendly = $request->prof_friendly;
       $lab_evaluation->prof_jobhunt = $request->prof_jobhunt;
       $lab_evaluation->prof_network = $request->prof_network;
       $lab_evaluation->prof_experience = $request->prof_experience;
       $lab_evaluation->prof_average = ($lab_evaluation->prof_friendly + $lab_evaluation->prof_care + $lab_evaluation->prof_jobhunt +
                                        $lab_evaluation->prof_network + $lab_evaluation->prof_experience) / 5.0;
       /*就活について*/
       $lab_evaluation->job_major = $request->job_major;
       $lab_evaluation->job_small = $request->job_small;
       $lab_evaluation->job_jobhunt = $request->job_jobhunt;
       $lab_evaluation->job_recommendation = $request->job_recommendation;
       $lab_evaluation->job_reserch = $request->job_reserch;
       $lab_evaluation->job_average = ($lab_evaluation->job_major + $lab_evaluation->job_small + $lab_evaluation->job_jobhunt +
                                       $lab_evaluation->job_recommendation + $lab_evaluation->job_reserch) / 5.0;
       /*研究室について*/
       $lab_evaluation->lab_restraint = $request->lab_restraint;
       $lab_evaluation->lab_event = $request->lab_event;
       $lab_evaluation->lab_free = $request->lab_free;
       $lab_evaluation->lab_advice = $request->lab_advice;
       $lab_evaluation->lab_communication = $request->lab_communication;
       $lab_evaluation->lab_popularity = $request->lab_popularity;
       $lab_evaluation->lab_average = ($lab_evaluation->lab_restraint + $lab_evaluation->lab_event + $lab_evaluation->lab_free +
                                       $lab_evaluation->lab_advice + $lab_evaluation->lab_communication + $request->lab_popularity) / 6.0;
       /*その他*/
       $lab_evaluation->other_skill = $request->other_skill;
       $lab_evaluation->other_fac = $request->other_fac;
       $lab_evaluation->other_regret = $request->other_regret;
       $lab_evaluation->other_international = $request->other_international;
       $lab_evaluation->other_gender = $request->other_gender;
       $lab_evaluation->other_average = ($lab_evaluation->other_skill + $lab_evaluation->other_fac + $lab_evaluation->other_regret +
                                         $lab_evaluation->other_international + $lab_evaluation->other_gender) / 5.0;
       /*他*/
       $lab_evaluation->all_average = ($lab_evaluation->prof_average + $lab_evaluation->job_average + $lab_evaluation->lab_average + $lab_evaluation->other_average) / 4.0;
       $lab_evaluation->objobtype = $request->objobtype;
       if(!empty($request->terms)){
         $lab_evaluation->terms = $request->terms;
       }
       else{
         $lab_evaluation->terms = "該当条件なし。";
       }
       $lab_evaluation->content = $request->content;
       $lab_evaluation->token = $request->token;

        if (!empty($request->objobtype)) {
            $tmp = implode("、 ", $request->objobtype);
        } else {
            $tmp = "";
        }
        $lab_evaluation->objobtype = $tmp;
        $lab_evaluation->save();

        /*口コミを投稿すると閲覧できる口コミ数を変更する処理*/
        /*登録されているデータの変更方法*/
        if ($token_flag == 1) {
            $user_id = $user_token->id;
        } else {
            $user_id = Auth::user()->id;
        }

        if(!isset($is_unregistered)){
          \DB::table('users')->where('id', $user_id)->update([
              'role' => 10,
              'status' => config('const.USER_STATUS.REGISTER'),
          ]);
        }

        $lab_details_univ = $request->lab_univ;
        $lab_details_lab = $request->lab_name;
        return redirect(url('lab/' . $lab_details_univ . '/' . $lab_details_lab));
  }
}
