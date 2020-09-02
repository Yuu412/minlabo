@extends('layouts.app')
@section('content')

  <div class="card-body">
    <h2>登録情報の確認</h2>

    <div class="col-sm-5" style="padding:20px 0; padding-left:0px;">
      <ul class="list-group">
        <li class="list-group-item">{{ $auth -> name}}</li>
        <li class="list-group-item">{{ $auth -> email}}</li>
        <li class="list-group-item">{{ $auth -> password}}</li>
        <li class="list-group-item">{{ $auth -> univ_name}}</li>
        <li class="list-group-item">{{ $auth -> faculty_name}}</li>
        <li class="list-group-item">{{ $auth -> department_name}}</li>
        <li class="list-group-item">{{ $auth -> lab_name}}</li>
      </ul>
    </div>

    <li class="nav-item">
      <a class="nav-link" href="{{ url('/edit_user') }}">登録情報を変更する</a>
    </li>

  </div>
@endsection
