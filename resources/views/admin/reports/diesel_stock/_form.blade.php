<div class="d-flex w-100 justify-content-between row">
    <div class="mb-3 col-md-6 col-12">
        <label for="exampleInputPassword1">Vendor</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span id="basic-icon-default-fullname2" class="input-group-text">
                    <i class="fa fa-plus"></i>
                </span>
            </div>
            <select name="vendor_id" id="vendor_id" class="form-control select2 a3" required>
                <option value="" selected>Select Vendor</option>
                @foreach ($vendors as $item)
                    <option @if(isset($sell_register) && $sell_register->party_name == $item->id){{"selected"}} @endif value="{{$item->id}}">{{$item->vendor_name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="mb-3 col-md-6 col-12">
        <label for="exampleInputPassword1">Total diesel (Ltr)</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span id="basic-icon-default-fullname2" class="input-group-text">
                    <i class="fa fa-plus"></i>
                </span>
            </div>
            <input type="number" name="total_diesel_ltr" id="total_diesel" required value="{{isset($diesel_stock)?$diesel_stock->total_diesel_ltr:""}}" readonly class="form-control" placeholder="Total Disel (Ltr)">
        </div>
    </div>
</div>

<div class="row">
    <div class="mb-3 col-md-6 col-12">
        <label for="exampleInputPassword1">Total Amount</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span id="basic-icon-default-fullname2" class="input-group-text">
                    <i class="fa fa-plus"></i>
                </span>
            </div>
            <input type="number" readonly name="total_amount" id="total_amount" required value="{{isset($diesel_stock)?$diesel_stock->total_amount:""}}" class="form-control sell_qty" placeholder="Enter Total Amount">

        </div>
        <span class='text-danger qty_err' id="qty_err"></span>
    </div>

    <div class="mb-3 col-md-6 col-12">
        <label for="exampleInputPassword1">Payment Amount</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span id="basic-icon-default-fullname2" class="input-group-text">
                    <i class="fa fa-plus"></i>
                </span>
            </div>
            <input type="number" name="payment_amount" id="payment_amount" required value="{{isset($diesel_stock)?$diesel_stock->payment_amount:""}}"  class="form-control" placeholder="Enter Payment Amount">
        </div>
    </div>

    <div class="mb-3 col-md-6 col-12">
        <label for="exampleInputPassword1">Remaining Amount</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span id="basic-icon-default-fullname2" class="input-group-text">
                    <i class="fa fa-plus"></i>
                </span>
            </div>
            <input type="number" name="remaining_amount" id="remaining_amount" required readonly value="{{isset($sell_register)?$sell_register->remaining_amount:""}}"  class="form-control" placeholder="Enter Remaining Amount">
        </div>
    </div>
</div>
    <div class="modal-footer a18">
        <button type="submit" class="btn btn-success btn-sm mt-3 ">Submit</button>
        <button type="reset" class="btn btn-warning btn-sm mt-3">Reset</button>
    </div>

