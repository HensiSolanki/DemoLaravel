@extends('admin.layouts.app')
@section('mytitle', 'Product List')
@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <h3 class="text-center">Product Application</h3>
            <div class="card">
                <div class="card-header">
                    <a class="btn btn-success float-end btn-sm" href="{{ route('admin.products.create') }}"> Add Product</a>
                    <a href="{{ route('admin.products.create') }}" data-bs-toggle="modal" data-bs-target="#AddProductModal" class="btn btn-success float-end btn-sm mr-2">Add Product Model</a>&nbsp;&nbsp;
                </div>
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
                @endif
                <div class="card-body">
                    <table class="table table-bordered table-striped project-datatable" id="product_table" name="products">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>User name</th>
                                <th>Product Name</th>
                                <th>description</th>
                                <th>Image</th>
                                <th width='204px'>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- #Add Model -->
        <div class="modal fade" id="AddProductModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form novalidate method="POST" id="form1" enctype="multipart/form-data">
                            <ul id="saveform_errList"></ul>

                            <div class="form-group mb-3">
                                <label for="name"><b>Name:</b></label>
                                <input type="text" name="product_name" id="product_name" class="form-control @error('product_name') is-invalid @enderror" value="{{ old('product_name') }}" placeholder="Name" data-validation="required">
                                @error('product_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="select"><b>Select User:</b></label>
                                <select name="user_id" id="user_id" class="form-select @error('user_id') is-invalid @enderror" aria-label="Default select example">
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
                            <div class="form-group mb-3">
                                <label for="Details"><b>Discription:</b></label>
                                <textarea name="detail" id="detail" class="form-control @error('detail') is-invalid @enderror" style="height:150px" placeholder="Detail">{{ old('detail') }}</textarea>
                                @error('detail')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="Image"><b>Image:</b></label>
                                <input type="file" name='image' id="image" class="form-control @error('image') is-invalid @enderror" value="{{ old('image') }}">
                                @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="submit" class="btn btn-primary add_product">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #Edit Model -->
    <div class="modal fade" id="EditProductModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul id="saveform_errList"></ul>
                    <form id="edit-product" method="POST" enctype="multipart/form-data">

                        <input type="hidden" id="id" name="id" value="">

                        <div class="form-group row mb-3">
                            <label for="product_name"><b>Name:</b></label>
                            <input type="text" name="product_name" id="product_name1" value="" class="form-control @error('product_name') is-invalid @enderror product_name">
                            <!-- @error('product_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror -->
                        </div>
                        <div class="form-group row mb-3">
                            <label for="name"><b>User Name:</b></label>
                            <input type="text" name="username" id="user_id1" value="" class="form-control" disabled>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="Details"><b>Discription:</b></label>
                            <textarea class="form-control @error('detail') is-invalid @enderror" id="detail1" style="height:150px" name="detail"></textarea>
                            <!-- @error('detail')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror -->
                        </div>
                        <div class="form-group row mb-3">
                            <label for="ProductImage"><b>Product Image:</b></label>
                            <img id="file1" src="" style="width:30%; height: 185px;border-radius: 10px; background-color: white; box-shadow: 0 4px 8px 0 rgb(0 0 0 / 60%), 0 6px 20px 0 rgb(0 0 0 / 60%);
    margin: 10px;">
                        </div>
                        <div class="form-group row mb-3">
                            <label for="Image"><b>New Image:</b></label>
                            <input type="file" name="image" class="form-control  @error('image') is-invalid @enderror">

                            <!-- @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror -->
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary update_product">Edit</button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<!-- #Show Model -->
<div class="modal fade" id="ShowProductModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Product Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul id="saveform_errList"></ul>
                <input type="hidden" id="id" name="id" value="">

                <div class="form-group row mb-3">
                    <label for="product_name"><b>Name:</b></label>
                    <p name="product_name" id="product_name2" value=""></p>

                </div>
                <div class="form-group row mb-3">
                    <label for="name"><b>User Name:</b></label>
                    <p name="username" id="user_id2" value=""></p>
                </div>
                <div class="form-group row mb-3">
                    <label for="Details"><b>Discription:</b></label>
                    <p id="detail2" name="detail"></p>

                </div>
                <div class="form-group row mb-3">
                    <label for="ProductImage"><b>Product Image:</b></label>
                    <img id="file2" src="" style="width:30%; height: 185px;border-radius: 10px; background-color: white; box-shadow: 0 4px 8px 0 rgb(0 0 0 / 60%), 0 6px 20px 0 rgb(0 0 0 / 60%);
    margin: 10px;">
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</div>

</div>

</div>
@endsection
@push('scripts')
<script>
    // Jquery Validation for Registration Form
    $(document).ready(function() {
        $('#form').validate({
            rules: {
                name: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                number: {
                    required: true,
                    digits: true

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

    // Datatable
    $('#product_table').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        ajax: "{!! route('admin.products.index') !!}",
        columns: [{
                data: 'id',
                name: 'id'
            },
            {
                data: 'username',
                name: 'users.username'
            },
            {
                data: 'product_name',
                name: 'product_name'
            },
            {
                data: null,
                render: function(data, type, row, meta) {
                    // return (`<textarea disabled style="resize: none;height: 200px; width: 450px;">` + data.description +
                    //     `</textarea >`)
                    return (` <pre style="white-space: pre-wrap; text-overflow: ellipsis;"> ` + data.description +
                        ` </pre>`);
                }
            },

            {
                data: 'image_thumb_url',
                name: 'image',
                'bSortable': false,
                'aTargets': [-1],
                'render': function(data, type, row) {
                    return `<img src="${data}" />`;
                }
            },
            {
                data: null,
                render: function(data, type, row) {
                    return (
                        `<a href="{{ url('/admin/products/${data.id}') }}" class='btn btn-primary btn-sm mr-2'><i class='fa fa-eye'></i></a><a href="{{ url('/admin/products/${data.id}/edit') }}" class='btn btn-success btn-sm mr-2'><i class='fa fa-edit'></i></a><a href='javascript:void(0);' id="${data.id}" class='remove btn btn-danger btn-sm'><i class='fa fa-trash'></i></a>
                        <a href="{{ url('/admin/products/${data.id}') }}" id="${data.id}" data-bs-toggle="modal" data-bs-target="#ShowProductModal" class='btn btn-primary btn-sm mr-2 mt-2 show_product'><i class='fa fa-eye'>Show Model</i></a><a href="{{ url('/admin/products/${data.id}/edit') }}" id="${data.id}" data-bs-toggle="modal" data-bs-target="#EditProductModal" class='btn btn-success btn-sm mr-2 mt-2 edit_product'><i class='fa fa-edit'>Edit Model</i></a>`
                    );
                },
                searchable: false,
                orderable: false,
            },
        ],

    });

    // Jquery Validation for Add Model
    $(document).ready(function() {
        $('#form1').validate({
            rules: {
                product_name: {
                    minlength: 5,
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
                },
                image: {
                    required: "Please Select Image",
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

    // Add Model
    $(document).ready(function(e) {
        $("#submit").on('click', (function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            let formData = new FormData(document.getElementById("form1"));
            $.ajax({
                url: `{{ route('admin.products.store') }}`,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.status == 400) {
                        console.log("response", response.errors);
                        $('#saveform_errList').html("");
                        $('#saveform_errList').addClass("alert alert-danger");
                        $.each(response.errors, function(key, err_value) {
                            console.log(err_value);
                            $('#saveform_errList').append('<li>' + err_value +
                                '</li>');
                        });
                    } else {
                        $('#saveForm_errList').html("");
                        $('#success_message').addClass('alert alert-success')
                        $('#success_message').text(response.messages);
                        $('#AddProductModal').modal('hide')
                        $('#AddProductModal').find('input').val("");
                        $('.yajra-datatable').DataTable().ajax.reload();
                    }
                },
                error: function(data) {
                    console.log('Error:', data);

                }
            });
        }));
    });

    // Show Model
    $(document).on("click", ".show_product", function(e) {

        e.preventDefault()
        console.log("Show model");
        var id = $(this).attr('id');
        var url = `{{ url('/admin/products/${id}') }}`

        console.log(id);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "GET",
            url: `{{ url('/admin/products/${id}') }}`,
            dataType: "json",
            success: function(response) {
                if (response.status == 400) {
                    console.log("response", response.errors);
                    $('#saveform_errList').html("");
                    $('#saveform_errList').addClass("alert alert-danger");
                    $.each(response.errors, function(key, err_value) {
                        console.log(err_value);
                        $('#saveform_errList').append('<li>' + err_value +
                            '</li>');
                    });
                } else {
                    console.log("url::", url);
                    console.log("response::", response.products);

                    $('#product_name2').html(response.products.product_name);
                    $('#user_id2').html(response.products.username);
                    $('#detail2').html(response.products.description);
                    $('#file2').attr('src', response.products.image_thumb_url);
                    $('#id').val(id);
                }

            }
        })
    })

    // Edit Model
    $(document).on("click", ".edit_product", function(e) {
        e.preventDefault();
        var id = $(this).attr('id');
        $('#EditProductModal').modal('show');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: `{{ url('/admin/products/${id}/edit') }}`,
            type: "GET",
            processData: false,
            success: function(response) {
                if (response.status == 400) {
                    console.log("response", response.errors);
                    $('#saveform_errList').html("");
                    $('#saveform_errList').addClass("alert alert-danger");
                    $.each(response.errors, function(key, err_value) {
                        console.log(err_value);
                        $('#saveform_errList').append('<li>' + err_value +
                            '</li>');
                    });
                } else {
                    console.log("response::", response.products);
                    $('#product_name1').val(response.products.product_name);
                    $('#user_id1').val(response.products.username);
                    $('#detail1').val(response.products.description);
                    $('#file1').attr('src', response.products.image_thumb_url);
                    $('#id').val(id);
                }
            },
            error: function(data) {
                console.log('Error:', data);

            }
        });

    })

    // Update Model
    $(document).on("click", ".update_product", function(e) {
        e.preventDefault();
        var id = $(this).attr('id');
        $('#EditProductModal').modal('show');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let formData = new FormData(document.getElementById("edit-product"));
        $.ajax({
            url: `{{ url('/admin/products/${id}/update') }}`,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.status == 400) {
                    console.log("response", response.errors);
                    $('#saveform_errList').html("");
                    $('#saveform_errList').addClass("alert alert-danger");
                    $.each(response.errors, function(key, err_value) {
                        console.log(err_value);
                        $('#saveform_errList').append('<li>' + err_value +
                            '</li>');
                    });
                } else {
                    $('#saveForm_errList').html("");
                    $('#success_message').addClass('alert alert-success')
                    $('#success_message').text(response.messages);
                    $('#AddProductModal').modal('hide')
                    $('#AddProductModal').find('input').val("");
                    $('.yajra-datatable').DataTable().ajax.reload();
                }
            },
            error: function(data) {
                console.log('Error:', data);

            }
        });

    })

    // Delete Model
    $(document).on('click', '.remove', function(e) {
        e.preventDefault();

        var id = $(this).attr('id');
        console.log('id::', id);
        var token = $("meta[name='csrf-token']").attr("content");
        Swal.fire({
            title: 'Are you sure?',
            text: 'Once deleted, you will not be able to recover this file!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, Remove!",
            showLoaderOnConfirm: true,
            preConfirm: function() {
                return new Promise(function(resolve, reject) {
                    setTimeout(function() {
                        $.ajax({
                            url: "{{ url('/admin/products') }}" + "/" + id,
                            type: 'DELETE',
                            data: {
                                "id": id,
                                "_token": token,
                            },
                            success: function(data) {
                                Swal.fire("Success! Product has been deleted!", {
                                    icon: "success",
                                });
                                $('#product_table').DataTable().ajax.reload(null, true);
                            }
                        });
                    }, 0);
                });
            },
        });
    });
</script>

@endpush
