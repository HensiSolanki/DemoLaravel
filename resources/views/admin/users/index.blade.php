@extends('admin.layouts.app')
@section('mytitle', 'Users Index')
@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center">Users</h1>
            <div class="card">
                {{-- <div class="card-header">
                        <a class="btn btn-success float-end btn-lg" href="{{ route('products.create') }}"> Create New Product</a>
            </div> --}}
            {{-- @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
        </div>
        @endif --}}
        <div class="card-body">
            <table class="table table-bordered table-striped project-datatable" id="user_table" name="products">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>User Name</th>
                        <th>Email</th>
                        <th>Image</th>
                        <th width='204px'>action</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
    $('#user_table').DataTable({

        ajax: "{!! route('admin.userIndex') !!}",
        columns: [{
                data: 'id',
                name: 'id'
            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'username',
                name: 'username'
            },
            {
                data: 'email',
                name: 'email'
            },
            {
                data: 'image_thumb_url',
                name: 'image',
                'bSortable': false,
                'aTargets': [-1],
                'render': function(data, type, row) {
                    return `<img style="width:130px; height:100px;" src="${data}" />`;
                }
            },
            {
                data: null,
                render: function(data, type, row) {
                    return (
                        `<a href="{{ url('admin/users/view/${data.id}') }}" class='btn btn-primary btn-sm' style="margin-right:5px"><i class='fa fa-eye'></i></a><a href='javascript:void(0);' id="${data.id}" class='remove btn btn-danger btn-sm'><i class='fa fa-trash'></i></a>`
                    );
                },
                searchable: false,
                orderable: false,
            }
        ]
    });
    $(document).on('click', '.remove', function() {
        var id = $(this).attr('id');
        var token = $("meta[name='csrf-token']").attr("content");
        Swal.fire({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this file!",
            icon: "warning",
            html: true,
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, Remove!",
            showLoaderOnConfirm: true,
            preConfirm: function() {
                return new Promise(function(resolve, reject) {
                    setTimeout(function() {
                        $.ajax({
                            url: "{{ url('/admin/users/delete') }}" + "/" + id,
                            type: 'DELETE',
                            data: {
                                "id": id,
                                "_token": token,
                            },
                            success: function(data) {
                                Swal.fire("Success! User has been deleted!", {
                                    icon: "success",
                                });
                                $('#user_table').DataTable().ajax.reload(null, true);
                            }
                        });
                    }, 0);
                });
            },
        });
    });
</script>

@endpush
