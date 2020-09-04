<?php

use App\Laboratory;
use Illuminate\Http\Request;

Auth::routes(); //認証機能を使用する。

//認証を必須にするミドルウェア
Route::group(['middleware' => ['web']], function ()
{

  Route::post('register/pre_check', 'Auth\RegisterController@pre_check')->name('register.pre_check');


  //研究室サイトダッシュボード表示
  Route::get('/', 'LabController@index');
  Route::post('/', 'LabController@index');

  //検索結果表示
  Route::get('/search_result', 'LabController@search');

  //エリアごとに探すページ
  Route::get('/area/{pre_name}','LabController@area_search');

  //学部ごとに探すページ
  Route::get('/faculty_result/{faculty}', 'LabController@faculty_result');

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
  Route::get('/univ/{univ_name}','LinkController@to_univ');

  //TO:各研究室ページ
  Route::get('/lab/{lab_details_univ}/{lab_details_lab}','LinkController@to_lab_details');

  //TO:各研究室の評価詳細ページ
  Route::get('/lab-evaluation/{lab_evaluation_details}','LinkController@to_lab_evaluation_details');

  //TO: マイページ
  Route::get('/mypage','LinkController@to_mypage');

  //TO: 登録情報の確認画面
  Route::get('/confirm_user',[
    'uses' => 'UserController@confirm_user',
    'as' => 'confirm'
  ]);

  //TO: 登録情報の編集画面
  Route::get('/edit_user','UserController@edit_user');

});

//========ログインしなくてもアクセスできるページ========================================

//本会員登録用URLがクリックされると本会員登録フォームに遷移
Route::get('register/verify/{token}', 'Auth\RegisterController@showForm');

Route::post('register/main_check', 'Auth\RegisterController@mainCheck')->name('register.main.check');
Route::post('register/main_register', 'Auth\RegisterController@mainRegister')->name('register.main.registered');

Route::get('/home', 'LabController@index')->name('home');

Route::get('/welcome', function(){
  return view('welcome');
});

//QRコードから口コミ登録画面への遷移
Route::get('/review/{token}', 'LinkController@qr_to_add');

//研究室の追加
Route::post('/laboratories', 'LabController@store');

//TO:研究室の情報追加ページ
Route::post('/add/2', 'LinkController@ret_univ');

//研究室の評価追加
Route::post('/laboratory/{laboratory}', 'LinkController@store_evaluation');

//TO:研究室の評価追加ページ(大学を追加 to 評価を追加)
Route::POST('/add_evaluation', 'LinkController@add_evaluation');
//TO:研究室の評価追加ページ(リダイレクト)
Route::GET('/add_evaluation',  function()
{
    return view('add_evaluation');
});

//TO:研究室の評価追加ページ(研究室を表示するview to 評価を追加)
Route::get('/add_evaluation/{lab_details_univ}/{lab_details_lab}', 'LinkController@to_add_evaluation');

//TO:研究室の情報追加ページ
Route::get('/add', 'LinkController@to_add');
