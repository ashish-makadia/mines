@extends('layout.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#response2">Add New Meter Reading
                        </a>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active">Master</li>
                            <li class="breadcrumb-item active">Meter Reading</li>
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
                                <div class="row">
                                 <div class="col-md-8 col-4">

                                 </div>
                                <div class="col-md-4 col-8">
                                   
          
            <div class="input-group date" id="reservationdate111" data-target-input="nearest">
                <input type="datetime" name="date" class="form-control datetimepicker-input" data-target="#reservationdate111" placeholder="Select Month" required/>
                <div class="input-group-append" data-target="#reservationdate111" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
            </div>
        </div> </div><hr/>
                                <table id="example1" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>id</th>
                                            <th> Date</th>
                                            <th> Meter No.</th>
                                            <th> Per Unit Bill</th>
                                            <th> Total Unit</th>
                                            <th> Approx. Bill of Today</th>
                                            <th> Bill of Month</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                     <tfoot>
        <tr>
            <th colspan="6" style="text-align:right">Total:</th>
            <th id="totalBillOfMonth"></th>
            <th></th>
        </tr>
    </tfoot>
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
                    <h4 class="modal-title">Add New Meter Readng </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('meter-reading') }}" method="post" enctype="multipart/form-data" id="addassign">
                        @method('POST')
                        @include('admin.meter_reading._form')
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
                        <h4 class="modal-title">Edit Meter Reading</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    {{-- {{dd($assign_assets)}} --}}
                    <div class="modal-body">
                        <form method="post" enctype="multipart/form-data" id="editMeterReading">
                            @csrf
                            @method('PATCH')
                            @include('admin.meter_reading._form')
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
        $(document).on('keyup', '#per_unit_bill', function(){
        // $("#per_unit_bill").on("keyup",function(){
            var totalUnit = $('input[name="total_unit"]').val();
            var perUnitBill = $(this).val();

            console.log(parseFloat(totalUnit)," aaaa:: ",parseFloat(perUnitBill));
            var totalBilla = parseFloat(totalUnit)*parseFloat(perUnitBill);
            console.log("totalBill per unit:: ",totalBilla);

            $('input[name="today_bill"]').val(totalBilla);
            console.log($('input[name="today_bill"]'));
            billOfMonth = "{{$billOfMonth->bill_of_month}}";

            totalBillMonth = totalBilla+parseFloat(billOfMonth);
            console.log(totalBillMonth," bill:: ",billOfMonth);
            $('input[name="bill_of_month"]').val(totalBillMonth);
        });
        $(document).on('keyup', "#total_unit",function(){
            var totalUnit = $(this).val();
            var perUnitBill = $('input[name="per_unit_bill"]').val();

            console.log(parseFloat(totalUnit)," aaaa:: ",parseFloat(perUnitBill));
            var totalBilla = parseFloat(totalUnit)*parseFloat(perUnitBill);
            console.log("totalBill:: ",totalBilla);

            $('input[name="today_bill"]').val(totalBilla);
            console.log($('input[name="today_bill"]'));
            billOfMonth = "{{$billOfMonth->bill_of_month}}";

            totalBillMonth = totalBilla+parseFloat(billOfMonth);
            console.log(totalBillMonth," bill:: ",billOfMonth);
            $('input[name="bill_of_month"]').val(totalBillMonth);
        });
        $(function() {
            
            oTable = $('#example1').DataTable({
                processing: true,
                serverSide: true,
                bFilter: true,
                searchable: true,
                bInfo: true,
                paging: true,
                ajax: {
                url: "{{ route('meter-reading') }}",
                method: 'get',
                data: function(d) {
                    d.month = $('input[name="date"]').val();  // Add the month parameter to the data
                }
            },
                // ajax: "{{ route('meter-reading') }}",
                // method: 'get',
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
                        data: 'meter_no',
                        name: 'meter_no',
                    },
                    {
                        data: 'per_unit_bill',
                        name: 'per_unit_bill'
                    },
                    {
                        data: 'total_unit',
                        name: 'total_unit'
                    },
                    {
                        data: 'today_bill',
                        name: 'today_bill'
                    },
                    {
                        data: 'bill_of_month',
                        name: 'bill_of_month'
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
                            <a href="javascript:void(0);" onclick="editassignasset(${row.id})" class="btn btn-info btn-sm" > <i class="fas fa-pencil-alt"></i></a>&nbsp;
                            <a href="javascript:void(0);" onclick="deleteAssignAssets(${row.id})" class="btn btn-danger btn-sm" > <i class="fas fa-trash-alt"></i></a>
                        </div>`;
                        }
                    },
                ],
                drawCallback: function(settings) {
        var api = this.api();
        var total = api.column(6, { page: 'current' }).data().reduce(function(a, b) {
            return parseFloat(a) + parseFloat(b);
        }, 0);
        $(api.column(6).footer()).html(total.toFixed(2));
    }
            });
            $('#reservationdate111').on('change.datetimepicker', function() {
             oTable.draw();
        });
        });
        // $("#today_bill").on("keydown",function(){
        //     todayBill = $(this).val();
        //     billOfMonth = "{{$billOfMonth->bill_of_month}}";
        //     console.log(todayBill," bill:: ",billOfMonth);
        //     totalBill = todayBill+billOfMonth;
        //     $("#bill_of_month").val(totalBill);
        // });
        $('input[name="date"]').on("change",function(){
            console.log("hjghgjhgj:: ",$('input[name="date"]').val())
            oTable.draw();
        });
        //  $('#reservationdate111').on("change",function(){
        //     console.log("hjghgjhgj:: ",$('input[name="date"]').val())
        //     oTable.draw();
        // });
        
        function editassignasset(id) {
            let editUrl = "{{ route('meter-reading.edit', ':meter_reading') }}";
            editUrl = editUrl.replace(":meter_reading", id);
            let updateUrl = "{{ route('meter-reading.update', ':meter_reading') }}";
            updateUrl = updateUrl.replace(":meter_reading", id);
            $("#editMeterReading").attr("action", updateUrl);

            $.ajax({
                url: editUrl,
                type: 'get',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {

                    $('#today_bill').val(data.meter_reading.today_bill);
                    $.each(data.meter_reading, function(key, value) {

                             $('input[name="' + key + '"]').val(value);
                        $('textarea[name="' + key + '"]').val(value);
                        if (key == "date")
                            $('input[name="' + key + '"]').val(moment(value).format("DD-MM-YYYY"));




                    });

                    $('#today_bill').val(data.meter_reading.today_bill);
                    $('#response').modal('show');

                }
            });
        }
            function deleteAssignAssets(id) {
                let deleteUrl = "{{ route('meter-reading.destroy', ':meter_reading') }}";
                deleteUrl = deleteUrl.replace(":meter_reading", id);

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

            function viewdata(id) {
                $.ajax({
                    url: "{{ route('view-assign-asset') }}",
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
        $(function() {
            $.validator.setDefaults({
                submitHandler: function(form) {
                    // Your AJAX code to submit the form can go here
                    form.submit();
                }
            });

            $('#addassign').validate({
                rules: {
                   date: {
                        required: true,
                    },
                    meter_no: {
                        required: true
                    },
                    per_unit_bill: {
                        required: true,
                    },
                    total_unit: {
                        required: true,
                    },
                    today_bill: {
                        required: true,
                    },
                    bill_of_month: {
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
@endsection
