<link href="{{ asset('css/laboratories.css') }}" rel="stylesheet" type="text/css">
<script src="//code.jquery.com/jquery.min.js"></script>
@extends('layouts.app')
@section('content')
<!--バリテーションエラーの表示に使用-->
@include('common.errors')
  <!--↓↓ キーワード検索 ↓↓-->
  <div class="top">
    <center>
      <h1>「研究室・ゼミ」選びの不安を、ゼロに。</h1>
    </center>
    <div class="search-form-box">
      <h2>研究室・ゼミを探す</h2>
      <div class="search-form">
        <form class="form-inline" method="POST" action="{{ url('/search_result') }}">
          <!-- CSRF保護 -->
          @csrf
          <input type="text" name="keyword" value="" class="myform form-control" placeholder="キーワード[例:佐藤研究室、佐藤]">
          <input type="submit" value="検索" class="mybtn btn btn-info">
        </form>
      </div>
    </div>
  </div>
  <div class="main">
    <h2 class="next-section">エリアから探す</h2>
    <!--↓↓ 主要都市ごと表示部 ↓↓-->
    <div class="flex">
      @foreach($main_prefectures as $key => $main_prefecture)
        <div class="main-prefectures-box">
          <a href="{{ url('area/'.$main_prefecture['name']) }}">
            <img src="{{ asset('img/prefecture_image/' .$main_prefecture['image']) }}" alt="{{ $main_prefecture['name'] }}">
            <span class="main-prefecture-name">
              {{ $main_prefecture['name'] }}
            </span>
          </a>
        </div>
      @endforeach
    </div>

    <!--↓↓ 全県名ごと表示部 ↓↓-->
    <div class="flex area-box">
      @foreach($all_prefectures as $key => $all_prefecture)
        <div class="area">
          <h4>{{ $all_prefecture['category'] }}</h4>
          @foreach($all_prefecture['prefectures'] as $prefecture_name)
            <a href="{{ url('area/'.$prefecture_name) }}">
                <span>{{ $prefecture_name }}</span>
            </a>
          @endforeach
        </div>
      @endforeach
    </div>

    <!--↓↓ 学部ごと表示部 ↓↓-->
    <h2>学部から探す</h2>
    @foreach($faculties as $key => $faculty_group)
      <h4>{{ $faculty_group['category'] }}</h4>
      <div class="flex">
        @foreach($faculty_group['faculty_names'] as $key => $faculty_name)
          <div class="faculty-box">
            <a href="{{ url('faculty-result/'.$faculty_name['name']) }}">
              <img src="{{ asset('img/faculty_logo/' .$faculty_name['image']) }}" alt="{{ $faculty_name['name'] }}" width="75" height="75">
                <div class="faculty-name">
                  {{ $faculty_name['name'] }}
                </div>
            </a>
          </div>
        @endforeach
      </div>
    @endforeach

    <!--↓↓ 新着口コミ表示 ↓↓-->
    <h2>新着口コミ</h2>
    <div class="flex scroll">
      @foreach($latest_evaluation_collection as $evaluation)
        <div class="evaluation-box">
          <a href="{{ url('/lab-evaluation/'.$evaluation['review_id']) }}">
            <div class="lab-information-box">
              <div class="lab-information">
                <div>{{ $evaluation['univ_name'] }}</div>
                <div>{{ $evaluation['faculty_name'] }}</div>
                <div>{{ $evaluation['lab_name'] }}</div>
              </div>
              <div class="black">
                <img src="{{ asset('img/prefecture_image/' .$evaluation['prefecture_image']) }}" alt="{{ $evaluation['univ_name'] }}" class="black-img" >
              </div>
            </div>
            <div class="star-box">
              <div>
                教授<img src="{{ asset('img/evaluation_star/star_'.$evaluation['prof_stars'].'.png') }}" alt="star" width="100">
              </div>
              <div>
                研究室<img src="{{ asset('img/evaluation_star/star_'.$evaluation['job_stars'].'.png') }}" alt="star" width="100">
              </div>
              <div>
                就活<img src="{{ asset('img/evaluation_star/star_'.$evaluation['lab_stars'].'.png') }}" alt="star" width="100">
              </div>
              <div>
                その他<img src="{{ asset('img/evaluation_star/star_'.$evaluation['other_stars'].'.png') }}" alt="star" width="100">
              </div>
            </div>
          </a>
        </div>
      @endforeach
    </div>

    <!--↓↓ 総合評価ランキング表示 ↓↓-->
    <h2>総合評価ランキング</h2>
    <div class="flex scroll">
      @foreach($ranking_evaluation_collection as $evaluation)
        <div class="evaluation-box">
          <a href="{{ url('/lab-evaluation/'.$evaluation['review_id']) }}">
            <div class="lab-information-box">
              <div class="lab-information">
                <div>{{ $evaluation['univ_name'] }}</div>
                <div>{{ $evaluation['faculty_name'] }}</div>
                <div>{{ $evaluation['lab_name'] }}</div>
              </div>
              <div class="black">
                <img src="{{ asset('img/prefecture_image/' .$evaluation['prefecture_image']) }}" alt="{{ $evaluation['univ_name'] }}" class="black-img" >
              </div>
            </div>
            <div class="star-box">
              <div>
                教授<img src="{{ asset('img/evaluation_star/star_'.$evaluation['prof_stars'].'.png') }}" alt="star" width="100">
              </div>
              <div>
                研究室<img src="{{ asset('img/evaluation_star/star_'.$evaluation['job_stars'].'.png') }}" alt="star" width="100">
              </div>
              <div>
                就活<img src="{{ asset('img/evaluation_star/star_'.$evaluation['lab_stars'].'.png') }}" alt="star" width="100">
              </div>
              <div>
                その他<img src="{{ asset('img/evaluation_star/star_'.$evaluation['other_stars'].'.png') }}" alt="star" width="100">
              </div>
            </div>
          </a>
        </div>
      @endforeach
    </div>

    <!--↓↓ 広告 ↓↓-->
    <h2>大学生にオススメのサービス</h2>
    <div class="flex">
      <div>
        <a href="https://px.a8.net/svt/ejp?a8mat=3H3F8R+4TUNQI+4K88+60H7L" rel="nofollow">
          <img border="0" width="300" height="250" alt="" src="https://www21.a8.net/svt/bgt?aid=210111723292&wid=004&eno=01&mid=s00000021284001010000&mc=1">
        </a>
        <img border="0" width="1" height="1" src="https://www17.a8.net/0.gif?a8mat=3H3F8R+4TUNQI+4K88+60H7L" alt="">
      </div>
      <div>
        <a href="https://px.a8.net/svt/ejp?a8mat=3BMKII+FBWVBU+45EC+609HT" rel="nofollow">
          <img border="0" width="300" height="250" alt="" src="https://www29.a8.net/svt/bgt?aid=200927322927&wid=002&eno=01&mid=s00000019362001009000&mc=1">
        </a>
        <img border="0" width="1" height="1" src="https://www15.a8.net/0.gif?a8mat=3BMKII+FBWVBU+45EC+609HT" alt="">
      </div>
      <div>
        <a href="https://px.a8.net/svt/ejp?a8mat=3BMKII+FBBH9M+42GS+60WN5" rel="nofollow">
          <img border="0" width="300" height="250" alt="" src="https://www20.a8.net/svt/bgt?aid=200927322926&wid=004&eno=01&mid=s00000018982001012000&mc=1">
        </a>
        <img border="0" width="1" height="1" src="https://www17.a8.net/0.gif?a8mat=3BMKII+FBBH9M+42GS+60WN5" alt="">
      </div>
    </div>
  </div>

@endsection
