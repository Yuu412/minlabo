@extends('layouts.app')
<link href="{{ asset('css/univ_name.css') }}" rel="stylesheet" type="text/css">
<script src="http://code.jquery.com/jquery.min.js"></script>

@section('content')
  @if(count($laboratories) > 0)
  <!--バリテーションエラーの表示に使用-->
  @include('common.errors')
      <div class="gray-block">
        <h3>"{{ $univ_name }}"の研究室一覧</h3>
          <!--↓↓ 研究室の口コミを追加　ボタン ↓↓-->
          @include('components.botton_add_reviews')
      </div>
      <div class="total-evaluation">
        <h4 class="search-result">該当件数（{{$hits}}件）</h4>
          @foreach($laboratories_collection as $laboratory)
          <div class="each-evaluation">
              <div class="top">
                <!--↓↓ 学部ロゴ　表示部 ↓↓-->
                @include('components.faculty_logo', ['faculty_name' => $laboratory['faculty_name'], 'faculty_filename' => $laboratory['faculty_filename']])
                <div class="right-block">
                  <!--↓↓ 大学名と大学の評価平均 部分 ↓↓-->
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
  @endif
@endsection
