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
            <label for="exampleInputPassword1">Mala Size.</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span id="basic-icon-default-fullname2" class="input-group-text">
                        <i class="fa fa-plus"></i>
                    </span>
                </div>
                <input type="number" name="mala_size"  class="form-control" required placeholder="Enter Mala Sie">
            </div>
        </div>

        <div class="mb-3 col-md-6 col-12">
            <label for="exampleInputPassword1">Volume</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span id="basic-icon-default-fullname2" class="input-group-text">
                        <i class="fa fa-plus"></i>
                    </span>
                </div>
                <select name="quc_id" id="quc_id" class="form-control select2 a3">
                    <option value="">Select Volume</option>
                    
                    @foreach($quc as $i)
                    <option value="{{$i->id}}"{{ $i->id == @$wire_saw->quc_id ? 'selected' : '' }}>{{$i->uqc_code}}</option>
                        @endforeach
                </select>
                
                {{-- <input type="number" name="volume" id="volume"  class="form-control" required placeholder="Enter Volume"> --}}
            </div>
        </div>

        <div class="mb-3 col-md-6 col-12">
            <label for="exampleInputPassword1">Quantity</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span id="basic-icon-default-fullname2" class="input-group-text">
                        <i class="fa fa-plus"></i>
                    </span>
                </div>
                <input type="number" class="form-control quantity" id="quantity" name="quantity" required placeholder="Enter Total Quantity">
            </div>
        </div>

        <div class="mb-3 col-md-6 col-12">
            <label for="exampleInputPassword1">Rate</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span id="basic-icon-default-fullname2"class="input-group-text">
                        <i class="fa fa-plus"></i>
                    </span>
                </div>
                <input type="number" class="form-control rate" id="rate" name="rate" required placeholder="Enter Rate">
            </div>
        </div>

        <div class="mb-3 col-md-6 col-12">
            <label for="exampleInputPassword1">Total Amount</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span id="basic-icon-default-fullname2"  class="input-group-text">
                        <i class="fa fa-plus"></i>
                    </span>
                </div>
                <input type="number" class="form-control total_amount" id="total_amount" readonly name="total_amount" required placeholder="Enter Total Amount">
            </div>
        </div>

        <div class="mb-3 col-md-12 col-12">
            <label for="exampleInputPassword1">Party Name</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span id="basic-icon-default-fullname2"class="input-group-text">
                        <i class="fa fa-plus"></i>
                    </span>
                </div>
                <input type="text" class="form-control" id="name" name="name"  required placeholder="Enter Rate">
            </div>
    </div>
    <div class="modal-footer a18">
        <button type="submit" class="btn btn-success btn-sm mt-3 ">Submit</button>
        <button type="reset" class="btn btn-warning btn-sm mt-3">Reset</button>
    </div>
</div>
