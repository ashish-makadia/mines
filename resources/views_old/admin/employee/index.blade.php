
@extends('layout.app')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <a class="btn btn-primary btn-sm" href="#" data-toggle="modal" data-target="#response1">
                      Add  Employee
                    </a>

                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">Employee</li>
                        <li class="breadcrumb-item active"> Employee  List</li>
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
                                        <th>Employee Name</th>
                                        <th>Employee Number</th>
                                        <th>Department</th>
                                        <th>Designation</th>

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
                <h4 class="modal-title">Add New Employee</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('employee.store')}}" method="post" id="addform">
                 @csrf   <div class="d-flex w-100 justify-content-between row">
                    
                    <div class="mb-3 col-md-12 col-12">
                        <label class="form-group" for="basic-icon-default-fullname">
                            Employee Name
                       </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span id="name" class="input-group-text">
                                  <i class="fa fa-user" aria-hidden="true"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" id="name" name="name" aria-describedby="basic-icon-default-fullname2" placeholder="Employee Name" />
                        </div>
                    </div>

                    <div class="mb-3 col-md-6 col-12">
                        <label class="form-label">
                            Mobile Number
                       </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span id="number" class="input-group-text">
                                  <i class="fab fa-whatsapp" aria-hidden="true"></i>
                                </span>
                            </div>
                            <input type="number" class="form-control" id="number" name="number" aria-describedby="basic-icon-default-fullname2" placeholder="Employee Number" />
                        </div>
                    </div>


                    <div class="mb-3 col-md-6 col-12">
                        <label class="form-label" for="basic-icon-default-fullname">
                            Email Id
                       </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span id="email" class="input-group-text">
                                  <i class="fa fa-envelope" aria-hidden="true"></i>
                                </span>
                            </div>
                            <input type="email" class="form-control" id="email" name="email" aria-describedby="basic-icon-default-fullname2" placeholder="Employee Email" />
                        </div>
                    </div>

                    

                    <div class="col-md-6 col-12 mb-3">
                        <div class="form-group">
                            <span class="text-red">*</span>    <label>Department</label>
                            <select name="depart_id" id="depart_id" class="form-control select2 a3">
                                <option value="">Select Department</option>
                                
                                @foreach($depar as $i)
                                        <option value="{{ $i->id }}">{{ $i->department}}</option>
                                    @endforeach
                            </select>
                           
                        </div>
                    </div>    
                    <div class="col-md-6 col-12 mb-3">
                        <div class="form-group">
                            <span class="text-red">*</span>    <label>Designation</label>
                            <select name="designation_id" id="designation_id" class="form-control select2 a3">
                                <option value="">Select Designation</option>
                                
                                @foreach($desig as $des)
                                        <option value="{{$des->id}}">{{$des->designation}}</option>
                                    @endforeach
                            </select>
                           
                        </div>
                    </div>  

                  
                    
                    
                    <div class="mb-3 col-md-6 col-12">
                        <label for="exampleInputPassword6">Joining Date</label>
                        <div class="input-group date reservationdate" id="reservationdate" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" name="joining_date"  data-target="#reservationdate" placeholder="Joining Date">
                            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 col-md-6 col-12">
                        <label for="exampleInputPassword6">Employee Salary</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span id="salary" class="input-group-text">
                                    <i class="fa fa-money-bill-wave-alt"></i>
                            </span>
                            </div>
                            <input type="text" id="salary" name="salary" class="form-control" placeholder="Employee Salary" id="exampleInputPassword7">
                        </div>
                    </div>


                    <div class="mb-3 col-md-6 col-12">
                        <label for="exampleInputPassword6">Employee PF</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span id="pf" class="input-group-text">
                                    <i class="fa fa-money-bill"></i>
                                </span>
                            </div>
                            <input type="text" name="pf" id="pf" class="form-control" placeholder="Employee PF" id="exampleInputPassword7">
                        </div>
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
                name: {
                    required: true,
                },
            
            },
            messages: {
                name: {
                    required: "Please Enter a Employee Name.",
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

            ajax: "{{route('employee')}}",
            method: 'get',
            columns: [{
                    "data": 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'number',
                    name: 'number'
                },
                {
                    data: 'depart_id',
                    name: 'depart_id'
                },
                {
                    data: 'designation_id',
                    name: 'designation_id'
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
            url: "{{route('employee.edit')}}",
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


