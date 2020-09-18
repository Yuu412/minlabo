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
        <laboratories-header :endpoint-search='@json(route('search'))'
                             :csrf="{{json_encode(csrf_token())}}"
                             :route-register='@json(route('register'))'
                             :route-login='@json(route('login'))'
                             :route-post='@json(action('LinkController@to_add'))'
                             :route-my-page='@json(route('my-page'))'
                             :endpoint-logout='@json(route('logout'))'
                             :is-login='@json(\Auth::check())'>
        </laboratories-header>
    @elseif(\Request::is('top'))
        <top-header :route-register='@json(route('register'))'
                    :route-login='@json(route('login'))'
                    :route-post='@json(action('LinkController@to_add'))'
                    :route-my-page='@json(route('my-page'))'
                    :endpoint-logout='@json(route('logout'))'
                    :csrf="{{json_encode(csrf_token())}}"
                    :is-login='@json(\Auth::check())'>
        </top-header>
    @elseif(\Auth::check())
        <logged-in-nav :route-post='@json(action('LinkController@to_add'))'
                       :route-my-page='@json(route('my-page'))'
                       :endpoint-logout='@json(route('logout'))'
                       :csrf="{{json_encode(csrf_token())}}">
        </logged-in-nav>
    @else
        <not-logged-in-nav :route-register='@json(route('register'))'
                           :route-login='@json(route('login'))'
                           :route-post='@json(action('LinkController@to_add'))'>
        </not-logged-in-nav>
    @endif
    <main>
        @yield('content')
    </main>
    <my-footer :year='@json($year)'></my-footer>
</div>
</body>
</html>
