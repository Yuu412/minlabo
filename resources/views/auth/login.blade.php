@extends('layouts.app')

@section('content')
    <login
        :endpoint-login='@json(action('Auth\LoginController@login'))'
        :csrf="{{json_encode(csrf_token())}}"
        :remember='@json(old('remember'))'
        :route-password-request='@json(route('password.request'))'
        :route-register='@json(route('register'))'>
    </login>
@endsection
