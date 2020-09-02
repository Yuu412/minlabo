@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
    @include('common.errors')

    <h3>
      {{$lab_evaluation->lab_univ}}に所属する
      {{$lab_evaluation->lab_name}}の評価の修正
    </h3>

    <form action="{{ url('mypage/update') }}" method="POST">

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
        <label for="content" class="control-label">上記の評価をつけた理由など研究室に関する口コミを記入してください(100文字以上1000文字以内)</label>
        <input type="text" name="content" class="form-control">


        <!-- Saveボタン/Backボタン -->
        <div class="well well-sm">
            {{-- Saveするボタン --}}
            <input type="hidden" name="id" value="{{ $lab_evaluation->id }}">
            <button type="submit" class="btn btn-primary">Save</button>
            {{-- Backするボタン --}}
            <a class="btn btn-link pull-right" href="{{ url('/') }}">Back</a>
        </div>
        <!--/ Saveボタン/Backボタン -->

         <!-- id値を送信 -->
         <input type="hidden" name="id" value="{{$lab_evaluation->id}}">
         <!--/ id値を送信 -->

         <!-- CSRF -->
         {{ csrf_field() }}
         <!--/ CSRF -->

    </form>
    </div>
</div>
@endsection
