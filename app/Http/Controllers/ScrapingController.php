<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Weidner\Goutte\GoutteFacade as GoutteFacade;

class ScrapingController extends Controller
{
  public function scraping(Request $request)
  {
      $input_prefecture = $request->pref_name;

      $prefecture = array( "北海道","青森県","岩手県","宮城県","秋田県",
                           "山形県","福島県","茨城県","栃木県","群馬県",
                           "埼玉県","千葉県","東京都","神奈川県","新潟県",
                           "富山県","石川県","福井県","山梨県","長野県",
                           "岐阜県","静岡県","愛知県","三重県","滋賀県",
                           "京都府","大阪府","兵庫県","奈良県","和歌山県",
                           "鳥取県","島根県","岡山県","広島県","山口県",
                           "徳島県","香川県","愛媛県","高知県","福岡県",
                           "佐賀県","長崎県","熊本県","大分県","宮崎県",
                           "鹿児島県","沖縄県" );
      for($j=0; $j<47; $j++){
        if(strcmp($prefecture[$j], $input_prefecture) == 0){
          $prefecture_num = $j + 1;
        }
      }
      //URLがhttps://〇〇〇/pre(数字)の形
      //$prefecture_numを使って任意の都道府県のurlを設定する
      if($prefecture_num < 10){
        $each_univ_url = '0'.$prefecture_num.'/';
      }
      else{
        $each_univ_url = $prefecture_num.'/';
      }

      $url = 'https://passnavi.evidus.com/search_univ/list/prefecture_'.$each_univ_url;
      $goutte = GoutteFacade::request('GET', $url);

      //テキストを取得するための配列を準備
      $texts = array();

      //テキストを取得
      $goutte->filter('.sitemap-list li a')->each(function ($node) use (&$texts) {
          if(mb_strlen($node->text()) > 3){
            $texts[] = $node->text();
          }
      });

      $params = ['texts' => $texts,];
      return view('add2', $params)->with([
        'prefecture' => $prefecture,
        'input_prefecture' => $input_prefecture,
      ]);
  }
}
