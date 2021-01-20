<link href="{{ asset('css/send_check.css') }}" rel="stylesheet" type="text/css">
<script src="//code.jquery.com/jquery.min.js"></script>
@extends('layouts.app')
@section('content')
<div class="main">
  <div class="form-box">
    <h2>メールアドレス 確認画面</h2>
    <p>
      メールアドレスをご確認の上、「送信する」ボタンを押してください。<br>
      ご入力いただいたメールアドレスに口コミ投稿フォームが送信されます。
    </p>
    <form method="POST" action="{{ route('send') }}">
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
     </table>

     <p class="policy-check">
       <label>
           <input type="checkbox" required>
           <a href="{{ route('policy')}}" target="_blank">利用規約</a>と<a href="{{ route('policy')}}" target="_blank">個人情報の取扱いについて</a>に同意する
       </label>
     </p>

      <div class="form-group mb-0">
        <div class="next-box">
          <a class="btn btn-primary" href="{{ route('send.link.page')}}">戻る</a>
          <button type="submit" class="btn btn-primary">送信する</button>
        </div>
      </div>
      </form>
    </div>
  </div>
@endsection
