<link href="{{ asset('css/faculty_result.css') }}" rel="stylesheet" type="text/css">
<script src="//code.jquery.com/jquery.min.js"></script>

@extends('layouts.app')
@section('content')
  @if(count($laboratories_collection))
    <div class="gray-block">
      <h3>"{{ $faculty_name }}"の研究室一覧</h3>
      <!--↓↓ 研究室の口コミを追加　ボタン ↓↓-->
      @include('components.botton_add_reviews')
    </div>
    <div class="total-evaluation">
      <h4 class="search-result">該当件数（{{$hits}}件）</h4>
      @foreach($laboratories_collection as $laboratory)
        <div class="each-evaluation">
          <div class="top">
              <!--↓↓ 学部ロゴ　表示部 ↓↓-->
              @include('components.faculty_logo')
              <div class="right-block">
                <!--↓↓ 大学名と大学の評価平均 部分 ↓↓-->
                @include('components.univ_data',['univ_name'=>$laboratory['univ_name']])
              </div>
          </div>
          <div class="details">
              <!--↓↓ 新着口コミの評価平均 部分 ↓↓-->
              @include('components.latest_review',['laboratory' => $laboratory])
          </div>

        </div>
      @endforeach
    </div>
    @else
    <!--↓↓ 該当データがなかったとき ↓↓-->
    @include('components.nothing_data', ['keyword' => $faculty_name ])
  @endif
@endsection
