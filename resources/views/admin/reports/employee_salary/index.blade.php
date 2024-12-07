@extends('layout.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <a class="btn btn-primary btn-sm" href="#" data-toggle="modal" data-target="#response1">
                            Add Employee Salary
                        </a>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active">Employee Salary</li>
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
                                            <th>Employee</th>
                                            <th>Total Salary</th>
                                            <th>Total Paid Salary</th>
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
                    <h4 class="modal-title">Add Employee Salary</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('employee-salary-report.store') }}" method="post" id="addform">
                        @csrf
                        @include('admin.reports.employee_salary._form')
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="response">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Employee Salary</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" id="editform">
                        @csrf
                        @method('PATCH')
                        @include('admin.reports.employee_salary._form')
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

            $('#addform').validate({
                rules: {
                    employee_id: {
                        required: true,
                    },
                    total_amount: {
                        required: true,
                    },
                    payment_amount: {
                        required: true,
                    },
                    remaining_amount: {
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
             $('#editform').validate({
                rules: {
                    employee_id: {
                        required: true,
                    },
                    total_amount: {
                        required: true,
                    },
                    payment_amount: {
                        required: true,
                    },
                    remaining_amount: {
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
        $(function() {
            oTable = $('#example1').DataTable({
                processing: true,
                serverSide: true,
                bFilter: true,
                searchable: true,
                bInfo: true,
                paging: true,
                ajax: "{{ route('reports.employee-salary-report') }}",
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
                            return row.employee_id > 0 ? row.employees.name : "";
                        }
                    },
                    {
                        data: null,
                        name: null,
                        render: (row, index) => {
                            return row.employee_id > 0 ? row.employees.salary : "";
                        }
                    },
                    {
                        data: "total_salary",
                        name: "total_salary"
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
                                <a href="javascript:void(0);" onclick="deleteEmployeeSalary(${row.id})" class="btn btn-danger btn-sm" > <i class="fas fa-trash-alt"></i></a>
                            </div>`;
                        }
                    },
                ]
            });
        });
var paid_Salary = 0;
        function deleteEmployeeSalary(id) {
                let deleteUrl = "{{ route('employee-salary-report.destroy', ':employee_salary_report') }}";
                deleteUrl = deleteUrl.replace(":employee_salary_report", id);

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
            let editUrl = "{{ route('employee-salary-report.edit', ':employee_salary_report') }}";
            editUrl = editUrl.replace(":employee_salary_report", id);

            let updateUrl = "{{ route('employee-salary-report.update', ':employee_salary_report') }}";
            updateUrl = updateUrl.replace(":employee_salary_report", id);

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
                    $.each(data.employee_salary, function(key, value) {
                        // Set the value of the corresponding input field based on its name
                        $('input[name="' + key + '"]').val(value);
                        if (key == "payment_date")
                            $('input[name="' + key + '"]').val(moment(value).format("DD-MM-YYYY"));

                        if (key == "employee_id")
                            $('select[name="' + key + '"]').val(value).trigger('change');
                    });
                    paid_Salary = data.employee_salary.total_salary;
                    $(".total_employee_salary").val(data.employee_salary.employees.salary);
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

        $("#employee_id").on("change", function() {
            var employeeId = $(this).val();
            $.ajax({
                url: "{{ route('report.employee-salary.get-employee-salary') }}",
                type: 'post',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: employeeId,
                    date:$("#payment_date").val()
                },
                success: function(data) {
                    console.log("paid_salary",paid_Salary);
                    if(paid_Salary > 0 ){
                        $('input[name="total_salary"]').val(paid_Salary);
                    } else {
                        $(".total_employee_salary").val(data.total_salary);
                        $('input[name="total_salary"]').val(data.total_amount)
                    }

                }
            });
        });

        $('input[name="payment_amount"]').on("keyup", function() {
            console.log($(this).val());
            var paymentAmount = parseFloat($(this).val());
            var totalAmount = $('input[name="total_salary"]').val();
            var remainingAmount = totalAmount - paymentAmount;
            $('input[name="remaining_amount"]').val(remainingAmount)
        });
    </script>
@endsection
