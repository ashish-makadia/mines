@extends('layout.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <a class="btn btn-primary btn-sm" href="#" data-toggle="modal" data-target="#add-category">Add New Asset Category</a>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">Master</li>
                        <li class="breadcrumb-item active">Assets Category</li>
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
                            <table id="category-table" class="table table-bordered table-striped table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th class="text-center">Sr No.</th>
                                        <th>Catagory Name</th>
                                        <th class="text-center">Action</th>
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
<div class="modal" id="add-category">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Category </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('add-assets-category')}}" method="POST" id="addCatagory">
                    @csrf
                    <div class="d-flex w-100 justify-content-between row">
                        <div class="col-md-12 col-12  mb-3">
                            <div class="form-group">
                                <label>Asset Catagory<span class="text-red">*</span></label>
                                <input type="text" class="form-control" placeholder="Add New Assets" name="category_name">
                            </div>
                        </div>
                    </div>
                     <div class="modal-footer a18">
                        <button type="submit" class="btn btn-success btn-sm mt-3">Submit</button>
                        <button type="reset" class="btn btn-warning btn-sm mt-3">Reset</button>
                    </div>
                 
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="edit-category">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Category</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('update-assets-category', ['id' => 'REPLACE_ID']) }}" method="POST" id="editCatagory">
                    @csrf
                    <div class="d-flex w-100 justify-content-between row">
                        <div class="col-md-12 col-12  mb-3">
                            <div class="form-group">
                                <label>Assets Category<span class="text-red">*</span></label>
                                <input type="text" class="form-control" placeholder="Category Name" name="category_name" value="">
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
            ajax: "{{ route('assets-category') }}",
            columns: [ {
                        data: 'DT_RowIndex',
                        className: 'text-center'
                    },
                    {
                        data: 'category_name',
                        render: function (categoryData) {
                        return categoryData; 
                        }
                    },
                    {
                        "data": null,
                        "className": 'text-center',
                        render: function(o) {
                            var deleteUrl = "{{ route('delete-assets-category', ['id' => 'REPLACE_ID']) }}";
                            deleteUrl = deleteUrl.replace('REPLACE_ID', o.id);

                            var element = `<a class="btn btn-info btn-sm edit-category" href="#" data-toggle="modal" data-target="#edit-category" data-id="${o.id}"><i class="fas fa-pencil-alt"></i></a>
                            <a class="btn btn-danger btn-sm" href="${deleteUrl}" title="Delete"><i class="fas fa-trash"></i> </a>`;
                            return element;
                        }
                    },
                    ]
            });

            $('#category-table').on('click', '.edit-category', function () {
                var row = oTable.row($(this).closest('tr')).data();
                populateEditModal(row);
            });

            function populateEditModal(data) {
                $('#edit-category input[name="category_name"]').val(data.category_name);
                var editUrl = "{{ route('update-assets-category', ['id' => 'REPLACE_ID']) }}";
                editUrl = editUrl.replace('REPLACE_ID', data.id);
                $('#edit-category form').attr('action', editUrl);
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

