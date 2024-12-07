<div class="d-flex w-100 justify-content-between row">

    <div class="form-group mb-3 col-md-6 col-12">
        <label>Date</label>
        <div class="input-group date" id="reservationdate" data-target-input="nearest">
            <input type="text" class="form-control datetimepicker-input" name="date"
                value={{ date('d-m-y') }} data-target="#reservationdate"
                placeholder="Select Date" />
            <div class="input-group-append" data-target="#reservationdate"
                data-toggle="datetimepicker">
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-6  mb-3">
        <label>Diesel Stocking at</label>
        <div class="input-group">
            <select name="diesel_stock_at" id="diesel_stock_at" class="form-control select2 a3">
                <option value="">Select </option>
                @foreach ($assetCategorys as $i)
                    <option value="{{ $i->id }}"  @if(isset($diesel_stock->diesel_stock_at) && $mine->id == $diesel_stock->diesel_stock_at) selected @endif>{{ $i->category_name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="mb-3 col-md-6 col-12">
        <label for="exampleInputPassword1">Capacity of Storage</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span id="basic-icon-default-fullname2" class="input-group-text">
                    <i class="fa fa-plus"></i>
                </span>
            </div>
            <input type="number" id="capacity_storage" name="capacity_storage" class="form-control"
                placeholder="Enter Capacity of Storage">
        </div>
    </div>

    <div class="mb-3 col-md-6 col-12">
        <label for="exampleInputPassword1">Stock in Litre</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span id="basic-icon-default-fullname2" class="input-group-text">
                    <i class="fa fa-plus"></i>
                </span>
            </div>
            <input type="number" id="stock" name="stock" class="form-control"
                placeholder="Stock in Litre">
        </div>
    </div>


    <div class="form-group col-md-6 col-12">
        <label>Vendor</label>
        <select class="form-control select2 a3" name="vendor_id" required>
            <option value="" selected="selected">Select Vendor</option>
            @foreach($vendors as $vendor)
            <option value="{{$vendor->id}}">{{$vendor->vendor_name}}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3 col-md-6 col-12">
        <label for="exampleInputPassword1">Rate Per litre</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span id="basic-icon-default-fullname2" class="input-group-text">
                    <i class="fa fa-plus"></i>
                </span>
            </div>
            <input type="number" name="rate_per_ltr" class="form-control"
                placeholder="Rate Per litre">
        </div>
    </div>
    <div class="mb-3 col-md-12 col-12 mb-3">
        <label class="form-label" for="basic-icon-default-message"><i
                class="fa fa-message"></i>Remark
        </label>
        <textarea id="basic-icon-default-message" name="remarks" class="form-control"
            aria-describedby="basic-icon-default-message2" placeholder="Add Remark"></textarea>
    </div>
</div>
<div class="modal-footer a18">
    <button type="submit" class="btn btn-success btn-sm mt-3 ">Submit</button>
    <button type="reset" class="btn btn-warning btn-sm mt-3">Reset</button>
</div>
