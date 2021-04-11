@section('title', '会員登録完了')
<link href="{{ asset('css/auth/registered.css') }}" rel="stylesheet" type="text/css">
<script src="http://code.jquery.com/jquery.min.js"></script>

@extends('layouts.app')
@section('content')
<div class="main">
  <h2>仮会員登録が完了しました。</h2>
  <p>
    以下のメールアドレスへ「ユーザー本登録用リンク」を添付したメールを送信しましたので、<br>
    メールの内容を確認し、本登録手続きを完了させてください。
  </p>
  <div class="gray-block">
    {{$email}}
  </div>
  <div class="gold-block">
    <span class="break">お使いのメールアドレスによっては、</span>弊サービスからのメールが<br>
    誤って迷惑メールフォルダに振り分けられる可能性がありますのでご注意ください。
  </div>
  <p>
    しばらくしても、登録確認メールが届かない場合、ご入力メールアドレスに間違いがあった可能性があります。<br>
    お手数ですが、再度、ご登録いただくか、お問合せアドレスまでご連絡ください。
  </p>
</div>
@endsection
