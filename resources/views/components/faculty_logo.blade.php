<td class="table-text">
　  <!-- 学部名 -->
  {{ $laboratory->lab_faculty }}
  <!-- 学部ロゴ表示 -->
  @foreach($faculty_logos as $faculty_logo)
    @if($faculty_logo->faculty_name == $laboratory->lab_faculty)
      <img src="{{ asset('img/fac_logo/' .$faculty_logo->faculty_logo) }}" alt="{{ $faculty_logo->faculty_logo }}" width="75" height="75">
    @break
    @else
      <img src="{{ asset('img/fac_logo/other.png') }}" alt="{{ $faculty_logo->faculty_logo }}" width="75" height="75">
    @break
    @endif
  @endforeach
</td>
