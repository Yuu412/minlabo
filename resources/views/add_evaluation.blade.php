<link href="{{ asset('css/add_evaluation.css') }}" rel="stylesheet" type="text/css">
@extends('layouts.app')
@section('content')
<!--バリテーションエラーの表示に使用-->
@include('common.errors')

  <div class="gray-block">
    <h3>{{ $lab_details[0] }} の {{ $lab_details[1] }}の口コミを投稿する</h3>
  </div>
  <div class="main">
    <div class="main-inbox">
      <div class="step">
        <h3>STEP３</h3>
      </div>
      <div class="section">
        <div class="content-message">
          各項目について0から5までの値を選択してください。<br>
          数字が大きくなるほど評価が高くなります。
        </div>
        <!--研究室の評価の登録フォーム-->
        <form action="{{ url('/store/evaluation') }}" method="POST" class="form-horizontal">
          {{ csrf_field() }}

          @foreach ($eachtitle_array as $eachtitle)
          <div class="each-category">
            <div class="each-category-title">
              <h4>{{ $eachtitle }}</h4>
            </div>
            <div class="each-category-items wrap around">
                @foreach ($evaluation_array[$eachtitle] as $key => $prof_item)
                  <div class="content">
                    <table width="0" cellspacing="0" cellpadding="5">
                        <th class="left-block">
                          <label for="{{ $prof_item }}" class="control-label">{{ $key }}</label>
                        </th>
                        <th class="right-block">
                          @for ($val = 1; $val <= 5; $val++)
                            @if($val == 3)
                              <input type="radio" name="{{ $prof_item }}" value="{{ $val }}" checked>{{ $val }}
                            @else
                              <input type="radio" name="{{ $prof_item }}" value="{{ $val }}">{{ $val }}
                            @endif
                          @endfor
                        </th>
                    </table>
                  </div>
                @endforeach
            </div>
          </div>
          @endforeach
        </div>

        <div class="section">
          <h3>OBの就職先</h3>
          <div class="content-message">
            <label for="content" class="control-label">
              下記の画像から、OBの方が就職した業界の番号を記入してください。(例：1、4、30、34)
            </label>
          </div>
          <div>
            <img src="{{ asset('img/others/jobtype.jpg') }}" alt="業界リスト" width="600" height="300">
          </div>
          @for($i = 1; $i < 37; $i++)
            <input type="checkbox" name="objobtype[]" value="{{ $i }}"> {{ $i }}
          @endfor
        </div>

        <div class="section">
            <h3>ゼミ・研究室に入るために必要なＧＰＡや条件</h3>
            <div class="content-message">
              <label for="terms" class="control-label">
                このゼミ・研究室に入るための基準となるＧＰＡや条件や目安などがあれば教えてください
              </label>
            </div>
            <input type="text" name="terms" class="form-control @error('content') is-invalid @enderror">
        </div>

        <div class="section">
          <h3>口コミ</h3>
          <div class="content-message">
            <label for="content" class="control-label">
              研究室についての口コミ情報を記入してください。<br>
              内容は、上記で評価していただいた項目について説明していただく形でも構いませんし、追加情報などでも構いません。
            </label>
          </div>
          <textarea name="content" class="form-content form-control @error('content') is-invalid @enderror" required autocomplete="content" placeholder="（例）〇〇研究室は体育会系が多いというイメージ通りの研究室でした。研究をがっつりする研究室で、 土日・祝日関係なく実験をする時期は毎日研究室に行っていました。 上の評価項目で言った通り、教授がとてもフレンドリーで親切な方なので、わからないことは気軽に質問できる雰囲気でした。就活に関しては、某大手テレビ企業への推薦や、某大手商社へのコネがあるといった話を聴いたことがあります。"></textarea>
        </div>

          <!--研究室の評価 登録ボタン-->
          <div class="decision-button">
            <input type="hidden" name="lab_univ" value="{{ $lab_details[0] }}" >
            <input type="hidden" name="lab_name" value="{{ $lab_details[1] }}" >
            <input type="hidden" name="token" value="{{ $token }}">
            <button type="submit" class="btn btn-primary">送信する</button>
          </div>
      </form>
    </div>
  </div>
  <!--現在登録済みの研究室一覧-->
@endsection
