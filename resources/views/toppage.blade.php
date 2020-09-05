@extends('layouts.app')
@section('content')

  <!--バリテーションエラーの表示に使用-->
  @include('common.errors')

  <a class="nav-link" href="{{ route('register') }}">今すぐユーザー登録</a>
  <a class="nav-link" href="{{ route('login') }}">ログイン</a>

@endsection
