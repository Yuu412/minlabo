<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'みんラボ') }}</title>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    @if(\Request::is('/'))
        <laboratory-header :endpoint-search='@json(route('search'))' :csrf="{{json_encode(csrf_token())}}" :link-regist='@json(route('register'))'
                    :link-login='@json(route('login'))'
                    :link-post='@json(action('LinkController@to_add'))'></laboratory-header>
    @else
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'みんラボ') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false"
                        aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('register'))
                                <li>
                                    <a class="nav-link" href="{{ route('register') }}">ユーザー登録(1分)</a>
                                </li>
                            @endif
                            <li>
                                <a class="nav-link" href="{{ route('login') }}">ログイン</a>
                            </li>
                        @else
                            <li>
                                <a class="nav-link" href="{{ action('LinkController@to_add') }}">
                                    研究室の口コミを追加する
                                </a>
                            </li>

                            @php
                                $user = Auth::user();
                            @endphp
                            <li>
                                <a class="nav-link" href="{{ url('mypage')}} ">
                                    {{ __('マイページ') }}
                                </a>
                            </li>
                            <a class="nav-link" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                               document.getElementById('logout-form').submit();">
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
    @endif
    <main class="py-4">
        @yield('content')
    </main>
    <my-footer :year='@json($year)'></my-footer>
</div>
</body>
</html>
