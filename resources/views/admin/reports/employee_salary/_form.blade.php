<div class="d-flex w-100 justify-content-between row">
    <div class="form-group mb-3 col-md-6 col-12">
        <label> Date</label>
        <div class="input-group date" id="reservationdate" data-target-input="nearest">
            <input type="datetime" id="payment_date" name="payment_date" class="form-control datetimepicker-input" data-target="#reservationdate" placeholder="Select Date" value={{date("d-m-y")}} required/>
            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
            </div>
        </div>
    </div>
    <div class="mb-3 col-md-6 col-12">
        <label for="exampleInputPassword1">Employee</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span id="basic-icon-default-fullname2" class="input-group-text">
                    <i class="fa fa-plus"></i>
                </span>
            </div>
            <select name="employee_id" id="employee_id" class="form-control select2 a3" required>
                <option value="" selected>Select Employee</option>
                @foreach ($employees as $item)
                    <option @if(isset($employee_salary) && $employee_salary->employee_id == $item->id){{"selected"}} @endif value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<div class="row">
    <div class="mb-3 col-md-6 col-12">
        <label for="exampleInputPassword1">Total Salary</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span id="basic-icon-default-fullname2" class="input-group-text">
                    <i class="fa fa-plus"></i>
                </span>
            </div>
            <input type="number" readonly id="total_employee_salary" required value="{{isset($diesel_stock)?$diesel_stock->total_amount:""}}" class="form-control total_employee_salary" placeholder="Enter Total Amount">
        </div>
        <span class='text-danger qty_err' id="qty_err"></span>
    </div>
    <div class="mb-3 col-md-6 col-12">
        <label for="exampleInputPassword1">Total Paid Salary</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span id="basic-icon-default-fullname2" class="input-group-text">
                    <i class="fa fa-plus"></i>
                </span>
            </div>
            <input type="number" name="total_salary" id="total_salary" required value="{{isset($employee_salary)?$employee_salary->total_salary:""}}" readonly class="form-control" placeholder="Total Salary">
        </div>
    </div>
</div>
<div class="row">
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

