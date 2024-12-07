@csrf
    <div class="d-flex w-100 justify-content-between row">
        <div class="form-group mb-3 col-md-6 col-12">
            <label> Date</label>
            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                <input type="datetime" name="date" class="form-control datetimepicker-input" data-target="#reservationdate" placeholder="Select Date" value={{date("d-m-y")}} required/>
                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
            </div>
        </div>

        <div class="mb-3 col-md-6 col-12">
            <label for="exampleInputPassword1">Meter No.</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span id="basic-icon-default-fullname2" class="input-group-text">
                        <i class="fa fa-plus"></i>
                    </span>
                </div>
                <input type="text" name="meter_no" class="form-control" required placeholder="Enter Meter Number">
            </div>
        </div>

        <div class="mb-3 col-md-6 col-12">
            <label for="exampleInputPassword1">Per Unit Bill</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span id="basic-icon-default-fullname2" class="input-group-text">
                        <i class="fa fa-plus"></i>
                    </span>
                </div>
                <input type="number" name="per_unit_bill" id="per_unit_bill"  value="" class="form-control" required placeholder="Enter Per Unit Bill">
            </div>
        </div>

        <div class="mb-3 col-md-6 col-12">
            <label for="exampleInputPassword1">Total Unit</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span id="basic-icon-default-fullname2" class="input-group-text">
                        <i class="fa fa-plus"></i>
                    </span>
                </div>
                <input type="number" class="form-control" id="total_unit" name="total_unit" value="" required placeholder="Enter Total Unit">
            </div>
        </div>

        <div class="mb-3 col-md-6 col-12">
            <label for="exampleInputPassword1">Approx. Bill of Today</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span id="basic-icon-default-fullname2"class="input-group-text">
                        <i class="fa fa-plus"></i>
                    </span>
                </div>
                <input type="number" class="form-control" name="today_bill" readonly id="today_bill" value="" required placeholder="Enter Approx. Bill of Today">
            </div>
        </div>

        <div class="mb-3 col-md-6 col-12">
            <label for="exampleInputPassword1">Bill of Month</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span id="basic-icon-default-fullname2"  class="input-group-text">
                        <i class="fa fa-plus"></i>
                    </span>
                </div>
                <input type="number" class="form-control" name="bill_of_month" id="bill_of_month" value={{$billOfMonth->bill_of_month}} required placeholder="Enter Bill of Month" readonly>
            </div>
        </div>

        <div class="mb-3 col-md-12 col-12">
            <label for="remarks"> Remarks</label>
            <textarea class="form-control" id="remarks" name="remarks"
            placeholder="remarks"></textarea>
        </div>
    </div>
    <div class="modal-footer a18">
        <button type="submit" class="btn btn-success btn-sm mt-3 ">Submit</button>
        <button type="reset" class="btn btn-warning btn-sm mt-3">Reset</button>
    </div>
</div>

