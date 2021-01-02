<link href="{{ asset('css/auth/main/register.css') }}" rel="stylesheet" type="text/css">

@extends('layouts.app')
@section('content')
<div class="gray-block">
  <h3>本会員登録</h3>
</div>
<div class="main">
  <div class="main-inbox">
    <div class="step sizeup">
      <h4>STEP１</h4>
    </div>
    <div class="content-message">
      あなたの大学がある都道府県を選択してください。
    </div>

    <!--バリテーションエラーの表示に使用-->
    @include('common.errors')

    <!--研究室登録フォーム-->
    <form action="{{ route('register.main2') }}" method="POST" class="form-horizontal">
        {{ csrf_field() }}
        <select class="input-box" name="prefecture_name">
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
@endsection
