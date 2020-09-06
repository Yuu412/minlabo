@extends('layouts.app')
@section('content')

  <!--バリテーションエラーの表示に使用-->
  @include('common.errors')

  <a class="nav-link" href="{{ route('register') }}">今すぐユーザー登録</a>
  <a class="nav-link" href="{{ route('login') }}">ログイン</a>

  @foreach($amount_reviews_array as $key => $amount_reviews_item)
    {{ $region_array[$key] }} ： {{ $amount_reviews_item }}件 <br>
  @endforeach


  <a class="nav-link" href="{{ route('register') }}">今すぐユーザー登録</a>

@endsection
