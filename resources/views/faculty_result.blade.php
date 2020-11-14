@extends('layouts.app')
@section('content')
  @if(count($laboratories_collection))
  <!--↓↓ 研究室の口コミを追加　ボタン ↓↓-->
  @include('components.botton_add_reviews')


    <table class="table table-striped task-table">
      <thead>
        <th>{{ $faculty_name }}の研究室一覧</th>
      </thead>
      <tbody>
          @foreach($laboratories_collection as $laboratory)
            <tr>
              <!--↓↓ 学部ロゴ　表示部 ↓↓-->
              @include('components.faculty_logo')

              <!-- 大学、学部、学科、研究室名 -->
              <td class="table-text">
                <a class="nav-link" href="{{ url('lab/'.$laboratory['univ_name'].'/'.$laboratory['lab_name']) }}">
                  {{ $laboratory['univ_name'] }} {{ $faculty_name }} {{ $laboratory['department_name'] }} {{ $laboratory['lab_name'] }}
                </a>
              </td>

              <!--↓↓ 研究室の評価平均 表示部分 ↓↓-->
              <td class="table-text">
                平均口コミ：
                【{{ $laboratory['all_average'] }}】
                  {{ $laboratory['prof_average'] }}
                  {{ $laboratory['job_average'] }}
                  {{ $laboratory['lab_average'] }}
                  {{ $laboratory['other_average'] }}
              </td>

              <td class="table-text">
                新着口コミ：
                【{{ $laboratory['latest_evaluation']->all_average }}】
                  {{ $laboratory['latest_evaluation']->prof_average }}
                  {{ $laboratory['latest_evaluation']->job_average }}
                  {{ $laboratory['latest_evaluation']->lab_average }}
                  {{ $laboratory['latest_evaluation']->other_average }}
              </td>
              <!--↓↓ この研究室の口コミを見る ↓↓-->
              @include('components.botton_watch_reviews', ['univ_name' => $laboratory['univ_name']])
            </tr>
          @endforeach
        </tbody>
      </table>
    @else
    <!--↓↓ 該当データがなかったとき ↓↓-->
    @include('components.nothing_data', ['keyword' => $faculty_name ])
  @endif
@endsection
