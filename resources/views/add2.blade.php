@extends('layouts.app')
@section('content')

  <!--Bootstrapの定形コード-->
  <div class="card-body">
    <div class="card-title">
      研究室一覧
    </div>
  </div>

  <!--バリテーションエラーの表示に使用-->
  @include('common.errors')
  <!--end:バリテーションエラーの表示に使用-->

  <!--研究室登録フォーム-->
    <form action="{{ url('add_evaluation') }}" method="POST" class="form-horizontal">
    {{ csrf_field() }}

  <!--研究室が所属する大学名-->
    <div class="col-sm-6">
      <label for="lab_univ" class="col-sm-3 control-label">大学名</label>
        <select name="lab_univ">
          <option value="" selected>選択してください</option>
          @foreach($prefecture_univ_data as $each_univ_data)
            <option value="{{ $each_univ_data->univ_name }}">{{ $each_univ_data->univ_name }}</option>
          @endforeach
        </select>
      </div>

      <!--学部の名前-->
      <div class="form-groupe">
        学部名
        <div class="col-sm-6">
          <label for="lab_faculty" class="col-sm-3 control-label">文系</label>
          @foreach($faculty_lib_array as $faculty_lib_item)
            @if($faculty_lib_item == "文系その他")
              <input type="radio" name="lab_faculty" value="{{ $faculty_lib_item }}">その他
            @else
              <input type="radio" name="lab_faculty" value="{{ $faculty_lib_item }}">{{ $faculty_lib_item }}
            @endif
          @endforeach
        </div>
        <div class="col-sm-6">
          <label for="lab_faculty" class="col-sm-3 control-label">理系</label>
          @foreach($faculty_sci_array as $faculty_sci_item)
            @if($faculty_sci_item == "理系その他")
              <input type="radio" name="lab_faculty" value="{{ $faculty_sci_item }}">その他
            @else
              <input type="radio" name="lab_faculty" value="{{ $faculty_sci_item }}">{{ $faculty_sci_item }}
            @endif
          @endforeach
        </div>
      </div>

      <!--学科の名前-->
      <div class="form-groupe">
        <div class="col-sm-6">
          <label for="lab_department" class="col-sm-3 control-label">学科名</label>
          <input type="text" name="lab_department" class="form-control">
        </div>
      </div>

      <!--研究室の名前-->
      <div class="form-groupe">
        <div class="col-sm-6">
          <label for="lab_name" class="col-sm-3 control-label">口コミを投稿する研究室名</label>
          <input type="text" name="lab_name" class="form-control">
        </div>
      </div>

      <!--研究室 登録ボタン-->
      <div class="form-groupe">
        <div class="col-offset-3 col-sm-6">
          <input type="hidden" name="token" value="{{ $token }}">
          <button type="submit" class="btn btn-primary">次へ</button>
        </div>
      </div>
  </form>
  <!--現在登録済みの研究室一覧-->
@endsection
