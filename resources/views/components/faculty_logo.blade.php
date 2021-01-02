<link href="{{ asset('css/components/com_faculty_logo.css') }}" rel="stylesheet" type="text/css">
<div class="faculty-logo-fl">
  <!-- 学部ロゴ表示 -->
  <img src="{{ asset('img/faculty_logo/' .$faculty_filename) }}" alt="{{ $faculty_filename}}">
  <!-- 学部名 -->
  <div class="faculty-name-fl">
    {{ $faculty_name }}
  </div>
</div>
