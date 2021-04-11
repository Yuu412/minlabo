@section('title', "$lab_name.の口コミ")
<link href="{{ asset('css/lab_evaluation_details.css') }}" rel="stylesheet" type="text/css">
<script src="//code.jquery.com/jquery.min.js"></script>

@extends('layouts.app')
@section('content')
  <!--バリテーションエラーの表示に使用-->
  @include('common.errors')
  <!--end:バリテーションエラーの表示に使用-->

  <div class="gray-block">
      <div class="flex-box non-flex">
        <div class="flex-item">
          <h2>{{ $lab_name }}の口コミの詳細</h2>
        </div>
        <div class="flex-item">
          <div>{{ $lab_evaluation->created_at }}</div>
        </div>
      </div>

      <div class="all-review-box">
        <span class="sizeup">総合評価<span>
        <img src="{{ asset('img/evaluation_star/star_'.$evaluation_stars['all_stars'].'.png') }}" alt="star" width="100">
        <span class="evaluation_value">{{ $lab_evaluation->all_average }}</span>
      </div>
      <div class="review-box">
        <div class="review-item">
          教授
          <img src="{{ asset('img/evaluation_star/star_'.$evaluation_stars['prof_stars'].'.png') }}" alt="star" width="100">
          {{ $lab_evaluation->prof_average }}
        </div>
        <div class="review-item">
          就活
          <img src="{{ asset('img/evaluation_star/star_'.$evaluation_stars['job_stars'].'.png') }}" alt="star" width="100">
          {{ $lab_evaluation->job_average }}
        </div>
        <div class="review-item">
          研究室
          <img src="{{ asset('img/evaluation_star/star_'.$evaluation_stars['lab_stars'].'.png') }}" alt="star" width="100">
          {{ $lab_evaluation->lab_average }}
        </div>
        <div class="review-item">
          その他
          <img src="{{ asset('img/evaluation_star/star_'.$evaluation_stars['other_stars'].'.png') }}" alt="star" width="100">
          {{ $lab_evaluation->other_average }}
        </div>
      </div>
  </div>

  <div class="main">
    <div class="main-inbox">
      @foreach ($eachtitle_array as $eachtitle)
        <div class="main-inbox-block">
          <div class="block-name">
            <h4>{{ $eachtitle }}</h4>
          </div>
          <div class="each-evaluation">
            @foreach ($evaluation_array[$eachtitle] as $key => $prof_item)
              <div class="flex-box">
                <div class="flex-item">
                  {{ $key }}
                </div>
                <div class="flex-item evaluation_graph">
                  <img src="{{ asset('img/evaluation_graph/graph_'.$lab_evaluation->$prof_item.'.png') }}" alt="{{$prof_item}}" width="100">
                </div>
              </div>
            @endforeach
          </div>
        </div>
      @endforeach

      <div class="part">
        <h4>OB･OGの就職先</h4>
        <span class="part-content">{{ $lab_evaluation->objobtype}}</span>
      </div>

      <div class="part">
        <h4>ゼミ・研究室に入るために必要なＧＰＡや条件（回答者のGPA）</h4>
        <span class="part-content">{{ $lab_evaluation->terms }}</span>
      </div>

      <div class="part">
        <h4>{{ $lab_name }}に関する口コミ</h4>
        <div class="content">
          {{ $lab_evaluation->content }}
        </div>
      </div>

      <a href="https://px.a8.net/svt/ejp?a8mat=3H3F8R+4TUNQI+4K88+601S1" rel="nofollow">
        <img border="0" width="100%" alt="" src="https://www22.a8.net/svt/bgt?aid=210111723292&wid=004&eno=01&mid=s00000021284001008000&mc=1">
      </a>
      <img border="0" width="1" height="1" src="https://www14.a8.net/0.gif?a8mat=3H3F8R+4TUNQI+4K88+601S1" alt="">
    </div>
  </div>

  <!--現在登録済みの研究室一覧-->
@endsection
