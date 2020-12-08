@extends('layouts.app')
<link href="{{ asset('css/lab_details.css') }}" rel="stylesheet" type="text/css">
@section('content')
  @if(count($evaluations_collection) > 0)
    @include('common.errors')
    <div class="gray-block">
      <h3>"{{$lab_name}}" の口コミ一覧</h3>
      <!--↓↓ 研究室の口コミを追加　ボタン ↓↓-->
      @include('components.botton_add_reviews', ['flag' => $flag, 'lab_details_univ' => $univ_name, 'lab_details_lab' => $lab_name])
    </div>
    <div class="total-evaluation">
      <h4 class="search-result">該当件数（〇件）</h4>
      @foreach($evaluations_collection as $evaluation)
        @include('components.evaluation_category')
      @endforeach
    </div>
  @else
    該当する名前の研究室はありません。
  @endif
@endsection
