<div class="d-flex w-100 justify-content-between row">

    <div class="mb-3 col-md-6 col-12">
        <label for="exampleInputPassword1">Vendor</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span id="basic-icon-default-fullname2" class="input-group-text">
                    <i class="fa fa-plus"></i>
                </span>
            </div>
            <select name="vendor_id" id="vendor_id" class="form-control select2 a3 vendor_id" required>
                <option value="" selected>Select Vendor</option>
                @foreach ($vendors as $item)
                    <option @if(isset($assets_vendor) && $assets_vendor->vendor_id == $item->id){{"selected"}} @endif value="{{$item->id}}">{{$item->vendor_name}}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="row" id="stock_html">
@if (isset($assets))
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th> Purchase Date </th>
            <th> Assets </th>
            <th> Qty</th>
            <th> Amount </th>

        </tr>
    </thead>
    <tbody>
        @foreach ($assets as $value)
        <tr>
            <td>{{ date("d-m-Y",strtotime($value->date_of_purchase))}}</td>
            <td>{{ $value->machine_name}}</td>
            <td>{{ $value->machine_qty}}</td>
            <td>{{ $value->total_payble_amount}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif

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
            <input type="number" name="total_amount" id="total_amount" required readonly value="{{isset($assets_vendor)?$assets_vendor->total_amount:""}}" class="form-control totalAmount" placeholder="Enter Total Amount">

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
            <input type="number" name="payment_amount" value="{{isset($assets_vendor)?$assets_vendor->payment_amount:old('payment_amount')}}" id="payment_amount" required value="{{isset($diesel_stock)?$diesel_stock->payment_amount:""}}"  class="form-control" placeholder="Enter Payment Amount">
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
            <input type="number" name="remaining_amount" id="payment_amount" required id="remaining_amount" required readonly value="{{isset($assets_vendor)?$assets_vendor->remaining_amount:""}}"  class="form-control" placeholder="Enter Remaining Amount">
        </div>
    </div>
</div>
    <div class="modal-footer a18">
        <button type="submit" class="btn btn-success btn-sm mt-3 ">Submit</button>
        <button type="reset" class="btn btn-warning btn-sm mt-3">Reset</button>
    </div>

