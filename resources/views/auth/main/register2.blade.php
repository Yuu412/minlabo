<link href="{{ asset('css/auth/main/register2.css') }}" rel="stylesheet" type="text/css">
@extends('layouts.app')
@section('content')
  <div class="gray-block">
    <h3>本会員登録</h3>
  </div>
  @include('common.errors')

  <div class="main">
    <div class="main-inbox">
        <div class="step sizeup">
          <h4>STEP２</h4>
        </div>
        <div class="content-message">
          あなたが在籍する大学の情報を記入してください。
        </div>
        <form method="POST" action="{{ route('register.main.check') }}">
            @csrf
            <table border="1" width="1080" cellspacing="0" cellpadding="5" bordercolor="#EEE">
              <!--研究室が所属する大学名-->
              <tr>
                <th class="content-title">
                  大学名
                </th>
                <th class="right-block">
                  <select name="univ_name">
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
                      @if($faculty_lib_item == "文系その他")
                        <div class="choices">
                          <input type="radio" name="faculty_name" value="{{ $faculty_lib_item }}">その他
                        </div>
                      @else
                        <div class="choices">
                          <input type="radio" name="faculty_name" value="{{ $faculty_lib_item }}">{{ $faculty_lib_item }}
                        </div>
                      @endif
                    @endforeach
                  </div>

                  <label class="faculty-group" for="lab_faculty">理系</label>
                  <div class="faculty-name">
                    @foreach($faculty_sci_array as $faculty_sci_item)
                      @if($faculty_sci_item == "理系その他")
                        <div class="choices">
                          <input type="radio" name="faculty_name" value="{{ $faculty_sci_item }}">その他
                        </div>
                      @else
                        <div class="choices">
                          <input type="radio" name="faculty_name" value="{{ $faculty_sci_item }}">{{ $faculty_sci_item }}
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
                  <input type="text" name="department_name" class="form-control">
                </th>
              </tr>
            </table>

            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="prefecture_name" value="{{ $prefecture_name }}">

            <div class="next-button">
              <!--次のページへ ボタン-->
              <button type="submit" class="btn btn-primary">確認画面へ</button>
            </div>
        </form>
    </div>
  </div>
@endsection
