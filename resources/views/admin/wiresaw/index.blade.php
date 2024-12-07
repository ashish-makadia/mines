@extends('layout.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#response2">Add New Wire Saw
                        </a>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active">Master</li>
                            <li class="breadcrumb-item active">Wire Saw</li>
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
                                            <th> Date</th>
                                            <th> Mala Size.</th>
                                            <th> Quc</th>
                                            <th> Quantity</th>
                                            <th> Rate</th>
                                            <th> Total Amount</th>
                                            <th> Party Name</th>
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
                    <h4 class="modal-title">Add New Wire Saw Register </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('wiresaw') }}" method="post" enctype="multipart/form-data" id="addassign">
                        @method('POST')
                        @include('admin.wiresaw._form')
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="response1">
        <div id="editdata">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Wire Saw Register</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    {{-- {{dd($assign_assets)}} --}}
                    <div class="modal-body">
                        <form method="post" enctype="multipart/form-data" id="editWireSaw">
                            @csrf
                            @method('PATCH')
                            @include('admin.wiresaw._form')
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

                ajax: "{{ route('wiresaw') }}",
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
                        data: 'mala_size',
                        name: 'mala_size',
                    },
                    {
                        data: 'quc_id',
                        name: 'quc_id'
                    },
                    {
                        data: 'quantity',
                        name: 'quantity'
                    },
                    {
                        data: 'rate',
                        name: 'rate'
                    },
                    {
                        data: 'total_amount',
                        name: 'total_amount'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: null,
                        name: null,
                        orderable: false,
                        searchable: false,
                        render: (row, index) => {
                            let deleteUrl =
                            "{{ route('wiresaw.destroy', ':wire_saw') }}";
                            deleteUrl = deleteUrl.replace(":wire_saw", row.id);
                            return `<div class="d-flex action-btn-div">
                            <a href="javascript:void(0);" onclick="editwiresaw(${row.id})" class="btn btn-info btn-sm" > <i class="fas fa-pencil-alt"></i></a>&nbsp;
                            <a href="javascript:void(0);" onclick="deleteWireSaw(${row.id})" class="btn btn-danger btn-sm" > <i class="fas fa-trash-alt"></i></a>
                        </div>`;
                        }
                    },
                ]
            });
        });
        function editwiresaw(id) {
            let editUrl = "{{ route('wiresaw.edit', ':wire_saw') }}";
            editUrl = editUrl.replace(":wire_saw", id);
            let updateUrl = "{{ route('wiresaw.update', ':wire_saw') }}";
            updateUrl = updateUrl.replace(":wire_saw", id);
            $("#editWireSaw").attr("action", updateUrl);

            $.ajax({
                url: editUrl,
                type: 'get',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    // $("#editdata").html(data);
                    $.each(data.wire_saw, function(key, value) {
                        // Set the value of the corresponding input field based on its name
                        console.log(key," ",value);
                        $('input[name="' + key + '"]').val(value);
                         if(key == "quc_id")
    $('select[name="' + key + '"]').val(value).trigger('change');
                        if (key == "date")
                            $('input[name="' + key + '"]').val(moment(value).format("DD-MM-YYYY"));


                    });
                    $('#response1').modal('show');

                }
            });
        }
            function deleteWireSaw(id) {
                let deleteUrl = "{{ route('wiresaw.destroy', ':wire_saw') }}";
                deleteUrl = deleteUrl.replace(":wire_saw", id);

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
                    url: "{{ route('wiresaw') }}",
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
                    mala_size: {
                        required: true
                    },
                    quc_id: {
                        required: true,
                    },
                    quantity: {
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
        
         $(document).on('keyup', '.quantity,.rate', function(){
           
            var quantity = $(this).closest("form").find($('input[name="quantity"')).val();
            var rate =$(this).closest("form").find($('input[name="rate"]')).val();
            console.log(quantity," ",rate);
           
           
                var time = parseFloat(quantity) * parseFloat(rate);
                $(".total_amount").val(time);
            
        });

        // $("#quantity, #rate").on("keyup",function(){
        //     var quantity = $("#quantity").val();
        //     var rate = $("#rate").val();
        //     console.log(quantity," aaaa:: ",rate);
        //     var total_amount = parseFloat(quantity)*parseFloat(rate);
        //     console.log("total_amount:: ",total_amount);
        //     $("#total_amount").val(total_amount);
        // });
       
    </script>
@endsection
