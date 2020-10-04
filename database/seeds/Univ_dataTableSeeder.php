<?php

use Illuminate\Database\Seeder;

class Univ_dataTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $univ_array = [
          '北海道' => [
            "旭川医科大学", "小樽商科大学", "帯広畜産大学", "北見工業大学", "北海道教育大学", "北海道大学", "室蘭工業大学", "釧路公立大学", "公立千歳科学技術大学", "公立はこだて未来大学", "札幌医科大学", "札幌市立大学", "名寄市立大学", "旭川大学", "札幌大谷大学", "札幌学院大学", "札幌国際大学", "札幌大学", "札幌保健医療大学", "天使大学",
            "星槎道都大学", "苫小牧駒澤大学", "日本医療大学", "日本赤十字北海道看護大学", "函館大学", "藤女子大学", "北翔大学", "北星学園大学", "北海学園大学", "北海商科大学", "北海道医療大学", "北海道科学大学", "北海道情報大学", "北海道千歳リハビリテーション大学", "北海道文教大学", "酪農学園大学", "稚内北星学園大学", "旭川大学短期大学部",
            "帯広大谷短期大学", "釧路短期大学", "光塩学園女子短期大学", "國學院大学北海道短期大学部", "札幌大谷大学短期大学部", "札幌国際大学短期大学部", "札幌大学女子短期大学部", "拓殖大学北海道短期大学", "函館大谷短期大学", "函館短期大学", "北翔大学短期大学部", "北星学園大学短期大学部", "北海道科学大学短期大学部", "北海道武蔵女子短期大学",
          ],
          '青森県' => [
            "弘前大学", "青森県立保健大学", "青森公立大学", "青森大学", "青森中央学院大学", "東北女子大学", "八戸学院大学", "八戸工業大学", "弘前医療福祉大学", "弘前学院大学", "青森明の星短期大学", "青森中央短期大学", "東北女子短期大学", "八戸学院大学短期大学部", "弘前医療福祉大学短期大学部",
          ],
          '岩手県' => [
            "岩手大学", "岩手県立大学", "岩手医科大学", "岩手保健医療大学", "富士大学", "盛岡大学", "岩手県立大学宮古短期大学部", "岩手県立大学盛岡短期大学部", "修紅短期大学", "盛岡大学短期大学部",
          ],
          '宮城県' => [
            "東北大学", "宮城教育大学", "宮城大学", "石巻専修大学", "尚絅学院大学", "仙台白百合女子大学", "仙台大学", "東北医科薬科大学", "東北学院大学", "東北工業大学", "東北生活文化大学", "東北福祉大学", "東北文化学園大学", "宮城学院女子大学", "聖和学園短期大学", "仙台青葉学院短期大学", "仙台赤門短期大学", "東北生活文化大学短期大学部", "宮城誠真短期大学",
          ],
          '秋田県' => [
            "秋田大学", "秋田県立大学", "秋田公立美術大学", "国際教養大学", "秋田看護福祉大学", "日本赤十字秋田看護大学", "ノースアジア大学", "秋田栄養短期大学", "聖霊女子短期大学", "日本赤十字秋田短期大学", "聖園学園短期大学",
          ],
          '山形県' => [
            "山形大学", "山形県立保健医療大学", "山形県立米沢栄養大学", "東北芸術工科大学", "東北公益文科大学", "東北文教大学", "山形県立米沢女子短期大学", "羽陽学園短期大学", "東北文教大学短期大学部",
          ],
          '福島県' => [
            "福島大学", "会津大学", "福島県立医科大学", "医療創生大学", "奥羽大学", "郡山女子大学", "東日本国際大学", "福島学院大学", "会津大学短期大学部", "いわき短期大学", "郡山女子大学短期大学部", "桜の聖母短期大学", "福島学院大学短期大学部",
          ],
          '茨城県' => [
            "茨城大学", "筑波技術大学", "筑波大学", "茨城県立医療大学", "茨城キリスト教大学", "筑波学院大学", "つくば国際大学", "常磐大学", "日本ウェルネススポーツ大学", "流通経済大学", "茨城女子短期大学", "つくば国際短期大学", "常磐短期大学",
          ],
          '栃木県' => [
            "宇都宮大学", "足利大学", "宇都宮共和大学", "国際医療福祉大学", "作新学院大学", "自治医科大学", "獨協医科大学", "白鴎大学", "文星芸術大学", "足利短期大学", "宇都宮短期大学", "宇都宮文星短期大学", "國學院大学栃木短期大学", "作新学院大学女子短期大学部", "佐野日本大学短期大学",
          ],
          '群馬県' => [
            "群馬大学", "群馬県立県民健康科学大学", "群馬県立女子大学", "高崎経済大学", "前橋工科大学", "育英大学", "関東学園大学", "共愛学園前橋国際大学", "桐生大学", "群馬医療福祉大学", "群馬パース大学", "上武大学", "高崎健康福祉大学", "高崎商科大学",
            "育英短期大学", "桐生大学短期大学部", "群馬医療福祉大学短期大学部", "高崎商科大学短期大学部", "東京福祉大学短期大学部", "新島学園短期大学", "明和学園短期大学",
          ],
          '埼玉県' => [
            "埼玉大学", "防衛医科大学校", "埼玉県立大学", "浦和大学", "共栄大学", "埼玉医科大学", "埼玉学園大学", "埼玉工業大学", "十文字学園女子大学", "城西大学", "尚美学園大学", "女子栄養大学", "駿河台大学", "聖学院大学", "西武文理大学", "東京国際大学",
            "東都大学", "東邦音楽大学", "獨協大学", "日本工業大学", "日本医療科学大学", "日本保健医療大学", "日本薬科大学", "人間総合科学大学", "文教大学", "平成国際大学", "武蔵野学院大学", "ものつくり大学", "秋草学園短期大学", "浦和大学短期大学部",
            "川口短期大学", "国際学院埼玉短期大学", "埼玉医科大学短期大学", "埼玉純真短期大学", "埼玉女子短期大学", "埼玉東萌短期大学", "城西短期大学", "武蔵丘短期大学", "武蔵野短期大学", "山村学園短期大学",
          ],
          '千葉県' => [
            "千葉大学", "気象大学校", "千葉県立保健医療大学", "愛国学園大学", "植草学園大学", "江戸川大学", "開智国際大学", "亀田医療大学", "川村学園女子大学", "神田外語大学", "敬愛大学", "幸福の科学大学(仮称)", "国際武道大学", "三育学院大学", "秀明大学",
            "淑徳大学", "城西国際大学", "聖徳大学", "清和大学", "千葉科学大学", "千葉経済大学", "千葉工業大学", "千葉商科大学", "中央学院大学", "東京基督教大学", "東京情報大学", "放送大学", "明海大学", "了徳寺大学", "麗澤大学", "和洋女子大学", "植草学園短期大学",
            "昭和学院短期大学", "聖徳大学短期大学部", "清和大学短期大学部", "千葉敬愛短期大学", "千葉経済大学短期大学部", "千葉明徳短期大学", "東京経営短期大学", "日本大学短期大学部（船橋校舎）",
          ],
          '東京都' => [
            "お茶の水女子大学", "電気通信大学", "東京医科歯科大学", "東京外国語大学", "東京海洋大学", "東京学芸大学", "東京藝術大学", "東京工業大学", "東京大学", "東京農工大学", "一橋大学", "国立看護大学校", "職業能力開発総合大学校", "東京都立大学", "青山学院大学",
            "亜細亜大学", "跡見学園女子大学", "上野学園大学", "桜美林大学", "大妻女子大学", "嘉悦大学", "学習院女子大学", "学習院大学", "共立女子大学", "杏林大学", "国立音楽大学", "慶應義塾大学", "恵泉女学園大学", "工学院大学", "國學院大学", "国際基督教大学",
            "国際ファッション専門職大学", "国士舘大学", "こども教育宝仙大学", "駒沢女子大学", "駒澤大学", "産業能率大学", "実践女子大学", "芝浦工業大学", "順天堂大学", "上智大学", "情報経営イノベーション専門職大学", "昭和女子大学", "昭和大学", "昭和薬科大学",
            "白梅学園大学", "白百合女子大学", "杉野服飾大学", "成蹊大学", "成城大学", "聖心女子大学", "清泉女子大学", "聖路加国際大学", "専修大学", "創価大学", "大正大学", "大東文化大学", "高千穂大学", "拓殖大学", "玉川大学", "多摩大学", "多摩美術大学", "中央大学",
            "津田塾大学", "帝京科学大学", "帝京大学", "帝京平成大学", "デジタルハリウッド大学", "東海大学", "東京有明医療大学", "東京医科大学", "東京医療学院大学", "東京医療保健大学", "東京音楽大学", "東京家政学院大学", "東京家政大学", "東京経済大学", "東京工科大学",
            "東京工芸大学", "東京国際工科専門職大学", "東京歯科大学", "東京慈恵会医科大学", "東京純心大学", "東京女子医科大学", "東京女子体育大学", "東京女子大学", "東京神学大学", "東京保健医療専門職大学", "東京聖栄大学", "東京成徳大学", "東京造形大学", "東京通信大学",
            "東京電機大学", "東京都市大学", "東京農業大学", "東京福祉大学", "東京富士大学", "東京未来大学", "東京薬科大学", "東京理科大学", "桐朋学園大学", "東邦大学", "東洋学園大学", "東洋大学", "二松学舎大学", "日本歯科大学", "日本体育大学", "日本医科大学",
            "日本社会事業大学", "日本獣医生命科学大学", "日本女子体育大学", "日本女子大学", "日本赤十字看護大学", "日本大学", "日本文化大学", "ビジネス・ブレークスルー大学", "文化学園大学", "文京学院大学", "法政大学", "星薬科大学", "武蔵大学", "武蔵野音楽大学",
            "武蔵野大学", "武蔵野美術大学", "明治学院大学", "明治大学", "明治薬科大学", "明星大学", "目白大学", "ヤマザキ動物看護大学", "立教大学", "立正大学", "ルーテル学院大学", "和光大学", "早稲田大学", "愛国学園短期大学", "有明教育芸術短期大学", "上野学園大学短期大学部",
            "大妻女子大学短期大学部", "共立女子短期大学", "国際短期大学", "駒沢女子短期大学", "実践女子大学短期大学部", "淑徳大学短期大学部", "女子栄養大学短期大学部", "女子美術大学短期大学部", "白梅学園短期大学", "杉野服飾大学短期大学部", "星美学園短期大学", "創価女子短期大学",
            "帝京大学短期大学", "帝京短期大学", "貞静学園短期大学", "戸板女子短期大学", "東京家政大学短期大学部", "東京交通短期大学", "東京歯科大学短期大学", "東京女子体育短期大学", "東京成徳短期大学", "東京立正短期大学", "東邦音楽短期大学", "桐朋学園芸術短期大学",
            "日本歯科大学東京短期大学", "新渡戸文化短期大学", "フェリシアこども短期大学", "文化学園大学短期大学部", "目白大学短期大学部", "ヤマザキ動物看護専門職短期大学", "山野美容芸術短期大学",
          ],
          '神奈川県' => [
              "横浜国立大学", "防衛大学校", "神奈川県立保健福祉大学", "横浜市立大学", "麻布大学", "神奈川工科大学", "神奈川歯科大学", "神奈川大学", "鎌倉女子大学", "関東学院大学", "北里大学", "相模女子大学", "松蔭大学", "湘南医療大学", "湘南鎌倉医療大学", "湘南工科大学",
              "昭和音楽大学", "女子美術大学", "星槎大学", "聖マリアンナ医科大学", "洗足学園音楽大学", "鶴見大学", "田園調布学園大学", "桐蔭横浜大学", "東洋英和女学院大学", "日本映画大学", "ビューティアンドウェルネス専門職大学(仮称)", "フェリス女学院大学", "八洲学園大学",
              "横浜商科大学", "横浜創英大学", "横浜美術大学", "横浜薬科大学", "川崎市立看護短期大学", "和泉短期大学", "小田原短期大学", "神奈川歯科大学短期大学部", "鎌倉女子大学短期大学部", "相模女子大学短期大学部", "上智大学短期大学部", "湘北短期大学", "昭和音楽大学短期大学部",
              "洗足こども短期大学", "鶴見大学短期大学部", "横浜女子短期大学",
          ],
          '新潟県' => [
            "上越教育大学", "長岡技術科学大学", "新潟大学", "三条市立大学(仮称)", "長岡造形大学", "新潟県立看護大学", "新潟県立大学", "開志専門職大学", "敬和学園大学", "長岡大学", "長岡崇徳大学", "新潟医療福祉大学", "新潟経営大学", "新潟工科大学", "新潟国際情報大学", "新潟産業大学",
            "新潟食料農業大学", "新潟青陵大学", "新潟薬科大学", "新潟リハビリテーション大学", "新潟工業短期大学", "新潟青陵大学短期大学部", "新潟中央短期大学", "日本歯科大学新潟短期大学", "明倫短期大学",
          ],
          '富山県' => [
             "富山大学", "富山県立大学", "高岡法科大学", "富山国際大学", "富山短期大学", "富山福祉短期大学",
          ],
          '石川県' => [
            "金沢大学", "石川県立看護大学", "石川県立大学", "金沢美術工芸大学", "公立小松大学", "金沢医科大学", "金沢学院大学", "金沢工業大学", "金沢星稜大学", "金城大学", "北陸学院大学", "北陸大学", "金沢学院短期大学", "金沢星稜大学女子短期大学部", "金城大学短期大学部", "北陸学院大学短期大学部",
          ],
          '福井県' => [
            "福井大学", "敦賀市立看護大学", "福井県立大学", "仁愛大学", "福井医療大学", "福井工業大学", "仁愛女子短期大学",
          ],
          '愛知県' => [
            "愛知教育大学", "豊橋技術科学大学", "名古屋工業大学", "名古屋大学", "愛知県立芸術大学", "愛知県立大学", "名古屋市立大学", "愛知医科大学", "愛知学院大学", "愛知学泉大学", "愛知工科大学", "愛知工業大学", "愛知産業大学", "愛知淑徳大学", "愛知大学", "愛知東邦大学",
            "愛知文教大学", "愛知みずほ大学", "一宮研伸大学", "桜花学園大学", "岡崎女子大学", "金城学院大学", "至学館大学", "修文大学", "椙山女学園大学", "星城大学", "大同大学", "中京大学", "中部大学", "東海学園大学", "同朋大学", "豊田工業大学", "豊橋創造大学",
            "名古屋音楽大学", "名古屋外国語大学", "名古屋学院大学", "名古屋学芸大学", "名古屋経済大学", "名古屋芸術大学", "名古屋産業大学", "名古屋商科大学", "名古屋女子大学", "名古屋造形大学", "名古屋文理大学", "名古屋柳城女子大学", "南山大学", "日本赤十字豊田看護大学",
            "日本福祉大学", "人間環境大学", "藤田医科大学", "名城大学", "愛知医療学院短期大学", "愛知学院大学短期大学部", "愛知学泉短期大学", "愛知工科大学自動車短期大学", "愛知江南短期大学", "愛知大学短期大学部", "愛知文教女子短期大学", "愛知みずほ短期大学", "岡崎女子短期大学",
            "至学館大学短期大学部", "修文大学短期大学部", "豊橋創造大学短期大学部", "名古屋経営短期大学", "名古屋女子大学短期大学部", "名古屋短期大学", "名古屋文化短期大学", "名古屋文理大学短期大学部", "名古屋柳城短期大学",
          ],
          '静岡県' => [
            "静岡大学", "浜松医科大学", "静岡県立大学", "静岡県立農林環境専門職大学", "静岡文化芸術大学", "静岡英和学院大学", "静岡産業大学", "静岡福祉大学", "静岡理工科大学", "聖隷クリストファー大学", "常葉大学", "浜松学院大学", "静岡県立大学短期大学部", "静岡英和学院大学短期大学部", "常葉大学短期大学部", "日本大学短期大学部（三島校舎）", "浜松学院大学短期大学部",
          ],
          '三重県' => [
            "三重大学", "三重県立看護大学", "皇學館大学", "鈴鹿医療科学大学", "鈴鹿大学", "四日市看護医療大学", "四日市大学", "三重短期大学", "鈴鹿大学短期大学部", "高田短期大学", "ユマニテク短期大学",
          ],
          '山梨県' => [
            "山梨大学", "都留文科大学", "山梨県立大学", "健康科学大学", "身延山大学", "山梨英和大学", "山梨学院大学", "大月短期大学", "帝京学園短期大学", "山梨学院短期大学",
          ],
          '長野県' => [
            "信州大学", "公立諏訪東京理科大学", "長野大学", "長野県看護大学", "長野県立大学", "佐久大学", "清泉女学院大学", "長野保健医療大学", "松本看護大学(仮称)", "松本歯科大学", "松本大学", "飯田女子短期大学", "上田女子短期大学", "佐久大学信州短期大学部", "信州豊南短期大学", "清泉女学院短期大学", "長野女子短期大学", "松本大学松商短期大学部", "松本短期大学",
          ],
          '岐阜県' => [
            "岐阜大学", "岐阜県立看護大学", "岐阜薬科大学", "朝日大学", "岐阜医療科学大学", "岐阜協立大学", "岐阜聖徳学園大学", "岐阜女子大学", "岐阜保健大学", "中京学院大学", "中部学院大学", "東海学院大学", "岐阜市立女子短期大学", "大垣女子短期大学", "岐阜聖徳学園大学短期大学部",
            "岐阜保健大学短期大学部", "正眼短期大学", "高山自動車短期大学", "中京学院大学短期大学部", "中部学院大学短期大学部", "東海学院大学短期大学部", "中日本自動車短期大学", "平成医療短期大学",
          ],
          '大阪府' => [
            "大阪教育大学", "大阪大学", "航空保安大学校", "大阪市立大学", "大阪府立大学", "藍野大学", "追手門学院大学", "大阪青山大学", "大阪医科大学", "大阪大谷大学", "大阪音楽大学", "大阪学院大学", "大阪河﨑リハビリテーション大学", "大阪観光大学", "大阪経済大学", "大阪経済法科大学",
            "大阪芸術大学", "大阪工業大学", "大阪国際大学", "大阪産業大学", "大阪歯科大学", "大阪樟蔭女子大学", "大阪商業大学", "大阪女学院大学", "大阪信愛学院大学(仮称)", "大阪成蹊大学", "大阪総合保育大学", "大阪体育大学", "大阪電気通信大学", "大阪人間科学大学", "大阪物療大学",
            "大阪保健医療大学", "大阪薬科大学", "大阪行岡医療大学", "関西医科大学", "関西医療大学", "関西外国語大学", "関西大学", "関西福祉科学大学", "近畿大学", "滋慶医療科学大学(仮称)", "四條畷学園大学", "四天王寺大学", "摂南大学", "千里金蘭大学", "相愛大学", "太成学院大学",
            "宝塚大学", "帝塚山学院大学", "常磐会学園大学", "梅花女子大学", "羽衣国際大学", "阪南大学", "東大阪大学", "桃山学院教育大学", "桃山学院大学", "森ノ宮医療大学", "大和大学", "藍野大学短期大学部", "大阪音楽大学短期大学部", "大阪学院大学短期大学部", "大阪キリスト教短期大学",
            "大阪芸術大学短期大学部", "大阪健康福祉短期大学", "大阪国際大学短期大学部", "大阪城南女子短期大学", "大阪女学院短期大学", "大阪信愛学院短期大学", "大阪成蹊短期大学", "大阪千代田短期大学", "大阪夕陽丘学園短期大学", "関西外国語大学短期大学部", "関西女子短期大学", "近畿大学短期大学部",
            "堺女子短期大学", "四條畷学園短期大学", "四天王寺大学短期大学部", "常磐会短期大学", "東大阪大学短期大学部", "平安女学院大学短期大学部",
          ],
          '京都府' => [
            "京都教育大学", "京都工芸繊維大学", "京都大学", "京都市立芸術大学", "京都府立医科大学", "京都府立大学", "福知山公立大学", "大谷大学", "京都医療科学大学", "京都外国語大学", "京都先端科学大学", "京都華頂大学", "京都看護大学", "京都芸術大学", "京都光華女子大学", "京都産業大学",
            "京都女子大学", "京都精華大学", "京都橘大学", "京都ノートルダム女子大学", "京都美術工芸大学", "京都文教大学", "京都薬科大学", "嵯峨美術大学", "種智院大学", "同志社女子大学", "同志社大学", "花園大学", "佛教大学", "平安女学院大学", "明治国際医療大学", "立命館大学", "龍谷大学",
            "池坊短期大学", "華頂短期大学", "京都外国語短期大学", "京都経済短期大学", "京都光華女子大学短期大学部", "京都西山短期大学", "京都文教短期大学", "嵯峨美術短期大学", "龍谷大学短期大学部",
          ],
          '兵庫県' => [
            "神戸大学", "兵庫教育大学", "神戸市外国語大学", "神戸市看護大学", "兵庫県立大学", "芦屋大学", "大手前大学", "関西看護医療大学", "関西国際大学", "関西福祉大学", "関西学院大学", "甲子園大学", "甲南女子大学", "甲南大学", "神戸医療福祉大学", "神戸海星女子学院大学", "神戸学院大学",
            "神戸芸術工科大学", "神戸国際大学", "神戸松蔭女子学院大学", "神戸女学院大学", "神戸女子大学", "神戸親和女子大学", "神戸常盤大学", "神戸薬科大学", "園田学園女子大学", "宝塚医療大学", "姫路大学", "姫路獨協大学", "兵庫医科大学", "兵庫医療大学", "兵庫大学", "武庫川女子大学",
            "流通科学大学", "大手前短期大学", "甲子園短期大学", "神戸教育短期大学", "神戸女子短期大学", "神戸常盤大学短期大学部", "産業技術短期大学", "頌栄短期大学", "聖和短期大学", "園田学園女子大学短期大学部", "東洋食品工業短期大学", "豊岡短期大学", "姫路日ノ本短期大学", "兵庫大学短期大学部",
            "湊川短期大学", "武庫川女子大学短期大学部",
          ],
          '滋賀県' => [
            "滋賀医科大学", "滋賀大学", "滋賀県立大学", "成安造形大学", "聖泉大学", "長浜バイオ大学", "びわこ学院大学", "びわこ成蹊スポーツ大学", "びわこリハビリテーション専門職大学", "滋賀短期大学", "滋賀文教短期大学", "びわこ学院大学短期大学部",
          ],
          '奈良県' => [
            "奈良教育大学", "奈良女子大学", "奈良県立医科大学", "奈良県立大学", "畿央大学", "帝塚山大学", "天理医療大学", "天理大学", "奈良学園大学", "奈良大学", "奈良芸術短期大学", "奈良佐保短期大学", "白鳳短期大学",
          ],
          '和歌山県' => [
             "和歌山大学", "和歌山県立医科大学", "高野山大学", "和歌山信愛大学", "和歌山信愛女子短期大学",
          ],
          '岡山県' => [
            "岡山大学", "岡山県立大学", "新見公立大学", "岡山医療専門職大学", "岡山学院大学", "岡山商科大学", "岡山理科大学", "川崎医科大学", "川崎医療福祉大学", "環太平洋大学", "吉備国際大学", "倉敷芸術科学大学", "くらしき作陽大学", "山陽学園大学", "就実大学", "中国学園大学", "ノートルダム清心女子大学",
            "美作大学", "倉敷市立短期大学", "岡山短期大学", "川崎医療短期大学", "作陽音楽短期大学", "山陽学園短期大学", "就実短期大学", "中国短期大学", "美作大学短期大学部",
          ],
          '広島県' => [
            "広島大学", "海上保安大学校", "叡啓大学(仮称)", "尾道市立大学", "県立広島大学", "広島市立大学", "福山市立大学", "エリザベト音楽大学", "日本赤十字広島看護大学", "比治山大学", "広島経済大学", "広島工業大学", "広島国際大学", "広島修道大学", "広島女学院大学", "広島都市学園大学",
            "広島文化学園大学", "広島文教大学", "福山大学", "福山平成大学", "安田女子大学", "山陽女子短期大学", "比治山大学短期大学部", "広島国際学院大学自動車短期大学部", "広島文化学園短期大学", "安田女子短期大学",
          ],
          '鳥取県' => [
            "鳥取大学", "公立鳥取環境大学", "鳥取看護大学", "鳥取短期大学",
          ],
          '島根県' => [
            "島根大学", "島根県立大学", "島根県立大学短期大学部",
          ],
          '山口県' => [
            "山口大学", "水産大学校", "下関市立大学", "山口県立大学", "山陽小野田市立山口東京理科大学", "宇部フロンティア大学", "至誠館大学", "東亜大学", "徳山大学", "梅光学院大学", "山口学芸大学", "岩国短期大学", "宇部フロンティア大学短期大学部", "下関短期大学", "山口芸術短期大学", "山口短期大学",
          ],
          '香川県' => [
            "香川大学", "香川県立保健医療大学", "四国学院大学", "高松大学", "香川短期大学", "高松短期大学",
          ],
          '徳島県' => [
            "徳島大学", "鳴門教育大学", "四国大学", "徳島文理大学", "四国大学短期大学部", "徳島工業短期大学", "徳島文理大学短期大学部",
          ],
          '愛媛県' => [
            "愛媛大学", "愛媛県立医療技術大学", "聖カタリナ大学", "松山東雲女子大学", "松山大学", "今治明徳短期大学", "聖カタリナ大学短期大学部", "松山東雲短期大学", "松山短期大学",
          ],
          '高知県' => [
            "高知大学", "高知県立大学", "高知工科大学", "高知学園大学", "高知リハビリテーション専門職大学", "高知学園短期大学",
          ],
          '福岡県' => [
            "九州工業大学", "九州大学", "福岡教育大学", "北九州市立大学", "九州歯科大学", "福岡県立大学", "福岡女子大学", "九州栄養福祉大学", "九州共立大学", "九州国際大学", "九州産業大学", "九州情報大学", "九州女子大学", "久留米工業大学", "久留米大学", "サイバー大学", "産業医科大学",
            "純真学園大学", "西南学院大学", "西南女学院大学", "聖マリア学院大学", "第一薬科大学", "筑紫女学園大学", "中村学園大学", "西日本工業大学", "日本経済大学", "日本赤十字九州国際看護大学", "福岡看護大学", "福岡工業大学", "福岡国際医療福祉大学", "福岡歯科大学", "福岡女学院看護大学",
            "福岡女学院大学", "福岡大学", "折尾愛真短期大学", "九州大谷短期大学", "九州女子短期大学", "九州産業大学造形短期大学部", "近畿大学九州短期大学", "久留米信愛短期大学", "香蘭女子短期大学", "純真短期大学", "精華女子短期大学", "西南女学院大学短期大学部", "中村学園大学短期大学部",
            "西日本短期大学", "東筑紫短期大学", "福岡医療短期大学", "福岡工業大学短期大学部", "福岡こども短期大学", "福岡女学院大学短期大学部", "福岡女子短期大学",
          ],
          '佐賀県' => [
            "佐賀大学", "西九州大学", "九州龍谷短期大学", "佐賀女子短期大学", "西九州大学短期大学部",
          ],
          '長崎県' => [
            "長崎大学", "長崎県立大学", "活水女子大学", "長崎ウエスレヤン大学", "長崎外国語大学", "長崎国際大学", "長崎純心大学", "長崎総合科学大学", "長崎女子短期大学", "長崎短期大学",
          ],
          '熊本県' => [
             "熊本大学", "熊本県立大学", "九州看護福祉大学", "九州ルーテル学院大学", "熊本学園大学", "熊本保健科学大学", "尚絅大学", "崇城大学", "平成音楽大学", "尚絅大学短期大学部", "中九州短期大学",
          ],
          '大分県' => [
            "大分大学", "大分県立看護科学大学", "日本文理大学", "別府大学", "立命館アジア太平洋大学", "大分県立芸術文化短期大学", "大分短期大学", "東九州短期大学", "別府大学短期大学部", "別府溝部学園短期大学",
          ],
          '宮崎県' => [
            "宮崎大学", "宮崎県立看護大学", "宮崎公立大学", "九州保健福祉大学", "南九州大学", "宮崎国際大学", "宮崎産業経営大学", "南九州短期大学", "宮崎学園短期大学",
          ],
          '鹿児島県' => [
            "鹿児島大学", "鹿屋体育大学", "鹿児島国際大学", "鹿児島純心女子大学", "志學館大学", "第一工業大学", "鹿児島県立短期大学", "鹿児島純心女子短期大学", "鹿児島女子短期大学", "第一幼児教育短期大学",
          ],
          '沖縄県' => [
            "琉球大学", "沖縄県立看護大学", "沖縄県立芸術大学", "名桜大学", "沖縄キリスト教学院大学", "沖縄国際大学", "沖縄大学", "沖縄キリスト教短期大学", "沖縄女子短期大学",
          ],
        ];

        foreach ($univ_array as $key => $univ_data) {
          foreach ($univ_data as $univ_name) {
            DB::table('univ_data')->insert([
              [
                'prefecture_name'     => $key,
                'univ_name'    => $univ_name,
                'created_at'   => new DateTime(),
                'updated_at'   => new DateTime(),
              ],
            ]);
          }
        }
    }
}
