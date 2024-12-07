@extends('layout.app')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <a class="btn btn-primary btn-sm" href="#" data-toggle="modal" data-target="#response5">
                        Credit Days
                    </a>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">Master</li>
                        <li class="breadcrumb-item active">Credit Days List</li>
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
                            <table id="category-table" class="table table-hover text-nowrap table-bordered">
                                <thead>
                                    <tr>
                                        <th>Sr No.</th>
                                        <th>Credit Days</th>
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
<div class="modal" id="response5">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Credit Days</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('add-credit-daysh')}}" method="post" id="addCreditDay">
                    @csrf <div class="d-flex w-100 justify-content-between row">
                        <div class="col-md-12 col-12  mb-3">
                            <div class="form-group">
                                <label>Credit Days<span class="text-red">*</span></label>
                                <input type="text" class="form-control" placeholder="Credit Days" name="days">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer a18">
                        <button type="submit" class="btn btn-success btn-sm mt-3 ">Submit</a>
                        <button type="reset" class="btn btn-warning btn-sm mt-3">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="edit-days">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Credit Days </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('update-days',['id'=>'REPLACE_ID']) }}" method="POST" id="editCreditDay">
                    @csrf
                    <div class="d-flex w-100 justify-content-between row">
                        <div class="col-md-12 col-12  mb-3">
                            <div class="form-group">
                                <label>Credit days<span class="text-red">*</span></label>
                                <input type="text" class="form-control" placeholder="Credit days" name="days">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer a18">
                        <button type="submit" class="btn btn-success btn-sm mt-3">Submit</button>
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
            ajax: "{{ route('credit-days') }}",
            columns: [ {
                        data: 'DT_RowIndex',
                        width: "20%",
                        className: 'text-center'
                    },
                    {
                        "data": 'days',
                        render: function(daysData) {
                            return daysData;
                        }
                    },
                    {
                        "data": null,
                        "width": "20%",
                        "className": 'text-center',
                        render: function(o) {
                            var deleteUrl = "{{ route('delete-days', ['id' => 'REPLACE_ID']) }}";
                            deleteUrl = deleteUrl.replace('REPLACE_ID', o.id);

                            var element = `<a class="btn btn-info btn-sm edit-day" href="#" data-toggle="modal" data-target="#edit-days" data-id="${o.id}"><i class="fas fa-pencil-alt"></i></a>
                            <a class="btn btn-danger btn-sm" href="${deleteUrl}" title="Delete" onclick="deleteactivity(${o.id})"><i class="fas fa-trash"></i> </a>`;
                            return element;
                        }
                    },
                    ]
                });

                $('#category-table').on('click', '.edit-day', function () {
                    var row = oTable.row($(this).closest('tr')).data();
                    populateEditModal(row);
                });

                function populateEditModal(data) {
                    $('#edit-days input[name="days"]').val(data.days);
                    var editUrl = "{{ route('update-days', ['id' => 'REPLACE_ID']) }}";
                    editUrl = editUrl.replace('REPLACE_ID', data.id);
                    $('#edit-days form').attr('action', editUrl);
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
            $('#addCreditDay').validate({
                rules: {
                    days: {
                        required: true,
                    },
                },
                messages: {
                    days: {
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
            $('#editCreditDay').validate({
                rules: {
                    days: {
                        required: true,
                    },
                },
                messages: {
                    days: {
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
