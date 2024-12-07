@extends('layout.app')

@section('content')

@php


use Carbon\Carbon;
@endphp

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <a href="{{route('add-mine-managment')}}" class="btn btn-primary btn-sm">Add New Mine</a>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item">Mines</li>
                        <li class="breadcrumb-item active">Mines List</li>

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
                            <table id="example" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th> Sr No.</th>
                                        <th> Mine Name</th>
                                        <th>Mine Contact</th>
                                        <th>Mine Email</th>
                                        <th>State</th>
                                        <th>City/Village</th>
                                        
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                   
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>

            </div>
        </div>
    </section>

<div class="modal" id="response">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">View Mine</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <tr>
                        <td><strong> Mine Name:</strong><span id="mine_name"></span></td>
                        <td><strong> Mine Contact:</strong><span id="mine_contact"></span></td>
                    </tr>
                    <tr>
                        <td><strong>Mine Email:</strong><span id="mine_email"></span></td>
                        <td><strong>State:</strong> <span id="state_id"></span></td>
                    </tr>
                    <tr>
                        <td><strong>City/Village:</strong><span id="city_id"></span></td>
                        <td><strong>Gps Location:</strong><span id="gps_location"></span></td>
                    </tr>
                    <tr>
                        <td><strong>Address:</strong><span id="address"></span></td>
                        <td><strong>Mine Purchase Date:</strong><span id="mine_purchase_date"></span></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
</div>



@endsection




<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type="text/javascript">
    $(function() {

        var oTable = $('#example').DataTable({
            processing: true,
            serverSide: true,
            bFilter: true,
            bInfo: true,
            paging: true,
          
            ajax: "{{ route('list-mine-managment') }}",
            columns: [{
                    "data": 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },

                {
                    data: 'mine_name',
                    name: 'mine_name'
                },

                {
                    data: 'mine_contact',
                    name: 'mine_contact'
                },

                {
                    data: 'mine_email',
                    name: 'mine_email'
                },
                {
                    data: 'state_id',
                    name: 'state_id'
                },
                {
                    data: 'city_id',
                    name: 'city_id'
                },

              
                
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });
        $('#example').on('click', '.btn-primary', function () {
                var row = oTable.row($(this).closest('tr')).data();
                populateViewModal(row);
            });

            function populateViewModal(data) {
                $('#mine_name').text(data.mine_name);
                $('#mine_contact').text(data.mine_contact);
                $('#mine_email').text(data.mine_email);
         
                
                $('#state_id').text(data.state_id);
                $('#city_id').text(data.city_id);
                $('#gps_location').text(data.gps_location);
                $('#address').text(data.address);
                $('#mine_purchase_date').text(data.mine_purchase_date);      
            }

    });
</script>