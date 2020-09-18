@extends('layouts.app')
@section('content')

  <!--Bootstrapの定形コード-->
  <div class="card-body">
    <div class="card-title">
      研究室の追加
    </div>
  </div>

  <div class="card-body">
    <div class="card-title">
      大学がある都道府県を選択してください。
    </div>
  </div>

  <!--バリテーションエラーの表示に使用-->
  @include('common.errors')
  <!--end:バリテーションエラーの表示に使用-->

  <!--研究室登録フォーム-->
    <form action="{{ url('add/2') }}" method="POST" class="form-horizontal">
    {{ csrf_field() }}

      <div class="form-groupe">
        <div class="col-sm-6">
            <select name="pref_name">
                <option selected>選択してください</option>
                @foreach($all_prefectures as $item_prefecture)
                  <option value="{{ $item_prefecture }}">{{ $item_prefecture }}</option>
                @endforeach
            </select>
      </div>

      <!--次のページへ ボタン-->
      <div class="form-groupe">
        <div class="col-offset-3 col-sm-6">
          <input type="hidden" name="token" value="{{ $token }}">
          <button type="submit" class="btn btn-primary">次へ</button>
        </div>
      </div>
  </form>

  <!--現在登録済みの研究室一覧-->
@endsection
