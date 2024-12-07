<div class="card-body">
    <div class="row">
        <div class="col-md-3 col-6  mb-3">
            <div class="form-group">
                <label> W/P no.</label>
                <select name="sell_id" id="wip_no" class="form-control select2 a3 wipId" required>
                    <option value="" selected>Select W/P no.</option>
                    @foreach ($sell as $item)
                    <option value="{{$item->id}}" @if (isset($invoice_generate->sell_id) && $item->id == $invoice_generate->sell_id) selected @endif>{{$item->wip->wp_no}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mb-3 col-md-3 col-12">
            <label>Select Mines</label>
            <select name="mine_id" id="mine_id" class="form-control select2 a3">
            <option value="" selected>Select Transfer mine</option>
            @foreach ($mines as $mine)
                <option value="{{ $mine->id }}" @if (isset($invoice_generate->mine_id) && $mine->id == $invoice_generate->mine_id) selected @endif>
                    {{ $mine->mine_name }}</option>
            @endforeach
            </select>
        </div>

        <div class="mb-3 col-md-3 col-6">
            <label for="exampleInputPassword1">Invoice No.</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span id="basic-icon-default-fullname2" class="input-group-text"><i class="fa fa-list-ol" aria-hidden="true"></i></span>
                </div>
                <input type="text" name="invoice_no" class="form-control" value="{{isset($invoice_generate->invoice_no)?$invoice_generate->invoice_no:(isset($invoiceNo)?$invoiceNo:"")}}" readonly placeholder="Invoice No">
            </div>
        </div>

        <div class="form-group mb-3 col-md-3 col-6">
            <label>Date</label>
            <div class="input-group date reservationdate" id="reservationdate" data-target-input="nearest">
                <input type="text" name="invoice_date" class="form-control datetimepicker-input" disabled data-target="#reservationdate" placeholder="Date" value="{{isset($invoice_generate->invoice_date)?date("d-m-Y",strtotime($invoice_generate->invoice_date)):date("d-m-Y")}}" />
                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
            </div>
        </div>

        <div class="mb-3 col-md-3 col-6">
            <label>Delivery Note</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span id="basic-icon-default-fullname2" class="input-group-text"><i class="fa fa-truck" aria-hidden="true"></i></span>
                </div>
                <input type="text" name="delivery_note" value="{{isset($invoice_generate->delivery_note)?$invoice_generate->delivery_note:old('delivery_note')}}" class="form-control" placeholder="Delivery Note">
            </div>
        </div>

        <div class="form-group mb-1 col-md-3 col-6">
            <label>Mode/Terms of Payment</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span id="basic-icon-default-fullname2" class="input-group-text"><i class="fa fa-credit-card" aria-hidden="true"></i></span>
                </div>
                <input type="text" name="payment_mode" value="{{isset($invoice_generate->payment_mode)?$invoice_generate->payment_mode:""}}" class="form-control" placeholder="Mode/Terms of Payment">
            </div>
        </div>

        <div class="mb-3 col-md-3 col-6">
            <label for="exampleInputPassword1">Reference No. & Date.</label>
            <div class="input-group date" id="reservationdate1" data-target-input="nearest">
                <input type="text" name="ref_date" class="form-control datetimepicker-input" data-target="#reservationdate1" placeholder="Reference No. & Date." value="{{isset($invoice_generate->ref_date)?date("d-m-Y",strtotime($invoice_generate->ref_date)):date("d-m-Y")}}" />
                <div class="input-group-append" data-target="#reservationdate1" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
            </div>
        </div>

        <div class="mb-3 col-md-3 col-6">
            <label class="form-label" for="basic-icon-default-message">Other References
        </label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span id="basic-icon-default-fullname2" class="input-group-text"><i class="fa fa-asterisk"></i>
                    </span>
                </div>
                <input type="text" name="other_ref" value="{{isset($invoice_generate->other_ref)?$invoice_generate->other_ref:""}}"  class="form-control" placeholder="Other References" />
            </div>
        </div>



        <div class="form-group mb-3 col-md-3 col-12">
            <label>Consignee (Ship to)</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span id="basic-icon-default-fullname2" class="input-group-text"><i class="fa fa-building"></i></span>
                </div>
                <select name="consignee_id" class="form-control select2 a3">
                    <option selected>Select Buyer</option>
                    @foreach ($vendors as $item)
                        <option value="{{$item->id}}" @if (isset($invoice_generate->consignee_id) && $item->id == $invoice_generate->consignee_id) selected @endif>{{$item->vendor_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group mb-3 col-md-3 col-6">
            <label>Buyer's Order No.</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span id="basic-icon-default-fullname2" class="input-group-text"><i class="fa fa-list-ol" aria-hidden="true"></i></span>
                </div>
                <input type="text" name="buyer_order_no" value="{{isset($invoice_generate->buyer_order_no)?$invoice_generate->buyer_order_no:""}}" class="form-control" placeholder="Buyer's Order No.">
            </div>
        </div>

        <div class="form-group mb-3 col-md-3 col-6">
            <label>Date</label>
            <div class="input-group date" id="reservationdate2" data-target-input="nearest">
                <input type="text" name="buy_date" class="form-control datetimepicker-input" value="{{isset($invoice_generate->buy_date)?date("d-m-Y",strtotime($invoice_generate->buy_date)):date("d-m-Y")}}" data-target="#reservationdate2" placeholder="Date" />
                <div class="input-group-append" data-target="#reservationdate2" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
            </div>
        </div>

        <div class="form-group mb-3 col-md-3 col-6">
            <label>Dispatch Doc No.</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span id="basic-icon-default-fullname2" class="input-group-text"><i class="fa fa-shipping-fast" aria-hidden="true"></i></span>
                </div>
                <input type="text" name="dispatch_doc_no" value="{{isset($invoice_generate->dispatch_doc_no)?$invoice_generate->dispatch_doc_no:""}}" class="form-control" placeholder="Buyer's Order No.">
            </div>
        </div>

        <div class="form-group mb-3 col-md-3 col-6">
            <label>Delivery Note Date</label>
            <div class="input-group date" id="reservationdate3" data-target-input="nearest">
                <input type="text" value="{{isset($invoice_generate->delivery_date)?date("d-m-Y",strtotime($invoice_generate->delivery_date)):date("d-m-Y")}}" name="delivery_date" class="form-control datetimepicker-input" data-target="#reservationdate3" placeholder="Delivery Note Date" />
                <div class="input-group-append" data-target="#reservationdate3" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
            </div>
        </div>

        <div class="form-group mb-3 col-md-3 col-6">
            <label>Dispatched Through</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span id="basic-icon-default-fullname2" class="input-group-text"><i class="fa fa-user"></i></span>
                </div>
                <input type="text" name="dispatch_through" value="{{isset($invoice_generate->dispatch_through)?$invoice_generate->dispatch_through:""}}" class="form-control" placeholder="Dispatched Through">
            </div>
        </div>

        <div class="form-group mb-3 col-md-3 col-6">
            <label>Destination</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span id="basic-icon-default-fullname2" class="input-group-text"><i class="fa fa-map-marked-alt" aria-hidden="true"></i></span>
                </div>
                <input type="text" name="destination" value="{{isset($invoice_generate->destination)?$invoice_generate->destination:""}}" class="form-control" placeholder="Destination">
            </div>
        </div>

        <div class="form-group mb-3 col-md-3 col-6">
            <label>Bill of Lading/LR-RR No.</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span id="basic-icon-default-fullname2" class="input-group-text"><i class="fa fa-list-ol" aria-hidden="true"></i></span>
                </div>
                <input type="text" name="bill_land_no" value="{{isset($invoice_generate->bill_land_no)?$invoice_generate->bill_land_no:""}}" class="form-control" placeholder="Destination">
            </div>
        </div>

        <div class="form-group mb-3 col-md-3 col-6">
            <label>Motor Vehicle No.</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span id="basic-icon-default-fullname2" class="input-group-text">
                        <i class="fas fa-car"></i></span>
                </div>
                <input type="text" name="motor_vehicle_no" value="{{isset($invoice_generate->motor_vehicle_no)?$invoice_generate->motor_vehicle_no:""}}" class="form-control" placeholder="Motor Vehicle No.">
            </div>
        </div>

        <div class="form-group mb-3 col-md-3 col-6">
            <label>Buyer (Bill to)</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span id="basic-icon-default-fullname2" class="input-group-text"><i class="fa fa-building"></i></span>
                </div>
                <select name="buyer_id" class="form-control select2 a3">
                    <option selected>Select Buyer</option>
                    @foreach ($vendors as $item)
                        <option value="{{$item->id}}" @if(isset($invoice_generate->buyer_id) && $item->id == $invoice_generate->buyer_id) selected @endif>{{$item->vendor_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group mb-3 col-md-3 col-6">
            <label>Customer Name</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span id="basic-icon-default-fullname2" class="input-group-text"><i class="fa fa-user"></i></span>
                </div>
                <select name="customer_id" class="form-control select2 a3">
                    <option selected>Select Customer</option>
                    @foreach ($customers as $item)
                        <option value="{{$item->id}}" @if(isset($invoice_generate->customer_id) && $item->id == $invoice_generate->customer_id) selected @endif>{{$item->customer_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group mb-3 col-md-3 col-6">
            <label>Bill Type</label>
            <select name="bill_type" id="bill_type" class="form-control select2 a3">
                <option value="" selected>Select Status</option>
                <option value="gst_bill" @if(isset($invoice_generate->bill_type) && "gst_bill" == $invoice_generate->bill_type) selected @endif>Gst Bill</option>
                <option value="without_gst_bill" @if(isset($invoice_generate->bill_type) && "without_gst_bill" == $invoice_generate->bill_type) selected @endif>Without Gst Bill</option>
            </select>
        </div>

        <div class="form-group mb-3 col-md-12 col-12">
            <label>Terms of Delivery</label>
            <textarea class="form-control" name="delivery_terms" rows="5">{{isset($invoice_generate->delivery_terms)?$invoice_generate->delivery_terms:""}}</textarea>
        </div>

        <div class="form-group mb-3 col-md-2 col-4">
            <label>Sr No.</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span id="basic-icon-default-fullname2" class="input-group-text">
                        <i class="fa fa-list-ol" aria-hidden="true"></i></span>
                </div>
                <input type="text" name="sr_no" class="form-control" value="{{isset($invoice_generate->sr_no)?$invoice_generate->sr_no:""}}" placeholder="Sr No.">
            </div>
        </div>
        <div class="form-group mb-3 col-md-4 col-6">
            <label>HSN/SAC</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span id="basic-icon-default-fullname2" class="input-group-text">
                        <i class="fa fa-list-ol" aria-hidden="true"></i></span>
                </div>
                <input type="text" name="hsn_no" id="hsn" value="{{isset($invoice_generate->hsn_no)?$invoice_generate->hsn_no:""}}" readonly class="form-control" placeholder="HSN/SAC CODE">
            </div>
        </div>
        <div class="form-group mb-3 col-md-3 col-6">
            <label>Unit</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span id="basic-icon-default-fullname2" class="input-group-text">
                        <i class="fa fa-recycle"></i></span>
                </div>
                <select name="volume" class="form-control select2 a3">
                    <option selected>Select Unit</option>
                    @foreach ($quc as $item)
                        <option value="{{$item->id}}" @if(isset($invoice_generate->volume) && $item->id == $invoice_generate->volume) selected @endif>{{$item->uqc_code}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group mb-3 col-md-3 col-6">
            <label>Amount</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span id="basic-icon-default-fullname2" class="input-group-text">
                            <i class="fa fa-money-bill" aria-hidden="true"></i>
                            </span>
                </div>
                <input type="number" name="sell_amount" value="{{isset($invoice_generate->sell_amount)?$invoice_generate->sell_amount:""}}" readonly id="sell_amount" class="form-control" placeholder="Enter Amount">
            </div>
        </div>
    </div>
    <div class="row gst_row @if(isset($invoice_generate->bill_type) && $invoice_generate->bill_type ==="with_gst") selected @endif">
        <div class="form-group mb-3 col-md-3 col-6">
            <label>CGST</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span id="basic-icon-default-fullname2" class="input-group-text">
                            <i class="fa fa-percentage" aria-hidden="true"></i></span>
                </div>
                <input type="number" onkeyup="calculateTaxAmount()" value="{{isset($invoice_generate->cgst)?$invoice_generate->cgst:""}}" name="cgst" id="cgst" class="form-control" placeholder="CGST">
            </div>
        </div>

        <div class="form-group mb-3 col-md-3 col-6">
            <label>CGST Amount</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span id="basic-icon-default-fullname2" class="input-group-text">
                        <i class="fa fa-money-bill" aria-hidden="true"></i></span>
                </div>
                <input type="number" name="cgst_amount" value="{{isset($invoice_generate->cgst_amount)?$invoice_generate->cgst_amount:""}}" readonly id="cgst_amount" class="form-control" placeholder="CGST Amount">
            </div>
        </div>

        <div class="form-group mb-3 col-md-3 col-6">
            <label>SGST</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span id="basic-icon-default-fullname2" class="input-group-text">
                            <i class="fa fa-percentage" aria-hidden="true"></i></span>
                </div>
                <input type="number" name="sgst" value="{{isset($invoice_generate->sgst)?$invoice_generate->sgst:""}}" onkeyup="calculateTaxAmount()" id="sgst" class="form-control" placeholder="SGST Amount">
            </div>
        </div>

        <div class="form-group mb-3 col-md-3 col-6">
            <label>SGST Amount</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span id="basic-icon-default-fullname2" class="input-group-text">
                        <i class="fa fa-money-bill" aria-hidden="true"></i>
                        </span>
                </div>
                <input type="number" name="sgst_amount" value="{{isset($invoice_generate->sgst_amount)?$invoice_generate->sgst_amount:""}}"  readonly id="sgst_amount" class="form-control" placeholder="Amount">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="form-group mb-3 col-md-3 col-6">
            <label>Total</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span id="basic-icon-default-fullname2" class="input-group-text">
                            <i class="fa fa-money-bill" aria-hidden="true"></i>
                            </span>
                </div>
                <input type="number" name="total_amount" value="{{isset($invoice_generate->total_amount)?$invoice_generate->total_amount:""}}" readonly id="total_amount" class="form-control" placeholder="Total Amount">
            </div>
        </div>

        <div class="form-group mb-3 col-md-3 col-6">
            <label>Status</label>
            <select name="status" class="form-control select2 a3">
                <option value="" selected>Select Status</option>
                <option value="paid" @if(isset($invoice_generate->status) && "paid" == $invoice_generate->status) selected @endif>Paid</option>
                <option value="unpaid" @if(isset($invoice_generate->status) && "unpaid" == $invoice_generate->status) selected @endif>Unpaid</option>
                <option value="delete" @if(isset($invoice_generate->status) && "delete" == $invoice_generate->status) selected @endif>Delete</option>
            </select>
        </div>

        <div class="form-group mb-3 col-md-6 col-12">
            <label>Details</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span id="basic-icon-default-fullname2" class="input-group-text">
                        <i class="fa fa-pen"></i></span>
                </div>
                <input type="text" name="details" value="{{isset($invoice_generate->details)?$invoice_generate->details:""}}" class="form-control" placeholder="Write On Word">
            </div>
        </div>

        <div class="form-group mb-3 col-md-3 col-6">
            <label>Taxable Value</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span id="basic-icon-default-fullname2" class="input-group-text">
                        <i class="fa fa-money-bill"></i>
                        </span>
                </div>
                <input type="number" value="{{isset($invoice_generate->taxable_amount)?$invoice_generate->taxable_amount:""}}" name="taxable_amount" readonly id="taxable_amount" class="form-control" placeholder="Taxable Value">
            </div>
        </div>

        <div class="form-group mb-3 col-md-3 col-6">
            <label>Central Tax</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span id="basic-icon-default-fullname2" class="input-group-text">
                        <i class="fa fa-percentage" aria-hidden="true"></i>
                        </span>
                </div>
                <input type="number" name="central_tax" value="{{isset($invoice_generate->central_tax)?$invoice_generate->central_tax:""}}" readonly id="central_tax" class="form-control" placeholder="Central Tax Rupees">
            </div>
        </div>

        <div class="form-group mb-3 col-md-3 col-6">
            <label>State Tax</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span id="basic-icon-default-fullname2" class="input-group-text">
                        <i class="fa fa-percentage" aria-hidden="true"></i>
                        </span>
                </div>
                <input type="number" name="state_tax" value="{{isset($invoice_generate->state_tax)?$invoice_generate->state_tax:""}}" readonly id="state_tax" class="form-control" placeholder="State Tax Rupees">
            </div>
        </div>

        <div class="form-group mb-3 col-md-3 col-12">
            <label>Total Tax Amount</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span id="basic-icon-default-fullname2" class="input-group-text">
                        <i class="fa fa-money-bill" aria-hidden="true"></i>
                        </span>
                </div>
                <input type="number" name="total_taxable_amount" value="{{isset($invoice_generate->total_taxable_amount)?$invoice_generate->total_taxable_amount:""}}" readonly id="total_taxAmount" class="form-control" placeholder="Total Tax Amount">
            </div>
        </div>

        <div class="form-group mb-3 col-md-4 col-12">
            <label>Rupees in Word</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span id="basic-icon-default-fullname2" class="input-group-text">
                        <i class="fa fa-money-bill" aria-hidden="true"></i>
                        </span>
                </div>
                <input type="text" name="rs_word" value="{{isset($invoice_generate->rs_word)?$invoice_generate->rs_word:""}}" readonly class="form-control" id="rs_word" placeholder="Rupees in Word">
            </div>
        </div>
        <div class="form-group mb-3 col-md-4 col-12">
            <label>Pay Amount</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span id="basic-icon-default-fullname2" class="input-group-text">
                        <i class="fa fa-money-bill" aria-hidden="true"></i>
                        </span>
                </div>
                <input type="number" name="pay_amount"  id="pay_amount" value="{{isset($invoice_generate->pay_amount)?$invoice_generate->pay_amount:""}}" class="form-control" placeholder="Total Tax Amount">
            </div>
        </div>
        <div class="form-group mb-3 col-md-4 col-12">
            <label>Remaining Amount</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span id="basic-icon-default-fullname2" class="input-group-text">
                        <i class="fa fa-money-bill" aria-hidden="true"></i>
                        </span>
                </div>
                <input type="number" name="remaining_amount" value="{{isset($invoice_generate->remaining_amount)?$invoice_generate->remaining_amount:""}}" readonly id="remaining_amount" class="form-control" placeholder="Total Tax Amount">
            </div>
        </div>

        <div class="form-group mb-3 col-md-5 col-12">
            <label>Declaration</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span id="basic-icon-default-fullname2" class="input-group-text">
                        <i class="fa fa-money-bill" aria-hidden="true"></i>
                        </span>
                </div>
                <input type="text" name="declaration" value="{{isset($invoice_generate->declaration)?$invoice_generate->declaration:""}}" class="form-control" placeholder="Declaration Full">
            </div>
        </div>

        <div class="form-group mb-3 col-md-3 col-12">
            <label>Stamp In Company</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span id="basic-icon-default-fullname2" class="input-group-text">
                        <i class="fas fa-stamp"></i>
                        </span>
                </div>
                <input type="text" name="company_stamp" value="{{isset($invoice_generate->company_stamp)?$invoice_generate->company_stamp:""}}" class="form-control" placeholder="Full  Of Company Details">
            </div>
        </div>
    </div>
    <center>
        <button type="submit" class="btn btn-success btn-sm mt-3">Submit</button>
        <a href="{{route("invoice-generate")}}" class="btn btn-default btn-sm mt-3">Cancle</button>
    </center>
</div>
