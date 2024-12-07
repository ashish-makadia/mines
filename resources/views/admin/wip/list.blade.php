@extends('layout.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <a class="btn btn-primary btn-sm" href="{{route('wip.index')}}">Add WIP
                        </a>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active">Sell Register</li>
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
                        <div class="card">
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Sr no.</th>
                                            <th>W/P no.</th>

                                            <th>Target</th>
                                            <th>Start Date</th>
                                            <th>No of Days</th>
                                            <th>Incharge</th>
                                            <th>Total Block</th>
                                            <th>Status</th>
                                            <th>Action</th>
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

        </section>
    </div>


@endsection
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}
@section('other-scripts')

    <script type="text/javascript">
        var oTable;
        $(function() {
            oTable = $('#example1').DataTable({
                processing: true,
                serverSide: true,
                bFilter: true,
                searchable: true,
                bInfo: true,
                paging: true,
                ajax: "{{ route('wip.list') }}",
                method: 'get',
                columns: [{
                        "data": 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'wp_no',
                        name: 'wp_no',
                    },
                    {
                        data: 'target',
                        name: 'target'
                    },
                    {
                        data: 'start_date',
                        name: 'start_date'
                    },
                    {
                        data: 'no_of_pieces',
                        name: 'no_of_pieces'
                    },

                    {
                        data: null,
                        name: null,
                        render: (row, index) => {
                            return row.incharge_id>0?row.incharge?.name:""
                        }
                    },
                    {
                        data: 'total_pieces',
                        name: 'total_pieces'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: null,
                        name: null,
                        orderable: false,
                        searchable: false,
                        render: (row, index) => {
                            let deleteUrl = "{{ route('sell-register.destroy', ':sell_register') }}";
                            deleteUrl = deleteUrl.replace(":sell_register", row.id);
                            let editUrl = "{{ route('wip.edit', ':wip') }}";
                            editUrl = editUrl.replace(":wip", row.id);
                            var url = "{{ route('wip.update-stock-of-finish-good', 'wip_id') }}";
                        url = url.replace("wip_id", row.id);

                            return `<div class="d-flex action-btn-div">
                                <a href="${editUrl}" class="btn btn-info btn-sm" > <i class="fas fa-pencil-alt"></i></a>&nbsp;
                                <a href="${url}" class="btn btn-primary btn-sm" > <i class="fas fa-eye"></i></a>&nbsp;
                                <a href="javascript:void(0);" onclick="deleteSellRegister(${row.id})" class="btn btn-danger btn-sm" > <i class="fas fa-trash-alt"></i></a>
                            </div>`;
                        }
                    },
                ]
            });
        });

        function deleteSellRegister(id) {
            let deleteUrl = "{{ route('sell-register.destroy', ':sell_register') }}";
            deleteUrl = deleteUrl.replace(":sell_register", id);
            console.log("deleteUrl:: ", deleteUrl);
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
@endsection
