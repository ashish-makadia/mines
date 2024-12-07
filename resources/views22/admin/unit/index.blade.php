
@extends('layout.app')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <a class="btn btn-primary btn-sm" href="#" data-toggle="modal" data-target="#response1">
                      Add  Unit
                    </a>

                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">Master</li>
                        <li class="breadcrumb-item active">  Unit List</li>
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
                                        <th>Name</th>
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
                <h4 class="modal-title">Add New Unit</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('unit.store')}}" method="post" id="addform">
                 @csrf   <div class="d-flex w-100 justify-content-between row">
                        {{-- <div class="col-md-12 col-12  mb-3">
                            <div class="form-group">
                           <span id="designation"></span>     <span class="text-red">*</span>  <label>Designation</label>
                                <input type="text" name="designation" class="form-control" placeholder="Add New Designation">
                            </div>
                        </div> --}}
                        <div class="col-md-12 col-12  mb-3">
                            <div class="form-group">
                                <span class="text-red">*</span>    <label>Unit</label>
                                <input type="text" name="unit" class="form-control" placeholder="Add New Department">
                                @error('department')
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
    <div id="editdata">
        <div class="modal-dialog modals">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Unit</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{-- {{dd($assign_assets)}} --}}
                <div class="modal-body">
                    <form method="post" id="editform">
                        @method('PATCH')
                        @csrf   <div class="d-flex w-100 justify-content-between row">

                               <div class="col-md-12 col-12  mb-3">
                                   <div class="form-group">
                                       <span class="text-red">*</span>    <label>Unit</label>
                                       <input type="text" name="unit" id="unit" class="form-control" placeholder="Add New Unit">
                                       @error('unit')
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
                unit: {
                    required: true,
                },

            },
            messages: {
                unit: {
                    required: "Please Enter a unit.",
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
var oTable;
    $(function() {

        oTable = $('#example1').DataTable({
            processing: true,
            serverSide: true,
            bFilter: true,
            searchable: true,
            bInfo: true,
            paging: true,

            ajax: "{{route('unit')}}",
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
                    data: 'unit',
                    name: 'unit'
                },


                {
                    data: null,
                    name: null,
                    orderable: false,
                    searchable: false,
                    render: (row, index) => {

                        return `<div class="d-flex action-btn-div">
                            <a href="javascript:void(0);" onclick="editfunc(${row.id})" class="btn btn-info btn-sm" > <i class="fas fa-pencil-alt"></i></a>&nbsp;
                            <a href="javascript:void(0);" onclick="deleteUnit(${row.id})" class="btn btn-danger btn-sm" > <i class="fas fa-trash-alt"></i></a>
                        </div>`;
                    }
                },
            ]
        });
    });

    function editfunc(id) {
        let editUrl = "{{ route('unit.edit', ':unit') }}";
        editUrl = editUrl.replace(":unit", id);

        let updateUrl = "{{ route('unit.update', ':unit') }}";
        updateUrl = updateUrl.replace(":unit", id);


        $("#editform").attr("action",updateUrl);
        $.ajax({
            url:editUrl,
            type: 'get',
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                $("#unit").val(data.unit.unit);
                $('#response').modal('show');
            }

        });
    }

    function deleteUnit(id){
        let deleteUrl = "{{ route('unit.destroy', ':unit') }}";
        deleteUrl = deleteUrl.replace(":unit", id);
        console.log("deleteUrl:: ",deleteUrl);
        if(confirm("Are you sure to delete this record?")){
                $.ajax({
                url: deleteUrl,
                type: 'DELETE',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    if(data.message){
                        toastr.success(data.message);
                    }
                    if(data.error){
                        toastr.error(data.error);
                    }
                    oTable.draw();
                    // location.reload();
                }

            });
        }

    }
</script>


