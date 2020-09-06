@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">本会員登録確認</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register.main.registered') }}">
                        @csrf
                        {{--
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">名前</label>
                            <div class="col-md-6">
                                <span class="">{{$user->name}}</span>
                                <input type="hidden" name="name" value="{{$user->name}}">
                            </div>
                        </div>
                        --}}
                        <div class="form-group row">
                            <label for="univ_name" class="col-md-4 col-form-label text-md-right">大学名</label>
                            <div class="col-md-6">
                                <span class="">{{$user->univ_name}}</span>
                                <input type="hidden" name="univ_name" value="{{$user->univ_name}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="faculty_name" class="col-md-4 col-form-label text-md-right">学部</label>
                            <div class="col-md-6">
                                <span class="">{{$user->faculty_name}}</span>
                                <input type="hidden" name="faculty_name" value="{{$user->faculty_name}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="department_name" class="col-md-4 col-form-label text-md-right">学科</label>
                            <div class="col-md-6">
                                <span class="">{{$user->department_name}}</span>
                                <input type="hidden" name="department_name" value="{{$user->department_name}}">
                            </div>
                        </div>

                        <input type="hidden" name="email_token" value="{{$email_token}}">

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    本登録
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
