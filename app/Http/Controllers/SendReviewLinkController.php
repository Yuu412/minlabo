<?php

namespace App\Http\Controllers;
use App\Mail\EmailVerification;
use App\Mail\ReviewFormMail;
use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;
use App\User;

class SendReviewLinkController extends Controller
{
  public function to_send_check(Request $request)
  {
      $request->flashOnly('email');

      $email_flag = User::where('email', $request->email)->first();
      if (isset($email_flag)) {
          $role = $email_flag->role;
          if($role == 1){ //仮会員登録
              $error_msg = "すでに仮会員登録は完了しております。
                本登録がまだの方は登録に使ったメールアドレスをご確認ください。
                本登録が終了されている方は、以下からログインしてください。";
              return view('send_review_link', [
                  'error_msg' => $error_msg,
              ]);
          } elseif($role == 2) {  //以前に投稿済み＆未登録
              return view('send_check',[
                'email' => $request->email
              ]);
          } elseif ($role == 10) { //本登録済み
              return view('send_review_link', [
                  'flag' => 1,
              ]);
          } else{ //未登録
            return view('send_check',[
              'email' => $request->email
            ]);
          }
      } else {
        $bridge_request = $request->all();

        return view('send_check',[
          'email' => $request->email
        ]);
      }
  }

  protected function to_sent(Request $request)
  {
      $email_flag = User::where('email', $request->email)->first();
      if (isset($email_flag)) {
        /*
        $email = new EmailVerification($email_flag);
        Mail::to($email_flag->email)->send($email);
        */
        $email = new ReviewFormMail($email_flag);
        Mail::to($email_flag->email)->send($email);
      }
      else{
        $role = 2;
        $user = User::create([
            'email' => $request->email,
            'email_verify_token' => base64_encode($request->email),
            'role' => $role,
        ]);
        //$email = new EmailVerification($user);
        $email = new ReviewFormMail($user);
        Mail::to($user->email)->send($email);
      }

      return view('sent', ["email" => $request->email]);
  }

  public function to_add($email_token){
    $token = $email_token;
    $all_prefectures = [
            "北海道", "青森県", "秋田県", "山形県", "岩手県", "宮城県", "福島県",
            "東京都", "神奈川県", "埼玉県", "千葉県", "栃木県", "茨城県", "群馬県",
            "愛知県", "岐阜県", "静岡県", "三重県", "新潟県", "山梨県", "長野県", "石川県", "富山県", "福井県",
            "大阪府", "兵庫県", "京都府", "滋賀県", "奈良県", "和歌山県",
            "岡山県", "広島県", "鳥取県", "島根県", "山口県", "香川県", "徳島県", "愛媛県", "高知県",
            "福岡県", "佐賀県", "長崎県", "熊本県", "大分県", "宮崎県", "鹿児島県", "沖縄県",
    ];

    return view('add',[
      'token' => $token,
      'all_prefectures' => $all_prefectures,
    ]);
  }
}
