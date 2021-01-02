<link href="{{ asset('css/user/confirm_user.css') }}" rel="stylesheet" type="text/css">
@extends('layouts.app')
@section('content')
<div class="gray-block">
  <h2>登録情報の確認</h2>
</div>
<div class="main">
  <div class="form-box">
      <h3>メールアドレス</h3>
      <div class="content">{{ $auth -> email}}</div>

      <h3>パスワード</h3>
      <div class="content">********</div>

      <h3>プロフィール情報</h3>
      <table border="1">
        <tr>
         <th>所属大学</th>
         <td>{{ $auth->univ_name}}</td>
        </tr>
        <tr>
         <th>学部</th>
         <td>{{ $auth->faculty_name}}</td>
        </tr>
        <tr>
         <th>学科</th>
         <td>{{ $auth->department_name}}</td>
        </tr>
      </table>
    </div>
  </div>

    <li class="nav-item">
      <a class="nav-link" href="{{ url('/edit_user') }}">登録情報を変更する</a>
    </li>
@endsection
