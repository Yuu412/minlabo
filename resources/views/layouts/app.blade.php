<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Goodle adsense -->
  <script data-ad-client="ca-pub-4967925705019017" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
  <!-- Search Console -->
  <meta name="google-site-verification" content="0cl3OMCi_KHO8k1KSo8mU_B2AgRY6eeeK5zOYeGfack" />
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-156021282-2"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-156021282-2');
  </script>


  <!-- favicon -->
  <link rel="shortcut icon" href="{{ asset('img/minlabo_logo/favicon.ico') }}">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title') | {{ config('app.name') }}</title>
  @hasSection('description')
    <meta name="description" itemprop="description" content="@yield('description')">
  @else
    <meta name="description" itemprop="description" content="ゼミ・研究室口コミサイト|みんラボ">
  @endif

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <!-- Styles -->
  <link href="{{ mix('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('css/app_origin.css') }}" rel="stylesheet">

</head>
<body>
  <div id="app">
    <nav class="header navbar navbar-expand-md navbar-light">
      <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
          <img src="{{ asset('img/minlabo_logo/logo_2.png') }}" alt="みんラボ" width="150px" />
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">

            @guest
                <li>
                  <a class="nav-link" href="{{ route('send.link.page')}}">
                    研究室の口コミを投稿する
                  </a>
                </li>
              @if (Route::has('register'))
                <li><a class="nav-link" href="{{ route('register') }}">ユーザー登録(1分)</a></li>
              @endif
                <li><a class="nav-link" href="{{ route('login') }}">ログイン</a></li>
            @else
              @php
                $user = Auth::user();
              @endphp
              <li>
                <a class="nav-link" href="{{ action('LinkController@to_add') }}">
                  研究室の口コミを投稿する
                </a>
              </li>
              <li>
                <a class="nav-link" href="{{ url('/my-page')}} ">
                  {{ __('マイページ') }}
                </a>
              </li>
              <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                ログアウト
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            @endguest
           </ul>
         </div>
      </div>
    </nav>
    <main>
        @yield('content')
    </main>
    <footer>
      <div class="upper">
        <img src="{{ asset('img/minlabo_logo/logo_1.png') }}" alt="みんラボ" />
        <ul class="footer-menu">
         <li><a href="{{url('/')}}">home</a> ｜</li>
         <li><a href="{{route('login')}}">ログイン</a> ｜</li>
         <li><a href="{{route('policy')}}">プライバシーポリシー</a> ｜</li>
         <li><a href="{{route('policy')}}">利用規約</a></li>
        </ul>
      </div>
      <div class="under">
        <p>© All rights reserved by webcampnavi.</p>
      </div>
    </footer>
   </div>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
</body>
</html>
