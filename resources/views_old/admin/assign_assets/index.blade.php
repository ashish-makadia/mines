@extends('layout.app')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#response2">Assign Assets </a>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">Master</li>
                        <li class="breadcrumb-item active">Assets List</li>
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
                                        <th>Mines </th>
                                        <th>Assets Catagory</th>
                                        <th>Multipal Machine</th>
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
    <div id="viewdata"></div>
</div>
{{-- //add modal --}}
<div class="modal" id="response2">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Assign Assets</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('add-assign-asset')}}" method="post" enctype="multipart/form-data" id="addassign">
                    @csrf
                    <div class="d-flex w-100 justify-content-between row">
                        <div class="col-md-6 col-6  mb-3">
                            <div class="form-group">
                                <label for="mine_id"><span class="text-red">*</span>Mines</label>
                                <select name="mine_id" class="form-control select2 a3" readonly>
                                    <option value="">Select Mine</option>
                                    @foreach($mines as $mine)
                                        <option value="{{$mine->id}}" {{ $mine->id === $mineId?"selected":"" }} @endif >{{$mine->mine_name}}</option>
                                    @endforeach
                                    </select>
                            </div>
                        </div>

                        <div class="col-md-6 col-6  mb-3">
                            <div class="form-group">
                                <span class="text-red">*</span> <label>Assets Catagory</label>
                                <select class="form-control select2 a3" name="asset_category_id" onClick="getAssets(this.value)">
                                  <option  value="">Assets Select</option>
                                  @foreach($assets as $asset)
                                  <option value="{{$asset->id}}">{{$asset->category_name}}</option>
                                  @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12 col-12  mb-3">
                            <div class="form-group">
                                <span class="text-red">*</span><label>Multipal Machine</label>
                                <select class="select2 a3 form-control" name='machine_id[]' multiple="multiple" data-placeholder="Machine Select">
                                  @foreach($machines as $machine)
                                  <option value="{{$machine->id}}">{{$machine->machine_name}}</option>
                                  @endforeach
                                </select>
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

<script type="text/javascript">
    $(function() {

        var oTable = $('#example1').DataTable({
            processing: true,
            serverSide: true,
            bFilter: true,
            searchable: true,
            bInfo: true,
            paging: true,

            ajax: "{{route('assign-asset')}}",
            method: 'get',
            columns: [{
                    "data": 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },

                {
                    data: 'mine_id',
                    name: 'mine_id'
                },
                {
                    data: 'asset_category_id',
                    name: 'asset_category_id'
                },

                {
                    data: 'machine_id',
                    name: 'machine_id'
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


    function editassignasset(id) {

        $.ajax({
            url: "{{route('edit-assign-asset')}}",
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
            }

        });
    }
    function viewdata(id) {

        $.ajax({
            url: "{{route('view-assign-asset')}}",
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
                $('#response1').modal('show');

            },
        });
    }
    </script>
<script>
    $(function () {
        $.validator.setDefaults({
            submitHandler: function (form) {
                form.submit();
            }
        });
        $('#addassign').validate({
            rules: {
                mine_id: {
                    required: true,
                },
                asset_category_id: {
                    required: true,
                },
                'machine_id[]': {
                    required: true,
                    minlength: 1, // At least one machine must be selected
                },
            },
            messages: {
                mine_id: {
                    required: "Please select a mine.",
                },
                asset_category_id: {
                    required: "Please select an asset category.",
                },
                'machine_id[]': {
                    required: "Please select at least one machine.",
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

