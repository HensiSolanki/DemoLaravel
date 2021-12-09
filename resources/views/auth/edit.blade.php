@extends('layouts.app')

@section('mytitle', 'Edit Profile')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit Profile') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('auth.editprofile') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row mb-3">
                                <img src="{{ Auth::user()->image_url }}" alt="profile_image" style="width: 150px;height: 150px; float:left; border-radius:50%; margin-left: 277px; margin-bottom: 11px;">
                              <div class="col-md-6">
                                <input type="file" name="profile" class="form-control @error('profile') is-invalid @enderror" style="margin-left: 241px;">
                              </div>
                                @error('profile')
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="margin-left:292px;">{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <div class="form-group row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name : ') }}</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{!! old('name', Auth::user()->name) !!}" autocomplete>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('UserName : ') }}</label>

                                <div class="col-md-6">
                                    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{!! old('username', Auth::user()->username) !!}" autocomplete>
                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address :') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" disabled>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-success">
                                        {{ __('Edit') }}
                                    </button>
                                    <a href="{{ asset('home') }}">
                                        <button type="button" class="btn btn-danger">
                                            {{ __('Cancle') }}
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



















