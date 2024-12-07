@extends('layout.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#response2">Add Dispatch Register
                        </a>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active">Master</li>
                            <li class="breadcrumb-item active">Assets Stock</li>
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
                                            <th>id</th>
                                            <th> Mine Name</th>
                                            <th> Issued to Asset</th>
                                            <th>Assets Name</th>
                                            <th> Quantity Issued</th>
                                            <th> Issued By</th>
                                            <th> Issued For</th>
                                            <th> Pending Quantity</th>
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
    {{-- //add modal --}}
    <div class="modal" id="response2">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Dispatch Register</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('dispatch-register') }}" method="post" enctype="multipart/form-data"
                        id="addassign">
                        @method('POST')
                        @include('admin.dispatch_register._form')
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="response">
        <div id="editdata"></div>
    </div>
@endsection
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}
@section('other-scripts')
    <script>
        var qty = 0;
        // $("#issued_assets").on("change", function() {
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
        //             if (data.machineryAssets) {
        //                 html = '<option value="">Select Assets</option>'
        //                 $.each(data.machineryAssets, function(index, value) {
        //                     html += `<option value=${value.id}>${value.machine_name}</option>`;
        //                 });
        //                 console.log(html);;
        //                 $("#assets_name").html(html);

        //             }
        //         }

        //     })
        // });
        // $("#assets_name").on("change", function() {
        //     $.ajax({
        //         url: "{{ route('get-assets-data') }}",
        //         type: 'get',
        //         dataType: 'json',
        //         data: {
        //             id: $("#assets_name").val()
        //         },
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         },
        //         success: function(data) {
        //             if (data.machineryAssets) {
        //                 qty = data.machineryAssets.machine_qty;
        //                 $("#assign_qty").val(qty)
        //                 $("#quantity").attr("max", qty);
        //                 $("#quantity").val(qty);

        //                 var pend_qty = qty - parseFloat($("#quantity").val())
        //                 $("#pending_quantity").val((pend_qty > 0 ? pend_qty : 0))
        //                 $("#pending_quantity").attr("max", (pend_qty > 0 ? pend_qty : 0));
        //             }

        //         }
        //     });
        // });
        $(".quantity").on("keyup", function() {
            var val = $("#quantity").val();
            console.log(val, " ", qty);
            if (val > qty) {
                $(".qty_err").text("Quantity doen't allow greater than " + qty)
            }
            pend_qty = 0;
            if ($(this).val() > 0) {
                pend_qty = parseFloat($(this).val());
                pend_qty = qty - pend_qty;
            }

            $(".pending_quantity").val(pend_qty > 0 ? pend_qty : 0);
        })
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
                ajax: "{{ route('dispatch-register') }}",
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
                            return row.mine_id > 0 ? row.mines.mine_name : "";
                        }
                    },
                    {
                        data: null,
                        name: null,
                        render: (row, index) => {
                            return row.issued_assets > 0 ? row.assetscategory.category_name : "";
                        }
                    },
                    {
                        data: null,
                        name: null,
                        render: (row, index) => {
                            return row.assets_name > 0 ? row.assets.machine_name : "";
                        }
                    },

                    {
                        data: 'quantity_issued',
                        name: 'quantity_issued'
                    },
                    {
                        data: null,
                        name: null,
                        render: (row, index) => {
                            return row.issued_by > 0 ? row.user.name : "";
                        }
                    },
                    {
                        data: 'issued_for',
                        name: 'issued_for'
                    },

                    {
                        data: 'pending_quantity',
                        name: 'pending_quantity'
                    },

                    {
                        data: null,
                        name: null,
                        orderable: false,
                        searchable: false,
                        render: (row, index) => {

                            let deleteUrl =
                                "{{ route('dispatch-register.destroy', ':dispatch_register') }}";
                            deleteUrl = deleteUrl.replace(":dispatch_register", row.id);
                            return `<div class="d-flex action-btn-div">
                            <a href="javascript:void(0);" onclick="editdispatchregister(${row.id})" class="btn btn-info btn-sm" > <i class="fas fa-pencil-alt"></i></a>&nbsp;
                            <a href="javascript:void(0);" onclick="deletedispatchregister(${row.id})" class="btn btn-danger btn-sm" > <i class="fas fa-trash-alt"></i></a>
                        </div>`;

                        }
                    },
                ]
            });
        });

        function deletedispatchregister(id) {
            let deleteUrl = "{{ route('dispatch-register.destroy', ':dispatch_register') }}";
            deleteUrl = deleteUrl.replace(":dispatch_register", id);
            console.log("deleteUrl:: ", deleteUrl);
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

        function editdispatchregister(id) {

            let editUrl = "{{ route('dispatch-register.edit', ':dispatch_register') }}";
            editUrl = editUrl.replace(":dispatch_register", id);

            $.ajax({
                url: editUrl,
                type: 'get',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },

                success: function(data) {
                    $("#editdata").html(data);
                    $('#response').modal('show');
                    $('.select').select2({
                        theme: 'bootstrap4'
                    });
                }

            });
        }
    </script>
@endsection
