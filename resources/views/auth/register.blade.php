@extends('layouts.app')

@section('content')
    <register :csrf="{{json_encode(csrf_token())}}"
              :endpoint-register-pre-check='@json(route('register.pre_check'))'></register>
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
