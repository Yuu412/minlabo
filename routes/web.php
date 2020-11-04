<?php

use App\Laboratory;
use Illuminate\Http\Request;
use App\Http\Controllers\TermController;
use App\Http\Controllers\PolicyController;

Auth::routes(); //認証機能を使用する。
/*====== 会員登録関係 ===================*/
Route::post('register/pre_check', 'Auth\RegisterController@pre_check')->name('register.pre_check');

Route::get('register/verify/{token}', 'Auth\RegisterController@mainRegister');
/*=======================================*/

//認証を必須にするミドルウェア
Route::group(['middleware' => ['web']], function ()
{

  //研究室サイトダッシュボード表示
  Route::get('/', 'IndexController@index');
  Route::post('/', 'IndexController@index');

  //検索結果表示
  Route::post('/search_result', 'LabController@search')->name('search');

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
  Route::get('/lab/{lab_details_univ}/{lab_details_lab}','LinkController@to_lab_details');

  //TO:各研究室の評価詳細ページ
  Route::get('/lab-evaluation/{lab_evaluation_details}','LabEvaluationController@to_lab_evaluation_details');

  //TO: マイページ
  Route::get('/my-page','LinkController@to_mypage')->name('my-page');

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

Route::get('/welcome', function(){
  return view('welcome');
});

//QRコードから口コミ登録画面への遷移
Route::get('/review/{token}', 'LinkController@qr_to_add');

//研究室の追加
Route::post('/laboratories', 'LabController@store');

//TO:研究室の情報追加ページ
Route::post('/add/2', 'RetunivController@ret_univ');

//研究室の評価追加
Route::post('/store/evaluation', 'StoreEvaluationController@store_evaluation');

//TO:研究室の情報追加ページ(大学・学部・学科・研究室名)
Route::POST('/add_evaluation', 'LabAdditionController@add_evaluation');

//TO:研究室の評価追加ページ(リダイレクト)
Route::GET('/add_evaluation',  function()
{
    return view('add_evaluation');
});

//TO:研究室の評価追加ページ(研究室を表示するview to 評価を追加)
Route::get('/add_evaluation/{lab_details_univ}/{lab_details_lab}', 'LinkController@to_add_evaluation');

//TO:研究室の情報追加ページ
Route::get('/add', 'LinkController@to_add');

//利用規約ページ
Route::get('term', [TermController::class, 'index'])->name('term');

//プライバシーポリシーページ
Route::get('policy', [PolicyController::class, 'index'])->name('policy');
