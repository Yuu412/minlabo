@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('仮会員登録') }}</div>

                <div class="card-body">
                   <form method="POST" action="{{ route('register.pre_check') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('メールアドレス') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('パスワード') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('パスワードの確認') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if(!empty($error_msg))
        {{$error_msg}}
        @include('components.botton_login')

    @elseif(!empty($token))
        本登録が完了しています。<br>
        上記のQRコードのスクリーンショットを撮って、<br>
        先輩・友人・兄弟に送信し、口コミを1件以上投稿してもらってください！<br>
        口コミが投稿され次第「みんラボ」のサービスをお使いいただけます。<br>

        {!!
           QrCode::format('svg')->size(300)
              ->generate('http://127.0.0.1:8080/review/'.$token);
        !!}
        <div>
            既に口コミ投稿をしてもらっている方は、以下からログインしてください。
            @include('components.botton_login')
        </div>
    @endif
</div>
@endsection
