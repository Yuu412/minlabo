@extends('layouts.app')
@section('content')
    <top :areas='@json($areas)' :route-register='@json(route('register'))'></top>
@endsection
