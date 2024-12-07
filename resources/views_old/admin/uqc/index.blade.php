@extends('layout.app')

@section('content')






<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <a class="btn btn-primary btn-sm" href="#" data-toggle="modal" data-target="#response1">
                        Add UQC
                    </a>

                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">Master</li>
                        <li class="breadcrumb-item active">Assets Category List</li>
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
                                        <th>UQC</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <!-- <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>BOX(BOX)</td>
                                        <td>
                                            <a class="btn btn-info btn-sm" href="#" data-toggle="modal" data-target="#response" title="Edit">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>

                                            <a class="btn btn-danger btn-sm" href="#" title="Delete">
                                                <i class="fas fa-trash"> </i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>NUMBERS(NOS)</td>
                                        <td>
                                            <a class="btn btn-info btn-sm" href="#" data-toggle="modal" data-target="#response" title="Edit">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>

                                            <a class="btn btn-danger btn-sm" href="#" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>SQUARE FEET(SQF)</td>
                                        <td>
                                            <a class="btn btn-info btn-sm" href="#" data-toggle="modal" data-target="#response" title="Edit">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>

                                            <a class="btn btn-danger btn-sm" href="#" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>SQUARE METERS(SQM)</td>
                                        <td>
                                            <a class="btn btn-info btn-sm" href="#" data-toggle="modal" data-target="#response" title="Edit">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>

                                            <a class="btn btn-danger btn-sm" href="#" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody> -->
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<div class="modal" id="response1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Uqc</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('quc-store-managment')}}" method="post" id="adduqc">
                    @csrf
                    <div class="d-flex w-100 justify-content-between row">
                        <div class="col-md-12 col-12  mb-3">
                            <div class="form-group">
                                <label>UQC</label>
                                <input type="text" name="uqc_code"  value="{{old('uqc_code')}}" class="form-control" placeholder="Add UQC" required>

                            </div>
                        </div>

                    </div>
                    <div class="modal-footer a18">
                   
                        <button class="btn btn-success btn-sm mt-3 " type="submit">Submit</button>
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

<script type="text/javascript">
    $(function() {

        var oTable = $('#example1').DataTable({
            processing: true,
            serverSide: true,
            bFilter: true,
            bInfo: true,
            paging: true,
          
            ajax: "{{ route('quc-managment') }}",
            columns: [{
                    "data": 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },

                {
                    data: 'uqc_code',
                    name: 'uqc_code'
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


    function editquc(id) {
        $.ajax({
            url: "{{route('quc-edit-managment')}}",
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
            },
        });
    }


    $(function () {
            $.validator.setDefaults({
                submitHandler: function () {
                    return true;
                }
            });
            $('#adduqc').validate({
                rules: {
                    uqc_code: {
                        required: true,
                    },
                },
                messages: {
                    uqc_code: {
                        required: "Please enter a UQC .",
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
            // -------------
            $('#edituqc').validate({
                rules: {
                    uqc_code: {
                        required: true,
                    },
                },
                messages: {
                    uqc_code: {
                        required: "Please enter a UQC.",
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