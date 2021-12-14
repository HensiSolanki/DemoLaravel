@extends('admin.layouts.app')
@section('mytitle', 'Add Products')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2>Add Product</h2>
                </div>
                <div class="card-body">
                    <form novalidate action="{{ route('admin.products.store') }}" method="POST" id="form" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group row mb-3">
                                    <label for="name"><b>Name:</b></label>
                                    <input type="text" name="product_name" id="product_name" class="form-control @error('product_name') is-invalid @enderror" value="{{ old('product_name') }}" placeholder="Name">
                                    @error('product_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group row mb-3">
                                    <label for="select"><b>Select User:</b></label>
                                    <select name="user_id" class="form-select @error('user_id') is-invalid @enderror" aria-label="Default select example">
                                        <option value="">Select User</option>
                                        @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->username }}</option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group row mb-3">
                                    <label for="Details"><b>Discription:</b></label>
                                    <textarea name="detail" class="form-control @error('detail') is-invalid @enderror" style="height:150px" placeholder="Detail">{{ old('detail') }}</textarea>
                                    @error('detail')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group row mb-3">
                                    <label for="Image"><b>Image:</b></label>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror" value="{{ old('image') }}" name='image'>
                                    @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <a class="btn btn-secondary" href="{{ route('admin.products.index') }}" role="button">Back</a>
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</form>
@endsection
@push('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $('#form').validate({
            rules: {
                product_name: {
                    minlength: 6,
                    maxlength: 50,
                    required: true,
                    remote: {
                        url: "{!! route('admin.validate') !!}",
                        type: "GET",
                    },
                },
                user_id: {
                    required: true,
                },
                detail: {
                    required: true,
                },
                image: {
                    required: true,
                }
            },
            messages: {
                product_name: {
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
