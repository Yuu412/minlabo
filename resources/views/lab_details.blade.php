@extends('layouts.app')
@section('content')
  @if(count($evaluations_collection) > 0)
    <!--バリテーションエラーの表示に使用-->
    @include('common.errors')

    <h2>{{$lab_name}} の口コミ一覧</h2>

    <!--↓↓ 研究室の口コミを追加　ボタン ↓↓-->
    @include('components.botton_add_reviews', ['flag' => $flag, 'lab_details_univ' => $univ_name, 'lab_details_lab' => $lab_name])
    @foreach($evaluations_collection as $evaluation)
    <div class="card-body">
      <table class="table table-striped task-table">
        <tbody>
          @include('components.evaluation_category')
        </tbody>
      </table>
    </div>
    @endforeach
  @else
    該当する名前の研究室はありません。
  @endif
@endsection
