<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Edit Employee </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">
            <form action="{{route('employee.update')}}" method="post" id="editform">
             @csrf   <div class="d-flex w-100 justify-content-between row">
                     <input type="hidden" name="editid" id="" value="{{@$data->id}}"> 
                     <div class="mb-3 col-md-12 col-12">
                        <label class="form-group" for="basic-icon-default-fullname">
                            Employee Name
                       </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span id="name" class="input-group-text">
                                  <i class="fa fa-user" aria-hidden="true"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" id="name" name="name" value="{{$data->name}}" aria-describedby="basic-icon-default-fullname2" placeholder="Employee Name" />
                        </div>
                    </div>

                    <div class="mb-3 col-md-6 col-12">
                        <label class="form-label">
                            Mobile Number
                       </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span id="number" class="input-group-text">
                                  <i class="fab fa-whatsapp" aria-hidden="true"></i>
                                </span>
                            </div>
                            <input type="number" class="form-control" id="number" name="number" value="{{$data->number}}" aria-describedby="basic-icon-default-fullname2" placeholder="Employee Number" />
                        </div>
                    </div>


                    <div class="mb-3 col-md-6 col-12">
                        <label class="form-label" for="basic-icon-default-fullname">
                            Email Id
                       </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span id="email" class="input-group-text">
                                  <i class="fa fa-envelope" aria-hidden="true"></i>
                                </span>
                            </div>
                            <input type="email" class="form-control" id="email" name="email" value="{{$data->email}}" aria-describedby="basic-icon-default-fullname2" placeholder="Employee Email" />
                        </div>
                    </div>

                    

                    <div class="col-md-6 col-12 mb-3">
                        <div class="form-group">
                            <span class="text-red">*</span>    <label>Department</label>
                            <select name="depart_id" id="depart_id" class="form-control select a3">
                                <option value="">Select Department</option>
                                
                                @foreach($depar as $i)
                                        <option value="{{$i->id}}"{{  $data->depart_id == $i->id ? 'selected' : '' }}>{{$i->department}}</option>
                                    @endforeach
                            </select>
                           
                        </div>
                    </div>    
                    <div class="col-md-6 col-12 mb-3">
                        <div class="form-group">
                            <span class="text-red">*</span>    <label>Designation</label>
                            <select name="designation_id" id="designation_id" class="form-control select2 a3">
                                <option value="">Select Designation</option>
                                
                                @foreach($desig as $des)
                                <option value="{{$des->id}}"{{  $data->designation_id == $des->id ? 'selected' : '' }}>{{$des->designation}}</option>
                                      
                                    @endforeach
                            </select>
                           
                        </div>
                    </div>  

                  
                    
                    
                    <div class="mb-3 col-md-6 col-12">
                        <label for="exampleInputPassword6">Joining Date</label>
                        <div class="input-group date reservationdate1" id="reservationdate1" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" name="joining_date" value="{{isset($data->joining_date)?date("d-m-Y",strtotime($data->joining_date)):old('joining_date')??date("d-m-Y")}}"  data-target="#reservationdate1" placeholder="Joining Date">
                            <div class="input-group-append" data-target="#reservationdate1" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 col-md-6 col-12">
                        <label for="exampleInputPassword6">Employee Salary</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span id="salary" class="input-group-text">
                                    <i class="fa fa-money-bill-wave-alt"></i>
                            </span>
                            </div>
                            <input type="text" id="salary" name="salary" value="{{$data->salary}}" class="form-control" placeholder="Employee Salary" id="exampleInputPassword7">
                        </div>
                    </div>


                    <div class="mb-3 col-md-6 col-12">
                        <label for="exampleInputPassword6">Employee PF</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span id="pf" class="input-group-text">
                                    <i class="fa fa-money-bill"></i>
                                </span>
                            </div>
                            <input type="text" name="pf" id="pf" value="{{$data->pf}}" class="form-control" placeholder="Employee PF" id="exampleInputPassword7">
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
                
                name: {
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