<link href="{{ asset('css/components/com_univ_data.css') }}" rel="stylesheet" type="text/css">
{{--
  大学名は、univ/○○大学では必要ないけど、他では必要そうだから修正する。
  --}}
    <div class="flex-box-ud non-flex-ud">
      <div class="flex-item-ud">
        <h3>
          <a class="nav-link lab-info-ud" href="{{ url('lab/'.$univ_name.'/'.$laboratory['lab_name']) }}">
            <span class="break-ud">{{ $univ_name }}</span> {{ $laboratory['lab_name'] }}
          </a>
        </h3>
      </div>
      <div class="flex-item-ud">
        <!--↓↓ この研究室の口コミを見る ↓↓-->
        @include('components.botton_watch_reviews')
      </div>
    </div>
      <div class="all-review-box-ud">
        <span class="sizeup-ud">総合評価<span>
        <img src="{{ asset('img/evaluation_star/star_'.$laboratory['all_stars'].'.png') }}" alt="star" width="100">
        <span class="evaluation_value-ud">{{ $laboratory['all_average'] }}</span>
      </div>

      <div class="review-box-ud">
        <div class="review-item-ud">
            教授
            <img src="{{ asset('img/evaluation_star/star_'.$laboratory['prof_stars'].'.png') }}" alt="star" width="100">
            <span class="evaluation_value-ud">{{ $laboratory['prof_average'] }}</span>
        </div>
        <div class="review-item-ud">
            就活
            <img src="{{ asset('img/evaluation_star/star_'.$laboratory['job_stars'].'.png') }}" alt="star" width="100">
            <span class="evaluation_value-ud">{{ $laboratory['job_average'] }}</span>
        </div>
        <div class="review-item-ud">
            雰囲気
            <img src="{{ asset('img/evaluation_star/star_'.$laboratory['lab_stars'].'.png') }}" alt="star" width="100">
            <span class="evaluation_value-ud">{{ $laboratory['lab_average'] }}</span>
        </div>
        <div class="review-item-ud">
            その他
            <img src="{{ asset('img/evaluation_star/star_'.$laboratory['other_stars'].'.png') }}" alt="star" width="100">
            <span class="evaluation_value-ud">{{ $laboratory['other_average'] }}</span>
        </div>
    </div>
