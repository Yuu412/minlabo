@extends('layouts.app')
@section('content')
  <!--バリテーションエラーの表示に使用-->
  @include('common.errors')
  <!--end:バリテーションエラーの表示に使用-->

  <div class="card-body">
      <h2>{{ $lab_evaluation->lab_name }}の口コミの詳細</h2>
      <div>{{ $lab_evaluation->add_time }}</div>

      総合評価：{{ $lab_evaluation->all_average }}<br>
      教授：{{ $lab_evaluation->prof_average }}<br>
      就活：{{ $lab_evaluation->job_average }}<br>
      研究室：{{ $lab_evaluation->lab_average }}<br>
      その他：{{ $lab_evaluation->other_average }}<br>

      @foreach ($eachtitle_array as $eachtitle)
        <h3>{{ $eachtitle }}</h3>
        @foreach ($evaluation_array[$eachtitle] as $key => $prof_item)
          <div>{{ $key }} : {{ $lab_evaluation->$prof_item }}</div>
        @endforeach
      @endforeach
  </div>

  <div>
    <img src="{{ asset('img/others/jobtype.jpg') }}" alt="業界リスト" width="600" height="300">
  </div>
    {{ $lab_evaluation->objobtype}}
  <div>
    {{ $lab_evaluation->terms }}
  </div>
  <div>
    {{ $lab_evaluation->content }}
  </div>

  <!--現在登録済みの研究室一覧-->
@endsection
