<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Edit Designation Department</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">
            <form action="{{route('update-department')}}" method="post" id="editform">
             @csrf   <div class="d-flex w-100 justify-content-between row">
                     <input type="hidden" name="editid" id="" value="{{@$data->id}}"> 
                    {{-- <div class="col-md-12 col-12  mb-3">
                        <div class="form-group">
                        </span>     <span class="text-red">*</span> <label>Designation</label>
                            <input type="text" name="designation" class="form-control" placeholder="Manegar" value="{{$data->designation}}">
                        </div>
                    </div> --}}

                    <div class="col-md-12 col-12  mb-3">
                        <div class="form-group">
                        </span>     <span class="text-red">*</span>    <label>Department</label>
                            <input type="text" name="department" class="form-control" placeholder="Account" value="{{$data->department}}">
                        </div>
                    </div>
                </div>
                <div class="modal-footer a18">
                 <button type="submit" class="btn btn-success btn-sm" >Submit</button>
                </div>
            </form>

        </div>
    </div>
</div>
<script>
    $(function () {
        $.validator.setDefaults({
            submitHandler: function (form) {
                // Your AJAX code to submit the form can go here
                form.submit();
            }
        });

        $('#editform').validate({
            rules: {
                // designation: {
                //     required: true,
                // },
                department: {
                    required: true,
                },
            
            },
            messages: {
                // designation: {
                //     required: "Please Enter a Designation.",
                // },
                department: {
                    required: "Please Enter a Department.",
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