<tr>
  <td class="table-text">
    <a class="nav-link" href="{{ url('lab-evaluation/'.$evaluation['id']) }}">
      この口コミについて詳しく見る
    </a>
    {{ $evaluation['created_at'] }}
    <a class="nav-link" href="{{ url('lab-evaluation/'.$evaluation['id']) }}">
      <div class="d-flex flex-row">
        <div class="p-2">総合評価 ：{{ $evaluation['all_average'] }}</div>
        <div class="p-2">教授：{{ $evaluation['prof_average'] }}</div>
        <div class="p-2">就活：{{ $evaluation['job_average'] }}</div>
        <div class="p-2">研究室：{{ $evaluation['lab_average'] }}</div>
        <div class="p-2">その他：{{ $evaluation['other_average'] }}</div>
      </div>
      <div>
        口コミ：{{ $evaluation['comment'] }}
      </div>
    </a>
  </td>
</tr>
