<link href="{{ asset('css/components/com_evaluation_category.css') }}" rel="stylesheet" type="text/css">

    <div class="each-evaluation-ec">
        <div class="average-evaluation-ec">
          <a class="average-evaluation-block-ec" href="{{ url('lab-evaluation/'.$evaluation['id']) }}">
            総合評価
            <img class="all_stars_img-ec" src="{{ asset('img/evaluation_star/star_'.$evaluation['all_stars'].'.png') }}" alt="star" width="100">
            {{ $evaluation['all_average'] }}
          </a>
          <div class="add-time-ec">
            {{ $evaluation['created_at'] }}
          </div>
        </div>

        <div class="new-evaluation-ec">
              <div class="review-box-ec">
                <div class="review-item-ec">
                    教授
                    <img src="{{ asset('img/evaluation_star/star_'.$evaluation['prof_stars'].'.png') }}" alt="star" width="100">
                    <span class="evaluation_value-ec">{{ $evaluation['prof_average'] }}</span>
                </div>
                <div class="review-item-ec">
                    就活
                    <img src="{{ asset('img/evaluation_star/star_'.$evaluation['job_stars'].'.png') }}" alt="star" width="100">
                    <span class="evaluation_value-ec">{{ $evaluation['job_average'] }}</span>
                </div>
                <div class="review-item-ec">
                    雰囲気
                    <img src="{{ asset('img/evaluation_star/star_'.$evaluation['lab_stars'].'.png') }}" alt="star" width="100">
                    <span class="evaluation_value-ec">{{ $evaluation['lab_average'] }}</span>
                </div>
                <div class="review-item-ec">
                    その他
                    <img src="{{ asset('img/evaluation_star/star_'.$evaluation['other_stars'].'.png') }}" alt="star" width="100">
                    <span class="evaluation_value-ec">{{ $evaluation['other_average'] }}</span>
                </div>
              </div>
              <div class="flex-box-ec non-flex-ec">
                <div class="content-box-ec">
                  <a href="{{ url('lab-evaluation/'.$evaluation['id']) }}">
                      口コミ：{{ $evaluation['comment'] }}
                  </a>
                </div>
                <div class="botton-box-ec">
                  <a class="botton-ec" href="{{ url('lab-evaluation/'.$evaluation['id']) }}">
                    この研究室の口コミを見る
                  </a>
                </div>
              </div>
        </div>
    </div>
