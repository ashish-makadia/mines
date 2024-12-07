<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Edit Volume</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">
            <form action="{{route('volume.update')}}" method="post" id="editform">
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
                        </span>     <span class="text-red">*</span>    <label>Volume</label>
                            <input type="text" name="volume" class="form-control" placeholder="Volume" value="{{$data->volume}}">
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
                volume: {
                    required: true,
                },
            
            },
            messages: {
                // designation: {
                //     required: "Please Enter a Designation.",
                // },
                volume: {
                    required: "Please Enter a Volume.",
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