@extends('layouts.app')
@section('content')
<!--バリテーションエラーの表示に使用-->
@include('common.errors')
<!--end:バリテーションエラーの表示に使用-->

  <!--Bootstrapの定形コード-->
  <div class="card-body">
    <div class="card-title">
      {{ $lab_details[0] }} の {{ $lab_details[1] }}の評価
    </div>
  </div>

  <!--研究室の評価の登録フォーム-->
  <form action="{{ url('/laboratory/{laboratory}') }}" method="POST" class="form-horizontal">
    {{ csrf_field() }}
    @foreach ($eachtitle_array as $eachtitle)
      <h3>{{ $eachtitle }}</h3>
      @foreach ($evaluation_array[$eachtitle] as $key => $prof_item)
        <div class="form-groupe">
            <label for="{{ $prof_item }}" class="control-label">{{ $key }}</label>
            @for ($val = 1; $val <= 5; $val++)
              @if($val == 3)
                <input type="radio" name="{{ $prof_item }}" value="{{ $val }}" checked>{{ $val }}
              @else
                <input type="radio" name="{{ $prof_item }}" value="{{ $val }}">{{ $val }}
              @endif
            @endfor
        </div>
      @endforeach
    @endforeach

    <h3>OBの就職先</h3>
      <label for="content" class="control-label">下記の画像から、OBの方が就職した業界の番号を記入してください。(例：1、4、30、34)</label>
      <div>
        <img src="{{ asset('img/others/jobtype.jpg') }}" alt="業界リスト" width="600" height="300">
      </div>
        @for($i = 1; $i < 37; $i++)
          <input type="checkbox" name="objobtype[]" value="{{ $i }}"> {{ $i }}
        @endfor

    <h3>口コミ</h3>
      <label for="content" class="control-label">上記の評価をつけた理由など研究室に関する口コミを記入してください(50文字以上1000文字以内)</label>
      <input type="text" name="content" class="form-control @error('content') is-invalid @enderror" required autocomplete="content">

      <!--研究室の評価 登録ボタン-->
      <div class="form-groupe">
        <div class="col-offset-3 col-sm-6">
          <input type="hidden" name="lab_univ" value="{{ $lab_details[0] }}" class="form-control">
          <input type="hidden" name="lab_name" value="{{ $lab_details[1] }}" class="form-control">
          <input type="hidden" name="token" value="{{ $token }}">
          <button type="submit" class="btn btn-primary">送信する</button>
        </div>
      </div>
  </form>

  <!--現在登録済みの研究室一覧-->
@endsection
