@extends('layout.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <a class="btn btn-primary btn-sm" href="{{route('reports-assets-vendor.create')}}" >
                            Add Assets Vendor
                        </a>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Assets Vendor List</li>
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
    var oTable = "";
        $(function() {
            oTable = $('#example1').DataTable({
                processing: true,
                serverSide: true,
                bFilter: true,
                searchable: true,
                bInfo: true,
                paging: true,
                ajax: "{{ route('reports.assets-vendor') }}",
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
                            let editUrl = "{{ route('reports-assets-vendor.edit', ':reports_assets_vendor') }}";
                            editUrl = editUrl.replace(":reports_assets_vendor", row.id);

                            return `<div class="d-flex action-btn-div">
                                <a href="${editUrl}" class="btn btn-info btn-sm"> <i class="fas fa-pencil-alt"></i></a>&nbsp;
                                <a href="javascript:void(0);" onclick="deleteAssetsVendor(${row.id})" class="btn btn-danger btn-sm" > <i class="fas fa-trash-alt"></i></a>
                            </div>`;
                        }
                    },
                ]
            });
        });

        function deleteAssetsVendor(id) {
                let deleteUrl = "{{ route('reports-assets-vendor.destroy', ':reports_assets_vendor') }}";
                deleteUrl = deleteUrl.replace(":reports_assets_vendor", id);

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


    </script>
@endsection
