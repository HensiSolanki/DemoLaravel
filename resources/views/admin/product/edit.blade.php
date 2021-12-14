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
                    <form action="{{ route('admin.products.update',$products->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group row mb-3">
                                    <label for="name"><b>Name:</b></label>
                                    <input type="text" name="name" value="{!! old('name', $products->product_name) !!}" class="form-control @error('name') is-invalid @enderror" placeholder="Name">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group row mb-3">
                                    <label for="name"><b>User Name:</b></label>
                                    <input type="text" name="name" value={{ $products->username }} class="form-control" disabled>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
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
        $('#form').validate({
            rules: {
                name: {
                    minlength: 6,
                    maxlength: 50,
                    required: true,
                    remote: {
                        url: "{!! route('admin.validateProduct') !!}",
                        type: "GET",
                    },
                    data: {
                        product_name: $('#name').val(),
                    },
                },
                detail: {
                    required: true,
                },
            },
            messages: {
                name: {
                    remote: "Product Name already taken"
                }
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
