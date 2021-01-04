<link href="{{ asset('css/auth/main/register_check.css') }}" rel="stylesheet" type="text/css">
@extends('layouts.app')

@section('content')

  <div class="gray-block">
    <h3>本会員登録確認</h3>
  </div>
  @include('common.errors')

  <div class="main">
    <div class="main-inbox">
        <div class="step">
          <h4>STEP２</h4>
        </div>
        <div class="content-message">
          あなたが在籍する大学の情報を確認してください。
        </div>
        <form method="POST" action="{{ route('register.main.done') }}">
            @csrf
            <table border="1" width="1080" cellspacing="0" cellpadding="5" bordercolor="#EEE">
              <!--研究室が所属する大学名-->
              <tr>
                <th class="content-title" width="30%" height="75px">
                  大学名
                </th>
                <th class="right-block">{{ $user['univ_name'] }}</th>
                <input type="hidden" name="univ_name" value="{{ $user['univ_name'] }}">
              </tr>

              <!--学部の名前-->
              <tr>
                <th class="content-title" width="30%" height="75px">
                  学部名
                </th>
                <th class="right-block">{{ $user['faculty_name'] }}</th>
                <input type="hidden" name="faculty_name" value="{{ $user['faculty_name'] }}">
              </tr>

              <!--学科の名前-->
              <tr>
                <th class="content-title" width="30%" height="75px">
                  学科名
                </th>
                <th class="right-block">{{ $user['department_name'] }}</th>
                <input type="hidden" name="department_name" value="{{ $user['department_name'] }}">
              </tr>
            </table>

            <input type="hidden" name="token" value="{{ $user['token'] }}">
            <input type="hidden" name="prefecture_name" value="{{ $prefecture_name }}">

              <p class="policy-check">
                <label>
                    <input type="checkbox" required>
                    <a href="">利用規約</a>と<a href="">個人情報の取扱いについて</a>に同意する
                </label>
              </p>

            <div class="next-button">
              <!--次のページへ ボタン-->
              <button type="submit" class="btn btn-primary">本登録</button>
            </div>
        </form>
    </div>
  </div>

@endsection
