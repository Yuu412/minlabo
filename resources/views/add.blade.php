<link href="{{ asset('css/add.css') }}" rel="stylesheet" type="text/css">
<script src="http://code.jquery.com/jquery.min.js"></script>

@extends('layouts.app')
@section('content')

<div class="gray-block">
  <h3>口コミを投稿する研究室情報</h3>
</div>
<div class="main">
  <div class="main-inbox">
    <div class="step sizeup">
      <h4>STEP１</h4>
    </div>
    <div class="content-message">
      大学がある都道府県を選択してください。
    </div>

    <!--バリテーションエラーの表示に使用-->
    @include('common.errors')

    <!--研究室登録フォーム-->
    <form action="{{ url('add/2') }}" method="POST" class="form-horizontal">
        {{ csrf_field() }}
        <select class="input-box" name="pref_name">
          <option selected>選択してください</option>
            @foreach($all_prefectures as $item_prefecture)
              <option value="{{ $item_prefecture }}">{{ $item_prefecture }}</option>
            @endforeach
        </select>
        <div class="next-button">
          <!--次のページへ ボタン-->
          <input type="hidden" name="token" value="{{ $token }}">
          <button type="submit" class="btn btn-primary">次へ</button>
        </div>
     </form>
  </div>
</div>
  <!--現在登録済みの研究室一覧-->
@endsection
