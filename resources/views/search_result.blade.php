@section('title', "$keyword.の検索結果")
<link href="{{ asset('css/search_result.css') }}" rel="stylesheet" type="text/css">
<script src="//code.jquery.com/jquery.min.js"></script>

@extends('layouts.app')
@section('content')
  <div class="gray-block">
    <h3>検索キーワード："{{ $keyword }}"</h3>
  </div>
  @if(count($laboratories))
  <div class="total-evaluation">
    <h4 class="search-result">該当件数（{{$hits}}件）</h4>
      @foreach($laboratories_collection as $laboratory)
        <div class="each-evaluation">
          <div class="top">
            <!--↓↓ 学部ロゴ　表示部 ↓↓-->
            @include('components.faculty_logo', ['faculty_name' => $laboratory['faculty_name'], 'faculty_filename' => $laboratory['faculty_filename']])
            <div class="right-block">
              <!-- 大学、学部、学科、研究室名 -->
              {{--
              <a class="nav-link" href="{{ url('lab/'.$laboratory['univ_name'].'/'.$laboratory['lab_name']) }}">
                {{ $laboratory['univ_name'] }} {{ $laboratory['faculty_name'] }} {{ $laboratory['department_name'] }} {{ $laboratory['lab_name'] }}
                <!--↓↓ この研究室の口コミを見る ↓↓-->
                @include('components.botton_watch_reviews')
              </a>
              --}}
              <!--↓↓ 研究室の評価平均 表示部分 ↓↓-->
              @include('components.univ_data')
            </div>
          </div>
          <div class="details">
            <!--↓↓ 新着口コミの評価平均 部分 ↓↓-->
            @include('components.latest_review')
          </div>
        </div>
      @endforeach
    </div>
  @else
    <!--↓↓ 該当データがなかったとき ↓↓-->
    @include('components.nothing_data')
  @endif
@endsection
