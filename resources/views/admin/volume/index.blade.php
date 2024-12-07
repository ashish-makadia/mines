
@extends('layout.app')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <a class="btn btn-primary btn-sm" href="#" data-toggle="modal" data-target="#response1">
                      Add  Volume
                    </a>

                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">Master</li>
                        <li class="breadcrumb-item active">  Volume List</li>
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
                                        {{--  --}}
                                        <th>Volume</th>
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
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add New Volume</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('volume.store')}}" method="post" id="addform">
                 @csrf   <div class="d-flex w-100 justify-content-between row">
                        {{-- <div class="col-md-12 col-12  mb-3">
                            <div class="form-group">
                           <span id="designation"></span>     <span class="text-red">*</span>  <label>Designation</label>
                                <input type="text" name="designation" class="form-control" placeholder="Add New Designation">
                            </div>
                        </div> --}}
                        <div class="col-md-12 col-12  mb-3">
                            <div class="form-group">
                                <span class="text-red">*</span>    <label>Volume</label>
                                <input type="text" name="volume" class="form-control" placeholder="Add New Volume">
                                @error('volume')
                                        <div style="color: red;">{{ $message }}</div>
                                        @enderror
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
                // designation: {
                //     required: true,
                // },
                volume: {
                    required: true,
                },
            
            },
            messages: {
                // designation: {
                //     required: "Please Enter a Designation.",
                // },
                volume: {
                    required: "Please Enter a Volume.",
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

            ajax: "{{route('volume')}}",
            method: 'get',
            columns: [{
                    "data": 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },

                // {
                //     data: 'designation',
                //     name: 'designation'
                // },
                {
                    data: 'volume',
                    name: 'volume'
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
            url: "{{route('volume.edit')}}",
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
               
            }

        });
    }
</script>


