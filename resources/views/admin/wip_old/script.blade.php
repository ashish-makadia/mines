<script type="text/javascript">
    var currentStep = "{{ isset($wip->current_step)?$wip->current_step:1 }}";
    console.log("currentStep:: ",currentStep);
        $(function() {
            setStep(currentStep,"{{ isset($wip->id)?$wip->id:0 }}");
                $('#step1-form').validate({
                rules: {
                    wp_no: {
                        required: true,
                    },
                    target: {
                        required:true
                    },
                    quc_id: {
                        required: true,
                    },
                    no_of_days: {
                        required: true,
                    },
                    incharge_id: {
                        required: true,
                    },
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                    element.closest('.form-control').append(error);
                    element.closest('.input-group').append(error);

                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });

            $('#step2-form').validate({
                rules: {
                    no_of_pieces: {
                        required: true,
                    },
                    current_date: {
                        required: true
                    },
                    'size_of_pic[]': {
                        required: true,
                        // other rules like minlength, maxlength, etc.
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                    element.closest('.form-control').append(error);
                    element.closest('.input-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });


            $('#step3-form').validate({
                rules: {
                    finish_good: {
                        required: true,
                    },
                    finished_current_date: {
                        required: true
                    },
                    waste_quantity: {
                        required: true
                    },
                    waste_quc_id: {
                        required: true
                    },
                    waste_uploaded_file: {
                        required: true
                    },
                    luffers_quantity: {
                        required: true
                    },
                    luffers_quc_id: {
                        required: true
                    },
                    luffers_uploaded_file: {
                        required: true
                    },
                    'height[]': {
                        required: true,
                    },
                    'weight[]': {
                        required: true,
                    },
                    'gunfoot[]': {
                        required: true,
                    },
                    'width[]': {
                        required: true,
                    },
                    'no_of_piece[]': {
                        required: true,
                    },
                    'piece_file[]': {
                        required: true,
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                    element.closest('.form-control').append(error);
                    element.closest('.input-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });

            // if($('.bs-stepper').length > 0){
            //     console.log($('.bs-stepper'));
            //     var stepper = new Stepper($('.bs-stepper')[0]);
            // }

            $('.row-container-step2').on('click', '.add-icon-step2', function(e) {
                e.preventDefault();
                // Create the HTML for the new row
                var newRow = $('<div class="row">\
                            <div class="mb-3 col-md-3 col-12">\
                                <div class="input-group">\
                                    <div class="input-group-prepend">\
                                        <span id="basic-icon-default-fullname2" class="input-group-text">\
                                            <i class="fa fa-list-ol" aria-hidden="true"></i>\
                                        </span>\
                                    </div>\
                                    <input type="text" name="size_of_pic[]" class="form-control" placeholder="1 Size of pieces" id="exampleInputPassword1">\
                                </div>\
                            </div>\
                            <div class="mb-3 col-md-4 col-12">\
                                <div class="custom-file col-md-12 mr-2">\
                                    <input type="file" name="pic_image[]">\
                                </div>\
                            </div>\
                            <div class="mb-3 col-md-4 col-12">\
                                <a class="btn btn-danger btn-sm remove-icon-step2" href="#">\
                                    <i class="fas fa-trash"></i>\
                                </a>\
                            </div>\
                        </div>');

                // Append the new row to the container
                $('.row-container-step2').append(newRow);
                $("input[name='size_of_pic[]']").each(function() {
                    $(this).rules('add', {
                        required: true,
                        // other rules
                        messages: {
                            required: "This field is required",
                            // other messages
                        }
                    });
                });
            });

            // Optionally, handle the removal of rows
            $('.row-container-step2').on('click', '.remove-icon-step2', function(e) {
                e.preventDefault();

                // Remove the row
                $(this).closest('.row').remove();
            });

            $('.row-container-step3').on('click', '.add-icon-step3', function(e) {
                e.preventDefault();
                // Create the HTML for the new row
                var newRow = $(' <div class="row">\
                        <div class="form-group mb-3 col-md-1 col-12">\
                            <label for="exampleInputHeight">Height</label>\
                            <input type="number"  name="height[]" class="form-control" id="exampleInputheights" placeholder="Enter Height">\
                        </div>\
                        <div class="form-group mb-3 col-md-1 col-12">\
                            <label for="exampleInputWeight">Weight</label>\
                            <input type="number" name="weight[]" class="form-control" id="exampleInputWeight" placeholder="Enter Weight">\
                        </div>\
                        <div class="form-group mb-3 col-md-2 col-12">\
                            <label for="exampleInputWidth">Width</label>\
                            <input type="number" name="width[]" class="form-control" id="exampleInputWidth" placeholder="Enter Width">\
                        </div>\
                        <div class="form-group mb-3 col-md-2 col-12">\
                            <label for="exampleInputGunfoot">Gunfoot</label>\
                            <input type="number" name="gunfoot[]" class="form-control" id="exampleInputGunfoot" placeholder="Enter Gunfoot">\
                        </div>\
                        <div class="form-group mb-3 col-md-1 col-12">\
                            <label for="exampleInputpic">No. of Pices</label>\
                            <input type="number" name="no_of_pieces[]" class="form-control" id="exampleInputPic" placeholder="Enter Pices">\
                        </div>\
                        <div class="mb-3 col-md-2 col-12">\
                            <label for="example1">Upload Picture </label>\
                            <div class="custom-file mr-2">\
                                <input type="file" name="uploaded_pic[]" class="custom-file-input" id="customFiles">\
                                <label class="custom-file-label" for="customFile">Upload Pic</label>\
                            </div>\
                        </div>\
                        <div class="mb-3 col-md-1 col-12">\
                        <div>\
                            <label for="example1">&nbsp;</label>\
                                <a class="btn btn-danger btn-sm mt-4 remove-icon-step3" href="#">\
                                    <i class="fas fa-trash"></i>\
                                </a>\
                                </div>\
                            </div>\
                    </div>');
                // Append the new row to the container
                $('.row-container-step3').append(newRow);
            });

            // Optionally, handle the removal of rows
            $('.row-container-step2').on('click', '.remove-icon-step2', function(e) {
                e.preventDefault();

                // Remove the row
                $(this).closest('.row').remove();
            });

            $('.row-container-step3').on('click', '.remove-icon-step3', function(e) {
                e.preventDefault();

                // Remove the row
                $(this).closest('.row').remove();
            });
        });
        $(document).on('submit', '#step1-form', function(event) {
            event.preventDefault();
            var wipId = "{{ $wip->id??''}}"
            var formData = new FormData(this);
            var url = $(this).attr("action");
            $('.submitBtn').prop('disabled', true);
            $.ajax({
                url: "{{ route('wip.create.step.one.post') }}",
                type: 'POST',
                processData: false,
                contentType: false,
                data: formData,
                success: function(result) {
                    $(".errMsg").empty();
                    if (result.status) {
                        setStep(2,wipId);
                    }
                      $('.submitBtn').prop('disabled', false);
                },
                error: function(data) {
                     $('.submitBtn').prop('disabled', false);
                    if (data.responseJSON) {

                    }

                }
            });
        });

        $(document).on('submit', '#step2-form', function(event) {
            event.preventDefault();
            var wipId = "{{ $wip->id??''}}";
            var formData = new FormData(this);
            var url = $(this).attr("action");
             $('.submitBtn').prop('disabled', true);
            $.ajax({
                url: "{{ route('wip.create.step.two.post') }}",
                type: 'POST',
                processData: false,
                contentType: false,
                data: formData,
                success: function(result) {
                    if (result.status) {
                        // stepper.next();
                        setStep(3,wipId);
                    }
                     $('.submitBtn').prop('disabled', false);
                },
                error: function(data) {
                    if (data.responseJSON) {

                    }
                    $('.submitBtn').prop('disabled', false);
                }
            });
        });

        $(document).on('click', '#update_stock', function(event) {
            console.log("btnName::",$(this));
            event.preventDefault();
            var btnName = $(this).val();
            var formData = new FormData($("#step3-form")[0]);
            formData.append("btnValue", btnName);
            var url = $(this).attr("action");
             $('.submitBtn').prop('disabled', true);
            $.ajax({
                url: "{{ route('wip.create.step.three.post') }}",
                type: 'POST',
                processData: false,
                contentType: false,
                data: formData,
                success: function(result) {
                    if (result.status) {
                        toastr.success("stock updated successfully");
                    }
                     $('.submitBtn').prop('disabled', false);
                },
                error: function(data) {
                    if (data.responseJSON) {

                    }
                     $('.submitBtn').prop('disabled', false);

                }
            });
        });

        $(document).on('click', '#finish_wip', function(event) {
            console.log("btnName::",$(this));
            event.preventDefault();
            var btnName = $(this).val();
             $('.submitBtn').prop('disabled', true);
            var formData = new FormData($("#step3-form")[0]);
            formData.append("btnValue", btnName)
            var url = $(this).attr("action");
            $.ajax({
                url: "{{ route('wip.create.step.three.post') }}",
                type: 'POST',
                processData: false,
                contentType: false,
                data: formData,
                success: function(result) {
                    if (result.status) {
                        window.location = "{{ route('wip.index') }}";
                    }
                     $('.submitBtn').prop('disabled', false);
                },
                error: function(data) {
                    if (data.responseJSON) {

                    }
                $('.submitBtn').prop('disabled', false);
                }
            });
        });

        function setStep(step,wipId) {
            $('.step').removeClass('active'); // First, hide all
            $('.content').removeClass('dstepper-block');
           // getStepData(step,wipId);
            if (step == 1) {
                // window.location = "{{ route('wip.create.step.one') }}";
                $('#logins-part-trigger').parent().addClass('active');
                // To ensure the correct tab pane is shown

                $('.bs-stepper-content .content').removeClass('active'); // First, hide all
                $('#logins-part').addClass('active'); // Then show the desired step
                // Then show the desired step

            } else if (step == 2) {
                $('#information-part-trigger').parent().addClass('active');
                // To ensure the correct tab pane is shown
                $('.bs-stepper-content .content').removeClass('active'); // First, hide all
                $('#information-part').addClass('active'); // Then show the desired step
                // window.location = "{{ route('wip.create.step.two') }}";
            } else if (step == 3) {
                $('#information-part-2-trigger').parent().addClass('active');
                // To ensure the correct tab pane is shown
                $('.bs-stepper-content .content').removeClass('active'); // First, hide all
                $('#information-part-2').addClass('active'); // Then show the desired step
                // swindow.location = "{{ route('wip.create.step.three') }}";
            }
        }
        function getStepData(step,wipId) {
            $.ajax({
                url: "{{ route('wip.get-step-data') }}",
                type: 'POST',               
                data: {
                    step:step,
                    id:wipId,
                    _token: '{{csrf_token()}}'
                },
                success: function(result) {
                if (step == 1) {
                    $('#logins-part').html(result);
                } else if (step == 2) {
                    $('#information-part').html(result);
                } else if (step == 3) {
                    $('#information-part-2').html(result);
                }
                $('#reservationdate').datetimepicker({
                format: 'DD-MM-YYYY',
              });
                $('#reservationdate input').focus(function() {
                    $(this).parent().datetimepicker('show');
                });
                $('#reservationdate5').datetimepicker({
                    format: 'DD-MM-YYYY',
                  });
               $('#reservationdate5 input').focus(function() {
                    $(this).parent().datetimepicker('show');
                });
                },
                error: function(data) {
                    if (data.responseJSON) {

                    }
                $('.submitBtn').prop('disabled', false);
                }
            });
        }
    </script>
