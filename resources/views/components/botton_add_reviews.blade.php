  <!--研究室登録ボタン-->
  <link href="{{ asset('css/com_botton_add_reviews.css') }}" rel="stylesheet" type="text/css">
  @if(!empty($flag))
    <a class="botton_add_reviews" href="{{ url('add_evaluation/'.$lab_details_univ.'/'.$lab_details_lab) }}">研究室の口コミを投稿する</a>
  @else
    <a class="botton_add_reviews" href="{{ action('LinkController@to_add') }}">研究室の口コミを投稿する</a>
  @endif
