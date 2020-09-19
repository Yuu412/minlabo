@extends('layouts.app')

@section('content')
    <registered :email='@json($email)'></registered>
@endsection
