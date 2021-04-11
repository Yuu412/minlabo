@section('title', 'ログイン')
@section('description', 'Laravel個別ページです。')
<link href="{{ asset('css/login.css') }}" rel="stylesheet" type="text/css">
<script src="http://code.jquery.com/jquery.min.js"></script>

@extends('layouts.app')
@section('content')
  <div class="main">
    <div class="form-box">
      <h2>ログイン</h2>
      <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="メールアドレス" required autocomplete="email" autofocus>
            @error('email')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
        </div>

        <div class="form-group">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="パスワード">
            @error('password')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
        </div>

        <div class="form-group">
          <input class="" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
          <label class="" for="remember">
            ログイン状態を保持する
          </label>
        </div>

        <div class="form-group mb-0">
          <div class="login-box">
            <button type="submit" class="btn btn-primary">
              ログイン
            </button>

            @if (Route::has('password.request'))
              <a class="btn-link" href="{{ route('password.request') }}">
                パスワードをお忘れになった方はこちら
              </a>
            @endif
          </div>
        </div>
      </form>
    </div>
  </div>
@endsection
