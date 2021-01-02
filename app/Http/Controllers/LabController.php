<?php

/*
======================================================
===認証済みアカウントがアクセスできるページへの処理=======
======================================================
*/

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\User;
use App\Laboratory;
use App\Univ_data;
use App\lab_evaluation;
use App\Faculty_logo;
use App\Prefecture_image;
use Validator;
use Auth;

class LabController extends Controller
{
    //ログイン認証後にのみ表示
    public function __construct()
    {
        $this->middleware('auth');
    }

    //更新処理
    public function update(Request $request)
    {
        $rules = [
            'content' => 'required|min:50',
        ];

        $messages = [
            'content.required' => '口コミを入力してください。',
            'content.min' => '50文字以上で入力してください。',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        $userID = Auth::user()->id;
        if ($validator->fails()) {
            return redirect('/mypage/' . $userID)
                ->withErrors($validator)
                ->withInput();
        }

        //研究室のDBにデータを格納
        //Eloquentモデル (=MySQL記述なしにデータベース管理をしてくれる)
        $today = date("Y-m-d");   //現在時刻の取得

        $lab_evaluation = lab_evaluation::where('id', $request->id);
        $lab_evaluation->user_id = Auth::user()->id;
        $lab_evaluation->lab_name = $request->lab_name;
        $lab_evaluation->lab_univ = $request->lab_univ;

        //研究室の口コミの編集
        if (isset($request->objobtype)) {
            $tmp = $request->objobtype;
        } else {
            $tmp = "";
        }
        \DB::table('lab_evaluation')->where('id', $request->id)->update([
            /*教授について*/
            'prof_care' => $request->prof_care,
            'prof_friendly' => $request->prof_friendly,
            'prof_jobhunt' => $request->prof_jobhunt,
            'prof_network' => $request->prof_network,
            'prof_experience' => $request->prof_experience,
            'prof_average' => ($request->prof_friendly + $request->prof_care + $request->prof_jobhunt +
                    $request->prof_network + $request->prof_experience) / 5.0,
            /*就活について*/
            'job_major' => $request->job_major,
            'job_small' => $request->job_small,
            'job_jobhunt' => $request->job_jobhunt,
            'job_recommendation' => $request->job_recommendation,
            'job_reserch' => $request->job_reserch,
            'job_average' => ($request->job_major + $request->job_small + $request->job_jobhunt +
                    $request->job_recommendation + $request->job_reserch) / 5.0,
            /*研究室について*/
            'lab_restraint' => $request->lab_restraint,
            'lab_event' => $request->lab_event,
            'lab_free' => $request->lab_free,
            'lab_advice' => $request->lab_advice,
            'lab_communication' => $request->lab_communication,
            'lab_popularity' => $request->lab_popularity,
            'lab_average' => ($request->lab_restraint + $request->lab_event + $request->lab_free +
                    $request->lab_advice + $request->lab_communication + $request->lab_popularity) / 6.0,
            /*その他*/
            'other_skill' => $request->other_skill,
            'other_fac' => $request->other_fac,
            'other_regret' => $request->other_regret,
            'other_international' => $request->other_international,
            'other_gender' => $request->other_gender,
            'other_average' => ($request->other_skill + $request->other_fac + $request->other_regret +
                    $request->other_international + $request->other_gender) / 5.0,
            /*他*/
            'all_average' => (
                    ($request->prof_friendly + $request->prof_care + $request->prof_jobhunt + $request->prof_network + $request->prof_experience) / 5.0
                    + ($request->job_major + $request->job_small + $request->job_jobhunt + $request->job_recommendation + $request->job_reserch) / 5.0
                    + ($request->lab_restraint + $request->lab_event + $request->lab_free + $request->lab_advice + $request->lab_communication + $request->lab_popularity) / 6.0
                    + ($request->other_skill + $request->other_fac + $request->other_regret + $request->other_international + $request->other_gender) / 5.0
                ) / 4.0,

            'objobtype' => $tmp,
            'content' => $request->content,

            'add_time' => $today,

        ]);
        return redirect(url('mypage'));
    }

    //削除処理
    public function delete(lab_evaluation $lab_evaluation_id)
    {
        $user = Auth::user();
        $lab_evaluation_id->delete();
        return redirect(url('mypage/' . $user->name));
    }

    //トークンによる口コミ投稿
    public function add_review($token)
    {

        return view('labedit', [
            'lab_evaluation' => $lab_evaluation,
            'evaluation_array' => $evaluation_array,
        ]);

    }
}
