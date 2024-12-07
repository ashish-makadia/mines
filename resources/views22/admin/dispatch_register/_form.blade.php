@csrf
    <div class="d-flex w-100 justify-content-between row">
        <div class="form-group col-md-6 col-12">
            <label>Mines From:</label>
            <select class="form-control select2 a3" name="mine_id" id="mine_id" required>
                <option value="" selected>Select mines</option>
                @foreach($mines as $mine)
                    <option value="{{$mine->id}}" @if(isset($dispatch_register->mine_id) && $mine->id == $dispatch_register->mine_id) selected @endif>{{$mine->mine_name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group  col-md-6 col-12">
            <label>Issued to Asset</label>
            <select class="form-control select2 a3" onChange="getAssets(this.value)" name="issued_assets" id="issued_assets" required>
                <option value="" selected>Select Assets</option>
                @foreach($assetCategorys as $assetCategory)
                    <option value="{{$assetCategory->id}}" @if(isset($dispatch_register->issued_assets) && $assetCategory->id == $dispatch_register->issued_assets) selected @endif>{{$assetCategory->category_name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group mb-3 col-md-6 col-12">
            <label>Assets Name</label>
            <select class="form-control select2 a3 assets_name"  onChange="getAssetsData(this.value)" name="assets_name" id="assets_name" required>
                <option value="" selected>Select Assets</option>
            </select>
        </div>
        <div class="form-group mb-3 col-md-6 col-12">
            <label for="exampleInputPassword1">Assigned Qty</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span id="basic-icon-default-fullname2" class="input-group-text">
                        <i class="fa fa-plus"></i>
                    </span>
                </div>
                <input type="number" step="any" id="assign_qty" readonly class="form-control assign_qty"  name="assign_qty" value="{{isset($dispatch_register->assign_qty)?$dispatch_register->assign_qty:old('assign_qty')}}" required>
            </div>

        </div>
        <div class="form-group mb-3 col-md-6 col-12">
            <label for="exampleInputPassword1">Quantity Issued</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span id="basic-icon-default-fullname2" class="input-group-text">
                        <i class="fa fa-plus"></i>
                    </span>
                </div>
                <input type="number" step="any" id="quantity" class="form-control quantity" placeholder="Enter Quantity" name="quantity_issued" value="{{isset($dispatch_register->quantity_issued)?$dispatch_register->quantity_issued:old('quantity_issued')}}" required>
            </div>
            <span class='text-danger' id="qty_err"></span>
        </div>
        <div class="form-group mb-3 col-md-6 col-12">
            <label>Issued By</label>
            <select class="form-control select2 a3" name="issued_by" id="issued_by" required>
                <option value="" selected>Select Issued By</option>
                @foreach($users as $user)
                    <option value="{{$user->id}}" @if(isset($dispatch_register->issued_by) && $user->id == $dispatch_register->issued_by) selected @endif>{{$user->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group mb-3 col-md-6 col-12">
            <label for="exampleInputPassword1">Pending Quantity</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span id="basic-icon-default-fullname2" class="input-group-text">
                        <i class="fa fa-plus"></i>
                    </span>
                </div>
                <input type="number" step="any" readonly id="pending_quantity" class="form-control pending_quantity" placeholder="Enter Quantity" name="pending_quantity" value="{{isset($dispatch_register->pending_quantity)?$dispatch_register->pending_quantity:old('pending_quantity')}}" required>
            </div>
        </div>

        <div class="form-group mb-3 col-md-6 col-12">
            <label>Issued For</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span id="basic-icon-default-fullname2" class="input-group-text">
                        <i class="fa fa-plus"></i>
                    </span>
                </div>
                <input type="text" class="form-control" placeholder="Enter issued for" id="issued_for" name="issued_for" value="{{ isset($dispatch_register->issued_for)?$dispatch_register->issued_for:old('issued_for')}}" required>
            </div>
        </div>
        {{-- <div class="mb-3 col-md-12 col-12">
            <label for="remarks"> Remarks</label>
            <textarea class="form-control" id="remarks" name="remarks" placeholder="remarks">{{isset($dispatch_register->remarks)?$dispatch_register->remarks:old('remarks')}}</textarea>
        </div> --}}
    </div>
    <div class="modal-footer a18">
        <button type="submit" class="btn btn-success btn-sm mt-3 ">Submit</button>
        <button type="reset" class="btn btn-warning btn-sm mt-3">Reset</button>
    </div>



