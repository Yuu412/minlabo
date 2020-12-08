<link href="{{ asset('css/com_univ_data.css') }}" rel="stylesheet" type="text/css">
{{--
  大学名は、univ/○○大学では必要ないけど、他では必要そうだから修正する。
  --}}
    <div class="flex-box">
      <div class="flex-item">
        <h3>
          <a class="nav-link" href="{{ url('lab/'.$univ_name.'/'.$laboratory['lab_name']) }}">
            {{ $univ_name }} {{ $laboratory['lab_name'] }}
          </a>
        </h3>
      </div>
      <div class="flex-item">
        <!--↓↓ この研究室の口コミを見る ↓↓-->
        @include('components.botton_watch_reviews')
      </div>
    </div>
    <div class="all-review-box">
      <span class="sizeup">総合評価<span>
      <img src="{{ asset('img/evaluation_star/star_'.$laboratory['all_stars'].'.png') }}" alt="star" width="100">
      <span class="evaluation_value">{{ $laboratory['all_average'] }}</span>
    </div>

    <div class="review-box">
      <div class="review-item">
          教授
          <img src="{{ asset('img/evaluation_star/star_'.$laboratory['prof_stars'].'.png') }}" alt="star" width="100">
          <span class="evaluation_value">{{ $laboratory['prof_average'] }}</span>
      </div>
      <div class="review-item">
          就活
          <img src="{{ asset('img/evaluation_star/star_'.$laboratory['job_stars'].'.png') }}" alt="star" width="100">
          <span class="evaluation_value">{{ $laboratory['job_average'] }}</span>
      </div>
      <div class="review-item">
          雰囲気
          <img src="{{ asset('img/evaluation_star/star_'.$laboratory['lab_stars'].'.png') }}" alt="star" width="100">
          <span class="evaluation_value">{{ $laboratory['lab_average'] }}</span>
      </div>
      <div class="review-item">
          その他
          <img src="{{ asset('img/evaluation_star/star_'.$laboratory['other_stars'].'.png') }}" alt="star" width="100">
          <span class="evaluation_value">{{ $laboratory['other_average'] }}</span>
      </div>
    </div>
