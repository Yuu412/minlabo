@extends('layouts.app')
@section('content')

  @if(count($datas))

    <div class="paginate">
        <table class="table table-striped task-table">
          <thead>
            <th>"{{ $keyword }}"にある大学一覧</th>
          </thead>
          <tbody>
            @foreach($datas as $pre_data)
              <tr>
                <!--↓↓ 大学名と大学の評価平均 部分 ↓↓-->
                @include('components.univ_data',['array_tmp1'=>$average_item_jp])

                <!--↓↓ 新着口コミの評価平均 部分 ↓↓-->
                @include('components.latest_review',['tmp1'=>'lab_univ', 'tmp2'=>'univ_name'])
              </tr>
              @php
                $count1++;
                $count2 = 0;
              @endphp
            @endforeach
          </tbody>
      </table>
    </div>

    @else
      <div>
        <h3>「{{ $keyword }}」に一致する研究室情報は見つかりませんでした。</h3>
        <div>研究室の新規登録をご希望される場合は、下記のフォームから登録してください。</div>
      </div>

      <!--↓↓ 研究室登録フォーム ↓↓-->
        @include('components.botton_add_reviews')
    @endif
  @endsection
