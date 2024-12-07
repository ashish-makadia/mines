<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Edit Dumper & Machine Asset </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">
            <form action="{{route('dumpermachine-register.update')}}" method="post" id="editform">
             @csrf   <div class="d-flex w-100 justify-content-between row">
                     <input type="hidden" name="editid" id="" value="{{@$data->id}}">
                     <div class="form-group mb-3 col-md-6 col-12">
                        <label> Date</label>
                        <div class="input-group date" id="reservationdate1" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" name="dm_date" value="{{isset($data->dm_date)?date("d-m-Y",strtotime($data->dm_date)):old('dm_date')??date("d-m-Y")}}"  data-target="#reservationdate1" placeholder="Select Date" />
                            <div class="input-group-append" data-target="#reservationdate1" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>



                    <div class="col-md-6 col-6  mb-3">
                        <div class="form-group">
                            <label>Working Assets</label>
                            <select name="asset_id" id="asset_id" class="form-control select2 a3" onChange="getAssets(this.value)">
                             <option value="">Select Assets Type</option>

                             @foreach($ac as $i)
                             <option value="{{$i->id}}"{{  $data->asset_id == $i->id ? 'selected' : '' }}>{{$i->category_name}}</option>

                                 @endforeach

                            </select>
                        </div>
                    </div>
                    <div class="form-group mb-3 col-md-6 col-12">
                        <label>Assets Name</label>
                        <select class="form-control select2 a3 assets_name"  onChange="getAssetsData(this.value)" name="assets_name" id="assets_name" required>
                            <option value="" selected>Select Assets</option>
                        </select>
                    </div>
                    <div class="mb-3 col-md-6 col-12">
                        <label for="exampleInputPassword1">Start</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span id="basic-icon-default-fullname2" class="input-group-text">
                                    <i class="fa fa-plus"></i>
                                </span>
                            </div>
                            <input type="number" name="start"  value="{{$data->start}}" class="form-control" placeholder="Enter Start Value">
                        </div>
                    </div>

                    <div class="mb-3 col-md-6 col-12">
                        <label for="exampleInputPassword1">Off</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span id="basic-icon-default-fullname2" class="input-group-text">
                                    <i class="fa fa-plus"></i>
                                </span>
                            </div>
                            <input type="number" name="off"  value="{{$data->off}}" class="form-control" placeholder="Enter Off Value">
                        </div>
                    </div>

                    <div class="mb-3 col-md-6 col-12">
                        <label for="exampleInputPassword1">Time</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span id="basic-icon-default-fullname2" class="input-group-text">
                                    <i class="fa fa-plus"></i>
                                </span>
                            </div>
                            <input type="number" name="time"  value="{{$data->time}}" class="form-control" placeholder="Enter Time">
                        </div>
                    </div>

                    <div class="mb-3 col-md-6 col-12">
                        <label for="exampleInputPassword1">Diesel</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span id="basic-icon-default-fullname2" class="input-group-text">
                                    <i class="fa fa-plus"></i>
                                </span>
                            </div>
                            <input type="number" name="diesel" value="{{$data->diesel}}" class="form-control" placeholder="Enter Diesel in litre">
                        </div>
                    </div>



                    <div class="mb-3 col-md-12 col-12 mb-3">
                        <label class="form-label" for="basic-icon-default-message"><i class="fa fa-message"></i>Remark
                    </label>
                        <textarea id="basic-icon-default-message" name="remark" class="form-control" aria-describedby="basic-icon-default-message2" placeholder="Add Remark">{{$data->remark}}</textarea>
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
        getAssets("{{$data->asset_id}}","{{$data->assets_name}}");
        $('.select2').select2({ theme: 'bootstrap4'});
       
        $.validator.setDefaults({
            submitHandler: function (form) {
                // Your AJAX code to submit the form can go here
                form.submit();
            }
        });

        $('#editform').validate({
            rules: {

                start: {
                    required: true,
                },

            },
            messages: {
                name: {
                    required: "Please Enter a Employee Name.",
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
