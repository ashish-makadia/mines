@extends('layout.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        {{-- <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#response2">Add Sell Register
                        </a> --}}
                        <a class="btn btn-primary btn-sm" href="{{route('sell-register.create')}}">Add Sell Register
                        </a>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active">Sell Register</li>
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
                                            <th>W/P no.</th>
                                            <th>Product no. Blocks</th>
                                            <th>Sell Quantity</th>
                                            <th>Pending</th>
                                            <th>Rate</th>
                                            <th>Volume</th>
                                            <th>Party Name</th>
                                            <th>Sold By</th>
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
                    <h4 class="modal-title">Add Sell Register</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('sell-register') }}" method="post" enctype="multipart/form-data" id="sell-register">
                        @method('POST')
                        @include('admin.sell_register._form')
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="response">
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
                        @include('admin.sell_register._form')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}
@section('other-scripts')
    <script>
        var qty = 0;
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
                ajax: "{{ route('sell-register') }}",
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
                            return row.wip_no > 0 ? row.wip.wp_no : "";
                        }
                    },
                    // {
                    //     data: 'products_block',
                    //     name: 'products_block'
                    // },
                    {
                        data: 'sell_qty',
                        name: 'sell_qty'
                    },
                    {
                        data: 'pending_qty',
                        name: 'pending_qty'
                    },
                    {
                        data: 'rate',
                        name: 'rate'
                    },
                    {
                        data: null,
                        name: null,
                        render: (row, index) => {
                            return row.volume > 0 ? row.quc.uqc_code : "";
                        }
                    },
                    {
                        data: null,
                        name: null,
                        render: (row, index) => {
                            return row.sold_by > 0 ? row.users.name : "";
                        }
                    },
                    {
                        data: null,
                        name: null,
                        render: (row, index) => {
                            return row.party_name > 0 ? row.parties.vendor_name : "";
                        }
                    },
                    {
                        data: null,
                        name: null,
                        orderable: false,
                        searchable: false,
                        render: (row, index) => {
                            let deleteUrl = "{{ route('sell-register.destroy', ':sell_register') }}";
                            deleteUrl = deleteUrl.replace(":sell_register", row.id);
                            let editUrl = "{{ route('sell-register.edit', ':sell_register') }}";
                            editUrl = editUrl.replace(":sell_register", row.id);
                            return `<div class="d-flex action-btn-div">
                                <a href="${editUrl}" class="btn btn-info btn-sm" > <i class="fas fa-pencil-alt"></i></a>&nbsp;
                                <a href="javascript:void(0);" onclick="deleteSellRegister(${row.id})" class="btn btn-danger btn-sm" > <i class="fas fa-trash-alt"></i></a>
                            </div>`;
                        }
                    },
                ]
            });
        });

        function deleteSellRegister(id) {
            let deleteUrl = "{{ route('sell-register.destroy', ':sell_register') }}";
            deleteUrl = deleteUrl.replace(":sell_register", id);
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

            let editUrl = "{{ route('sell-register.edit', ':sell_register') }}";
            editUrl = editUrl.replace(":sell_register", id);
            let updateUrl = "{{ route('sell-register.update', ':sell_register') }}";
        updateUrl = updateUrl.replace(":sell_register", id);


        $("#editassign").attr("action",updateUrl);
            $.ajax({
                url: editUrl,
                type: 'get',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },

                success: function(data) {
                    // $("#editdata").html(data);
                    $.each(data.sell_register, function(key, value) {
                    // Set the value of the corresponding input field based on its name
                    $('input[name="' + key + '"]').val(value);
                    // if(key == "sales_date")
                    // $('input[name="' + key + '"]').val(moment(value).format("DD-MM-YYYY"));
                    // if(key == "remarks")
                    // $('textarea[name="' + key + '"]').val(value);
                    if(key == "wip_no" || key == "volume" || key == "party_name"|| key == "sold_by")
                    $('select[name="' + key + '"]').val(value).trigger('change');
                });
                    $('#response').modal('show');
                    $('.select').select2({
                        theme: 'bootstrap4'
                    });
                }

            });
        }

        $(".wipId").on("change",function(){
            var wipId = $(this).val();
            $.ajax({
                    url: "{{route("sell-register.get-stock")}}",
                    type: 'POST',
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data:{
                        wipId:wipId
                    },
                    success: function(result) {
                        var totalUnit = $('input[name="products_block"]').val(result.data);
                        var stockTable = `<table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th> Height </th>
                                            <th> Weight </th>
                                            <th> Width </th>
                                            <th> Total </th>
                                            <th> Sell Qty </th>
                                            <th> Rem Qty </th>
                                        </tr>
                                    </thead>
                                    <tbody>`;
                                        var baseUrl = "{{ url('public/uploads/step3') }}";
                                        $.each(result.wip, function(key, value) {
                                            stockTable += `<tr>
                                            <td>${value.height}</td>
                                            <td>${value.weight}</td>
                                            <td>${value.width}
                                                <input type="hidden" name="item_id[]" value=${value.id} />
                                                </td>
                                            <td><input type="number" name="total_item_qty[]" class="form-control total_item_qty" readonly value=${value.remQty}></td>
                                            <td><input type="number" name="sell_item_qty[]" class="form-control sell_item_qty"></td>
                                            <td><input type="number" name="rem_item_qty[]" readonly class="form-control rem_item_qty" value=${value.remQty}></td>`;

                                            // if (value.uploaded_pic && value.uploaded_pic != ''){
                                            //     stockTable += `<td>
                                            //         <div class="mb-3 col-md-1 col-12">
                                            //             <img src="${baseUrl}/${value.wip_id}/${value.uploaded_pic}"
                                            //                 style="width:50px;height:50px" />
                                            //         </div>
                                            //     </td>`;
                                            //  }
                                            stockTable += ` </tr>`;
                                        });
                                    stockTable +`</tbody>
                                </table>`;
                                // console.log(stockTable);
                                $("#stock_html").html(stockTable);
                        // location.reload();
                    }
                });
        });

        $(".sell_qty").on("keyup",function(){
            var sellQty = $(this).val();
            var totalQty = $('input[name="products_block"]').val();
            var pendQty = totalQty - sellQty;
            console.log(sellQty," !",totalQty," p ",pendQty);
            $(".qty_err").text("");
            if (parseFloat(sellQty) > parseFloat(totalQty)) {
                $(".qty_err").text("Quantity doen't allow greater than " + totalQty)
            }
                $('input[name="pending_qty"]').val(pendQty);


        })
        $(document).on('keyup', '.sell_item_qty', function(event) {
           var totalItemQty = $(this).closest("tr").find(".total_item_qty").val();
           var sellItemQty = $(this).closest("tr").find(".sell_item_qty").val();
           var remItemQty = parseFloat(totalItemQty) - parseFloat(sellItemQty);
           console.log(parseFloat(totalItemQty)," ",parseFloat(sellItemQty)," ",remItemQty);
           if(sellItemQty > 0)
           $(this).closest("tr").find(".rem_item_qty").val(remItemQty);
           var totalSellQty = 0;
           var totalRemQty = 0;
           $('.sell_item_qty').each(function(index) {
            console.log("sell_item_qty",($(this).val()));
                if($(this).val()>0){
                    totalSellQty += parseFloat($(this).val());
                }
           });
           $('.rem_item_qty').each(function(index) {
            console.log("rem_item_qty",($(this).val()));
            if($(this).val()>0){
                totalRemQty += parseFloat($(this).val());
            }
           });
           $(".sell_qty").val(totalSellQty);
           var totalQty = $('input[name="products_block"]').val();
           $('input[name="pending_qty"]').val(totalRemQty)

        });
    </script>
@endsection
