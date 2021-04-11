@section('title', '無料ユーザー登録')
<link href="{{ asset('css/auth/register.css') }}" rel="stylesheet" type="text/css">
<script src="http://code.jquery.com/jquery.min.js"></script>

@extends('layouts.app')
@section('content')
  <div class="main">
    <div class="form-box">
      <h2>無料ユーザー登録（1分）</h2>
      <form method="POST" action="{{ route('register.pre_check') }}">
        <h3>基本情報<span class="necessary"><span>*</span>必須</span></h3>
        @csrf

        <table border="1">
         <tr>
           <th>
             <label for="email" class="">メールアドレス（ID）<span class="necessary"><span>*</span></span></label>
           </th>
           <td>
             <div class="input-box">
               <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="email@email.com">
               <span>ログイン時のIDとなります。</span>
               @error('email')
                 <span class="invalid-feedback" role="alert">
                   <strong>{{ $message }}</strong>
                 </span>
               @enderror
             </div>
           </td>
         </tr>
         <tr>
           <th>
             <label for="password" class="">パスワード<span class="necessary"><span>*</span></span></label>
           </th>
           <td>
             <div class="input-box">
               <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
               <span>8文字以上16文字以内で入力してください。</span>
               @error('password')
                 <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                 </span>
               @enderror
             </div>
           </td>
         </tr>
         <tr>
          <th>
           <label for="password-confirm" class="">パスワードの確認<span class="necessary"><span>*</span></span></label>
          </th>
          <td>
            <div class="input-box">
              <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>
          </td>
         </tr>
       </table>

        <div class="form-group mb-0">
          <div class="next-box">
            <button type="submit" class="btn btn-primary">
              次へ
            </button>
          </div>
        </div>
        </form>
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
