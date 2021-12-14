@extends('admin.layouts.app')
@section('mytitle', 'Edit Products')
@section('content')
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2>Edit Product</h2>
                </div>
                <div class="card-body">
                    <form id="edit-product" action="{{ route('admin.products.update',$products->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="id" name="id" value="{{$products->id}}">

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group row mb-3">
                                    <label for="product_name"><b>Name:</b></label>
                                    <input type="text" name="product_name" value="{!! old('product_name', $products->product_name) !!}" class="form-control @error('product_name') is-invalid @enderror" placeholder="Name">
                                    @error('product_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group row mb-3">
                                    <label for="name"><b>User Name:</b></label>
                                    <input type="text" name="username" value="{{ $products->username }}" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group row mb-3">
                                    <label for="Details"><b>Discription:</b></label>
                                    <textarea class="form-control @error('detail') is-invalid @enderror" style="height:150px" name="detail" placeholder="Detail">{!! old('detail', $products->description) !!}</textarea>
                                    @error('detail')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="ProductImage"><b>Product Image:</b></label>
                                    <img src="{{ $products->image_url }}">
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="Image"><b>New Image:</b></label>
                                    <input type="file" name="image" class="form-control  @error('image') is-invalid @enderror">

                                    @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <a class="btn btn-secondary" href="{{ route('admin.products.index') }}" role="button">Back</a>
                                <button type="submit" class="btn btn-primary">Edit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $('#edit-product').validate({
            rules: {
                product_name: {
                    minlength: 6,
                    maxlength: 50,
                    required: true,
                    remote: {
                        url: "{!! route('admin.validateProduct') !!}",
                        type: "GET",
                        data: {
                            id: function() {
                                return $('#id').val();
                            }
                        },
                    },
                },
                detail: {
                    required: true,
                },
            },
            messages: {
                product_name: {
                    required: "Product name is required",
                    remote: "Product Name already taken"
                },
                detail: {
                    required: "Please Enter Product Details",
                },
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>
@endpush
