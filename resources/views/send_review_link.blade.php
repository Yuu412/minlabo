@section('title', '口コミ投稿フォームの送信')
<link href="{{ asset('css/send_review_link.css') }}" rel="stylesheet" type="text/css">
<script src="//code.jquery.com/jquery.min.js"></script>

@extends('layouts.app')
@section('content')
  <div class="main">
    <div class="form-box">
      <h2>指定のメールアドレスに投稿用フォームを送信します。</h2>
      <form method="POST" action="{{ route('send.email.check') }}">
        @csrf

        <table border="1">
         <tr>
           <th>
             <label for="email" class="">メールアドレス</label>
           </th>
           <td>
             <div class="input-box">
               <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="email@email.com">
               @error('email')
                 <span class="invalid-feedback" role="alert">
                   <strong>{{ $message }}</strong>
                 </span>
               @enderror
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
      <div class="msg-box">
        @if(!empty($error_msg))
          すでに仮会員登録は完了しております。<br>
          ご登録に使用されたメールアドレスをご確認ください。<br>
          メールアドレスを忘れた方は、お問い合わせメールアドレスよりご連絡ください。
          <div class="msg-button-box">
            <a class="btn btn-primary" href="{{ route('home')}}">トップページ</a>
            <a class="btn btn-primary" href="{{ route('login')}}">ログイン</a>
          </div>
        @elseif(!empty($flag))
          ご記入いただいたメールアドレスは、本登録が完了しています。<br>
          以下のボタンからログインしてください。
          <div class="msg-button-box">
            <a class="btn btn-primary" href="{{ route('home')}}">トップページ</a>
            <a class="btn btn-primary" href="{{ route('login')}}">ログイン</a>
          </div>
        @endif
      </div>
      </div>
@endsection
