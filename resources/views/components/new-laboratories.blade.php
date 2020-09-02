@php
  $lab_name = $lab_evaluation->lab_name;
  $lab_univ = $lab_evaluation->lab_univ;
@endphp
@foreach($laboratories as $laboratory)
  @if($lab_name == $laboratory->lab_name and $lab_univ == $laboratory->lab_univ)
    @php
      $lab_faculty = $laboratory->lab_faculty;
    @endphp
  @endif
@endforeach

<tr>
  <td>
  @foreach($pre_images as $pre_image)
    @foreach($univ_datas as $univ_data)
      @if($univ_data->univ_name == $lab_univ)
        @php
          $pre_name = $univ_data->pre_name;
        @endphp
      @endif
    @endforeach
    @if($pre_image->pre_name == $pre_name)
      <img src="{{ asset('img/pre_image/' .$pre_image->pre_image) }}" alt="{{ $pre_image->pre_name }}" width="75" height="75">
    @endif
  @endforeach
</td>
<!-- 研究室名 -->
  <td class="table-text">
    <a class="nav-link" href="{{ url('lab/'.$lab_univ.'/'.$lab_name) }}">
      <div>{{ $lab_name }}</div>
    </a>
  </td>
  <!-- 大学名 -->
  <td class="table-text">
    <a class="nav-link" href="{{ url('univ/'.$lab_univ) }}">{{ $lab_univ }}</a>
  </td>
  <!-- 学部名 -->
  <td class="table-text">
    <div>
      <a class="nav-link" href="{{ url('faculty_result/'.$lab_faculty) }}">
        {{ $lab_faculty }}
      </a>
    </div>
  </td>
  <!-- 総合評価 -->
  <td class="table-text">
    <a class="nav-link" href="{{ url('lab-evaluation/'.$lab_evaluation->id) }}">
      {{ $lab_evaluation->prof_average }}　
      {{ $lab_evaluation->job_average }}　
      {{ $lab_evaluation->lab_average }}　
      {{ $lab_evaluation->other_average }}　
    </a>
  </td>
</tr>
