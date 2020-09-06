@extends('layouts.app')
@section('content')

  @if(count($laboratories) > 0)

  <!--バリテーションエラーの表示に使用-->
  @include('common.errors')

  <h2>{{$lab_details_lab}} の口コミ一覧</h2>

  <!--↓↓ 研究室の口コミを追加　ボタン ↓↓-->
  @php $flag = 1; @endphp
  @include('components.botton_add_reviews', ['flag' => $flag])

  @foreach($array_average as $item_average)
    {{ $average_item_jp[$count] }} : {{ $item_average}},
    @php
      $count++;
    @endphp
  @endforeach
        <!--テーブル本体-->
        <div class="card-body">
          <table class="table table-striped task-table">
            <tbody>
              @foreach($evaluation_array as $evaluation)
                @include('components.evaluation_category', ['evaluation'=>$evaluation, 'average_item'=>$average_item_jp])
              @endforeach
            </tbody>
          </table>
        </div>
      @endif
@endsection
