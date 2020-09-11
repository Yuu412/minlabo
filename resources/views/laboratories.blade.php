@extends('layouts.app')
@section('content')
    @include('common.errors')
    <laboratories :main-prefectures='@json($main_prefectures)'
         :all-prefectures='@json($all_prefectures)' :faculties='@json($faculties)'
         :new-evaluations='@json($new_evaluations)' :high-evaluations='@json($high_evaluations)'></laboratories>
@endsection
