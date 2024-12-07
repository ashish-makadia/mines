@extends('layout.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">

                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active">Master</li>
                            <li class="breadcrumb-item active">Assets Stock</li>
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
                                            <th>Sr No.</th>
                                            <th>Working assets </th>
                                            <th>item_name</th>
                                            <th>Volume</th>
                                            <th>Quantity</th>
                                            <th>Re Order Quantity</th>
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
@section("other-scripts")
<script type="text/javascript">
    $(function() {
        var oTable = $('#example1').DataTable({
            processing: true,
            serverSide: true,
            bFilter: true,
            searchable: true,
            bInfo: true,
            paging: true,

            ajax: "{{ route('assets-stock') }}",
            method: 'get',
            columns: [{
                    "data": 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },

                {
                    data: null,
                    name: null,
                    render: (row, index) => {

                        return row.working_assets ? row.working_assets.category_name : "";
                    }
                },
                {
                    data: 'item_name',
                    name: 'item_name'
                },
                {
                    data: 'volume',
                    name: 'volume',
                    render: (row, index) => {
                        return `-`;
                        }

                },
                {
                    data: 'total_purchase_quantity',
                    name: 'total_purchase_quantity'
                },
                {
                    data: 'remaining_quantity',
                    name: 'remaining_quantity',
                    render: (row, index) => {
                        return `<span class="${row>0?'text-success':'text-danger'}">${row}</span>`;
                        }
                },
                {
                    data: null,
                    name: null,
                    orderable: false,
                    searchable: false,
                    render: (row, index) => {

                        return "";
                    }
                },
            ]
        });
    });
</script>
@endsection

