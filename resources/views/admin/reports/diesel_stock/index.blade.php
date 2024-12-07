@extends('layout.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <a class="btn btn-primary btn-sm" href="#" data-toggle="modal" data-target="#response1">
                            Add Diesel Stock
                        </a>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active"> Diesel Stock Report</li>
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
                                <table id="example1" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Sr No.</th>
                                            <th>Date</th>
                                            <th>Vendor</th>
                                            <th>Total Diesel(ltr)</th>
                                            <th>Total Amount</th>
                                            <th>Payment Amount</th>
                                            <th>Remaining Amount</th>
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
                    <h4 class="modal-title">Add diesel stock</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('reports-diesel-stock.store') }}" method="post" id="addform">
                        @csrf
                        @include('admin.reports.diesel_stock._form')
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="response">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Diesel Stock</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" id="editform">
                        @csrf
                        @method('PATCH')
                        @include('admin.reports.diesel_stock._form')
                    </form>
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

            $('#addform','#editform').validate({
                rules: {
                    asset_id: {
                        required: true,
                    },
                    start: {
                        required: true,
                    },
                    off: {
                        required: true,
                    },
                    time: {
                        required: true,
                    },
                    diesel: {
                        required: true,
                    },

                },

                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.input-group').append(error);

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
    var totalAmountEdit = 0;
        $(function() {
            oTable = $('#example1').DataTable({
                processing: true,
                serverSide: true,
                bFilter: true,
                searchable: true,
                bInfo: true,
                paging: true,
                ajax: "{{ route('reports.diesel-stock') }}",
                method: 'get',
                columns: [{
                        "data": 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: null,
                        name: null,
                        render: (row, index) => {
                            return moment(row.payment_date).format('DD-MM-YYYY');
                        }
                    },
                    {
                        data: null,
                        name: null,
                        render: (row, index) => {
                            return row.vendor_id > 0 ? row.vendor.vendor_name : "";
                        }
                    },
                    {
                        data: "total_diesel_ltr",
                        name: "total_diesel_ltr"
                    },
                    {
                        data: "total_amount",
                        name: "total_amount"
                    },
                    {
                        data: "payment_amount",
                        name: "payment_amount"
                    },
                    {
                        data: "remaining_amount",
                        name: "remaining_amount"
                    },
                    {
                        data: null,
                        name: null,
                        orderable: false,
                        searchable: false,
                        render: (row, index) => {

                            return `<div class="d-flex action-btn-div">
                                <a class="btn btn-info btn-sm" onClick=
                            editfunc(${row.id})> <i class="fas fa-pencil-alt"></i></a>&nbsp;
                                <a href="javascript:void(0);" onclick="deleteDieselStock(${row.id})" class="btn btn-danger btn-sm" > <i class="fas fa-trash-alt"></i></a>
                            </div>`;
                        }
                    },
                ]
            });
        });

        function deleteDieselStock(id) {
                let deleteUrl = "{{ route('reports-diesel-stock.destroy', ':reports_diesel_stock') }}";
                deleteUrl = deleteUrl.replace(":reports_diesel_stock", id);

                if (confirm("Are you sure to delete this record?")) {
                    $.ajax({
                        url: deleteUrl,
                        type: 'DELETE',
                        dataType: 'json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                            if (data.message) {
                                toastr.success(data.message);
                            }
                            if (data.error) {
                                toastr.error(data.error);
                            }
                            oTable.draw();
                            // location.reload();
                        }

                    });
                }

            }

        function editfunc(id) {
            let editUrl = "{{ route('reports-diesel-stock.edit', ':reports_diesel_stock') }}";
            editUrl = editUrl.replace(":reports_diesel_stock", id);

            let updateUrl = "{{ route('reports-diesel-stock.update', ':reports_diesel_stock') }}";
            updateUrl = updateUrl.replace(":reports_diesel_stock", id);

            $("#editform").attr("action",updateUrl);
            $.ajax({
                url: editUrl,
                type: 'get',
                dataType: 'json',
                data: {
                    id: id
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    // $("#editdata").html(data);
                    $.each(data.diesel_stock, function(key, value) {
                        // Set the value of the corresponding input field based on its name
                        $('input[name="' + key + '"]').val(value);
                        if(key == "total_amount"){
                              totalAmountEdit = value;
                        }
                        if (key == "payment_date")
                            $('input[name="' + key + '"]').val(moment(value).format("DD-MM-YYYY"));

                        if (key == "vendor_id"){
                          
                            $('select[name="' + key + '"]').val(value).trigger('change');
                        }
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

        $("#vendor_id").on("change", function() {
            var vendorId = $(this).val();
            $.ajax({
                url: "{{ route('report.diesel-report.get-vendor-stock') }}",
                type: 'post',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: vendorId
                },
                success: function(data) {
                    $("#total_diesel").val(data.total_diesel)
                    $("#total_amount").val(data.total_amount)
                }
            });
        });

        $('input[name="payment_amount"]').on("keyup", function() {
            var paymentAmount = parseFloat($(this).val());
           
            var totalAmount = $('input[name="total_amount"]').val();
            console.log("totalAmountEdit:: ",totalAmountEdit)
            var remainingAmount = (totalAmountEdit>0?totalAmountEdit:totalAmount) - paymentAmount;
             console.log("payment_amount",paymentAmount," ",(totalAmountEdit>0?totalAmountEdit:totalAmount));
            $('input[name="remaining_amount"]').val(remainingAmount)
        });
    </script>
@endsection
