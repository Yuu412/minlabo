@extends('layouts.app')
@section('content')
  検索キーワード：{{ $keyword }}
  <br>
  @if(count($laboratories))
  <table class="table table-striped task-table">
    <tbody>
      @foreach($laboratories_collection as $laboratory)
        <tr>
          <!--↓↓ 学部ロゴ　表示部 ↓↓-->
          @include('components.faculty_logo', ['faculty_name' => $laboratory['faculty_name'], 'faculty_filename' => $laboratory['faculty_filename']])

          <!-- 大学、学部、学科、研究室名 -->
          <td class="table-text">
            <a class="nav-link" href="{{ url('lab/'.$laboratory['univ_name'].'/'.$laboratory['lab_name']) }}">
              {{ $laboratory['univ_name'] }} {{ $laboratory['faculty_name'] }} {{ $laboratory['department_name'] }} {{ $laboratory['lab_name'] }}
            </a>
          </td>

          <!--↓↓ 研究室の評価平均 表示部分 ↓↓-->
          @include('components.univ_data')

          <!--↓↓ 新着口コミの評価平均 部分 ↓↓-->
          @include('components.latest_review')

          <!--↓↓ この研究室の口コミを見る ↓↓-->
          @include('components.botton_watch_reviews')
        </tr>
      @endforeach
    </tbody>
  </table>
@else
  <!--↓↓ 該当データがなかったとき ↓↓-->
  @include('components.nothing_data')
@endif
@endsection
