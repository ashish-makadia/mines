@extends('layout.app')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#response2">Assign Asset </a>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">Master</li>
                        <li class="breadcrumb-item active">Assign Assets List</li>
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
                                        <th>Date </th>
                                        <th>Category</th>
                                        <th>Name </th>
                                        <th>Quantity</th>
                                        <th>Mine From</th>
                                        <th>Transfer To Mine</th>
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
                <form action="{{route('assets-assign')}}" method="post" enctype="multipart/form-data" id="addassign">
                    @csrf
                    @method('POST')
                    @include('admin.sale_assets._form')
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="response">
    <div id="editdata">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Assign Assets</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{-- {{dd($assign_assets)}} --}}
                <div class="modal-body">
                    <form method="post" enctype="multipart/form-data" id="editassign">
                        @csrf
                        @method('PATCH')
                        @include('admin.sale_assets._form')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

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

            ajax: "{{route('assets-assign')}}",
            method: 'get',
            columns: [{
                    "data": 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'sales_date',
                    name: 'sales_date',
                    render: (row, index) => {
                        return moment(row).format("DD-MM-YYYY");
                    }
                },

                {
                    data: null,
                    name: null,
                    render: (row, index) => {
                        console.log("row",row);
                        return row?.assetscategory?.category_name;
                    }
                },
                {
                    data: 'assets_name',
                    name: 'assets_name'
                },
                {
                    data: 'quantity',
                    name: 'quantity'
                },
                {
                    data: null,
                    name: null,
                    render: (row, index) => {
                        console.log("row",row);
                        return row.mine_id > 0?(row.mines ?row.mines.mine_name:""):"";
                    }
                },
                {
                    data: null,
                    name: null,
                     render: (row, index) => {
                        console.log("row",row);
                        return row.transfer_mine_name > 0?(row.transfer_mines ?row.transfer_mines.mine_name:""):"";
                    }
                },
                {
                    data:null,
                    name: null,
                    orderable: false,
                    searchable: false,
                    render: (row, index) => {
                        let deleteUrl = "{{ route('assets-assign.destroy', ':assets_assign') }}";
                        deleteUrl = deleteUrl.replace(":assets_assign", row.id);
                        return `<div class="d-flex action-btn-div">
                            <a href="javascript:void(0);" onclick="editassignasset(${row.id})" class="btn btn-info btn-sm" > <i class="fas fa-pencil-alt"></i></a>&nbsp;
                            <a href="javascript:void(0);" onclick="deleteAssignAssets(${row.id})" class="btn btn-danger btn-sm" > <i class="fas fa-trash-alt"></i></a>
                        </div>`;
                    }
                },
            ]
        });
    });


    function editassignasset(id) {
        let editUrl = "{{ route('assets-assign.edit', ':assets_assign') }}";
        editUrl = editUrl.replace(":assets_assign", id);

        let updateUrl = "{{ route('assets-assign.update', ':assets_assign') }}";
        updateUrl = updateUrl.replace(":assets_assign", id);


        $("#editassign").attr("action",updateUrl);
        $.ajax({
            url: editUrl,
            type: 'get',
            dataType: 'json',
            // data: {
            //     id: id
            // },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                // $("#editdata").html(data);
                $.each(data.assign_assets, function(key, value) {
    // Set the value of the corresponding input field based on its name
    $('input[name="' + key + '"]').val(value);
    if(key == "sales_date")
    $('input[name="' + key + '"]').val(moment(value).format("DD-MM-YYYY"));
    if(key == "remarks")
    $('textarea[name="' + key + '"]').val(value);
    if(key == "assets_category" || key == "assets_type")
    $('select[name="' + key + '"]').val(value).trigger('change');
});
                $('#response').modal('show');
                $('.select').select2({ theme: 'bootstrap4'});
            }

        });
    }

    function deleteAssignAssets(id){
        let deleteUrl = "{{ route('assets-assign.destroy', ':assets_assign') }}";
        deleteUrl = deleteUrl.replace(":assets_assign", id);
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
        $('.reservationdate').datetimepicker({
            format: 'DD-MM-YYYY',
        });
        var qty = 0;
        // $("#assets_category").on("change", function() {
        //     var val = $(this).val();
        //     $.ajax({
        //         url: "{{ route('get-assets-name') }}",
        //         type: 'get',
        //         dataType: 'json',
        //         data: {
        //             category: val
        //         },
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         },
        //         success: function(data) {
        //             $("#assets_name").val(data.machineryAssets.machine_name);
        //             qty = data.machineryAssets.machine_qty;
        //             $("#quantity").val(qty);
        //             $("#quantity").attr("max", qty);
        //             console.log(data.machineryAssets.machine_name, qty);
        //             console.log("data:: ", data, " ", qty);
        //         }

        //     })
        // });
        $("#quantity").on("keyup", function() {
            var val = $("#quantity").val();
            console.log(val, " ", qty);
            if (val > qty) {
                // $("#quantity").closest(".form-group").append("<span class='text-danger'>Quantity doen't allow greater than "+qty+"</span>")
                $("#qty_err").text("Quantity doen't allow greater than " + qty)
            }
        })
    </script>
<script>
    $(function () {
        $.validator.setDefaults({
            submitHandler: function (form) {
                // Your AJAX code to submit the form can go here
                form.submit();
            }
        });

        $('#addassign').validate({
            rules: {
                sales_date: {
                    required: true,
                },
                assets_type: {
                    required:true
                },
                assets_category: {
                    required: true,
                },
                asset_type: {
                    required: true,
                },
                assets_name: {
                    required: true,
                },
                transfer_mine_name: {
                    required: true,
                },
                quantity: {
                    required: true,
                },
            },
            messages: {
                sales_date: {
                    required: "Please select a date of sale.",
                },
                assets_type: {
                    required: "Please select a assets type.",
                },
                assets_name: {
                    required: "Please Enter Asset name.",
                },
                quantity: {
                    required: "Please Enter quantity.",
                },
                transfer_mine_name: {
                    required: "Please Enter transfer mine name.",
                },
                assets_category: {
                    required: "Please select an asset category.",
                }
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
@endsection

