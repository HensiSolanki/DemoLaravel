@extends('layouts.app')

@section('mytitle', 'Profile')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><b>{{ Auth::user()->name}}'s {{ __(' Profile ') }}</b>
                 <a href="{{ route('profile')}}"> <button type="button" class="btn btn-primary">
                                    {{ __('Edit') }}
                                </button></a></div>
                <div class="card-body">
                        <div class="row mb-2">
                        <div class="col-md-4">
                          <h5><b>{{ __('Name : ') }}</b></h5>  </div>
                          <h5>  {{ Auth::user()->name }} </h5>
                        </div>

                        <div class="row mb-2">
                        <div class="col-md-4">
                            <h5><b>{{ __('UserName : ') }}</b></h5> </div>
                            <h5>{{ Auth::user()->username }}</h5>
                        </div>

                        <div class="row mb-2">
                        <div class="col-md-4">
                          <h5><b>{{ __('E-Mail Address : ') }}</b></h5> </div>
                          <h5>{{ Auth::user()->email }}</h5>
                       </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
