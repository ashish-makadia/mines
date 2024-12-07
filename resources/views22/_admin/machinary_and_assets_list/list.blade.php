@extends('layout.app')

@section('content')




<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <a href="{{route('mine-machinary-assets-add-managment')}}" class="btn btn-primary btn-sm">Add Machinery / Assets</a>

                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">Mines</li>
                        <li class="breadcrumb-item active">Machinery / Assets List</li>
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
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Sr No.</th>
                                        <th> Owner Name</th>
                                        <th>Assets Category</th>
                                        <th>Machine Name</th>
                                        <th>Machine Quantity</th>
                                        <th>Date Of Purchased</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <!-- <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>pooja jani</td>
                                        <td>Trucks</td>
                                        <td>Machine 1</td>
                                        <td>Machine 15,Machine 25</td>
                                        <td>06/16/2022</td>
                                        <td>
                                            <a class="btn btn-primary btn-sm" href="#" data-toggle="modal" data-target="#response" title="View">
                                                <i class="fas fa-eye">
                                                </i>
                                            </a>
                                            <a class="btn btn-info btn-sm" href="machineryedit.html" title="Edit">
                                                <i class="fas fa-pencil-alt">
                                                </i>
                                            </a>

                                            <a class="btn btn-danger btn-sm" href="#" title="Delete">
                                                <i class="fas fa-trash">
                                                </i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>paresh patel</td>
                                        <td>Drills</td>
                                        <td>Machine 2</td>
                                        <td>Machine 19,Machine 20</td>
                                        <td>10/10/2021</td>
                                        <td>
                                            <a class="btn btn-primary btn-sm" href="#" data-toggle="modal" data-target="#response" title="View">
                                                <i class="fas fa-eye">
                                                </i>
                                            </a>
                                            <a class="btn btn-info btn-sm" href="machineryedit.html" title="Edit">
                                                <i class="fas fa-pencil-alt">
                                                </i>
                                            </a>

                                            <a class="btn btn-danger btn-sm" href="#" title="Delete">
                                                <i class="fas fa-trash">
                                                </i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>ramesh kumar</td>
                                        <td>Crushers</td>
                                        <td>Machine 3</td>
                                        <td>Machine 18,Machine 22</td>
                                        <td>08/08/2019</td>
                                        <td>
                                            <a class="btn btn-primary btn-sm" href="#" data-toggle="modal" data-target="#response" title="View">
                                                <i class="fas fa-eye">
                                                </i>
                                            </a>
                                            <a class="btn btn-info btn-sm" href="machineryedit.html" title="Edit">
                                                <i class="fas fa-pencil-alt">
                                                </i>
                                            </a>

                                            <a class="btn btn-danger btn-sm" href="#" title="Delete">
                                                <i class="fas fa-trash">
                                                </i>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>suresh patel</td>
                                        <td>Loaders</td>
                                        <td>Machine 4</td>
                                        <td>Machine 11,Machine 28</td>
                                        <td>03/02/2018</td>
                                        <td>
                                            <a class="btn btn-primary btn-sm" href="#" data-toggle="modal" data-target="#response" title="View">
                                                <i class="fas fa-eye">
                                                </i>
                                            </a>
                                            <a class="btn btn-info btn-sm" href="machineryedit.html" title="Edit">
                                                <i class="fas fa-pencil-alt">
                                                </i>
                                            </a>

                                            <a class="btn btn-danger btn-sm" href="#" title="Delete">
                                                <i class="fas fa-trash">
                                                </i>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody> -->
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>

            </div>
        </div>
    </section>
</div>
<div class="modal" id="response">
  <div id="viewdata"></div>
</div>











@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type="text/javascript">
    $(function() {

        var oTable = $('#example1').DataTable({
            processing: true,
            serverSide: true,
            bFilter: true,
            bInfo: true,
            paging: true,

            ajax: "{{ route('mine-machinary-assets-list-managment') }}",
            columns: [{
                    "data": 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },

                {
                    data: 'owner_name',
                    name: 'owner_name'
                },
                {
                    data: 'asset_category_id',
                    name: 'asset_category_id'
                },

                {
                    data: 'machine_name',
                    name: 'machine_name'
                },

                {
                    data: 'machine_qty',
                    name: 'machine_qty'
                },
                {
                    data: 'date_of_purchase',
                    name: 'date_of_purchase'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });
    });

    function viewdata(id) {
        $.ajax({
            url: "{{route('mine-machinary-assets-view-managment')}}",
            type: 'get',
            dataType: 'json',
            data: {
                id: id
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                $("#viewdata").html(data);
                $('#response').modal('show');
            },
        });
    }
</script>
