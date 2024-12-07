@extends('layout.app')
@section('title', $module_name)
@section('content')
    @push('styles')
    @endpush
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <a href="{{route('permission.create')}}" class="btn btn-primary btn-sm">Add Permission</a>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item">Permission</li>
                            <li class="breadcrumb-item active">Permission List</li>

                        </ol>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <table id="permission-datatable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Display Name</th>
                            <th>Description</th>
                            <th>Added</th>
                            <th>#</th>
                            <th>#</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </section>

    </div>
@endsection
@push('scripts')
    <script type="module">
        $(document).ready(function() {

            var oTable = $('#permission-datatable').DataTable({
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
                    {
                        data: 'display_name',
                        name: 'display_name'
                    },
                    {
                        data: 'description',
                        name: 'description'
                    },
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
                            var element =
                                `<a href="${url}" title="Edit"> <i class="fa fa-edit"></i></a>`;
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
                            var element = '<a title="Delete" onclick="deletePermission(' +
                                o.id + ')">  <i class="fa-solid fa-trash-can"></i></a>';
                            return element;
                        }
                    }
                ]
            });

            window.deletePermission = (permissionId) => {
                var url = '{{ route("{$module_route}.destroy", ':id') }}';
                url = url.replace(':id', permissionId);
                deleteRecordByAjax(url, "{{ $module_name }}", oTable);
            }
        });

    </script>
@endpush
