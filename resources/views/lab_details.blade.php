@extends('layouts.app')
@section('content')

  @if(count($laboratories) > 0)
  <!--Bootstrapの定形コード-->

  <!--バリテーションエラーの表示に使用-->
  @include('common.errors')
  <!--end:バリテーションエラーの表示に使用-->

  <h2>{{$lab_details_lab}} の口コミ一覧</h2>
  <a class="nav-link" href="{{ url('add_evaluation/'.$lab_details_univ.'/'.$lab_details_lab) }}">
    研究室の口コミを追加する
  </a>

  @foreach($array_average as $item_average)
    {{ $average_item_jp[$count] }} : {{ $item_average}},
    @php
      $count++;
    @endphp
  @endforeach

      @can('one-contents')
        <div class="card-body">
          <table class="table table-striped task-table">
            <!--テーブル本体-->
            <tbody>
                @foreach($evaluation_array as $countndex => $evaluation)
                  @if($countndex < 1)
                    @include('components.evaluation_category', ['evaluation'=>$evaluation])
                  @endif
                @endforeach
            </tbody>
          </table>
             他の{{ $lab_details_lab }}の口コミを閲覧するためには、ゼミ・研究室の口コミを投稿してください。<br>
             (全国どこのゼミ・研究室でも構いません)<br>
             まだゼミ・研究室に配属されていない方は、先輩・友人に聞いて投稿してください。<br>
          </div>

        @elsecan('three-contents','all-contents', 'admin')
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
        @endcan
      @endif
@endsection
