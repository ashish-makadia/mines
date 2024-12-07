@extends('layout.app')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#response2">Add New
                        Product</a>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item">Product</li>
                        <li class="breadcrumb-item active">List Product</li>
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
                                        <th>Product</th>
                                        <th>Mine Name</th>
                                        <th>Weight</th>
                                        <th>Rate</th>
                                        <th>Amount</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                   

                                </tbody>
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
    <div id="viewdata"></div>
</div>
<div class="modal" id="response1">
    <div id="editdata"></div>
</div>
<div class="modal" id="response2">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add New Product<span class="text-red">*</span></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('add-product')}}" method="post" id="addpoduct">
                    @csrf
                    <div class="d-flex w-100 justify-content-between row">

                        <div class="form-group mb-3 col-md-6 col-8">
                            <label>Product<span class="text-red">*</span></label>
                            <input type="text" name="product" class="form-control" placeholder="Add Product">
                        </div>

                        <div class="form-group mb-3 col-md-6 col-8">
                            <label>Mines Name<span class="text-red">*</span></label>
                            <select name="mines_id" class="form-control select2 a3 ">
                                <option value="">Select Mine</option>
                                @foreach($mines as $mine)
                                        <option value="{{$mine->id}}">{{$mine->mine_name}}</option>
                                    @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3 col-md-6 col-6">
                            <label>Weight<span class="text-red">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span id="basic-icon-default-fullname2" class="input-group-text">
                                        <i class="fa fa-balance-scale" aria-hidden="true"></i></span>
                                </div>
                                <input type="text" name="weight" class="form-control" placeholder="Weight">
                            </div>
                        </div>


                        <div class="form-group mb-3 col-md-6 col-6">
                            <label>Rate</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span id="basic-icon-default-fullname2" class="input-group-text">
                                        <i class="fa fa-money-bill" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input type="number" name="rate" class="form-control" placeholder="Rate">
                            </div>
                        </div>
                        <div class="form-group mb-3 col-md-6 col-6">
                            <label>Amount</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span id="basic-icon-default-fullname2" class="input-group-text">
                                        <i class="fa fa-money-bill" aria-hidden="true"></i></span>
                                </div>
                                <input type="number" name="amount" class="form-control" placeholder="Amount">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer a18">
                        <button type="submit" class="btn btn-success btn-sm">Submit</button>
                        <button type="reset" class="btn btn-warning btn-sm">Reset</button>
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
          
            ajax: "{{ route('product') }}",
            columns: [{
                    "data": 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },

                {
                    data: 'product',
                    name: 'product'
                },
                {
                    data: 'mines_id',
                    name: 'mines_id'
                },
                {
                    data: 'weight',
                    name: 'weight'
                },
                {
                    data: 'rate',
                    name: 'rate'
                },
                {
                    data: 'amount',
                    name: 'amount'
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

    function editproduct(id) {
        $.ajax({
            url: "{{route('edit-product')}}",
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
                $('#response1').modal('show');
            },
        });
    }
</script>   

<script>  
function viewdata(id) {
        $.ajax({
            url: "{{route('view-product')}}",
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
                $('#response').modal('show');
            },
        });
    }
</script>   


@section('other-scripts')
<script>
        $(function () {
            $.validator.setDefaults({
                submitHandler: function () {
                    return true;
                }
            });
            $('#addpoduct').validate({
                rules: {
                    product: {
                        required: true,
                    },
                    mines_id: {
                        required: true,
                    },
                    weight: {
                        required: true,
                    },
                   
                },
                messages: {
                    product: {
                        required: "Please enter a product.",
                    },
                    mines_id: {
                        required: "Please enter a Mine.",
                    },
                    weight: {
                        required: "Please enter a Rate.",
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