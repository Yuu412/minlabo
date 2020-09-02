<tr>
  <td class="table-text">
    <a class="nav-link" href="{{ url('lab-evaluation/'.$evaluation->id) }}">
      この口コミについて詳しく見る
    </a>
    {{ $evaluation->add_time }}
    <div class="d-flex flex-row">
      <a class="nav-link" href="{{ url('lab-evaluation/'.$evaluation->id) }}">
        <div class="p-2">総合評価 ：{{ $evaluation->all_average }}</div>
      </a>
      <a class="nav-link" href="{{ url('lab-evaluation/'.$evaluation->id) }}">
        <div class="p-2">教授：{{ $evaluation->prof_average }}</div>
      </a>
      <a class="nav-link" href="{{ url('lab-evaluation/'.$evaluation->id) }}">
        <div class="p-2">就活：{{ $evaluation->job_average }}</div>
      </a>
      <a class="nav-link" href="{{ url('lab-evaluation/'.$evaluation->id) }}">
        <div class="p-2">研究室：{{ $evaluation->lab_average }}</div>
      </a>
      <a class="nav-link" href="{{ url('lab-evaluation/'.$evaluation->id) }}">
        <div class="p-2">その他：{{ $evaluation->other_average }}</div>
      </a>
    </div>

    @php
      //32文字以上を･･･に置き換える関数

      //整形したい文字列
      $text = $evaluation->content;
      //文字数の上限
      $limit = 50;

      if(mb_strlen($text) > $limit) {
        $title = mb_substr($text,0,$limit);
        $text = "$title. ･･･ ";
      }
    @endphp

      <div>口コミ：{{ $text }}</div>
  </td>
</tr>
