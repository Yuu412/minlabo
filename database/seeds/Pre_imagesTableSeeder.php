<?php

use Illuminate\Database\Seeder;

class Pre_imagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $pre_array = [
        '北海道' => "hokkaido.jpg",
        '青森県' => "aomori.jpg",
        '秋田県' => "akita.jpg",
        '山形県' => "yamagata.jpg",
        '岩手県' => "iwate.jpg",
        '宮城県' => "miyagi.jpg",
        '福島県' => "hukushima.jpg",
        '東京都' => "tokyo.jpg",
        '神奈川県' => "kanagawa.jpg",
        '埼玉県' => "saitama.jpg",
        '千葉県' => "tiba.jpg",
        '栃木県' => "tochigi.jpg",
        '茨城県' => "ibaraki.jpg",
        '群馬県' => "gunma.jpg",
        '愛知県' => "aichi.jpg",
        '岐阜県' => "gihu.jpg",
        '静岡県' => "sizuoka.jpg",
        '三重県' => "mie.jpg",
        '新潟県' => "nigata.jpg",
        '山梨県' => "yamanashi.jpg",
        '長野県' => "nagano.jpg",
        '石川県' => "ishikawa.jpg",
        '富山県' => "toyama.jpg",
        '福井県' => "hukui.jpg",
        '大阪府' => "osaka.jpg",
        '兵庫県' => "hyogo.jpg",
        '京都府' => "kyoto.jpg",
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

<<<<<<< Updated upstream
      foreach ($pre_array as $key => $pre_data) {
          DB::table('pre_images')->insert([
            [
              'pre_name'     => $key,
              'pre_image'    => $pre_imgname,
=======
      foreach ($pre_array as $key => $pre_img_name) {
          DB::table('pre_images')->insert([
            [
              'pre_name'     => $key,
              'pre_image'    => $pre_img_name,
>>>>>>> Stashed changes
              'created_at'   => new DateTime(),
              'updated_at'   => new DateTime(),
            ],
          ]);
      }
    }
}
