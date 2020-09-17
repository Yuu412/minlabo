@extends('layouts.app')
@section('content')

  <!--バリテーションエラーの表示に使用-->
  @include('common.errors')

  @include('components.botton_register')
  @include('components.botton_login')

  @foreach($amount_reviews_array as $key => $amount_reviews_item)
    {{ $region_array[$key] }} ： {{ $amount_reviews_item }}件 <br>
  @endforeach

  @include('components.botton_register')


@endsection
