@extends('layouts.app')



@section('content')
    <register-pre-check :csrf="{{json_encode(csrf_token())}}"
                        :endpoint-register='@json(route('register'))'
                        :email='@json($email)'
                        :password='@json($password)'
                        :password-mask='@json($password_mask)'>
    </register-pre-check>
@endsection
