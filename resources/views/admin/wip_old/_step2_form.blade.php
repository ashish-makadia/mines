<form id="step2-form">
    @csrf
    <div class="row">
        <div class="mb-3 col-md-4 col-12">
            <label for="exampleInputPassword1">No of pieces </label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span id="basic-icon-default-fullname2"
                        class="input-group-text">
                        <i class="fa fa-building"></i>
                    </span>
                </div>
                <input type="text" name="no_of_pieces"class="form-control"
                    placeholder="4 pieces" id="exampleInputPassword1" value="{{isset($wip->no_of_pieces)?$wip->no_of_pieces:old("no_of_pieces")}}">
            </div>
        </div>

        <div class="mb-3 col-md-4 col-12">
            <label>Current Date</label>
            <div class="input-group date" id="reservationdate5"
                data-target-input="nearest">
                <input type="text" name="current_date"
                    class="form-control datetimepicker-input"
                    data-target="#reservationdate5" placeholder="Current date"
                    value={{isset($wip->current_date)? date('d-m-y',strtotime($wip->current_date)): date('d-m-y')}} />
                <div class="input-group-append" data-target="#reservationdate5" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
            </div>
        </div>

        <div class="mb-3 col-md-4 col-12">

        </div>
    </div>
    <div class="mb-3 col-md-12 col-12">
        <label for="exampleInputPassword1">Size of piece with upload
            pic</label>
    </div>

    <div class="row-container-step2">
        @if(isset($wip->wip_step) && count($wip->wip_step) > 0)
        @foreach ($wip->wip_step as $key => $value)
        <div class="row">
            <div class="mb-3 col-md-3 col-12">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span id="basic-icon-default-fullname2"
                            class="input-group-text">
                            <i class="fa fa-list-ol" aria-hidden="true"></i>
                        </span>
                    </div>
                    <input type="text" name="size_of_pic[]"
                        class="form-control" placeholder="1 Size of pieces"
                        id="exampleInputPassword1" value={{$value->size_of_piece}}>
                         <input type="hidden" value="{{$value->id}}" name="step2_id[]"/>
                </div>
            </div>

            <div class="mb-3 col-md-4 col-12">
                <div class="custom-file col-md-12 mr-2">
                    <input type="file" name="pic_image[]">
                      <input type="hidden" name="fileName[]" value="{{$value->upload_pic }}">
                    {{-- <label class="custom-file-label">Upload
                        Pic22s</label> --}}
                </div>
            </div>
            @if(isset($value->upload_pic) && $value->upload_pic !="")
            <div class="mb-3 col-md-1 col-12">
                <img src="{{url('public/uploads/'.$value->upload_pic)}}" style="width:50px;height:50px"/>
            </div>
           
            @endif
            @if($loop->first)
            <div class="mb-3 col-md-4 col-12">
                <a class="btn btn-info btn-sm add-icon-step2" href="#">
                    <i class="fas fa-plus-square"></i>
                </a>
            </div>
            @else
            <div class="mb-3 col-md-4 col-12">
                <a class="btn btn-danger btn-sm remove-icon-step2" href="#">
                    <i class="fas fa-trash"></i>
                </a>
            </div>
            @endif
        </div>
        @endforeach
        @else
        <div class="row">
            <div class="mb-3 col-md-3 col-12">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span id="basic-icon-default-fullname2"
                            class="input-group-text">
                            <i class="fa fa-list-ol" aria-hidden="true"></i>
                        </span>
                    </div>
                    <input type="text" name="size_of_pic[]"
                        class="form-control" placeholder="1 Size of pieces"
                        id="exampleInputPassword1">
                </div>
            </div>

            <div class="mb-3 col-md-4 col-12">
                <div class="custom-file col-md-12 mr-2">
                    <input type="file" name="pic_image[]">
                    {{-- <label class="custom-file-label">Upload
                        Pic</label> --}}
                </div>
            </div>

            <div class="mb-3 col-md-4 col-12">
                <a class="btn btn-info btn-sm add-icon-step2" href="#">
                    <i class="fas fa-plus-square"></i>
                </a>
            </div>
        </div>
        @endif
    </div>
    <button type="button" class="btn btn-primary"
        onclick='setStep(1,"{{isset($wip->id)?$wip->id:0}}")'>Previous</button>
        <input type="hidden" name="wipId" value="{{isset($wip->id)?$wip->id:0}}" />
    <button type="submit" class="btn btn-primary submitBtn">Finish</button>
</form>
@push('scripts')
<script type="text/javascript">
  $('.row-container-step21').on('click', '.add-icon-step2', function(e) {
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
</script>
@endpush
