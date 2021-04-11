@section('title', 'メール送信完了')
<link href="{{ asset('css/sent.css') }}" rel="stylesheet" type="text/css">
<script src="//code.jquery.com/jquery.min.js"></script>

@extends('layouts.app')
@section('content')
<div class="main">
  <h2>メール送信を完了いたしました。</h2>
  <p>
    以下のメールアドレスへ「口コミ投稿リンク」を添付したメールを送信しましたので、<br>
    メールの内容を確認し、口コミ投稿を完了させてください。
  </p>
  <div class="gray-block">
    {{$email}}
  </div>
  <div class="gold-block">
    <span class="break">お使いのメールアドレスによっては、</span>弊サービスからのメールが<br>
    誤って迷惑メールフォルダに振り分けられる可能性がありますのでご注意ください。
  </div>
  <p>
    しばらくしてもメールが届かない場合、ご入力メールアドレスに間違いがあった可能性があります。<br>
    お手数ですが、再度入力いただくか、お問合せメールアドレスまでご連絡ください。
  </p>
</div>
@endsection
