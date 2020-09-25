@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">本会員登録完了</div>

                    <div class="card-body">
                        <p>本会員登録が完了しました。</p>

                        <div>
                          ゼミ・研究室の口コミを閲覧するには、以下のQRコードを先輩に送り、口コミを1件以上投稿してください。
                          <br>
                          先輩からの口コミが投稿され次第、口コミが閲覧できるようになります！

                          {!!
                             QrCode::format('svg')->size(300)
                                ->generate('http://127.0.0.1:8080/review/'.$token);
                          !!}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
