@section('title', '口コミの追加')
<link href="{{ asset('css/add2.css') }}" rel="stylesheet" type="text/css">
<script src="//code.jquery.com/jquery.min.js"></script>

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
      <th class="content-title" width="30%" height="75px">
        大学名
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
      <th class="content-title" width="30%" height="200px">
        学部名
      </th>
      <th class="right-block faculty">
        <label class="faculty-group" for="lab_faculty">文系</label>
        <div class="faculty-name">
          @foreach($faculty_lib_array as $faculty_lib_item)
            @if($faculty_lib_item->faculty_name == "その他(文系)")
              <div class="choices">
                <input type="radio" name="lab_faculty" value="{{ $faculty_lib_item->faculty_name }}">その他
                <div class="hide-input">
                  <input type="text" name="new_lib_faculty" placeholder="〇〇学部">
                </div>
              </div>
            @else
              <div class="choices">
                <input type="radio" name="lab_faculty" value="{{ $faculty_lib_item->faculty_name }}">{{ $faculty_lib_item->faculty_name }}
              </div>
            @endif
          @endforeach
        </div>

        <label class="faculty-group" for="lab_faculty">理系</label>
        <div class="faculty-name">
          @foreach($faculty_sci_array as $faculty_sci_item)
            @if($faculty_sci_item->faculty_name == "その他(理系)")
              <div class="choices">
                <input type="radio" name="lab_faculty" value="{{ $faculty_sci_item->faculty_name }}">その他
                <div class="hide-input">
                  <input type="text" name="new_sci_faculty" placeholder="〇〇学部">
                </div>
              </div>
            @else
              <div class="choices">
                <input type="radio" name="lab_faculty" value="{{ $faculty_sci_item->faculty_name }}">{{ $faculty_sci_item->faculty_name }}
              </div>
            @endif
          @endforeach
        </div>
      </th>
    </tr>

    <!--学科の名前-->
    <tr>
      <th class="content-title" width="30%" height="75px">
        学科名
      </th>
      <th class="right-block">
        <input type="text" name="lab_department" class="form-control" placeholder="〇〇学科">
      </th>
    </tr>

    <!--研究室の名前-->
    <tr>
      <th width="30%" height="75px">
        <label for="lab_name">ゼミ・研究室名</label>
      </th>
      <th class="right-block">
        <input type="text" name="lab_name" class="form-control" placeholder="(教授の苗字)＋(ゼミ or 研究室)の形で入力してください。">
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
