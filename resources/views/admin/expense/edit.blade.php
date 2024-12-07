<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Expense Edit</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">
            <form action="{{route('update-expense')}}" method="post" id="editexpense" enctype="multipart/form-data">
                @csrf

            <input type="hidden" name="editid" value="{{$data->id}}" id="">
                <div class="d-flex w-100 justify-content-between row">
                    <div class="form-group mb-3 col-md-6 col-6">
                        <label class="form-label" for="basic-icon-default-fullname">
                            Date
                            <span class="text-red">*</span></label>
                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" name="expense_date" value="{{date('d-m-Y', strtotime($data->expense_date)) }}" data-target="#reservationdate"  />
                            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>


                    <div class="form-group mb-3 col-md-6 col-6">
                        <label class="form-label" for="basic-icon-default-company">Category <span class="text-red">*</span></label>
                        <select name="category_id" id="" class="form-control  select a3">
                            <option value="">Select Expense</option>
                            @foreach($expensecategorys as $expensecategory)
                            <option value="{{$expensecategory->id}}" {{ $expensecategory->id == $data->category_id ? 'selected' : '' }}>{{$expensecategory->exp_cat}}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="form-group mb-3 col-md-6 col-6">
                        <label class="form-label" for="basic-icon-default-state">Amount <span class="text-red">*</span></label>
                        <input type="text" name="amount" value="{{$data->amount}}" class="form-control" placeholder="2,00,00/-">
                    </div>


                    <div class="form-group mb-3 col-md-6 col-6">
                        <label>Attachment</label>
                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                            <input type="file" name="file" />
                        </div>
                    </div>
                    <div class="mb-3 col-md-12 col-12">
                        <label class="form-label" for="basic-icon-default-email">Details</label>
                        <textarea name="details" id="" cols="30" rows="5" placeholder="Enter Your Expense Details" class="form-control">{{$data->details}}</textarea>
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
    $(function() {
        $.validator.setDefaults({
            submitHandler: function() {
                return true;
            }
        });
        $('#editexpense').validate({
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