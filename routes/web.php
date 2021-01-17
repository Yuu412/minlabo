<?php

use App\Laboratory;
use Illuminate\Http\Request;
use App\Http\Controllers\TermController;
use App\Http\Controllers\PolicyController;

Auth::routes(); //認証機能を使用する。
/*====== 会員登録関係 ===================*/
Route::post('register/pre_check', 'Auth\RegisterController@pre_check')->name('register.pre_check');

// メールから本登録画面に遷移
Route::get('register/verify/{token}', 'Auth\RegisterController@toMainRegister');

// 本登録画面(1)から本登録画面(2)に遷移
Route::post('register/main2', 'Auth\RegisterController@toMain2Register')->name('register.main2');
// 本登録画面(2)から確認画面に遷移
Route::post('register/main/check', 'Auth\RegisterController@toMainRegisterCheck')->name('register.main.check');
// 確認画面から本登録を行う
Route::post('register/main/registered', 'Auth\RegisterController@mainRegistered')->name('register.main.done');

/*=======================================*/

//認証を必須にするミドルウェア
Route::group(['middleware' => ['web']], function ()
{
  //研究室サイトダッシュボード表示
  Route::get('/', 'IndexController@index');
  Route::post('/', 'IndexController@index');

  //検索結果表示
  Route::post('/search_result', 'SearchController@search')->name('search');

  //エリアごとに探すページ
  Route::get('/area/{prefecture_name}','AreaSearchController@area_search')->name('area');

  //学部ごとに探すページ
  Route::get('/faculty-result/{faculty}', 'FacultySearchController@faculty_result');

  Route::post('/', 'LabController@mv_add');

  //更新画面
  Route::post('/labedit/{lab_evaluation_id}','LabController@mv_update');

  //更新処理
  Route::post('/mypage/update', 'LabController@update');

  //削除処理
  Route::delete('/mypage/delete/{lab_evaluation_id}', 'LabController@delete');

  //TO: 登録情報の編集画面
  Route::PUT('update',[
    'uses' => 'UserController@update',
    'as' => 'update'
  ]);

  //TO:各大学ページ
  Route::get('/univ/{univ_name}','UnivController@to_univ');

  //TO:各研究室ページ
  Route::get('/lab/{lab_details_univ}/{lab_details_lab}','ToLabDetailsController@to_lab_details');

  //TO:各研究室の評価詳細ページ
  Route::get('/lab-evaluation/{lab_evaluation_details}','LabEvaluationController@to_lab_evaluation_details');

  //TO: マイページ
  Route::get('/my-page','ToMypageController@to_mypage')->name('my-page');

  //TO: 登録情報の確認画面
  Route::get('/confirm_user',[
    'uses' => 'UserController@confirm_user',
    'as' => 'confirm'
  ]);

  //TO: 登録情報の編集画面
  Route::get('/edit_user','UserController@edit_user');

});

//========ログインしなくてもアクセスできるページ========================================
//研究室サイトダッシュボード表示
Route::get('top', 'PreindexController@preindex')->name('top');

Route::get('/home', 'IndexController@index')->name('home');

Route::get('/policy', function(){
  return view('policy');
});

//QRコードから口コミ登録画面への遷移
//Route::get('/review/{token}', 'LinkController@qr_to_add');

//研究室の追加
Route::post('/laboratories', 'LabController@store');

//TO:研究室の情報追加ページ
Route::post('/add/2', 'RetunivController@ret_univ');

//研究室の評価追加
Route::post('/store/evaluation', 'StoreEvaluationController@store_evaluation');

//TO:研究室の情報追加ページ(大学・学部・学科・研究室名)
Route::POST('/add_evaluation', 'LabAdditionController@add_evaluation');

//TO:研究室の評価追加ページ(リダイレクト)
Route::GET('/add_evaluation',  function(){
    return view('add_evaluation');
});

//TO:研究室の評価追加ページ(研究室を表示するview to 評価を追加)
Route::get('/add_evaluation/{lab_details_univ}/{lab_details_lab}', 'LinkController@to_add_evaluation');

//TO:研究室の情報追加ページ
Route::get('/add', 'LinkController@to_add');

//TO:研究室の口コミ投稿リンクの送信先メールアドレス記入ページ
Route::get('send_review_link',  function(){
    return view('/send_review_link');
})->name('send.link.page');
//TO:送信先メールアドレスの確認ページ
Route::POST('/send_check', 'SendReviewLinkController@to_send_check')->name('send.email.check');
//TO:口コミ投稿フォーム送信完了ページ
Route::POST('/sent', 'SendReviewLinkController@to_sent')->name('send');
//From::メール, TO:口コミ投稿フォーム
Route::get('add/{email_token}', 'SendReviewLinkController@to_add');

//プライバシーポリシーページ
Route::get('policy', [PolicyController::class, 'index'])->name('policy');
