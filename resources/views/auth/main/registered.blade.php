@extends('layouts.app')
@section('content')
    <main-registered :qr='@json($qr)'></main-registered>
@endsection
