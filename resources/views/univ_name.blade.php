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
          @foreach($laboratories as $laboratory)
            <tr>
              <!--↓↓ 学部ロゴ　表示部 ↓↓-->
              @include('components.faculty_logo')

              <!-- 研究室名 -->
              <td>
                <a href="{{ url('lab/'.$univ_name.'/'.$laboratory->lab_name) }}">
                  {{ $laboratory->lab_name }}
                </a>
              </td>
              <!--↓↓ 大学名と大学の評価平均 部分 ↓↓-->
              @include('components.univ_data', ['prefecture_data'=>$laboratory, 'array_tmp1'=>$average_item_jp])

              <!--↓↓ 新着口コミの評価平均 部分 ↓↓-->
              @include('components.latest_review', ['prefecture_data'=>$laboratory,'tmp1'=>'lab_name','tmp2'=>'lab_name'])

              <!--↓↓ この研究室の口コミを見る ↓↓-->
              @include('components.botton_watch_reviews')
            </tr>
          @endforeach
      </tbody>
    </table>

  @endif
@endsection
