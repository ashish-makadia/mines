@extends('layout.app')
@section('content')
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <a class="btn btn-primary btn-sm" href="{{ route('user.create') }}">
                            Add User
                        </a>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">User List</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-outline card-primary">
                            <div class="card-body">
                                <table id="roles-datatable" class="table table-striped w-100">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Role</th>
                                            <th>Email</th>
                                            <th>Added</th>
                                            <th>#</th>

                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('scripts')
    <script>
        var oTable;
        $(document).ready(function() {

            oTable = $('#roles-datatable').DataTable({
                scrollX: true,
                processing: true,
                serverSide: true,
                responsive: true,
                pagingType: "full_numbers",
                ajax: {
                    url: "{{ route("{$module_route}.index") }}",
                    data: function(d) {}
                },
                columns: [{
                        data: 'DT_RowIndex',
                        className: 'text-center',
                        searchable: false,
                        orderable: false,
                        width: 20
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: null,
                        name: null,
                        render: function(o) {

                            return o?.role?.name;


                        }
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },

                    {
                        data: 'created_at',
                        name: 'created_at',
                        render: function(o) {
                            return moment(o).format("DD-MM-YYYY");
                        }
                    },
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        responsivePriority: 1,
                        targets: 0,
                        className: "text-center",
                        render: function(o) {
                            var url = '{{ route("{$module_route}.edit", ':id') }}';
                            url = url.replace(':id', o.id);
                            var element = '<div class="btn-group">';
                            var element =
                                `<a title="Edit" class="btn btn-info btn-sm" href="${url}" > <i class="fa fa-edit"></i></a>&nbsp;<a class="btn btn-danger btn-sm" title="Delete" onclick="deleteUser(${o.id})"> <i class="fas fa-trash-alt"></i></a>`;
                            element += '</div>';
                            return element;
                        }
                    },

                ]
            });




        });
        function deleteUser(id) {
            console.log(id);
                // var url = '{{ route("{$module_route}.destroy", ':user') }}';
                // url = url.replace(':user', id);

                let deleteUrl = "{{ route('user.destroy', ':user') }}";
        deleteUrl = deleteUrl.replace(":user", id);

                if (confirm("Are you sure to delete this record?")) {
                    $.ajax({
                        url: deleteUrl,
                        type: 'DELETE',
                        dataType: 'json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                            if (data.message) {
                                toastr.success(data.message);
                            }
                            if (data.error) {
                                toastr.error(data.error);
                            }
                            oTable.draw();
                            // location.reload();
                        }

                    });
                }

            }
    </script>
@endpush
