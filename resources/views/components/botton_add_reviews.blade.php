<!--研究室登録ボタン-->
<li class="nav-item">
  @if(!empty($flag))
  <a class="nav-link" href="{{ url('add_evaluation/'.$lab_details_univ.'/'.$lab_details_lab) }}">研究室の口コミを投稿する</a>
  @else
  <a class="nav-link" href="{{ action('LinkController@to_add') }}">研究室の口コミを投稿する</a>
  @endif
</li>
