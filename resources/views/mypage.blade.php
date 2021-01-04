<link href="{{ asset('css/mypage.css') }}" rel="stylesheet" type="text/css">
<script src="http://code.jquery.com/jquery.min.js"></script>

@extends('layouts.app')
@section('content')
  @if(count($user_datas) > 0)

  <!--バリテーションエラーの表示に使用-->
  @include('common.errors')
  <div class="gray-block">
    <h3>マイページ</h3>
    <a href="{{ url('/confirm_user') }}">登録情報を確認・変更する</a>

    <!--研究室登録フォーム-->
    @include('components.botton_add_reviews')
  </div>
  <div class="main">
    <div class="main-inbox">
      <h4 class="search-result">これまでに投稿した口コミ</h4>
        @foreach($evaluations_collection as $evaluation)
          @include('components.evaluation_category')
        @endforeach
    </div>
  </div>

{{--
    <table class="table table-striped task-table">
      <!--テーブルヘッダ-->
      <thead>
        <th>研究室一覧</th>
        <th>&nbsp;</th>
      </thead>
      <!--テーブル本体-->
      <tbody>
        @foreach($user_datas as $user_data)
          <tr>
            <td class="table-text">
              <a class="nav-link" href="{{ url('lab/'.$user_data->lab_univ.'/'.$user_data->lab_name) }}">
                <div>{{ $user_data->lab_name }}</div>
              </a>
            </td>
            <td class="table-text">
              <a class="nav-link" href="{{ url('univ/'.$user_data->lab_univ) }}">
                <div>{{ $user_data->lab_univ }}</div>
              </a>
            </td>
            <td class="table-text">
              <a class="nav-link" href="{{ url('lab-evaluation/'.$user_data->id) }}">
              <div>{{ $user_data->all_average }}</div>
            </td>
            <td class="table-text">
              <div>{{ $user_data->add_time }}</div>
            </td>
            <!--更新ボタン-->
            <td>
              <form action="{{ url('labedit/'.$user_data->id) }}" method="POST">
                {{ csrf_field() }}
                <button type="submit" class="btn btn-primary">
                  更新
                </button>
              </form>
            </td>
            <!--削除ボタン-->
            <td>
              <form action ="{{ url('mypage/delete/'.$user_data->id) }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}

                <button type="submit" class="btn btn-danger">
                  削除
                </button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
  </table>
  --}}

@endif
@endsection
