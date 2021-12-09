@extends('admin.layouts.app')
@section('mytitle', 'Users Index')
@section('content')
 <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2>View Products</h2>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 margin-tb">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <h5> <strong>Name:</strong>
                                        {{ $user->name }}
                                    </h5>
                                </div>
                            </div>
                            <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <h5> <strong>User Name:</strong>
                                        {{ $user->username }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <h5> <strong>Email:</strong>
                                        {{ $user->email }}
                                    </h5>
                                </div>
                            </div>
                             <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <h5> <strong>image:</strong>
                                      <img src="{{ $user->image_url }}">
                                    </h5>
                                </div>
                            </div>
                             <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <h5> <strong>imageThumb:</strong>
                                      <img id="thumb" src="{{ $user->image_thumb_url }}">
                                    </h5>
                                </div>
                            </div>
                            {{-- <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <h5> <strong>Image:</strong>
                                        <img src="{{ $products->image_url }}">
                                    </h5>
                                </div>
                            </div>
                        </div> --}}
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <a class="btn btn-secondary" href="{{ route('admin.userIndex') }}" role="button">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

