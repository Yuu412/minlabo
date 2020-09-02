@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">本会員登録</div>

                    @isset($message)
                        <div class="card-body">
                            {{$message}}
                        </div>
                    @endisset

                    @empty($message)
                        <div class="card-body">
                            <form method="POST" action="{{ route('register.main.check') }}">
                                @csrf

                                <input type="hidden" name="email_token" value="{{ $email_token }}">

                                {{--
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">名前</label>
                                    <div class="col-md-6">
                                        <input
                                            id="name" type="text"
                                            class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                            name="name" value="{{ old('name') }}" required>

                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback">
                                            <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                --}}
                                <div class="form-group row">
                                    <label for="univ_name" class="col-md-4 col-form-label text-md-right">{{ __('大学名') }}</label>

                                    <div class="col-md-6">
                                        <input id="univ_name" type="text" class="form-control @error('univ_name') is-invalid @enderror" name="univ_name">
                                        @error('univ_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="faculty_name" class="col-md-4 col-form-label text-md-right">{{ __('学部') }}</label>

                                    <div class="col-md-6">
                                        <input id="faculty_name" type="text" class="form-control @error('faculty_name') is-invalid @enderror" name="faculty_name">
                                        @error('faculty_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="department_name" class="col-md-4 col-form-label text-md-right">{{ __('学科') }}</label>

                                    <div class="col-md-6">
                                      <input id="department_name" type="text" class="form-control @error('department_name') is-invalid @enderror" name="department_name">
                                        @error('department_name')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="lab_name" class="col-md-4 col-form-label text-md-right">{{ __('研究室名') }}</label>

                                    <div class="col-md-6">
                                        <input id="lab_name" type="text" class="form-control @error('lab_name') is-invalid @enderror" name="lab_name">
                                        @error('lab_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            確認画面へ
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @endempty
                </div>
            </div>
        </div>
    </div>
@endsection
