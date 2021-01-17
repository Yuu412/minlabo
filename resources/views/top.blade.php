<link href="{{ asset('css/top.css') }}" rel="stylesheet" type="text/css">
  <!-- JavaScript -->
<script src="//code.jquery.com/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/gsap/2.0.1/TweenMax.min.js"></script>
<script src="//s3-us-west-2.amazonaws.com/s.cdpn.io/85188/jquery.wavify.js"></script>
<script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>

@extends('layouts.app')
@section('content')
  <div class="top">
    <div class="flex-box top-contents-box">
      <div class="top-contents">
        <h1 class="bold">
          研究室・ゼミ選択の<br />
          後悔をゼロに。
        </h1>
        <p>
          対面での情報共有が難しい中、<br />
          皆さんのゼミ・研究室選択への後悔を少しでも減らしたい。<br />
          そんな想いで立ち上がった学生団体です。
        </p>
        <div class="button-box">
          <a class="button login-button" href="{{ url('/login') }}">ログイン</a>
          <a class="button register-button" href="{{ url('/register') }}">今すぐユーザー登録</a>
        </div>
      </div>
      <div class="iphone-screen">
        <img src="img/others/iphone_screen.png" alt="操作画面" />
      </div>
    </div>
  </div>
  <div id="iphone-bubble"></div>

  <div class="main">
    <div class="section">
      <div class="introduce-box">
        <h2>
          みんラボってどんなサービス？
        </h2>
        <iframe width="560" height="315" src="https://www.youtube.com/embed/aW8riWJxOMA" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        <p>
          ホームページ・説明会だけじゃわからない、<br>
          ゼミや研究室のリアル。<br>
          学生側からの声を収集・分析し、<br
          >あなたの選択をサポートします。
        </p>
      </div>
    </div>

    <div class="section evaluation-count">
      <h2>
        どこの研究室の口コミが見られるの？
      </h2>
      <div class="relative">
        <div>
          <img src="img/others/japanmap.png" alt="日本地図" />
        </div>
        @foreach($areas as $key => $area)
          <div id="area-{{$loop->iteration}}" class="area">
            <span class="area-title">
              {{ $area['name'] }}
            </span>
            <p>
              <span class="count">
                {{ $area['count'] }}
              </span>件
            </p>
          </div>
        @endforeach
      </div>
      <svg class="wave-box" version="1.1" xmlns="https://www.w3.org/TR/SVG/"><path id="wave-upper" d=""/></svg>
      <svg class="wave-box" version="1.1" xmlns="https://www.w3.org/TR/SVG/"><path id="wave-under" d=""/></svg>
    </div>

    <div class="dot-right"></div>

    <div class="section register-step">
      <h2>
        無料登録はたったの3ステップ！
      </h2>
      <div class="flex-box flex-step">
        <div class="step">
          <img src="img/others/3step/step1.png" alt="簡単会員登録" />
          <p>
            基本情報を<br>
            入力して<br>
            仮会員登録
          </p>
        </div>
        <div class="step">
          <img src="img/others/3step/step2.png" alt="メールから本登録" />
          <p>
            メールに届く<br>
            メッセージから <br>
            本登録を完了！
          </p>
        </div>
        <div class="step">
          <img src="img/others/3step/step3.png" alt="口コミの閲覧" />
          <p>
            ゼミ・研究室を<br>
            簡単に検索できる！
          </p>
        </div>
      </div>
      <div class="flex-box">
        <div class="step-details" id="step-details-left">
          <span>最短１分で会員登録</span>
          <p>
            基本情報の入力は、<br>
            メールアドレス、大学名、学部、学科の<br>
            たった４項目だけなので、<br>
            最短１分で終了します！<br>
          </p>
        </div>
        <div class="step-details">
          <span>ゼミ・研究室の情報がひと目でわかる</span>
          <p>
            ゼミ・研究室選択の際に<br>
            抑えておきたい<br>
            20以上の項目を選定し、<br>
            数直線を用いて<br>
            定量的に示しています。<br>
          </p>
        </div>
      </div>
    </div>

    <div class="button-box last-button-box">
      <a class="last-button button register-button" href="{{ url('/register') }}">今すぐユーザー登録</a>
    </div>
  </div>

@endsection
<script src="{{ asset('js/particles.js')}}"></script>
<!-- ファイルの読み込み -->
