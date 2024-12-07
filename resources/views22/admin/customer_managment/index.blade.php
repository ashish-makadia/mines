@extends('layout.app')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#response2">Add New Customer</a>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item">Customer Management</li>
                        <li class="breadcrumb-item">Customer List</li>

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
                                        <th>Customer Name</th>
                                        <th>Mobile Number</th>
                                        <th>Email Id</th>
                                        <th>City</th>
                                        <th>State</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>

                    </div>
                    <!-- /.card -->
                </div>

            </div>
        </div>
    </section>
</div>
<div class="modal fade" id="response">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Customer Edit</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="{{route('update-customer-managment', ['id' => 'REPLACE_ID'])}}" method="POST" id="edit-customer-form">
                    @csrf <div class="d-flex w-100 justify-content-between row">


                        <div class="form-group mb-3 col-md-6 col-12">
                            <label class="form-label" for="basic-icon-default-fullname">
                                Customer Name
                                <span class="text-red">*</span> </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span id="basic-icon-default-fullname2" class="input-group-text">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input type="text" name="customer_name" class="form-control" id="basic-icon-default-fullname" aria-describedby="basic-icon-default-fullname2" placeholder="Pinal Kumari"  />
                            </div>
                        </div>

                        <div class="form-group mb-3 col-md-6 col-6">
                            <label class="form-label" for="basic-icon-default-fullname">
                                Mobile Number
                                <span class="text-red">*</span> </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span id="basic-icon-default-fullname2" class="input-group-text">
                                        <i class="fab fa-whatsapp" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input type="number" name="customer_number" class="form-control" id="basic-icon-default-fullname" aria-describedby="basic-icon-default-fullname2" placeholder="123456789"  />
                            </div>
                            @error('customer_number')
                                        <div class="text-red">{{ $message }}</div>
                                        @enderror
                        </div>

                        <div class="form-group mb-3 col-md-6 col-6">
                            <label class="form-label" for="basic-icon-default-fullname">
                                Email Id
                                <span class="text-red">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span id="basic-icon-default-fullname2" class="input-group-text">
                                        <i class="fa fa-envelope" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input type="email" name="customer_email" class="form-control" id="basic-icon-default-fullname" aria-describedby="basic-icon-default-fullname2" placeholder="pinal123@gmail.com"  />
                            </div>
                            @error('customer_email')
                                        <div class="text-red">{{ $message }}</div>
                                        @enderror
                        </div>


                        <div class="form-group mb-3 col-md-6 col-6">
                            <label for="exampleInputPassword6">Gst Number<span class="text-red">*</span></label>
                            <input type="text" name="customer_gst" class="form-control" placeholder="24AAAAA0000A1Z5" >
                            @error('customer_gst')
                                        <div class="text-red">{{ $message }}</div>
                                        @enderror
                        </div>



                        <div class="form-group mb-3 col-md-4 col-6">
                            <label for="exampleInputPassword6">Pan Number<span class="text-red">*</span></label>
                            <input type="text" name="customer_pan" class="form-control" placeholder="ABCD1234A" >
                            @error('customer_pan')
                                        <div class="text-red">{{ $message }}</div>
                                        @enderror

                        </div>



                        <div class="form-group mb-3 col-md-4 col-12">
                            <label>State<span class="text-red">*</span></label>

                            <select class="form-control select2 a3" id="state-dd1" name="state_id" >
                                <option value="">Select State</option>
                                @foreach($states as $data)
                                <option value="{{$data->id}}">{{$data->name}}</option>

                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3 col-md-4 col-12">
                            <label>City<span class="text-red">*</span></label>

                            <select class="form-control select2 a3" id="city-dd1" name="city_id" >

                            </select>
                            </select>
                        </div>

                        <div class="mb-3 col-md-12 col-12">
                            <label for="exampleInputPassword6">Address</label>
                            <textarea class="form-control" name="customer_addr" placeholder="abc complex nr. pani taki nava vadej" rows="3"></textarea>
                        </div>


                        <div class="form-group mb-3 col-md-6 col-6">
                            <label for="exampleInputPassword6">Pin Code<span class="text-red">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span id="basic-icon-default-fullname2" class="input-group-text">
                                        <i class="fa fa-map-pin" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input type="number" name="customer_pin" maxlength="6" minlength="6" class="form-control" placeholder="374123" >
                            </div>
                        </div>

                        <div class="form-group mb-3 col-md-6 col-6">
                            <label>Credit Days<span class="text-red">*</span></label>
                            <select name="credit_days" class="form-control select2 a3 " val="" >
                                <option>Select Days</option>
                                @foreach($days as $day)
                                <option value="{{$day->days}}">{{$day->days}}</option>

                                @endforeach
                            </select>
                        </div>


                    </div>
                    <div class="modal-footer a18">
                        <button type="submit" class="btn btn-success btn-sm">Submit</a>


                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="response1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">View Customer</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <table class="table">
                    <tr>
                        <td><strong>Customer Name:</strong><span id="customer_name"></span> </td>
                        <td><strong>Mobile Number:</strong> <span id="customer_number"></span></td>
                    </tr>
                    <tr>
                        <td><strong>Email Id:</strong><span id="customer_email"></span></td>
                        <td><strong>Gst Number:</strong><span id="customer_gst"></span></td>
                    </tr>
                    <tr>
                        <td><strong>Pan Number:</strong><span id="customer_pan"></span></td>
                        <td><strong>City:</strong><span id="city_id"></span></td>
                    </tr>
                    <tr>
                        <td><strong>State:</strong><span id="state_id"></span></td>
                        <td><strong>Address:</strong><span id="customer_addr"></span></td>
                    </tr>
                    <tr>
                        <td><strong>Pin Code:</strong><span id="customer_pin"></span></td>
                        <td><strong>Credit Days:</strong><span id="credit_days"></span></td>
                    </tr>
                </table>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="response2">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add New Customer</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('add-customer-managment')}}" method="post" id="addcustomer">
                    @csrf
                     <div class="d-flex w-100 justify-content-between row">


                        <div class=" form-group  mb-3 col-md-6 col-12">
                            <label class="form-label" for="basic-icon-default-fullname">
                                Customer Name
                                <span class="text-red">*</span> </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span id="basic-icon-default-fullname2" class="input-group-text">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input type="text" name="customer_name" value="{{old('customer_name')}}" class="form-control" value="" placeholder="Customer Name">
                            </div>
                        </div>

                        <div class="form-group  mb-3 col-md-6 col-12">
                            <label class="form-label" for="basic-icon-default-fullname">
                                Mobile Number
                                <span class="text-red">*</span> </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span id="basic-icon-default-fullname2" class="input-group-text">
                                        <i class="fab fa-whatsapp" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input type="number" name="customer_number" value="{{old('customer_number')}}" class="form-control" id="basic-icon-default-fullname" aria-describedby="basic-icon-default-fullname2" placeholder="Customer Number" />
                            </div>
                            @error('customer_number')
                                        <div class="text-red">{{ $message }}</div>
                                        @enderror
                        </div>

                        <div class=" form-group mb-3 col-md-6 col-12">
                            <label class="form-label" for="basic-icon-default-fullname">
                                Email Id
                                <span class="text-red">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span id="basic-icon-default-fullname2" class="input-group-text">
                                        <i class="fa fa-envelope" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input type="email" name="customer_email" value="{{old('customer_email')}}" class="form-control" id="basic-icon-default-fullname" aria-describedby="basic-icon-default-fullname2" placeholder="Customer Email" />
                            </div>
                            @error('customer_email')
                                        <div class="text-red">{{ $message }}</div>
                                        @enderror
                        </div>

                        <div class=" form-group mb-3 col-md-6 col-6">
                            <label for="exampleInputPassword6">Gst Number<span class="text-red">*</span></label>
                            <input type="text" name="customer_gst" class="form-control" value="{{old('customer_gst')}}" placeholder="Ex.24AAAA0000A1Z11">
                            @error('customer_gst')
                                        <div class="text-red">{{ $message }}</div>
                                        @enderror
                        </div>



                        <div class=" form-group mb-3 col-md-4 col-6">
                            <label for="exampleInputPassword6">Pan Number<span class="text-red">*</span></label>
                            <input type="text" name="customer_pan" class="form-control" value="{{old('customer_pan')}}" placeholder="Ex.ABCD1234A" id="customer_pan">
                            @error('customer_pan')
                                        <div class="text-red">{{ $message }}</div>
                                        @enderror
                        </div>

                        <div class="form-group  mb-3  col-md-4 col-6">
                            <label>State<span class="text-red">*</span></label>

                            <select class="form-control select2 a3" id="state-dd" name="state_id">
                                <option value="">Select State</option>
                                @foreach($states as $data)
                                <option value="{{$data->id}}" {{ old('state_id') == $data->id ? 'selected' : '' }}>{{$data->name}}</option>

                                @endforeach
                            </select>
                        </div>
                        <div class="form-group  mb-3  col-md-4 col-6">

                            <label>City <span class="text-red">*</span> </label>


                            <select class="form-control select2 a3" id="city-dd" name="city_id">

                            </select>
                        </div>


                        <div class="mb-3 col-md-12 col-12">
                            <label for="exampleInputPassword6">Address</label>
                            <textarea name="customer_addr" value="{{old('customer_addr')}}" class="form-control"  placeholder="Address" rows="3"></textarea>
                        </div>


                        <div class="form-group mb-3 col-md-6 col-6">

                            <label for="exampleInputPassword6">Pin Code <span class="text-red">*</span> </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span id="basic-icon-default-fullname2" class="input-group-text">
                                        <i class="fa fa-map-pin" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input type="number" name="customer_pin"  value="{{old('customer_pin')}}" maxlength="6" minlength="6" class="form-control" placeholder="Ex.123456 " required>
                            </div>
                        </div>

                        <div class="form-group mb-3 col-md-6 col-6">

                            <label>Credit Days <span class="text-red">*</span> </label>
                            <select name="credit_days" class="form-control select2 a3">
                                <option value="">Select Credit Days </option>
                                @foreach($days as $day)
                                <option value="{{$day->days}}" {{ old('credit_days') == $day->days ? 'selected' : '' }}>{{$day->days}}</option>

                                @endforeach
                            </select>
                        </div>


                    </div>
                    <div class="modal-footer a18">
                        <button type="submit" class="btn btn-success btn-sm mt-3 ">Submit</button>
                        <button type="reset " class="btn btn-warning btn-sm mt-3 ">Reset</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {

        $('#state-dd').on('change', function() {
            var idState = this.value;
            $("#city-dd").html('');
            $.ajax({
                url: "{{url('get-state-by-cites')}}",
                type: "POST",
                data: {
                    state_id: idState,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function(res) {
                    $('#city-dd').html('<option value="">Select City</option>');
                    $.each(res.cities, function(key, value) {
                        $("#city-dd").append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                }
            });



        });
    });
</script>
<script>
    $(document).ready(function() {

        $('#state-dd1').on('change', function() {
            var idState = this.value;
            $("#city-dd1").html('');
            $.ajax({
                url: "{{url('get-state-by-cites')}}",
                type: "POST",
                data: {
                    state_id: idState,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function(res) {
                    $('#city-dd1').html('<option value="">Select City</option>');
                    $.each(res.cities, function(key, value) {
                        $("#city-dd1").append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                }
            });



        });
    });
</script>

@endsection
@section('other-scripts')
<script>
    $(function() {
        oTable = $('#example1').DataTable({
            paging: true,
            lengthChange: true,
            searching: true,
            ordering: true,
            info: true,
            autoWidth: false,
            responsive: true,
            ajax: "{{ route('customer-managment') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    className: 'text-center'
                },
                {
                    data: 'customer_name',
                },
                {
                    data: 'customer_number',
                },
                {
                    data: 'customer_email',
                },
                {
                    data: 'city_name',
                },
                {
                    data: 'state_name'
                },
                {
                    "data": null,
                    "className": 'text-center',
                    render: function(o) {
                        var deleteUrl = "{{ route('delete-customer-managment', ['id' => 'REPLACE_ID']) }}";
                        deleteUrl = deleteUrl.replace('REPLACE_ID', o.id);

                        var element = `<a class="btn btn-primary btn-sm" href="#"  data-toggle="modal" data-target="#response1" title="View">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a class="btn btn-info btn-sm" href="#" title="Edit" data-id="${o.id}" data-toggle="modal" data-target="#response">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>

                                                    <a class="btn btn-danger btn-sm" href="${deleteUrl}" title="Delete" onclick="deleteactivity(${o.id})">
                                                        <i class="fas fa-trash"></i>
                                                    </a>`;
                        return element;
                    }
                },
            ]
        });
        $('#example1').on('click', '.btn-info', function() {
            var row = oTable.row($(this).closest('tr')).data();
            populateEditModal(row);
        });

        function populateEditModal(data) {
            $('#response input[name="customer_name"]').val(data.customer_name);
            $('#response input[name="customer_number"]').val(data.customer_number);
            $('#response input[name="customer_email"]').val(data.customer_email);
            $('#response input[name="customer_gst"]').val(data.customer_gst);
            $('#response input[name="customer_pan"]').val(data.customer_pan);
            $('#response select[name="state_id"]').val(data.state_id).trigger('change');
            $('#response select[name="city_id"]').val(data.city_name).trigger('change');
            $('#response textarea[name="customer_addr"]').val(data.customer_addr);
            $('#response input[name="customer_pin"]').val(data.customer_pin);
            $('#response select[name="credit_days"]').val(data.credit_days).trigger('change');

            var editUrl = "{{ route('update-customer-managment', ['id' => 'REPLACE_ID']) }}";
            editUrl = editUrl.replace('REPLACE_ID', data.id);
            $('#edit-customer-form').attr('action', editUrl);
        }

        $('#example1').on('click', '.btn-primary', function() {
            var row = oTable.row($(this).closest('tr')).data();
            populateViewModal(row);
        });

        function populateViewModal(data) {
            $('#customer_name').text(data.customer_name);
            $('#customer_number').text(data.customer_number);
            $('#customer_email').text(data.customer_email);
            $('#customer_gst').text(data.customer_gst);
            $('#customer_pan').text(data.customer_pan);
            $('#city_id').text(data.city_name);
            $('#state_id').text(data.state_name);
            $('#customer_addr').text(data.customer_addr);
            $('#customer_pin').text(data.customer_pin);
            $('#credit_days').text(data.credit_days);
        }
    });
</script>


<script>
    $(function() {
        $.validator.setDefaults({
            submitHandler: function() {
                return true;
            }
        });
        $('#addcustomer').validate({
            rules: {
                customer_number: {
                    required: true,

                },
                customer_name: {
                    required: true,
                },

                customer_email: {
                    required: true,
                },
                customer_gst: {
                    required: true,
                },

                customer_pan: {
                    required: true,
                },

                state_id: {
                    required: true,
                },

                city_id: {
                    required: true,
                },
                customer_pin: {
                    required: true,
                },
                credit_days: {
                    required: true,
                },


            },
            messages: {
                customer_number: {
                    required: "Please enter a Customer Number.",

                },
                customer_name: {
                    required: "Please enter a Customer Name.",
                },

                customer_email: {
                    required: "Please enter a Customer Email.",
                },
                customer_gst: {
                    required: "Please enter a Customer GST Number.",
                },
                customer_pan: {
                    required: "Please enter a Customer Pan Number.",
                },
                state_id: {
                    required: "Please enter a  State.",
                },
                city_id: {
                    required: "Please enter a  City.",
                },
                customer_pin: {
                    required: "Please enter a  Pin Code.",
                },
                credit_days: {
                    required: "Please enter a Credit Days.",
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
        $('#edit-customer-form').validate({
            rules: {
                customer_number: {
                    required: true,

                },
                customer_name: {
                    required: true,
                },

                customer_email: {
                    required: true,
                },
                customer_gst: {
                    required: true,
                },

                customer_pan: {
                    required: true,
                },

                state_id: {
                    required: true,
                },

                city_id: {
                    required: true,
                },
                customer_pin: {
                    required: true,
                },
                credit_days: {
                    required: true,
                },


            },
            messages: {
                customer_number: {
                    required: "Please enter a Customer Number.",

                },
                customer_name: {
                    required: "Please enter a Customer Name.",
                },

                customer_email: {
                    required: "Please enter a Customer Email.",
                },
                customer_gst: {
                    required: "Please enter a Customer GST Number.",
                },
                customer_pan: {
                    required: "Please enter a Customer Pan Number.",
                },
                state_id: {
                    required: "Please enter a  State.",
                },
                city_id: {
                    required: "Please enter a  City.",
                },
                customer_pin: {
                    required: "Please enter a  Pin Code.",
                },
                credit_days: {
                    required: "Please enter a Credit Days.",
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