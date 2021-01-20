<link href="{{ asset('css/add_evaluation.css') }}" rel="stylesheet" type="text/css">
<script src="//code.jquery.com/jquery.min.js"></script>

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
        <div class="content-message">
          各項目について0から5までの値を選択してください。<br>
          数字が大きくなるほど評価が高くなります。
        </div>
        <!--研究室の評価の登録フォーム-->
        <form action="{{ url('/store/evaluation') }}" method="POST" class="form-horizontal">
          {{ csrf_field() }}
          <div class="section">

          @foreach ($eachtitle_array as $eachtitle)
          <div class="each-category">
            <div class="each-category-title">
              <h4>{{ $eachtitle }}</h4>
            </div>
            <div class="each-category-items wrap around">
                <div class="flex-box review-value">
                  <div class="flex-item">1</div>
                  <div class="flex-item">2</div>
                  <div class="flex-item">3</div>
                  <div class="flex-item">4</div>
                  <div class="flex-item">5</div>
                </div>
                @php
                  $count = $loop->iteration;
                @endphp
                @foreach ($evaluation_array[$eachtitle] as $key => $prof_item)
                  <div class="content">
                    @include('components.radio_input_review',['count_item' => $loop->iteration])
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
              ゼミ・研究室のOB･OGが就職した業界を教えてください。
            </label>
          </div>
          <div class="flex-box jobtype-box">
            @foreach ($jobtype_array as $key => $jobtype)
              <div class="jobtype">
                <h4 class="jobtype-name">{{$key}}</h4>
                <div class="job-name">
                  @foreach ($jobtype as $job)
                    <div class="choices">
                      <input type="checkbox" name="objobtype[]" value="{{$job}}">
                      {{$job}}
                    </div>
                  @endforeach
                </div>
              </div>
            @endforeach
          </div>
        </div>

        <div class="section">
            <h3>ゼミ・研究室に入るために必要なＧＰＡや条件</h3>
            <div class="content-message">
              <label for="terms" class="control-label">
                ご自身のGPAや、このゼミ・研究室に配属される際に必要な条件(GPA 2.8以上など)があれば教えて下さい。
              </label>
            </div>
            <input type="text" name="terms" id="form-terms" class="form-control @error('content') is-invalid @enderror">
        </div>

        <div class="section">
          <h3>口コミ</h3>
          <div class="content-message">
            <label for="content" class="control-label">
              研究室についての口コミ情報を記入してください。<br>
              内容は上記で評価していただいた項目について説明していただく形でも構いませんし、追加情報などでも構いません。
            </label>
          </div>
          <textarea name="content" class="form-content form-control @error('content') is-invalid @enderror" required autocomplete="content" placeholder="※100文字以上（例）〇〇研究室は体育会系が多いというイメージ通りの研究室でした。研究をがっつりする研究室で、 土日・祝日関係なく実験をする時期は毎日研究室に行っていました。 上の評価項目で言った通り、教授がとてもフレンドリーで親切な方なので、わからないことは気軽に質問できる雰囲気でした。就活に関しては、某大手テレビ企業への推薦や、某大手商社へのコネがあるといった話を聴いたことがあります。"></textarea>
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
