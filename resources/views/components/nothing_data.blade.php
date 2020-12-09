    <link href="{{ asset('css/com_nothing_data.css') }}" rel="stylesheet" type="text/css">
    <div class="gray-block-nd">
      <h3>検索キーワード：”{{ $keyword }}”</h3>
      <!--↓↓ 研究室登録フォーム ↓↓-->
      @include('components.botton_add_reviews')
    </div>
    <div class="total-evaluation-nd">
      <div class="each-evaluation-nd">
          ”{{ $keyword }}”のキーワード含む研究室は見つかりませんでした。<br>
          研究室の口コミ投稿をご希望される場合は、下記のフォームから登録してください。
      </div>
      <div class="return-button">
        <a class="btn btn-primary" href="/">トップページに戻る</a>
      </div>
    </div>
