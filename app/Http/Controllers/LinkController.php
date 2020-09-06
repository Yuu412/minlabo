<?php

/*
======================================================
===認証済みアカウントがアクセスできるページへの処理=======
======================================================
*/

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Laboratory;
use App\Univ_data;
use App\lab_evaluation;
use App\Fac_logo;
use Validator;
use Auth;

class LinkController extends Controller
{
    public function preindex(){
      $pre_array = [
          ["北海道", "青森県", "秋田県", "山形県", "岩手県", "宮城県", "福島県"],
          ["東京都", "神奈川県", "埼玉県", "千葉県", "栃木県", "茨城県","群馬県",
           "愛知県", "岐阜県", "静岡県", "三重県", "新潟県", "山梨県", "長野県", "石川県", "富山県", "福井県"],
          ["大阪府", "兵庫県", "京都府", "滋賀県", "奈良県", "和歌山県"],
          ["岡山県", "広島県", "鳥取県", "島根県", "山口県", "香川県", "徳島県", "愛媛県", "高知県"],
          ["福岡県", "佐賀県", "長崎県", "熊本県", "大分県", "宮崎県", "鹿児島県", "沖縄県"],
        ];
      $region_array = ["北海道・東北", "関東・中部", "近畿", "中国・四国", "九州"];
      $hokkaido = $kanto = $kinki = $chugoku = $kyushu = 0;
      $amount_reviews_array =[$hokkaido, $kanto, $kinki, $chugoku, $kyushu];

      $amount_lab_evaluation = lab_evaluation::get();
      foreach ($amount_lab_evaluation as $lab_evaluation)
      {
        $lab_evaluation_pre = Univ_data::where('univ_name', $lab_evaluation->lab_univ)->get();
        foreach ($lab_evaluation_pre as $pre) {
          for($i=0;  $i<5; $i++){
            if(in_array($pre->pre_name, $pre_array[$i])){
              $amount_reviews_array[$i]++;
            }
          }
        }
      }

      return view('toppage',[
        'amount_reviews_array' => $amount_reviews_array,
        'region_array' => $region_array
      ]);
    }

    //トップページに戻る
    public function to_index(){return view('laboratories');}

    //研究室の追加ページ１へ
    public function to_add(){
      $token = uniqid(rand(100, 999));

      return view('add',[
        'token' => $token
      ]);
    }

    //QRコードから研究室の追加ページ１へ
    public function qr_to_add($qr_token){
      $token = $qr_token;

      return view('add',[
        'token' => $token
      ]);
    }

    public function ret_univ(Request $request)
    {
      $rules = [
         'pref_name' => 'required|between:3,4',
     ];

     $messages = [
         'pref_name.required' => '名前を入力して下さい。',
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
                           "看護学部", "薬学部", "歯学部","建築学部", "海洋学部",
                           "スポーツ健康科学部", "芸術工学部", "生命科学部","理系その他"
                          ];

      $pre_input = $request->input('pref_name');
      $token = $request->input('token');
      $pre_univ_data = Univ_data::orderBy('created_at', 'asc')->where('pre_name', $pre_input)->get();
       return view('add2',[
        'pre_univ_data' => $pre_univ_data,
        'faculty_lib_array' => $faculty_lib_array,
        'faculty_sci_array' => $faculty_sci_array,
        'token' => $token
      ]);
     }

