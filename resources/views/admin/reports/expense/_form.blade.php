<div class="d-flex w-100 justify-content-between row">


    <div class="form-group mb-3 col-md-6 col-6">
        <label class="form-label" for="basic-icon-default-fullname">
            Invoice Date
        <span class="text-red">*</span></label>
        <div class="input-group date" id="reservationdate1" data-target-input="nearest">
            <input type="text" name="invoice_date" value="{{date("Y-m-d")}}" class="form-control datetimepicker-input" data-target="#reservationdate1" placeholder="Date" />
            <div class="input-group-append" data-target="#reservationdate1" data-toggle="datetimepicker">
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
            </div>
        </div>
    </div>

    <div class="form-group form-group mb-3 col-md-6 col-6">
        <label class="form-label" for="basic-icon-default-state">Innvoice No <span class="text-red">*</span></label>
        <input type="text" readonly name="invoice_no" value="{{isset($invoiceNo)?$invoiceNo:old('invoice_no')}}" class="form-control" placeholder="Invoice No">
    </div>

    <div class="form-group mb-3 col-md-6 col-6">
        <label class="form-label" for="basic-icon-default-company">Category <span class="text-red">*</span></label>
        <select name="category_id" id="" class="form-control  select2 a3">
            <option value="">Select Expense</option>
            @foreach($expensecategorys as $expensecategory)
            <option value="{{$expensecategory->id}}">{{$expensecategory->exp_cat}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group mb-3 col-md-6 col-12">
        <label class="form-label" for="basic-icon-default-company">Employee <span class="text-red">*</span></label>
        <select name="staff_id" id="staff_id" class="form-control select2 a3" required>
            <option value="" selected>Select Staff</option>
            @foreach ($employees as $item)
                <option @if(isset($employee_salary) && $employee_salary->employee_id == $item->id){{"selected"}} @endif value="{{$item->id}}">{{$item->name}}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group form-group mb-3 col-md-6 col-6">
        <label class="form-label" for="basic-icon-default-state">Cost <span class="text-red">*</span></label>
        <input type="number" required name="cost" value="{{old('cost')}}" class="form-control" placeholder="Cost">
    </div>

    <div class="form-group form-group mb-3 col-md-6 col-6">
        <label class="form-label" for="basic-icon-default-state">Tax (%)<span class="text-red">*</span></label>
        <input type="number" required name="tax" max="100" value="{{old('tax')}}" class="form-control" placeholder="Tax">
    </div>

    <div class="form-group form-group mb-3 col-md-6 col-6">
        <label class="form-label" for="basic-icon-default-state">Total Amount <span class="text-red">*</span></label>
        <input type="number" required name="total" value="{{old('total')}}" class="form-control" placeholder="Total Amount">
    </div>

    <div class="form-group form-group mb-3 col-md-6 col-6">
        <label class="form-label" for="basic-icon-default-state">TDS<span class="text-red">*</span></label>
        <input type="number" name="tds" value="{{old('tds')}}" class="form-control" placeholder="TDS">
    </div>

    <div class="form-group form-group mb-3 col-md-6 col-6">
        <label class="form-label" for="basic-icon-default-state">Credit Period<span class="text-red">*</span></label>
        <input type="number" name="credit_period" value="{{old('credit_period')}}" class="form-control" placeholder="Credit Period">
    </div>
    <div class="form-group form-group mb-3 col-md-6 col-6">
        <label>Attachment <span class="text-red">*</span></label>
        <input type="file" name="file" />
    </div>
    <div class="form-group mb-3 col-md-12 col-12">
        <label class="form-label" for="basic-icon-default-email">Details</label>
        <textarea id="" cols="30" rows="5" placeholder="Enter Your Expense Details" name="details" class="form-control"></textarea>
    </div>
</div>
