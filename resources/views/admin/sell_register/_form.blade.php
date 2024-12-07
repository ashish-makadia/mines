<div class="d-flex w-100 justify-content-between row">

    <div class="col-md-6 col-6  mb-3">
        <div class="form-group">
            <label> W/P no.</label>
            <select name="wip_no" class="form-control select2 a3 wipId">
                <option selected>Select W/P no.</option>
               @foreach ($wip as $item)
               <option @if(isset($sell_register) && $sell_register->wip_no == $item->id){{"selected"}} @endif value="{{$item->id}}">{{$item->wp_no}}</option>
               @endforeach
            </select>
        </div>
    </div>

    <div class="mb-3 col-md-6 col-12">
        <label for="exampleInputPassword1">Final Product no. of Blocks</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span id="basic-icon-default-fullname2" class="input-group-text">
                    <i class="fa fa-plus"></i>
                </span>
            </div>
            <input type="number" name="products_block" value="{{isset($sell_register)?$sell_register->products_block:""}}" readonly class="form-control" placeholder="Enter Final Product no. of Blocks">
        </div>
    </div>

</div>
<div class="row" id="stock_html">
@if (isset($sell_register->sellItem))
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th> Height </th>
            <th> Weight </th>
            <th> Width </th>
            <th> Total </th>
            <th> Sell Qty </th>
            <th> Rem Qty </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($sell_register->sellItem as $value)
        <tr>
            <td>{{ $value->wip_step3->height}}</td>
            <td>{{ $value->wip_step3->weight}}</td>
            <td>{{ $value->wip_step3->width}}
                <input type="hidden" name="item_id[]" value="{{$value->wip_step3->id}}" />
                <input type="hidden" name="sell_item_id[]" value="{{$value->id}}" />
            </td>
            <td><input type="number" name="total_item_qty[]" class="form-control total_item_qty" readonly value={{$value->Qty}}></td>
            <td><input type="number" name="sell_item_qty[]" class="form-control sell_item_qty" value={{$value->sellQty}}></td>
            <td><input type="number" name="rem_item_qty[]" readonly class="form-control rem_item_qty" value={{$value->remQty}}></td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif

</div>
<div class="row">
    <div class="mb-3 col-md-6 col-12">
        <label for="exampleInputPassword1">Sell Quantity</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span id="basic-icon-default-fullname2" class="input-group-text">
                    <i class="fa fa-plus"></i>
                </span>
            </div>
            <input type="number" name="sell_qty" value="{{isset($sell_register)?$sell_register->sell_qty:""}}" class="form-control sell_qty" placeholder="Enter Sell Quantity">
        </div>
        <span class='text-danger qty_err' id="qty_err"></span>
    </div>

    <div class="mb-3 col-md-6 col-12">
        <label for="exampleInputPassword1">Pending</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span id="basic-icon-default-fullname2" class="input-group-text">
                    <i class="fa fa-plus"></i>
                </span>
            </div>
            <input type="number" name="pending_qty" value="{{isset($sell_register)?$sell_register->pending_qty:""}}"  class="form-control" readonly placeholder="Enter Pending">
        </div>
    </div>

    <div class="mb-3 col-md-6 col-12">
        <label for="exampleInputPassword1">Rate</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span id="basic-icon-default-fullname2" class="input-group-text">
                    <i class="fa fa-plus"></i>
                </span>
            </div>
            <input type="number" name="rate"  value="{{isset($sell_register)?$sell_register->rate:""}}"  class="form-control" placeholder="Enter Rate">
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

            <select name="volume" class="form-control select2 a3">
                <option selected>Select Volume</option>
                @foreach ($quc as $item)
                    <option value="{{$item->id}}" @if(isset($sell_register) && $sell_register->volume == $item->id){{"selected"}} @endif>{{$item->uqc_code}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="mb-3 col-md-6 col-12">
        <label for="exampleInputPassword1">Party Name</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span id="basic-icon-default-fullname2" class="input-group-text">
                    <i class="fa fa-plus"></i>
                </span>
            </div>
            {{-- <input type="text" name="party_name" class="form-control" placeholder="Enter Party Name"> --}}
            <select name="party_name" class="form-control select2 a3">
                <option value="" selected>Select Party Name</option>
                @foreach ($vendors as $item)
                    <option @if(isset($sell_register) && $sell_register->party_name == $item->id){{"selected"}} @endif value="{{$item->id}}">{{$item->vendor_name}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-6 col-6  mb-3">
        <div class="form-group">
            <label>Sold by</label>
            <select name="sold_by" class="form-control select2 a3">
                <option value="" selected>Sold by</option>
                @foreach ($users as $item)
                    <option @if(isset($sell_register) && $sell_register->sold_by == $item->id){{"selected"}} @endif value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
        </div>
    </div>

</div>
    <div class="modal-footer a18">
        <button type="submit" class="btn btn-success btn-sm mt-3 ">Submit</button>
        <button type="reset" class="btn btn-warning btn-sm mt-3">Reset</button>
    </div>

