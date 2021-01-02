<link href="{{ asset('css/auth/main/registered.css') }}" rel="stylesheet" type="text/css">

@extends('layouts.app')
@section('content')
  <div class="gray-block">
    <h3>本会員登録が完了いたしました。</h3>
  </div>
  <div class="main">
    <div class="main-inbox">
      <div class="content">
        ユーザーの本登録が完了いたしました。<br>
        早速みんラボでゼミ・研究室を探してみましょう。<br>
        まずは、下のログインボタンからログインを行ってください。<br>
      </div>

      <div class="next-box">
        <a class="btn-left" href="{{ route('top') }}">トップに戻る</a>
        <a class="btn-right" href="{{ route('login') }}">ログイン</a>
      </div>
    </div>
  </div>
@endsection
