@extends('layout.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <a class="btn btn-primary btn-sm" href="#" data-toggle="modal" data-target="#response1">
                    Add Expense Category
                    </a>

                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">Master</li>
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
                            <table id="category-table" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Sr No.</th>
                                        <th>Category</th>
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
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Expense Category</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('add-expense-category')}}" method="POST" id="addCatagory">
                    @csrf
                    <div class="d-flex w-100 justify-content-between row">
                        <div class="col-md-12 col-12  mb-3">
                            <div class="form-group">
                                <label>Category<span class="text-red">*</span></label>
                                <input type="text" class="form-control" placeholder="Category Name" name="exp_cat">

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
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Expense Category</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="{{ route('update-expense-category') }}" method="POST" id="editCatagory">
                    @csrf   
                    <input type="hidden" class="form-control"  name="id">
                     <div class="d-flex w-100 justify-content-between row">

                        <div class="col-md-12 col-12  mb-3">
                            <div class="form-group">
                                <label>Category<span class="text-red">*</span></label>
                                <input type="text" class="form-control" placeholder="Category Name" name="exp_cat">

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer a18">
                        <button type="submit" class="btn btn-success btn-sm">Submit</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

@endsection

@section('other-scripts')
    <script>
        $(function () {
            oTable = $('#category-table').DataTable({
            paging: true,
            lengthChange: true,
            searching: true,
            ordering: true,
            info: true,
            autoWidth: false,
            responsive: true,
            ajax: "{{ route('expense-category') }}",
            columns: [ {
                data: 'DT_RowIndex',
                className: 'text-center'
            },
            {
                data: 'exp_cat',
                render: function (Data) {
                return Data; 
                }
            },
            {
                "data": null,
                "className": 'text-center',
                render: function(o) {
                    var deleteUrl = "{{ route('delete-expense-category', ['id' => 'REPLACE_ID']) }}";
                    deleteUrl = deleteUrl.replace('REPLACE_ID', o.id);

                    var element = `<a class="btn btn-info btn-sm" href="#" data-toggle="modal" data-target="#response" data-id="${o.id}"><i class="fas fa-pencil-alt"></i></a>
                    <a class="btn btn-danger btn-sm" href="${deleteUrl}" title="Delete" onclick="deleteactivity(${o.id})"><i class="fas fa-trash"></i> </a>`;
                    return element;
                }
            },
            ]
            });

            $('#category-table').on('click', '.btn-info', function () {
            var row = oTable.row($(this).closest('tr')).data();
            populateEditModal(row);
            });

            function populateEditModal(data) {
                $('#response input[name="exp_cat"]').val(data.exp_cat);
                $('#response input[name="id"]').val(data.id);
                var editUrl = "{{ route('update-expense-category', ['id' => 'REPLACE_ID']) }}";
               
                editUrl = editUrl.replace('REPLACE_ID', data.id);
              
                $('#edit-expense-form').attr('action', editUrl);
            }
        });
    </script>
    <script>
        $(function () {
            $.validator.setDefaults({
                submitHandler: function () {
                    return true;
                }
            });
            $('#addCatagory').validate({
                rules: {
                    exp_cat: {
                        required: true,
                    },
                },
                messages: {
                    exp_cat: {
                        required: "Please enter a category name.",
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
            // -------------
            $('#editCatagory').validate({
                rules: {
                    exp_cat: {
                        required: true,
                    },
                },
                messages: {
                    exp_cat: {
                        required: "Please enter a category name.",
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

@endsection
