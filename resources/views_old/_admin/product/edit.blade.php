<div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Product</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('update-product')}}" method="post" id="editproduct">
                    @csrf

                    <input type="hidden" value="{{$product->id}}" name="editid">
                    <div class="d-flex w-100 justify-content-between row">
                        <div class="form-group mb-3 col-md-6 col-8">
                            <label>Product<span class="text-red">*</span></label>
                            <input type="text" name="product" value="{{$product->product}}" class="form-control" placeholder="Marble">
                        </div>

                        <div class="form-group mb-3 col-md-6 col-8">
                            <label>Mines Name<span class="text-red">*</span></label>
                            <select name="mines_id" class="form-control select2 a3 ">
                                <option value="">Select Mine</option>
                                @foreach($mines as $mine)
                                        <option value="{{$mine->id}}"{{ $mine->id == $product->mines_id ? 'selected' : '' }}>{{$mine->mine_name}}</option>
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
                                <input type="text"  name="weight" value="{{$product->weight}}" class="form-control" placeholder="3961 TON">
                            </div>
                        </div>


                        <div class="form-group mb-3 col-md-6 col-6">
                            <label>Rate<span class="text-red">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span id="basic-icon-default-fullname2" class="input-group-text">
                                        <i class="fa fa-money-bill" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input type="number" name="rate" value="{{$product->rate}}" class="form-control" placeholder="610/-">
                            </div>
                        </div>

                        <div class="form-group mb-3 col-md-6 col-6">
                            <label>Amount<span class="text-red">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span id="basic-icon-default-fullname2" class="input-group-text">
                                        <i class="fa fa-money-bill" aria-hidden="true"></i></span>
                                </div>
                                <input type="number" name="amount"  value="{{$product->amount}}" class="form-control" placeholder="24,16,210/-">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer a18">
                        <button class="btn btn-success btn-sm" type="submit">Submit</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script>
        $(function () {
            $.validator.setDefaults({
                submitHandler: function () {
                    return true;
                }
            });
            $('#editproduct').validate({
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
                    weight: {
                        required: true,
                    },
                    rate: {
                        required: true,
                    },

                    amount: {
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

                    rate: {
                        required: "Please enter a Rate.",
                    },
                    amount: {
                        required: "Please enter a Amount.",
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