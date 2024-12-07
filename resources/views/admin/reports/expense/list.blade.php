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
                                        <th>Sr No.</th>
                                        <th>Invoice Date</th>
                                        <th>Invoice No</th>
                                        <th>Category</th>
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
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Expense</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form method="post" enctype="multipart/form-data" id="editform">
                    @csrf
                    @method('PATCH')
                    @include("admin.reports.expense._form")
                    <div class="modal-footer a18">
                        <button class="btn btn-success btn-sm" type="submit">Submit</button>
                        <button type="reset " class="btn btn-warning btn-sm ">Reset</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
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
                <form action="{{route('reports.expense-report')}}" method="post" enctype="multipart/form-data" id="addexpense">
                    @csrf
                    @include("admin.reports.expense._form")
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

@section('other-scripts')
<script>
    var oTable;
      $(function() {

 oTable = $('#example1').DataTable({
    processing: true,
    serverSide: true,
    bFilter: true,
    bInfo: true,
    paging: true,

    ajax: "{{ route('reports.expense-report') }}",
    columns: [{
            "data": 'DT_RowIndex',
            orderable: false,
            searchable: false
        },
        {
            data: 'invoice_date',
            name: 'invoice_date'
        },

        {
            data: 'invoice_no',
            name: 'invoice_no'
        },

        {
            data: null,
            name: null,
            render: (row, index) => {
                return row.category_id > 0 ? row.categories.exp_cat : "";
            }
        },
        {
            data: 'total',
            name: 'total'
        },
        {
            data: null,
            name: null,
            render: (row, index) => {
                url = `{{ asset('public/attachment/')}}`;
                url = url+row.file;
                return `<a href="${url}" target="_blank">Click Here</a>`;
            }
        },

        {
            data: null,
            name: null,
            orderable: false,
            searchable: false,
            render: (row, index) => {
                return `<div class="d-flex action-btn-div">
                    <a  href="javascript:void(0);" class="btn btn-info btn-sm"  onclick="editexpense(${row.id})"> <i class="fas fa-pencil-alt"></i></a>
                    &nbsp
                    <a href="javascript:void(0);" onclick="deleteExpense(${row.id})" class="btn btn-danger btn-sm" > <i class="fas fa-trash-alt"></i></a>
                </div>`;
            }
        },
    ]
});

});

function editexpense(id) {
    let editUrl = "{{ route('expense-report.edit', ':expense_report') }}";
    editUrl = editUrl.replace(":expense_report", id);
    let updateUrl = "{{ route('expense-report.update', ':expense_report') }}";
            updateUrl = updateUrl.replace(":expense_report", id);

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
            $.each(data.expense_report, function(key, value) {
                    // Set the value of the corresponding input field based on its name
                    if(key != "file"){
                        $('input[name="' + key + '"]').val(value);
                        if (key == "invoice_date")
                            $('input[name="' + key + '"]').val(moment(value).format("DD-MM-YYYY"));
                        if (key == "staff_id" || key == "category_id")
                            $('select[name="' + key + '"]').val(value).trigger('change');
                    }
                });
            $('#response').modal('show');

            $('.select').select2({
                theme: 'bootstrap4'
            });
        },
    });
}

function deleteExpense(id) {
                let deleteUrl = "{{ route('expense-report.destroy', ':expense_report') }}";
                deleteUrl = deleteUrl.replace(":expense_report", id);

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


                total: {
                    required: true,
                },
                
                 cost: {
                    required: true,
                },

 tax: {
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
        
         $('#editform').validate({
            rules: {
                expense_date: {
                    required: true,
                },
                category_id: {
                    required: true,
                },
                total: {
                    required: true,
                },
                 cost: {
                    required: true,
                },

 tax: {
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
    $('input[name="tax"]').on("keyup", function() {
            // var tax = parseFloat($(this).val());
            // var cost = $('input[name="cost"]').val();
            // var taxAmount = (cost*tax)/100;
            // var totalAmount = parseFloat(taxAmount)+parseFloat(cost)
            // $('input[name="total"]').val(totalAmount)
            
             var tax =$(this).val();
            var cost = parseFloat($(this).closest("form").find('input[name="cost"]').val());;
            console.log(tax + "  jjj " + cost,"  ",$(this).val(),"  dsfsd",$('input[name="cost"]'));
            var taxAmount = (cost * tax) / 100;
            console.log("totalAmount  " + totalAmount);
            var totalAmount = parseFloat(taxAmount) + parseFloat(cost)
            console.log("taxAmount: " + taxAmount, "totalAmount  " + totalAmount);
            $(this).closest("form").find('input[name="total"]').val(totalAmount)
        });
</script>

@endsection