     //研究室情報を追加し研究室の評価を追加するページへ
     public function add_evaluation(Request $request){
       /*研究室を判別するための"研究室名"と"研究室の所属大学"*/
       $tmp_lab_name = $request->lab_name;
       $tmp_lab_univ = $request->lab_univ;
       $lab_details = [$tmp_lab_univ, $tmp_lab_name];
       $token = $request->token;

       $query = Laboratory::query();

       $rules = [
         'lab_univ' => 'required|min:3',
         'lab_faculty' => 'required|min:3|max:32',
         'lab_department' => 'required|min:3|max:32',
         'lab_name' => 'required|min:3|max:32',
       ];

       $messages = [
          'lab_univ.required' => '大学名を選択してください。',
          'lab_univ.min' => '大学名を選択してください。',
          'lab_faculty.required' => '学部を入力して下さい。（例:工学部）',
          'lab_faculty.min' => '学部を正しく入力してください。（例:工学部）',
          'lab_faculty.max' => '名前は32文字以内で入力してください。',
          'lab_department.required' => '学科を入力してください。（例:情報系学科）',
          'lab_department.min' => '学科を正しく入力してください。（例:情報系学科）',
          'lab_department.max' => '名前は32文字以内で入力してください。',
          'lab_name.required' => 'ゼミ・研究室名を入力してください。（例:佐藤研究室）',
          'lab_name.min' => 'ゼミ・研究室名を正しく入力してください。（例:佐藤研究室）',
          'lab_name.max' => 'ゼミ・研究室名は32文字以内で入力してください。',
       ];

       $validator = Validator::make($request->all(), $rules, $messages);

       if ($validator->fails()) {
          return redirect('/add')
              ->withErrors($validator)
              ->withInput();
       }

       $already_data = Laboratory::where('lab_univ', $tmp_lab_univ)->where('lab_name', $tmp_lab_name)->exists();

       //対象の研究室が登録されていなかった場合
       if($already_data == FALSE){
         $today = date("Y/m/d");  //現在時刻の取得

         $user_token = User::where('token',$request->token)->first();
         if(isset($user_token)){
           $token_flag = 1;
         }
         else{
           $token_flag = 0;
         }

         $laboratories = new Laboratory;
         if($token_flag == 1){
           $laboratories->user_id = User::where('token',$token)->first()->id;
         }
         else{
           $laboratories->user_id = Auth::user()->id;
        }
         $laboratories->lab_univ = $request->lab_univ;
         $laboratories->lab_faculty = $request->lab_faculty;
         $laboratories->lab_department = $request->lab_department;
         $laboratories->lab_name = $request->lab_name;
         $laboratories->add_time = $today;
         $laboratories->save();
       }

       $faculty_lib_array = [
                             "文学部", "教育学部", "経済学部", "経営学部", "商学部",
                             "社会学部", "法学部", "外国語学部", "国際学部", "体育学部",
                             "福祉学部", "芸術学部", "観光学部", "神学部", "総合政策学部",
                             "音楽学部", "文系その他"
                            ];
       $faculty_sci_array = [
                             "理学部", "工学部", "理工学部", "情報学部", "農学部", "医学部",
                             "看護学部", "薬学部", "歯学部","建築学部", "海洋学部",
                             "スポーツ健康科学部", "芸術工学部", "生命科学部","理系その他"
                            ];

       $lib = in_array($request->lab_faculty , $faculty_lib_array);
       $sci = in_array($request->lab_faculty , $faculty_sci_array);

       /*=====↓↓　共通部分　↓↓=======*/
       $lab_evaluation = lab_evaluation::find($lab_details[0]);
       if($lib)
       {
         $prof_array = [
           "面倒見の良さ" => "prof_care",
           "熱意を持って接してくれる" => "prof_friendly",
           "就活イベント・選考会参加への理解" => "prof_jobhunt",
           "学外での人脈" => "prof_network",
           "教授の社会経験（人事経験など）" => "prof_experience"
         ];
         $jobhunt_array = [
           "大手に強いか" => "job_major",
           "就活に対するサポート（面札対策とかes添削）" => "job_small",
           "就活に十分な時間を充てられるか" => "job_jobhunt",
           "企業へのコネ・推薦" => "job_recommendation",
           "就活で活かせるスキルが身につくか" => "job_reserch"
         ];
         $lab_array = [
           "拘束時間の満足度" => "lab_restraint",
           "課外活動の頻度" => "lab_free",
           "研究テーマの設定の自由度" => "lab_advice",
           "ゼミのみの頻度" => "lab_event",
           "プライべートの交流" => "lab_communication",
           "ゼミ・研究室の人気度" => "lab_popularity"
         ];
         $other_array = [
           "英語を使用する頻度" => "other_skill",
           "講義形式" => "other_fac",
           "ゼミ･研究室選択の満足度" => "other_regret",
           "国際的な活動の頻度" => "other_international",
           "男女比の割合" => "other_gender",
         ];
       }
       else
       {
         $prof_array = [
           "面倒見の良さ" => "prof_care",
           "熱意を持って接してくれる" => "prof_friendly",
           "就活イベント・選考会参加への理解" => "prof_jobhunt",
           "学外での人脈" => "prof_network",
           "教授の社会人経験(人事経験など)" => "prof_experience"
         ];
         $jobhunt_array = [
           "大手に強いか" => "job_major",
           "中小・ベンチャーに強いか" => "job_small",
           "就活に十分な時間を充てられる" => "job_jobhunt",
           "企業へのコネ・推薦" => "job_recommendation",
           "研究内容が就活で活かせそうか" => "job_reserch"
         ];
         $lab_array = [
           "拘束時間の満足度" => "lab_restraint",
           "課外活動の頻度(例：勉強会・イベント)" => "lab_event",
           "研究テーマ設定の自由度" => "lab_free",
           "研究に関する上回生からのアドバイス" => "lab_advice",
           "メンバー間の仲の良さ" => "lab_communication",
           "ゼミ・研究室の人気度" => "lab_popularity"
         ];
         $other_array = [
           "スキル・専門性が身に付く" => "other_skill",
           "ゼミ・研究室の設備の充実度" => "other_fac",
           "ゼミ・研究室選択の後悔" => "other_regret",
           "国際的な活動の頻度" => "other_international",
           "男女比の割合" => "other_gender"
         ];
       }

       //各配列をまとめる配列
       $evaluation_array = [
         '教授について' => $prof_array,
         '就活について' => $jobhunt_array,
         '研究室について' => $lab_array,
         'その他' => $other_array
       ];
       /*各項目のタイトルにあたる配列*/
       $eachtitle_array = ["教授について", "就活について", "研究室について", "その他"];

       return view('add_evaluation',[
         'lab_details' => $lab_details,
         'lab_evaluation' => $lab_evaluation,
         'evaluation_array' => $evaluation_array,
         'eachtitle_array' => $eachtitle_array,
         'token' => $token,
       ]);
     }

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

