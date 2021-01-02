      <link href="{{ asset('css/components/com_latest_review.css') }}" rel="stylesheet" type="text/css">
      <div class="font-weight-bold-lr">
        <h4>最新口コミ</h4>
        <div class="review-box-lr">
          <div class="review-item-lr all-sp">
              総合評価
              <span id="evaluation_all_value-lr">{{ $laboratory['latest_evaluation']->all_average }}</span>
          </div>
          <div class="review-item-lr">
              教授
              <img src="{{ asset('img/evaluation_star/star_1.png') }}" alt="star" width="100">
              <span class="evaluation_value-lr">{{ $laboratory['latest_evaluation']->prof_average }}</span>
          </div>
          <div class="review-item-lr">
              就活
              <img src="{{ asset('img/evaluation_star/star_1.png') }}" alt="star" width="100">
              <span class="evaluation_value-lr">{{$laboratory['latest_evaluation']->job_average }}</span>
          </div>
          <div class="review-item-lr">
              雰囲気
              <img src="{{ asset('img/evaluation_star/star_1.png') }}" alt="star" width="100">
              <span class="evaluation_value-lr">{{ $laboratory['latest_evaluation']->lab_average }}</span>
          </div>
          <div class="review-item-lr">
              その他
              <img src="{{ asset('img/evaluation_star/star_1.png') }}" alt="star" width="100">
              <span class="evaluation_value-lr">{{ $laboratory['latest_evaluation']->other_average }}</span>
          </div>
        </div>
      </div>
