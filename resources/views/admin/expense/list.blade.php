@extends('layout.app')

@section('content')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#response2">Add
                        Expense</a>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item">Expense Management</li>
                        <li class="breadcrumb-item active">Expense List</li>

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
                                        <th> Sr No.</th>
                                        <th>Date</th>
                                        <th>Category</th>
                                        <th>Details</th>
                                        <th>Amount</th>
                                        <th>Attachment</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>

                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>

            </div>
        </div>
    </section>
</div>
<div class="modal" id="response">
    <div id="editdata"></div>
</div>
<div class="modal" id="response1">
    <div id="viewdata"></div>
</div>
<div class="modal" id="response2">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Expense</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="{{route('store-expense')}}" method="post" enctype="multipart/form-data" id="addexpense">
                    @csrf
                    <div class="d-flex w-100 justify-content-between row">


                        <div class="form-group mb-3 col-md-6 col-6">
                            <label class="form-label" for="basic-icon-default-fullname">
                                Date
                            <span class="text-red">*</span></label>
                            <div class="input-group date" id="reservationdate1" data-target-input="nearest">
                                <input type="text" name="expense_date" value="{{old('expense_date')}}" class="form-control datetimepicker-input" data-target="#reservationdate1" placeholder="Date" />
                                <div class="input-group-append" data-target="#reservationdate1" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>


                        <div class="form-group mb-3 col-md-6 col-6">
                            <label class="form-label" for="basic-icon-default-company">Category <span class="text-red">*</span></label>
                            <select name="category_id" id="" class="form-control  select2 a3">
                                <option value="">Select Expense</option>
                                @foreach($expensecategorys as $expensecategory)
                                <option value="{{$expensecategory->id}}">{{$expensecategory->exp_cat}}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group form-group mb-3 col-md-6 col-6">
                            <label class="form-label" for="basic-icon-default-state">Amount <span class="text-red">*</span></label>
                            <input type="text" name="amount" value="{{old('amount')}}" class="form-control" placeholder="Amount">
                        </div>


                        <div class="form-group form-group mb-3 col-md-6 col-6">
                            <label>Attachment <span class="text-red">*</span></label>
                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                <input type="file" name="file" />
                            </div>
                        </div>


                        <div class="form-group mb-3 col-md-12 col-12">
                            <label class="form-label" for="basic-icon-default-email">Details</label>
                            <textarea id="" cols="30" rows="5" placeholder="Enter Your Expense Details" name="details" class="form-control"></textarea>
                        </div>



                    </div>
                    <div class="modal-footer a18">
                        <button class="btn btn-success btn-sm" type="submit">Submit</button>
                        <button type="reset " class="btn btn-warning btn-sm ">Reset</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
    $(function() {

        var oTable = $('#example1').DataTable({
            processing: true,
            serverSide: true,
            bFilter: true,
            bInfo: true,
            paging: true,

            ajax: "{{ route('expense') }}",
            columns: [{
                    "data": 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },

                {
                    data: 'expense_date',
                    name: 'expense_date'
                },

                {
                    data: 'category_id',
                    name: 'category_id'
                },

                {
                    data: 'details',
                    name: 'details'
                },

                {
                    data: 'amount',
                    name: 'amount'
                },
                {
                    data: 'file',
                    name: 'file'
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

    function editexpense(id) {
        $.ajax({
            url: "{{route('edit-expense')}}",
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

                $('.select').select2({
                    theme: 'bootstrap4'
                });
            },
        });
    }


    function viewexpense(id) {
        $.ajax({
            url: "{{route('view-expense')}}",
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
@section('other-scripts')
<script>
    $(function() {
        $.validator.setDefaults({
            submitHandler: function() {
                return true;
            }
        });
        $('#addexpense').validate({
            rules: {
                expense_date: {
                    required: true,
                },

                category_id: {
                    required: true,
                },


                amount: {
                    required: true,
                },

                file: {
                    required: true,
                },



            },
            messages: {
                expense_date: {
                    required: "Please enter a Expense Date.",
                },

                category_id: {
                    required: "Please enter a Category.",
                },

                amount: {
                    required: "Please enter a Amount.",
                },

                file: {
                    required: "Please enter a Attachment.",
                },





            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
        // -------------
        $('#editCatagory').validate({
            rules: {
                category_name: {
                    required: true,
                },
            },
            messages: {
                category_name: {
                    required: "Please enter a category name.",
                },
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
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

@endsection