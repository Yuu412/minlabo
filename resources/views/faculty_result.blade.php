@extends('layouts.app')
@section('content')

  @if(count($laboratories))

  <!--↓↓ 研究室の口コミを追加　ボタン ↓↓-->
  @include('components.botton_add_reviews')

    <table class="table table-striped task-table">
      <thead>
        <th>{{ $keyword }}の研究室一覧</th>
      </thead>
      <tbody>
          @foreach($laboratories as $laboratory)
            <tr>
              <!--↓↓ 学部ロゴ　表示部 ↓↓-->
              @include('components.faculty_logo')

              <!-- 大学、学部、学科、研究室名 -->
              <td class="table-text">
                <a class="nav-link" href="{{ url('lab/'.$laboratory->lab_univ.'/'.$laboratory->lab_name) }}">
                  {{ $laboratory->lab_univ }} {{ $laboratory->lab_faculty }} {{ $laboratory->lab_department }} {{ $laboratory->lab_name }}
                </a>
              </td>

              <!--↓↓ 研究室の評価平均 表示部分 ↓↓-->
              @include('components.univ_data', ['prefecture_data'=>$laboratory, 'array_tmp1'=>$average_item_jp, 'count1'=>$laboratory->id, 'count2'=>'0'])

              <td>
                新着口コミ：
                @foreach($array_latest_evaluation as $item_latest_evaluation)
                  @if($item_latest_evaluation->lab_univ == $laboratory->lab_univ && $item_latest_evaluation->lab_name == $laboratory->lab_name)
                  【{{ $item_latest_evaluation->all_average }}】,
                  教授：{{ $item_latest_evaluation->prof_average }},
                  就活：{{ $item_latest_evaluation->job_average }},
                  研究室：{{ $item_latest_evaluation->lab_average }},
                  その他：{{ $item_latest_evaluation->other_average }}
                  @endif
                @endforeach
              </td>

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
