@extends('layouts.app')
@section('mytitle', 'Product List')
@section('content')

    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center">Product Application</h3>
                <div class="card">
                    <div class="card-header">
                        <a class="btn btn-success float-end btn-lg" href="{{ route('products.create') }}"> Add Product</a>
                    </div>
                    {{-- @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif --}}
                    <div class="card-body">
                        <table class="table table-bordered table-striped project-datatable" id="productt_table" name="products">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Name</th>
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
        </div>
    </div>
@endsection
@push('scripts')

    <script type="text/javascript">

            $('#productt_table').DataTable({

                ajax: "{!! route('products.index') !!}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                     {
                        data: 'product_name',
                        name: 'product_name'
                    },
                    {
                        data: 'description',
                        name: 'description'
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
                            `<a href="{{ url('products/${data.id}/edit') }}" class='btn btn-primary btn-sm' style="margin-right:5px"><i class='fa fa-eye'></i></a><a href="{{ url('products/${data.id}/edit') }}" class='btn btn-success btn-sm' style="margin-right:5px"><i class='fa fa-edit'></i></a><a href='javascript:void(0);' id="${data.id}" class='remove btn btn-danger btn-sm ml-3'><i class='fa fa-trash'></i></a>`

                            );
                        },
                        searchable:false,
                        orderable:false,
                    }
                ]
            });
             $(document).on('click', '.remove', function(e){
                  e.preventDefault();
                 var id = $(this).attr('id');
                 var token = $("meta[name='csrf-token']").attr("content");
                 swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this file!",
                    icon: "warning",
                    buttons:  ["No,Thanks!", "Yes, Remove!"],
                    dangerMode: true,
                })
                .then((willDelete) => {
                 if (willDelete) {
                    $.ajax({
                            url: "{{ url('/products') }}" + "/" + id,
                            type: 'DELETE',
                            data:{
                                "id": id,
                                "_token": token,},
                            success:function(data)
                            {
                                $('#productt_table').DataTable().ajax.reload(null,true);
                            }
                        });
                    swal("Success! User has been deleted!", {
                    icon: "success",
                    });
                } else {("Your file is safe!");}
                });
            });
       </script>

@endpush
