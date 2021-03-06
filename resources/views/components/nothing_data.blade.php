    <link href="{{ asset('css/components/com_nothing_data.css') }}" rel="stylesheet" type="text/css">
    <div class="gray-block-nd">
      <h3>検索キーワード：”{{ $keyword }}”</h3>
      <!--↓↓ 研究室登録フォーム ↓↓-->
      @include('components.botton_add_reviews')
    </div>
    <div class="total-evaluation-nd">
      <div class="each-evaluation-nd">
          ”{{ $keyword }}”のキーワードを含む研究室は見つかりませんでした。<br>
          口コミ投稿をご希望される場合は、ページ上部の「研究室の口コミを登録する」ボタンから登録してください。
      </div>
      <div class="return-button-nd">
        <a class="btn btn-primary" href="/">トップページに戻る</a>
      </div>
    </div>