       $user_token = User::where('token',$request->token)->first();
       if(isset($user_token)){
         $token_flag = 1;
       }
       else{
         $token_flag = 0;
       }

     //研究室のDBにデータを格納
     //Eloquentモデル (=MySQL記述なしにデータベース管理をしてくれる)
     $today = date("Y/m/d");  //現在時刻の取得

     $lab_evaluation = new lab_evaluation;

     //QRコードからの口コミ追加の場合Userテーブルからtokenが等しいものを検索してそのユーザーIDを登録
     //サイト内からの登録の場合その人自身のIDをユーザーIDとして登録
     if($token_flag == 1){
       $lab_evaluation->user_id = User::where('token',$request->token)->first()->id;
     }
     else{
       $lab_evaluation->user_id = Auth::user()->id;
    }

     $lab_evaluation->lab_name = $request->lab_name;
     $lab_evaluation->lab_univ = $request->lab_univ;

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
     $lab_evaluation->terms = $request->terms;
     $lab_evaluation->content = $request->content;

     $lab_evaluation->token = $request->token;

     if(!empty($request->objobtype)){
       $tmp = implode(", ", $request->objobtype);
     }
     else{
       $tmp = "";
     }
     $lab_evaluation->objobtype = $tmp;
     $lab_evaluation->add_time = $today;
     $lab_evaluation->save();

     /*口コミを投稿すると閲覧できる口コミ数を変更する処理*/
     /*登録されているデータの変更方法*/

