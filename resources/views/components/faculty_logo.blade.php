<td class="table-text">
　  <!-- 学部名 -->
  {{ $laboratory->lab_faculty }}
  <!-- 学部ロゴ表示 -->
  @foreach($fac_logos as $fac_logo)
    @if($fac_logo->fac_name == $laboratory->lab_faculty)
      <img src="{{ asset('img/fac_logo/' .$fac_logo->fac_logo) }}" alt="{{ $fac_logo->fac_logo }}" width="75" height="75">
    @else
      <img src="{{ asset('img/fac_logo/other.png') }}" alt="{{ $fac_logo->fac_logo }}" width="75" height="75">
      @break
    @endif
  @endforeach
</td>
