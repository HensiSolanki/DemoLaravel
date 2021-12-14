@extends('admin.layouts.app')

@section('mytitle', 'Product Details')
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
                                        {{ $products->product_name }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <h5> <strong>Details:</strong>
                                        {{ $products->description }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <h5> <strong>Image:</strong>
                                        <img src="{{ $products->image_url }}">
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <a class="btn btn-secondary" href="{{ route('admin.products.index') }}" role="button">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
