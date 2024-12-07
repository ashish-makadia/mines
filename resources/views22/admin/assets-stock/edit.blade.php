<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Edit Assign Assets</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="{{route('update-assign-asset')}}" method="post" enctype="multipart/form-data" id="editassign">
                @csrf
                <input type="hidden" name="editid" value="{{@$assign_assets->id}}">
                <div class="d-flex w-100 justify-content-between row">
                    <div class="col-md-6 col-6  mb-3">
                        <div class="form-group">
                            <span class="text-red">*</span>   <label>Mines</label>
                            <select name="mine_id" class="form-control select a3">
                                <option value="">Select Mine</option>
                                @foreach($mines as $mine)
                                <option value="{{$mine->id}}"{{  $assign_assets->mine_id == $mine->id ? 'selected' : '' }}>{{$mine->mine_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6 col-6  mb-3">
                        <div class="form-group">
                            <span class="text-red">*</span> <label>Assets Catagory</label>
                            <select class="form-control select a3" name="asset_category_id">
                              <option  value="">Assets Select</option>
                              @foreach($assets as $asset)
                              <option value="{{$asset->id}}"{{  $assign_assets->asset_category_id == $asset->id ? 'selected' : '' }}>{{$asset->category_name}}</option>
                              @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-12 col-12  mb-3">
                        <div class="form-group">
                            <span class="text-red">*</span>  <label>Multipal Machine</label>
                            <select class="select a3 form-control" name='machine_id[]' multiple="multiple" data-placeholder="Machine Select">
                                @foreach($machines as $machine)
                                <option value="{{$machine->id}}"{{ in_array($machine->id, explode(',', $assign_assets->machine_id)) ? ' selected' : '' }}>{{$machine->machine_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer a18">
                  <button type="submit" class="btn btn-success btn-sm mt-3 ">Submit</button>
                    <button type="reset" class="btn btn-warning btn-sm mt-3">Reset</button>
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

        $('#editassign').validate({
            rules: {
                mine_id: {
                    required: true,
                },
                asset_category_id: {
                    required: true,
                },
                'machine_id[]': {
                    required: true,
                    minlength: 1, // At least one machine must be selected
                },
            },
            messages: {
                mine_id: {
                    required: "Please select a mine.",
                },
                asset_category_id: {
                    required: "Please select an asset category.",
                },
                'machine_id[]': {
                    required: "Please select at least one machine.",
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