<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Laboratory;
use Auth;

class UserController extends Controller
{

  public function confirm_user()
  {
    $auth = Auth::user();
    return view('/user/confirm_user',[ 'auth' => $auth ]);
  }

  public function edit_user()
  {
    $auth = Auth::user();
    return view('user/edit_user',[ 'auth' => $auth ]);
  }


  public function update(Request $request)
  {
  // 対象レコード取得
  $id = Auth::user()->id;
  $auth = User::find($id);

  // リクエストデータ受取
  $form = $request->all();

  // フォームトークン削除
  unset($form['_token']);

  // レコードアップデート
  $auth->fill($form)->save();
  $user_data = Laboratory::where('user_id', Auth::user()->id)->get();

  return redirect(route('confirm',[
       'auth' => $auth
   ]));
  }
}
