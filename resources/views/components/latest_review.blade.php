<td>
  新着口コミ：

  @foreach($array_latest_evaluation as $item_latest_evaluation)
    @if($item_latest_evaluation->$tmp1 == $pre_data->$tmp2)
      【{{ $item_latest_evaluation->all_average }}】,
      教授：{{ $item_latest_evaluation->prof_average }},
      就活：{{ $item_latest_evaluation->job_average }},
      研究室：{{ $item_latest_evaluation->lab_average }},
      その他：{{ $item_latest_evaluation->other_average }}
    @endif
  @endforeach
</td>
