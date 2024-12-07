<form id="step3-form">
    @csrf
    <div class="row">
        <div class="mb-3 col-md-4 col-12">
            <label for="exampleInputPassword1">No of pieces of finished good
            </label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span id="basic-icon-default-fullname2" class="input-group-text">
                        <i class="fa fa-building"></i>
                    </span>
                </div>
                <input type="text" name="finish_good" class="form-control" placeholder="4 pieces"
                    value="{{ isset($wip->finish_good) ? $wip->finish_good : old('finish_good') }}">
            </div>
        </div>
        <div class="mb-3 col-md-4 col-12">
            <label>Current Date</label>
            <div class="input-group date" id="reservationdate3" data-target-input="nearest">
                <input type="text" name="finished_current_date" class="form-control datetimepicker-input"
                    data-target="#reservationdate3" placeholder="18/04/2024"
                    value="{{ isset($wip->finished_current_date) && $wip->finished_current_date != '' ? date('d-m-y', strtotime($wip->finished_current_date)) : date('d-m-Y') }}" />
                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-3 col-md-4 col-12">

        </div>

        <div class="mb-3 col-md-12 col-12">
            <label for="exampleInputPassword1">Size of piece with upload pic2s</label>
        </div>
    </div>
        <div class="row-container-step3">
            @if (isset($wip->wip_step3) && count($wip->wip_step3) > 0)
                @foreach ($wip->wip_step3 as $key => $value)
                    <div class="row">
                        <div class="form-group mb-3 col-md-2 col-12">
                            <label for="exampleInputHeight">Height</label>
                            <input type="number" name="height[]" class="form-control" id="exampleInputheights"
                                value="{{ $value->height }}" placeholder="Enter Height">
                        </div>

                        <div class="form-group mb-3 col-md-2 col-12">
                            <label for="exampleInputWeight">Weight</label>
                            <input type="number" name="weight[]" class="form-control" id="exampleInputWeight"
                                value="{{ $value->weight }}" placeholder="Enter Weight">
                        </div>

                        <div class="form-group mb-3 col-md-1 col-12">
                            <label for="exampleInputWidth">Width</label>
                            <input type="number" name="width[]" class="form-control" id="exampleInputWidth"
                                value="{{ $value->width }}" placeholder="Enter Width">
                        </div>

                        <div class="form-group mb-3 col-md-2 col-12">
                            <label for="exampleInputGunfoot">Gunfoot</label>
                            <input type="number" class="form-control" id="exampleInputGunfoot"
                                value="{{ $value->gunfoot }}" name="gunfoot[]" placeholder="Enter Gunfoot">
                        </div>

                        <div class="form-group mb-3 col-md-2 col-12">
                            <label for="exampleInputpic">No. of Pices</label>
                            <input type="number" class="form-control" id="exampleInputPic" name="no_of_pieces[]"
                                value="{{ $value->no_of_pieces }}" placeholder="Enter Pices">
                        </div>
                        <div class="mb-3 col-md-2 col-12">
                            <label for="example1">Upload Picture </label>
                            <div class="mr-2">
                                <input type="file" name="uploaded_pic[]">
                                <input type="hidden" name="fileName[]" value="{{ $value->uploaded_pic }}">
                            </div>
                        </div>
                        @if (isset($value->uploaded_pic) && $value->uploaded_pic != '')
                            <div class="mb-3 col-md-1 col-12">
                                <img src="{{ url('public/uploads/step3/' . $value->wip_id . '/' . $value->uploaded_pic) }}"
                                    style="width:50px;height:50px" />
                            </div>
                        @endif
                        <input type="hidden" name="step3_id" value="{{ $value->id }}">
                        @if ($loop->first)
                            <div class="mb-3 col-md-1 col-12 ">
                                <div>
                                    <a class="btn btn-info btn-sm add-icon-step3">
                                        <i class="fas fa-plus-square"></i>
                                    </a>
                                </div>
                            </div>
                        @else
                            <div class="mb-3 col-md-1 col-12 ">
                                <div>
                                    <a class="btn btn-info btn-sm add-icon-step3">
                                        <i class="fas fa-plus-square"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="mb-3 col-md-1 col-12">
                                <a class="btn btn-danger btn-sm remove-icon-step3" href="#">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                        @endif
                    </div>
                @endforeach
            @else
                <div class="row">
                    <div class="form-group mb-3 col-md-2 col-12">
                        <label for="exampleInputHeight">Height</label>
                        <input type="number" name="height[]" class="form-control" id="exampleInputheights"
                            placeholder="Enter Height">
                    </div>

                    <div class="form-group mb-3 col-md-2 col-12">
                        <label for="exampleInputWeight">Weight</label>
                        <input type="number" name="weight[]" class="form-control" id="exampleInputWeight"
                            placeholder="Enter Weight">
                    </div>

                    <div class="form-group mb-3 col-md-1 col-12">
                        <label for="exampleInputWidth">Width</label>
                        <input type="number" name="width[]" class="form-control" id="exampleInputWidth"
                            placeholder="Enter Width">
                    </div>

                    <div class="form-group mb-3 col-md-2 col-12">
                        <label for="exampleInputGunfoot">Gunfoot</label>
                        <input type="number" class="form-control" id="exampleInputGunfoot" name="gunfoot[]"
                            placeholder="Enter Gunfoot">
                    </div>

                    <div class="form-group mb-3 col-md-2 col-12">
                        <label for="exampleInputpic">No. of Pices</label>
                        <input type="number" class="form-control" id="exampleInputPic" name="no_of_pieces[]"
                            placeholder="Enter Pices">
                    </div>
                    <div class="mb-3 col-md-2 col-12">
                        <label for="example1">Upload Picture </label>
                        <div class="custom-file mr-2">
                            <input type="file" class="custom-file-input" id="customFiles" name="uploaded_pic[]">
                            <label class="custom-file-label" for="customFile">Upload Pic</label>
                        </div>
                    </div>

                    <div class="mb-3 col-md-1 col-12 ">
                        <!--<label for="example1">Add More </label>-->
                        <div>
                            <a class="btn btn-info btn-sm add-icon-step3">
                                <i class="fas fa-plus-square"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>

    <div class="row">
        <div class="mb-3 col-md-12 col-12">
            {{-- <label for="exampleInputPassword1">Waste quantity</label> --}}
        </div>
        <div class="form-group mb-3 col-md-3 col-12">
            <label for="exampleInputwq">Waste quantity</label>
            <input type="number" name="waste_quantity" class="form-control" id="exampleInputwq"
                placeholder="Waste quantity - 150"
                value="{{ isset($wip->waste_quantity) ? $wip->waste_quantity : '' }}">
        </div>
        <div class="form-group mb-3 col-md-3 col-12" data-select2-id="29">
            <label>VOM (Uom)</label>
            <select class="form-control select2bs4 select2-hidden-accessible" style="width: 100%;"
                name="waste_quc_id">
                <option value="" selected>Select volume</option>
                @foreach ($quc as $i)
                    <option value="{{ $i->id }}" @if (isset($wip->waste_quc_id) && $wip->waste_quc_id == $i->id) selected @endif>
                        {{ $i->uqc_code }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3 col-md-4 col-12">
            <label for="example1">Upload Picture </label>
            <div class="custom-file mr-2">
                <input type="file" name="waste_uploaded_pic">
            </div>
        </div>
        @if (isset($wip->waste_uploaded_pic) && $wip->waste_uploaded_pic != '')
            <div class="mb-3 col-md-1 col-12">
                <img src="{{ url('public/uploads/step3/' . $wip->waste_uploaded_pic) }}"
                    style="width:50px;height:50px" />
            </div>
        @endif
    </div>
    <div class="row">
        <div class="mb-3 col-md-12 col-12">
            {{-- <label for="exampleInputPassword1">Luffers quantity</label> --}}
        </div>
        <div class="form-group mb-3 col-md-3 col-12">
            <label for="exampleInputwq">Luffers quantity</label>
            <input type="number" class="form-control" name="luffers_quantity" id="exampleInputwq"
                placeholder="Luffers quantity - 150"
                value="{{ isset($wip->luffers_quantity) ? $wip->luffers_quantity : '' }}">
        </div>

        <div class="form-group mb-3 col-md-3 col-12">
            <label>VOM (Uom)</label>
            <select class="form-control select2" style="width: 100%;" name="luffers_quc_id">
                <option value="" selected>Select volume</option>
                @foreach ($quc as $i)
                    <option value="{{ $i->id }}" @if (isset($wip->luffers_quc_id) && $wip->luffers_quc_id == $i->id) selected @endif>
                        {{ $i->uqc_code }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3 col-md-4 col-12">
            <label for="example1">Upload Picture </label>
            <div class="custom-file mr-2">
                <input type="file" name="luffers_uploaded_pic">
            </div>
        </div>
        @if (isset($wip->luffers_uploaded_pic) && $wip->luffers_uploaded_pic != '')
            <div class="mb-3 col-md-1 col-12">
                <img src="{{ url('public/uploads/step3/' . $wip->luffers_uploaded_pic) }}"
                    style="width:50px;height:50px" />
            </div>
        @endif
    </div>
    <div class="row">
    <button type="button" class="btn btn-primary" onclick="setStep(2,'{{ isset($wip->id) ? $wip->id : 0 }}')">Previous</button>
    <!-- <button type="submit" class="btn btn-primary">Update Data Stock</button> -->
    <button type="submit" name="update_stock" id="update_stock" value="update_date" class="btn btn-primary submitBtn">Update
        Data Stock</button>
    <input type="hidden"  class="wipId" name="wipId" value="{{ isset($wip->id) ? $wip->id : 0 }}" />
    <input type="hidden" name="isEdit" value="{{ isset($isEdit) ? $isEdit : false }}" />
    <button type="submit" name="finish_wp" id="finish_wip" value="finish_wp"
        class="btn btn-success submitBtn">Finish
        W/P</button>
</form>
