<link href="{{ asset('css/add2.css') }}" rel="stylesheet" type="text/css">
@extends('layouts.app')
@section('content')

<div class="gray-block">
  <h3>口コミを投稿する研究室情報</h3>
</div>
<div class="main">
  <div class="main-inbox">
    <!--バリテーションエラーの表示に使用-->
    @include('common.errors')
    <div class="step sizeup">
      <h4>STEP２</h4>
    </div>
    <div class="content-message">
      口コミを投稿する研究室の情報を入力してください。
    </div>

  <!--研究室登録フォーム-->
  <form action="{{ url('add_evaluation') }}" method="POST" class="form-horizontal">
  {{ csrf_field() }}
  <table border="1" width="1080" cellspacing="0" cellpadding="5" bordercolor="#EEE">

    <!--研究室が所属する大学名-->
    <tr>
      <th width="30%" height="75px">
        <label for="lab_univ">大学名</label>
      </th>
      <th class="right-block">
        <select name="lab_univ">
          <option value="" selected>選択してください</option>
          @foreach($prefecture_univ_data as $each_univ_data)
            <option value="{{ $each_univ_data->univ_name }}">{{ $each_univ_data->univ_name }}</option>
          @endforeach
        </select>
      </th>
    </tr>

    <!--学部の名前-->
    <tr>
      <th width="30%" height="200px">
        学部名
      </th>
      <th class="right-block faculty">
        <label class="faculty-group" for="lab_faculty">文系</label>
        <div class="faculty-name">
          @foreach($faculty_lib_array as $faculty_lib_item)
            @if($faculty_lib_item == "文系その他")
              <div class="choices">
                <input type="radio" name="lab_faculty" value="{{ $faculty_lib_item }}">その他
              </div>
            @else
              <div class="choices">
                <input type="radio" name="lab_faculty" value="{{ $faculty_lib_item }}">{{ $faculty_lib_item }}
              </div>
            @endif
          @endforeach
        </div>

        <label class="faculty-group" for="lab_faculty">理系</label>
        <div class="faculty-name">
          @foreach($faculty_sci_array as $faculty_sci_item)
            @if($faculty_sci_item == "理系その他")
              <div class="choices">
                <input type="radio" name="lab_faculty" value="{{ $faculty_sci_item }}">その他
              </div>
            @else
              <div class="choices">
                <input type="radio" name="lab_faculty" value="{{ $faculty_sci_item }}">{{ $faculty_sci_item }}
              </div>
            @endif
          @endforeach
        </div>
      </th>
    </tr>

    <!--学科の名前-->
    <tr>
      <th width="30%" height="75px">
        <label for="lab_department">学科名</label>
      </th>
      <th class="right-block">
        <input type="text" name="lab_department" class="form-control">
      </th>
    </tr>

    <!--研究室の名前-->
    <tr>
      <th width="30%" height="75px">
        <label for="lab_name">口コミを投稿する研究室名</label>
      </th>
      <th class="right-block">
        <input type="text" name="lab_name" class="form-control">
      </th>
    </tr>
  </table>

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
