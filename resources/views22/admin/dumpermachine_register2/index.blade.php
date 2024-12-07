
@extends('layout.app')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <a class="btn btn-primary btn-sm" href="#" data-toggle="modal" data-target="#response1">
                      Add  New Working Asset
                    </a>

                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">Daily Register</li>
                        <li class="breadcrumb-item active"> Dumper & M/C Working Register List</li>
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
                                        
                                        <th>Sr No</th>
                                        <th>Date</th>
                                        <th>Working Asset</th>
                                        <th>Start</th>
                                        <th>Off</th>
                                        <th>Time</th>
                                        <th>Diesel</th>
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
<div class="modal" id="response1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add New Dumper & Machine Asset</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('dumpermachine-register.store')}}" method="post" id="addform">
                 @csrf   <div class="d-flex w-100 justify-content-between row">
                    
                    <div class="form-group mb-3 col-md-6 col-12">
                        <label> Date</label>
                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" name="dm_date"   data-target="#reservationdate" placeholder="Select Date" />
                            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                


                    <div class="col-md-6 col-6  mb-3">
                        <div class="form-group">
                            <label>Working Assets</label>
                            <select name="asset_id" id="asset_id" class="form-control select2 a3">
                             <option value="">Select Assets Type</option>
                                
                                @foreach($ac as $i)
                                        <option value="{{$i->id}}">{{$i->category_name}}</option>
                                    @endforeach 
                                
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 col-md-6 col-12">
                        <label for="exampleInputPassword1">Start</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span id="basic-icon-default-fullname2" class="input-group-text">
                                    <i class="fa fa-plus"></i>
                                </span>
                            </div>
                            <input type="number" name="start" class="form-control" placeholder="Enter Start Value">
                        </div>
                    </div>

                    <div class="mb-3 col-md-6 col-12">
                        <label for="exampleInputPassword1">Off</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span id="basic-icon-default-fullname2" class="input-group-text">
                                    <i class="fa fa-plus"></i>
                                </span>
                            </div>
                            <input type="number" name="off" class="form-control" placeholder="Enter Off Value">
                        </div>
                    </div>

                    <div class="mb-3 col-md-6 col-12">
                        <label for="exampleInputPassword1">Time</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span id="basic-icon-default-fullname2" class="input-group-text">
                                    <i class="fa fa-plus"></i>
                                </span>
                            </div>
                            <input type="number" name="time" class="form-control" placeholder="Enter Time">
                        </div>
                    </div>

                    <div class="mb-3 col-md-6 col-12">
                        <label for="exampleInputPassword1">Diesel</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span id="basic-icon-default-fullname2" class="input-group-text">
                                    <i class="fa fa-plus"></i>
                                </span>
                            </div>
                            <input type="number" name="diesel" class="form-control" placeholder="Enter Diesel in litre">
                        </div>
                    </div>

            

                    <div class="mb-3 col-md-12 col-12 mb-3">
                        <label class="form-label" for="basic-icon-default-message"><i class="fa fa-message"></i>Remark
                    </label>
                        <textarea id="basic-icon-default-message" name="remark" class="form-control" aria-describedby="basic-icon-default-message2" placeholder="Add Remark"></textarea>
                    </div>
                        
                     
                    </div>
                    <div class="modal-footer a18">
                        <button type="submit" class="btn btn-success btn-sm mt-3 ">Submit</button>
                        <button type="reset" class="btn btn-warning btn-sm mt-3">Reset</button>
                    </div>
                </form>

                
            </div>
        </div>
    </div>
</div>
<div class="modal" id="response">
   <div id="editdata"></div>
</div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
    $(function () {
        $.validator.setDefaults({
            submitHandler: function (form) {
                // Your AJAX code to submit the form can go here
                form.submit();
            }
        });

        $('#addform').validate({
            rules: {
                start: {
                    required: true,
                },
            
            },
            messages: {
                start: {
                    required: "Please Enter a start.",
                },
                
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
       
    });
</script>
<script type="text/javascript">
    $(function() {

        var oTable = $('#example1').DataTable({
            processing: true,
            serverSide: true,
            bFilter: true,
            searchable: true,
            bInfo: true,
            paging: true,

            ajax: "{{route('dumpermachine-register')}}",
            method: 'get',
            columns: [{
                    "data": 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                
                {
                    data: 'dm_date',
                    name: 'dm_date'
                },
                {
                    data: 'asset_id',
                    name: 'asset_id'
                },
                {
                    data: 'start',
                    name: 'start'
                },
                {
                    data: 'off',
                    name: 'off'
                },
                {
                    data: 'time',
                    name: 'time'
                },
                {
                    data: 'diesel',
                    name: 'diesel'
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

    function editfunc(id) {
        
        $.ajax({
            url: "{{route('dumpermachine-register.edit')}}",
            type: 'get',
            dataType: 'json',
            data: {
                id: id
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            success: function(data) {
                $("#editdata").html(data);
                $('#response').modal('show');
                $('.select').select2({ theme: 'bootstrap4'});
                $('#reservationdate1').datetimepicker({
                format: 'DD-MM-YYYY',
              });
            }

        });
    }
</script>