      if($token_flag == 1){
        $user_id = User::where('token',$request->token)->first()->id;
      }
      else{
        $user_id = Auth::user()->id;
     }
     \DB::table('users')->where('id', $user_id)->update([
         'role' => 10,
         'status' => config('const.USER_STATUS.REGISTER'),
     ]);

     $lab_details_univ = $lab_evaluation->lab_univ;
     $lab_details_lab = $lab_evaluation->lab_name;
     return redirect(url('lab/'.$lab_details_univ.'/'.$lab_details_lab));
     }


    //研究室の評価を追加するページへ
    public function to_add_evaluation($lab_details_univ, $lab_details_lab){
      $lab_details = [$lab_details_univ, $lab_details_lab];

      $lab_evaluation = lab_evaluation::find($lab_details[0]);
      $laboratory = Laboratory::where('lab_univ', $lab_details[0])->where('lab_name', $lab_details[1])->first();

      $token = uniqid(rand(100, 999));

      $faculty_lib_array = [
                            "文学部", "教育学部", "経済学部", "経営学部", "商学部",
                            "社会学部", "法学部", "外国語学部", "国際学部", "体育学部",
                            "福祉学部", "芸術学部", "観光学部", "神学部", "総合政策学部",
                            "音楽学部", "文系その他"
                           ];
      $faculty_sci_array = [
                            "理学部", "工学部", "理工学部", "情報学部", "農学部", "医学部",
                            "看護学部", "薬学部", "歯学部","建築学部", "海洋学部",
                            "スポーツ健康科学部", "芸術工学部", "生命科学部","理系その他"
                           ];

      $lib = in_array($laboratory->lab_faculty , $faculty_lib_array);
      $sci = in_array($laboratory->lab_faculty , $faculty_sci_array);

      if($lib)
      {
        $prof_array = [
          "面倒見の良さ" => "prof_care",
          "熱意を持って接してくれる" => "prof_friendly",
          "就活イベント・選考会参加への理解" => "prof_jobhunt",
          "学外での人脈" => "prof_network",
          "教授の社会経験（人事経験など）" => "prof_experience"
        ];
        $jobhunt_array = [
          "大手に強いか" => "job_major",
          "就活に対するサポート（面札対策とかes添削）" => "job_small",
          "就活に十分な時間を充てられるか" => "job_jobhunt",
          "企業へのコネ・推薦" => "job_recommendation",
          "就活で活かせるスキルが身につくか" => "job_reserch"
        ];
        $lab_array = [
          "拘束時間の満足度" => "lab_restraint",
          "課外活動の頻度" => "lab_free",
          "研究テーマの設定の自由度" => "lab_advice",
          "ゼミのみの頻度" => "lab_event",
          "プライべートの交流" => "lab_communication",
          "ゼミ・研究室の人気度" => "lab_popularity"
        ];
        $other_array = [
          "英語を使用する頻度" => "other_skill",
          "講義形式" => "other_fac",
          "ゼミ･研究室選択の満足度" => "other_regret",
          "国際的な活動の頻度" => "other_international",
          "男女比の割合" => "other_gender",
        ];
      }
      else
      {
        $prof_array = [
          "面倒見の良さ" => "prof_care",
          "熱意を持って接してくれる" => "prof_friendly",
          "就活イベント・選考会参加への理解" => "prof_jobhunt",
          "学外での人脈" => "prof_network",
          "教授の社会人経験(人事経験など)" => "prof_experience"
        ];
        $jobhunt_array = [
          "大手に強いか" => "job_major",
          "中小・ベンチャーに強いか" => "job_small",
          "就活に十分な時間を充てられる" => "job_jobhunt",
          "企業へのコネ・推薦" => "job_recommendation",
          "研究内容が就活で活かせそうか" => "job_reserch"
        ];
        $lab_array = [
          "拘束時間の満足度" => "lab_restraint",
          "課外活動の頻度(例：勉強会・イベント)" => "lab_event",
          "研究テーマ設定の自由度" => "lab_free",
          "研究に関する上回生からのアドバイス" => "lab_advice",
          "メンバー間の仲の良さ" => "lab_communication",
          "ゼミ・研究室の人気度" => "lab_popularity"
        ];
        $other_array = [
          "スキル・専門性が身に付く" => "other_skill",
          "ゼミ・研究室の設備の充実度" => "other_fac",
          "ゼミ・研究室選択の後悔" => "other_regret",
          "国際的な活動の頻度" => "other_international",
          "男女比の割合" => "other_gender"
        ];
      }

      //各配列をまとめる配列
      $evaluation_array = [
        '教授について' => $prof_array,
        '就活について' => $jobhunt_array,
        '研究室について' => $lab_array,
        'その他' => $other_array
      ];

      /*各項目のタイトルにあたる配列*/
      $eachtitle_array = ["教授について", "就活について", "研究室について", "その他"];

      return view('add_evaluation',[
        'token' => $token,
        'lab_details' => $lab_details,
        'lab_evaluation' => $lab_evaluation,
        'evaluation_array' => $evaluation_array,
        'eachtitle_array' => $eachtitle_array
      ]);
    }

    //各大学の研究室一覧ページへ
    public function to_univ($univ_name){
      $count1 = $count2 = 0;
      $average_item_jp = ["総合評価", "教授", "就活", "研究室", "その他"];

      $laboratories = Laboratory::orderBy('created_at', 'asc')->where('lab_univ', $univ_name)->get();

      /*=== 学部ロゴ画像 設定部=========================*/
      $fac_logos = Fac_logo::orderBy('created_at', 'asc')->get();

      $lab_evaluations = lab_evaluation::orderBy('created_at', 'asc')->where('lab_univ', $univ_name)->get();
      $lab_name = array();
      $array_average = array();
      $average_item = ['all_average', 'prof_average', 'job_average', 'lab_average', 'other_average'];

      /*=====研究室ごとの平均評価計算部===========*/
      $count = 0;
      foreach ($lab_evaluations as $lab_evaluation){
        if($count == 0){
          $lab_name[$count] = $lab_evaluation->lab_name;
          for($n=0; $n<5; $n++){
            $tmp = $average_item[$n];
            $array_average[$count][$n] = $lab_evaluation->$tmp;
          }
          $count++;
        }
        else{
          $frag = 0;
          for($i=0; $i < $count; $i++){
            if($lab_name[$i] == $lab_evaluation->lab_name){
              $frag = 1;
              for($n=0; $n<5; $n++){
                $tmp = $average_item[$n];
                $array_average[$i][$n] = ($array_average[$i][$n] + $lab_evaluation->$tmp);
              }
              break;
            }
          }
          if($frag == 0){
            $lab_name[$count] = $lab_evaluation->lab_name;
          }
          for($n=0; $n<5; $n++){
            $tmp = $average_item[$n];
            $array_average[$count][$n] = $lab_evaluation->$tmp;
           }
          $count++;
        }
      }

      /*======= 各研究室の評価の個数を求める ==============*/
      $num = 0;
      $array_count_evaluations = array();
      while(!empty($lab_name[$num])){
        $array_count_evaluations[] = lab_evaluation::orderBy('created_at', 'asc')->where('lab_name', $lab_name[$num])->where('lab_univ', $univ_name)->count();
        $num++;
      }

      // 各平均値を各研究室の評価の数で割る
      for($i=$num-1; $i>=0; $i--){
        for($n=0; $n<5; $n++){
            $tmp = $average_item[$n];
            $array_average[$i][$n] = number_format(round($array_average[$i][$n] / $array_count_evaluations[$i], 2), 2);
          }
      }


      /*=====最新口コミ　生成部===========*/
      $array_latest_evaluation = array();

      //lab_evaluationの中からカラムを指定して、そのカラム内の値の重複を取り除いてデータを取得する方法
      $array_lab_name_once = lab_evaluation::where('lab_univ', $univ_name)->select('lab_name')->distinct()->get();

      foreach ($array_lab_name_once as $lab_name_once) {
        $each_latest_lab_name = lab_evaluation::latest()
                              ->where('lab_univ', $univ_name)
                              ->where('lab_name', $lab_name_once->lab_name)
                              ->first();
        array_push($array_latest_evaluation, $each_latest_lab_name);
      }

      /*===== return 部 ======*/
      return view('univ_name',[
        'count1' => $count1, 'count2' => $count2,
        'average_item_jp' => $average_item_jp,

        'fac_logos' => $fac_logos,
        'array_count_evaluations' => $array_count_evaluations,
        'lab_name' => $lab_name,
        'array_average' => $array_average,

        'univ_name' => $univ_name,
        'laboratories' => $laboratories,

        'lab_evaluations' => $lab_evaluations,

        'array_latest_evaluation' => $array_latest_evaluation,
      ]);
    }

    //各研究室の詳細ページへ
    public function to_lab_details($lab_details_univ, $lab_details_lab){
      $count = 0;
      $average_item_jp = ["総合評価", "教授", "就活", "研究室", "その他"];
      $laboratories = Laboratory::latest()->get();
      $lab_evaluation = lab_evaluation::latest()->get();
      $evaluation_array = array();
      foreach($lab_evaluation as $index => $evaluation)
      {
        if( $evaluation->lab_univ == $lab_details_univ and $evaluation->lab_name == $lab_details_lab)
          array_push( $evaluation_array , $evaluation);
      }

      /*全平均値を格納した配列（2次元配列）*/
      $array_average = array();
      foreach ($evaluation_array as $evaluation_item) {
        /*空の一時的な配列を定義して、そこに各平均値を格納していく*/
        $array_average = array();
        $array_average[] = round(lab_evaluation::orderBy('created_at', 'asc')->where('lab_name', $evaluation_item->lab_name)->where('lab_univ', $evaluation_item->lab_univ)->avg('all_average'), 2);
        $array_average[] = round(lab_evaluation::orderBy('created_at', 'asc')->where('lab_name', $evaluation_item->lab_name)->where('lab_univ', $evaluation_item->lab_univ)->avg('prof_average'), 2);
        $array_average[] = round(lab_evaluation::orderBy('created_at', 'asc')->where('lab_name', $evaluation_item->lab_name)->where('lab_univ', $evaluation_item->lab_univ)->avg('job_average'), 2);
        $array_average[] = round(lab_evaluation::orderBy('created_at', 'asc')->where('lab_name', $evaluation_item->lab_name)->where('lab_univ', $evaluation_item->lab_univ)->avg('lab_average'), 2);
        $array_average[] = round(lab_evaluation::orderBy('created_at', 'asc')->where('lab_name', $evaluation_item->lab_name)->where('lab_univ', $evaluation_item->lab_univ)->avg('other_average'), 2);
      }

      return view('lab_details',[
        'count' => $count,
        'average_item_jp' => $average_item_jp,
        'lab_details_univ' => $lab_details_univ,
        'lab_details_lab' => $lab_details_lab,
        'lab_evaluation' => $lab_evaluation,
        'laboratories' => $laboratories,
        'evaluation_array' => $evaluation_array,
        'array_average' => $array_average,
      ]);
    }

    //各研究室の評価詳細ページへ
    public function to_lab_evaluation_details($lab_evaluation_details){
      $lab_evaluation = lab_evaluation::find($lab_evaluation_details);

      $laboratory = Laboratory::where('lab_univ', $lab_evaluation->lab_univ)->where('lab_name', $lab_evaluation->lab_name)->first();

      $faculty_lib_array = [
                            "文学部", "教育学部", "経済学部", "経営学部", "商学部",
                            "社会学部", "法学部", "外国語学部", "国際学部", "体育学部",
                            "福祉学部", "芸術学部", "観光学部", "神学部", "総合政策学部",
                            "音楽学部", "文系その他"
                           ];
      $faculty_sci_array = [
                            "理学部", "工学部", "理工学部", "情報学部", "農学部", "医学部",
                            "看護学部", "薬学部", "歯学部","建築学部", "海洋学部",
                            "スポーツ健康科学部", "芸術工学部", "生命科学部","理系その他"
                           ];

      $lib = in_array($laboratory->lab_faculty , $faculty_lib_array);
      $sci = in_array($laboratory->lab_faculty , $faculty_sci_array);

      if($lib)
      {
        $prof_array = [
          "面倒見の良さ" => "prof_care",
          "熱意を持って接してくれる" => "prof_friendly",
          "就活イベント・選考会参加への理解" => "prof_jobhunt",
          "学外での人脈" => "prof_network",
          "教授の社会経験（人事経験など）" => "prof_experience"
        ];
        $jobhunt_array = [
          "大手に強いか" => "job_major",
          "就活に対するサポート（面札対策とかes添削）" => "job_small",
          "就活に十分な時間を充てられるか" => "job_jobhunt",
          "企業へのコネ・推薦" => "job_recommendation",
          "就活で活かせるスキルが身につくか" => "job_reserch"
        ];
        $lab_array = [
          "拘束時間の満足度" => "lab_restraint",
          "課外活動の頻度" => "lab_free",
          "研究テーマの設定の自由度" => "lab_advice",
          "ゼミのみの頻度" => "lab_event",
          "プライべートの交流" => "lab_communication",
          "ゼミ・研究室の人気度" => "lab_popularity"
        ];
        $other_array = [
          "英語を使用する頻度" => "other_skill",
          "講義形式" => "other_fac",
          "ゼミ･研究室選択の満足度" => "other_regret",
          "国際的な活動の頻度" => "other_international",
          "男女比の割合" => "other_gender",
        ];
      }
      else
      {
        $prof_array = [
          "面倒見の良さ" => "prof_care",
          "熱意を持って接してくれる" => "prof_friendly",
          "就活イベント・選考会参加への理解" => "prof_jobhunt",
          "学外での人脈" => "prof_network",
          "教授の社会人経験(人事経験など)" => "prof_experience"
        ];
        $jobhunt_array = [
          "大手に強いか" => "job_major",
          "中小・ベンチャーに強いか" => "job_small",
          "就活に十分な時間を充てられる" => "job_jobhunt",
          "企業へのコネ・推薦" => "job_recommendation",
          "研究内容が就活で活かせそうか" => "job_reserch"
        ];
        $lab_array = [
          "拘束時間の満足度" => "lab_restraint",
          "課外活動の頻度(例：勉強会・イベント)" => "lab_event",
          "研究テーマ設定の自由度" => "lab_free",
          "研究に関する上回生からのアドバイス" => "lab_advice",
          "メンバー間の仲の良さ" => "lab_communication",
          "ゼミ・研究室の人気度" => "lab_popularity"
        ];
        $other_array = [
          "スキル・専門性が身に付く" => "other_skill",
          "ゼミ・研究室の設備の充実度" => "other_fac",
          "ゼミ・研究室選択の後悔" => "other_regret",
          "国際的な活動の頻度" => "other_international",
          "男女比の割合" => "other_gender"
        ];
      }

      //各配列をまとめる配列
      $evaluation_array = [
        '教授について' => $prof_array,
        '就活について' => $jobhunt_array,
        '研究室について' => $lab_array,
        'その他' => $other_array
      ];

      /*各項目のタイトルにあたる配列*/
      $eachtitle_array = ["教授について", "就活について", "研究室について", "その他"];

      return view('lab_evaluation_details',[
        'lab_evaluation_details' => $lab_evaluation_details,
        'evaluation_array' => $evaluation_array,
        'eachtitle_array' => $eachtitle_array,
        'lab_evaluation' => $lab_evaluation,
      ]);
    }

    //マイページへ
    public function to_mypage(){
      $user_datas = lab_evaluation::where('user_id', Auth::user()->id)->get();
      $laboratories = Laboratory::orderBy('created_at', 'asc')->get();
      return view('mypage',[
        'user_datas' => $user_datas,
        'laboratories' => $laboratories
      ]);

    }

}
