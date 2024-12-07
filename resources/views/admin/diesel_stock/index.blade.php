@extends('layout.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <a class="btn btn-primary btn-sm" href="#" data-toggle="modal" data-target="#response1">
                            Add New Diesel Stock
                        </a>

                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active">Daily Register</li>
                            <li class="breadcrumb-item active"> Diesel Stock Management</li>
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
                                            <th> Id</th>
                                            <th> Date</th>
                                            <th> Diesel Stocking at</th>
                                            <th> Capacity of Storage</th>
                                            <th> Stock in Litre</th>
                                            <th> Vendor</th>
                                            <th> Rate per Litre</th>
                                            <th> Note</th>
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
                    <h4 class="modal-title">Add Diesel Stock</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('diesel-stock.store') }}" method="post" id="addform">
                        @csrf
                       @include('admin.diesel_stock._form')
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
                        <h4 class="modal-title">Edit Diesel Stock</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{-- <form  method="post" id="editform"> --}}
                            <form method="post" enctype="multipart/form-data" id="editform">
                            @csrf
                            @method("PATCH")
                           @include('admin.diesel_stock._form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('other-scripts')
    <script>
        $(function() {
            $.validator.setDefaults({
                submitHandler: function(form) {
                    // Your AJAX code to submit the form can go here
                    form.submit();
                }
            });
            $('#addform').validate({
                rules: {
                    date: {
                        required: true,
                    },
                    diesel_stock_at: {
                        required: true,
                    },
                    capacity_storage: {
                        required: true,
                    },
                    stock: {
                        required: true,
                    },
                    rate_per_ltr: {
                        required: true,
                    },
                    vendor_id: {
                        required: true,
                    },
                    total_amount: {
                        required: true,
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.input-group').append(error);
                    element.closest('.form-group').append(error);

                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
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

                ajax: "{{ route('diesel-stock') }}",
                method: 'get',
                columns: [{
                        "data": 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'date',
                        name: 'date',
                        render: (row, index) => {
                            return moment(row).format("DD-MM-YYYY");
                        }
                    },
                    {
                        data: 'stocking__at_date',
                        name: 'stocking__at_date',
                        render: (row, index) => {
                            return moment(row).format("DD-MM-YYYY");
                        }
                    },

                    {
                        data: 'capacity_storage',
                        name: 'capacity_storage'
                    },
                    {
                        data: 'stock',
                        name: 'stock'
                    },
                    {
                        data: null,
                        name: null,
                        render: (row, index) => {
                            return row.vendor_id > 0 ? row.vendor.vendor_name : "";
                        }
                    },
                    {
                        data: 'rate_per_ltr',
                        name: 'rate_per_ltr'
                    },

                {
                        data: 'remarks',
                        name: 'remarks'
                    },

                    {
                        data: null,
                        name: null,
                        orderable: false,
                        searchable: false,
                        render: (row, index) => {
                            let deleteUrl =
                            "{{ route('assets-assign.destroy', ':assets_assign') }}";
                            deleteUrl = deleteUrl.replace(":assets_assign", row.id);
                            return `<div class="d-flex action-btn-div">
                            <a href="javascript:void(0);" onclick="editfunc(${row.id})" class="btn btn-info btn-sm" > <i class="fas fa-pencil-alt"></i></a>&nbsp;
                            <a href="javascript:void(0);" onclick="deleteAssignAssets(${row.id})" class="btn btn-danger btn-sm" > <i class="fas fa-trash-alt"></i></a>
                        </div>`;
                        }
                    },
                ]
            });
        });

        function deleteAssignAssets(id){
        let deleteUrl = "{{ route('diesel-stock.destroy', ':diesel_stock') }}";
        deleteUrl = deleteUrl.replace(":diesel_stock", id);
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
        function editfunc(id) {
            let editUrl = "{{ route('diesel-stock.edit', ':diesel_stock') }}";
            editUrl = editUrl.replace(":diesel_stock", id);

            let updateUrl = "{{ route('diesel-stock.update', ':diesel_stock') }}";
            updateUrl = updateUrl.replace(":diesel_stock", id);
            $("#editform").attr("action", updateUrl);
            console.log(updateUrl);

            $.ajax({
                url:editUrl,
                type: 'get',
                dataType: 'json',

                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    // $("#editdata").html(data);
                    $.each(data.diesel_stock, function(key, value) {
    // Set the value of the corresponding input field based on its name
    $('input[name="' + key + '"]').val(value);
    if(key == "diesel_stock_at"|| key == "sales_date")
    $('input[name="' + key + '"]').val(moment(value).format("DD-MM-YYYY"));
    if(key == "remarks")
    $('textarea[name="' + key + '"]').val(value);
    if(key == "vendor_id")
    $('select[name="' + key + '"]').val(value).trigger('change');
});
                    $('#response').modal('show');
                    $('.select').select2({
                        theme: 'bootstrap4'
                    });
                    $('#reservationdate1').datetimepicker({
                        format: 'DD-MM-YYYY',
                    });
                }
            });
        }
        $(document).on('keyup', '.stock,.rate_per_ltr', function(){
            var capacity_storage = $(this).closest("form").find($('input[name="capacity_storage"]')).val();
            var stock = $(this).closest("form").find($('input[name="stock"')).val();
            var rate_per_ltr =$(this).closest("form").find($('input[name="rate_per_ltr"]')).val();
            console.log(capacity_storage," ",stock," ",rate_per_ltr);
            $(".stock_err").text("");
            if(capacity_storage < stock){
                $(".stock_err").text("stock doesn't allow greater than capacity of storage");
            } else {
                var time = parseFloat(stock) * parseFloat(rate_per_ltr);
                $(".total_amount").val(time);
            }
        });

    </script>
@endsection
