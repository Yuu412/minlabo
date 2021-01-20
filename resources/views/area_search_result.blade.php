<link href="{{ asset('css/area_search_result.css') }}" rel="stylesheet" type="text/css">
<script src="//code.jquery.com/jquery.min.js"></script>
@extends('layouts.app')
@section('content')
  @if(count($universities_collection))
    <div class="gray-block">
      <h3>"{{ $prefecture_name }}"にある大学一覧</h3>
    </div>
    <div class="total-evaluation">
      <h4 class="search-result">該当件数（{{$hits}}件）</h4>
          @foreach($universities_collection as $university)
          <div class="each-evaluation">
            <div class="top">
                <div class="flex-box non-flex">
                  <a class="lab-info" href="{{ url('univ/'.$university['univ_name']) }}">
                    <h3>{{ $university['univ_name'] }}</h3>
                  </a>
                  <div class="all-review-box">
                    <span>総合評価</span>
                    <img src="{{ asset('img/evaluation_star/star_'.$university['all_stars'].'.png') }}" alt="star" width="100">
                    <span class="evaluation_value">{{ $university['all_average'] }}</span>
                  </div>
                </div>

                <div class="review-box">
                  <div class="review-item">
                      教授
                      <img src="{{ asset('img/evaluation_star/star_'.$university['prof_stars'].'.png') }}" alt="star" width="100">
                      <span class="evaluation_value">{{ $university['prof_average'] }}</span>
                  </div>
                  <div class="review-item">
                      就活
                      <img src="{{ asset('img/evaluation_star/star_'.$university['job_stars'].'.png') }}" alt="star" width="100">
                      <span class="evaluation_value">{{ $university['job_average'] }}</span>
                  </div>
                  <div class="review-item">
                      雰囲気
                      <img src="{{ asset('img/evaluation_star/star_'.$university['lab_stars'].'.png') }}" alt="star" width="100">
                      <span class="evaluation_value">{{ $university['lab_average'] }}</span>
                  </div>
                  <div class="review-item">
                      その他
                      <img src="{{ asset('img/evaluation_star/star_'.$university['other_stars'].'.png') }}" alt="star" width="100">
                      <span class="evaluation_value">{{ $university['other_average'] }}</span>
                  </div>
                </div>
              </div>
              <!--↓↓ 新着口コミの評価平均 部分 ↓↓-->
              <div class="details">
                @include('components.latest_review',['laboratory' => $university])
              </div>
            </div>
          @endforeach
        </div>
    @else

      @include('components.nothing_data', ['keyword' => $prefecture_name ])
      {{--
      <div>
        <h3>「{{ $prefecture_name }}」に一致する研究室情報は見つかりませんでした。</h3>
        <div>研究室の新規登録をご希望される場合は、下記のフォームから登録してください。</div>
      </div>

      <!--↓↓ 研究室登録フォーム ↓↓-->
      <li class="nav-item">
        <a class="nav-link" href="{{ action('LinkController@to_add') }}">研究室の追加</a>
      </li>
      <!--↑↑ 研究室登録フォーム ↑↑-->
      --}}
    @endif
  @endsection
