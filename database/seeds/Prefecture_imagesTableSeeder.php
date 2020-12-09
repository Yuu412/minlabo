<?php

use Illuminate\Database\Seeder;

class Prefecture_imagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $prefecturesFilenameArray = [
        '北海道' => "hokkaido.jpg",
        '青森県' => "aomori.jpg",
        '岩手県' => "iwate.jpg",
        '宮城県' => "miyagi.jpg",
        '秋田県' => "akita.jpg",
        '山形県' => "yamagata.jpg",
        '福島県' => "hukushima.jpg",
        '茨城県' => "ibaraki.jpg",
        '栃木県' => "tochigi.jpg",
        '群馬県' => "gunma.jpg",
        '埼玉県' => "saitama.jpg",
        '千葉県' => "tiba.jpg",
        '東京都' => "tokyo.jpg",
        '神奈川県' => "kanagawa.jpg",
        '新潟県' => "nigata.jpg",
        '富山県' => "toyama.jpg",
        '石川県' => "ishikawa.jpg",
        '福井県' => "hukui.jpg",
        '愛知県' => "aichi.jpg",
        '静岡県' => "sizuoka.jpg",
        '三重県' => "mie.jpg",
        '山梨県' => "yamanashi.jpg",
        '長野県' => "nagano.jpg",
        '岐阜県' => "gihu.jpg",
        '大阪府' => "osaka.jpg",
        '京都府' => "kyoto.jpg",
        '兵庫県' => "hyogo.jpg",
        '滋賀県' => "siga.jpg",
        '奈良県' => "nara.jpg",
        '和歌山県' => "wakayama.jpg",
        '岡山県' => "okayama.jpg",
        '広島県' => "hiroshima.jpg",
        '鳥取県' => "tottori.jpg",
        '島根県' => "shimane.jpg",
        '山口県' => "yamaguchi.jpg",
        '香川県' => "kagawa.jpg",
        '徳島県' => "tokushima.jpg",
        '愛媛県' => "ehime.jpg",
        '高知県' => "kochi.jpg",
        '福岡県' => "hukuoka.jpg",
        '佐賀県' => "saga.jpg",
        '長崎県' => "nagasaki.jpg",
        '熊本県' => "kumamoto.jpg",
        '大分県' => "oita.jpg",
        '宮崎県' => "miyazaki.jpg",
        '鹿児島県' => "kagoshima.jpg",
        '沖縄県' => "okinawa.jpg",
      ];

      foreach ($prefecturesFilenameArray as $key => $prefectureFilename) {
        $areaNameArray = ["北海道・東北", "関東・中部", "近畿", "中国・四国", "九州"];
        $prefecturesArray = [
            ["北海道", "青森県", "秋田県", "山形県", "岩手県", "宮城県", "福島県"],
            ["東京都", "神奈川県", "埼玉県", "千葉県", "栃木県", "茨城県", "群馬県",
             "愛知県", "岐阜県", "静岡県", "三重県", "新潟県", "山梨県", "長野県", "石川県", "富山県", "福井県"],
            ["大阪府", "兵庫県", "京都府", "滋賀県", "奈良県", "和歌山県"],
            ["岡山県", "広島県", "鳥取県", "島根県", "山口県", "香川県", "徳島県", "愛媛県", "高知県"],
            ["福岡県", "佐賀県", "長崎県", "熊本県", "大分県", "宮崎県", "鹿児島県", "沖縄県"],
        ];
        for ($i=0; $i < 5; $i++) {
          if(in_array($key, $prefecturesArray[$i])){
            $areaName = $areaNameArray[$i];
          }
        }

          DB::table('prefecture_images')->insert([
            [
              'prefecture_name'     => $key,
              'area_name'   => $areaName,
              'prefecture_filename'    => $prefectureFilename,
              'created_at'   => new DateTime(),
              'updated_at'   => new DateTime(),
            ],
          ]);
      }
    }
}
