@extends('layouts.app')
@section('content')

  @if(count($laboratories) >= 0)
  <!--Bootstrapの定形コード-->

  <!--バリテーションエラーの表示に使用-->
  @include('common.errors')
  <!--↓↓ 検索フォーム ↓↓-->
  <h2>研究室・ゼミ探す</h2>
  @include('components.search-form', ['keyword'=>$keyword])

  <h2>エリアから探す</h2>
  <!--↓↓ 主要都道府県 ↓↓-->
  <div class="d-flex flex-row" style="padding:20px 0; padding-left:0px;">
    @foreach($pre_array[0] as $pre_name)
      @include('components.area', ['i'=>$i])
    @endforeach
  </div>

  <!--↓↓ 各エリアごとの都道府県 ↓↓-->
  @for ($i = 1; $i <= 6; $i++)
    @include('components.area', ['i'=>$i])
  @endfor

  <!--↓↓ 学部ごと表示部 ↓↓-->
  <h2>学部から探す</h2>
  @for ($n = 0; $n < 2; $n++)
      <div class="d-flex flex-row" style="padding:20px 0; padding-left:0px;">
        <h3>{{ $HandS[$n] }}</h3>
        @foreach($fac_array[$n] as $lab_faculty)
          <a class="nav-link" href="{{  url('faculty_result/'.$lab_faculty) }}">
            @foreach($fac_logos as $fac_logo)
              @if($fac_logo->fac_name == $lab_faculty)
              <div>
                <img src="{{ asset('img/fac_logo/' .$fac_logo->fac_logo) }}" alt="{{ $fac_logo->fac_logo }}" width="75" height="75">
              </div>
              @endif
            @endforeach
            {{ $lab_faculty }}
          </a>
        @endforeach
      </div>
  @endfor

  <!--↓↓ 新着口コミ表示 ↓↓-->
    <table class="table table-striped task-table">
      <thead>
        <th>新着口コミ</th>
      </thead>
      <tbody>
        @foreach($lab_evaluations as $lab_evaluation)
          @if ($loop->index < 5)
            @include('components.new-laboratories', ['lab_evaluations' => $lab_evaluation])
          @endif
        @endforeach
      </tbody>
    </table>

    <!--↓↓ 総合評価ランキング表示 ↓↓-->
    <table class="table table-striped task-table">
      <thead>
        <th>総合評価ランキング</th>
      </thead>
      <tbody>
        @foreach($ranking_evaluations as $lab_evaluation)
          @if ($loop->index < 5)
            @include('components.new-laboratories', ['lab_evaluations' => $lab_evaluation])
          @endif
        @endforeach
      </tbody>
    </table>
@endif
@endsection
