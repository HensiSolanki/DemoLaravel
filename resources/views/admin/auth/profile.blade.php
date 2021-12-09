@extends('admin.layouts.app')
@section('mytitle', 'Profile')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><b>{{ Auth::guard('admin')->user()->name }}'s {{ __(' Profile ') }}</b></div>

                <div class="card-body">

                        <div class="row mb-2">
                        <div class="col-md-4">
                          <h5><b>{{ __('Name : ') }}</b></h5>  </div>
                          <h5>  {{ Auth::guard('admin')->user()->name }} </h5>
                        </div>

                        <div class="row mb-2">
                        <div class="col-md-4">
                          <h5><b>{{ __('E-Mail Address : ') }}</b></h5> </div>
                          <h5>{{ Auth::guard('admin')->user()->email }}</h5>
                       </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
