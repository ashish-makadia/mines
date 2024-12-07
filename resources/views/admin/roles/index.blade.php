@extends('layout.app')
@section('content')
    <div class="content-wrapper">

            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <a class="btn btn-primary btn-sm" href="{{ route('roles.create') }}">
                                Add Role
                            </a>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active">Role List</li>
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
                                                <th>Role</th>
                                                {{-- <th>Display Name</th>
                                                <th>Description</th> --}}
                                                <th>Added</th>
                                                <th>#</th>
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
                <script type="module">
                    $(document).ready(function() {

                        var oTable = $('#roles-datatable').DataTable({
                            scrollX: true,
                            processing: true,
                            serverSide: true,
                            responsive: true,
                            pagingType: "full_numbers",
                            ajax: {
                                url: "{{ route("{$module_route}.get-data-table") }}",
                                data: function(d) {}
                            },
                            columns: [{
                                    data: 'id',
                                    searchable: false,
                                    width: 20
                                },
                                {
                                    data: 'name',
                                    name: 'name'
                                },
                                // {
                                //     data: 'display_name',
                                //     name: 'display_name'
                                // },
                                // {
                                //     data: 'description',
                                //     name: 'description'
                                // },
                                {
                                    data: 'created_at',
                                    name: 'created_at'
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
                                            `<a title="Edit" href="${url}" > <i class="fa fa-edit"></i></a>`;
                                        element += '</div>';
                                        return element;
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
                                        var element = '<div class="btn-group">';
                                        var element = '<a title="Delete" onclick="deleteRole(' + o.id +
                                            ')"> <i class="fa-solid fa-trash-can"></i></a>';
                                        element += '</div>';
                                        return element;
                                    }
                                }
                            ]
                        });

                        window.deleteRole = (roleId) => {
                            var url = '{{ route("{$module_route}.destroy", ':id') }}';
                            url = url.replace(':id', roleId);
                            deleteRecordByAjax(url, "{{ $module_name }}", oTable);
                        }

                    });
                </script>
            @endpush
