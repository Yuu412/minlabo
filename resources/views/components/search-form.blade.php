<div class="col-sm-4" style="padding:20px 0; padding-left:0px;">
  <form class="form-inline" action="{{url('/search_result')}}">
    <div class="form-group">
      <input type="text" name="keyword" value="{{ $keyword }}" class="form-control" placeholder="キーワード[例:〇〇研究室、東京都、工学部]">
    </div>
    <input type="submit" value="検索" class="btn btn-info">
  </form>
</div>
