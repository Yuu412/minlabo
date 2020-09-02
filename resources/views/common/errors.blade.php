<!-- resourse/views/common/errors.blade.php -->

@if (count($errors) > 0)
  <!-- Form Error List-->
  <div class="alert alert-danger">
    <div><strong>入力した文字を修正してください。</strong></div>
    <div>
      <ul>
        @foreach ($errors->all() as $errors)
          <li>{{$errors}}</li>
        @endforeach
      </ul>
    </div>
  </div>
  @endif

  <!--p87-->
