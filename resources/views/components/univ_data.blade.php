<td class="table-text">
  <a class="nav-link" href="{{ url('univ/'.$pre_data -> univ_name) }}">{{ $pre_data -> univ_name }}</a>
</td>
<td class="table-text">
  @foreach($array_average[$count1] as $array_item)
    {{ $array_tmp1[$count2] }}:{{ $array_item }},
    @php
      $count2++;
    @endphp
  @endforeach
</td>
