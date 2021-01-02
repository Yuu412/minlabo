<link href="{{ asset('css/auth/register_check.css') }}" rel="stylesheet" type="text/css">
<script src="http://code.jquery.com/jquery.min.js"></script>
@extends('layouts.app')
@section('content')
<div class="main">
  <div class="form-box">
    <h2>ユーザー仮登録 確認画面</h2>
    <p>
      登録内容をご確認の上、「送信する」ボタンを押してください。<br>
      ご入力いただいたメールアドレスに仮登録確認メールが送信されます。
    </p>
    <form method="POST" action="{{ route('register') }}">
      <h3>基本情報</h3>
      @csrf

      <table border="1">
       <tr>
         <th>
           <label for="email" class="">メールアドレス（ID）</label>
         </th>
         <td>
           <div class="input-box">
            <span class="">{{$email}}</span>
            <input type="hidden" name="email" value="{{$email}}">
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
           <label for="password" class="">パスワード</label>
         </th>
         <td>
           <div class="input-box">
             <span class="">{{$password_mask}}</span>
             <input type="hidden" name="password" value="{{$password}}">
             @error('password')
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
          <a class="btn btn-primary" href="{{ route('register') }}">戻る</a>
          <button type="submit" class="btn btn-primary">送信する</button>

        </div>
      </div>
      </form>
    </div>
  </div>
@endsection
