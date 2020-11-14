@extends('layouts.app')
@section('content')
  @if(count($laboratories) > 0)
  <!--バリテーションエラーの表示に使用-->
  @include('common.errors')

  <!--↓↓ 研究室の口コミを追加　ボタン ↓↓-->
  @include('components.botton_add_reviews')

    <table class="table table-striped task-table">
      <!--テーブルヘッダ-->
      <thead>
        <th>{{ $univ_name }}の研究室一覧</th>
      </thead>
      <tbody>
          @foreach($laboratories_collection as $laboratory)
            <tr>
              <!--↓↓ 学部ロゴ　表示部 ↓↓-->
              @include('components.faculty_logo', ['faculty_name' => $laboratory['faculty_name'], 'faculty_filename' => $laboratory['faculty_filename']])

              <td>
                <a href="{{ url('lab/'.$univ_name.'/'.$laboratory['lab_name']) }}">
                  {{ $laboratory['lab_name'] }}
                </a>
              </td>
              <!--↓↓ 大学名と大学の評価平均 部分 ↓↓-->
              @include('components.univ_data')
              <!--↓↓ 新着口コミの評価平均 部分 ↓↓-->
              @include('components.latest_review')

              <!--↓↓ この研究室の口コミを見る ↓↓-->
              @include('components.botton_watch_reviews')
            </tr>
          @endforeach
      </tbody>
    </table>

  @endif
@endsection
