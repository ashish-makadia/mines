
<div class="d-flex w-100 justify-content-between row">
    <div class="form-group mb-3 col-md-6 col-6">
        <label>Assets Assign Date </label>
        <div class="input-group date reservationdate" id="reservationdate" data-target-input="nearest">
            <input type="text" class="form-control datetimepicker-input" name="sales_date"
                value="{{ isset($assign_assets->sales_date) ? date('d-m-Y', strtotime($assign_assets->sales_date)) : old('sales_date') ?? date('d-m-Y') }}"
                data-target="#reservationdate" placeholder="Date Of Sale" />
            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                <div class="input-group-text"><i class="fa fa-calendar"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group  col-md-6 col-12">
        <label>Assets Category</label>
        <select class="form-control select2 a3" name="assets_category" id="assets_category" onClick="getAssets(this.value)" required>
            <option value="" selected>Select Assets</option>
            @foreach ($assetCategorys as $assetCategory)
                <option value="{{ $assetCategory->id }}" @if (isset($assign_assets->assets_category) && $assetCategory->id == $assign_assets->assets_category) selected @endif>
                    {{ $assetCategory->category_name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group mb-3 col-md-6 col-12">
        <label>Assets Name</label>
        <div class="input-group">
            <select class="form-control select2 a3 assets_name"  onChange="getAssetsData(this.value)" name="assets_name" id="assets_name" required>
                <option value="" selected>Select Assets</option>
            </select>
            {{-- <div class="input-group-prepend">
                <span id="basic-icon-default-fullname2" class="input-group-text">
                    <i class="fa fa-file-signature"></i>
                </span>
            </div>
            <input type="text" class="form-control" placeholder="Enter Assets Name" id="assets_name"
                name="assets_name"
                value="{{ isset($assign_assets->assets_name) ? $assign_assets->assets_name : old('assets_name') }}"
                required> --}}
        </div>
    </div>
    <div class="form-group mb-3 col-md-6 col-12">
        <label for="exampleInputPassword1">Quantity</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span id="basic-icon-default-fullname2" class="input-group-text">
                    <i class="fa fa-paperclip"></i>
                </span>
            </div>
            <input type="number" step="any" id="quantity" class="form-control quantity" placeholder="Enter Quantity"
                name="quantity" value="{{ isset($assign_assets->quantity) ? $assign_assets->quantity : old('quantity') }}"
                required>
        </div>
        <span class='text-danger' id="qty_err"></span>
    </div>
    <div class="form-group col-md-6 col-12">
        <label>Mines From:</label>
        <select class="form-control select2 a3"  name="mine_id" id="mine_id" readonly required>
            <option value="" >Select mines {{ $mineId }}</option>
            @foreach ($mines as $mine)
                <option value="{{ $mine->id }}" @if ((isset($assign_assets->mine_id) && $mine->id == $assign_assets->mine_id) || $mine->id == $mineId) selected @endif>
                    {{ $mine->mine_name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group mb-3 col-md-6 col-12">
        <label for="exampleInputPassword1">Transfer to mine name</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span id="basic-icon-default-fullname2" class="input-group-text">
                    <i class="fa fa-truck"></i>
                </span>
            </div>
            <!--<input type="text" class="form-control" placeholder="Transfer to mine name" name="transfer_mine_name" value="{{ isset($assign_assets->transfer_mine_name) ? $assign_assets->transfer_mine_name : old('transfer_mine_name') }}" required>-->
            <select class="form-control select2 a3" name="transfer_mine_name" id="transfer_mine_name" required>
                <option value="" selected>Select Transfer to mine</option>
                @foreach ($mines as $mine)
                    <option value="{{ $mine->id }}" @if (isset($assign_assets->transfer_mine_name) && $mine->id == $assign_assets->transfer_mine_name) selected @endif>
                        {{ $mine->mine_name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="mb-3 col-md-12 col-12">
        <label for="remarks"> Remarks</label>
        <textarea class="form-control" id="remarks" name="remarks" placeholder="remarks">{{ isset($assign_assets->remarks) ? $assign_assets->remarks : old('remarks') }}</textarea>
    </div>
</div>
<div class="modal-footer a18">
    <button type="submit" class="btn btn-success btn-sm mt-3 ">Submit</button>
    <button type="reset" class="btn btn-warning btn-sm mt-3">Reset</button>
</div>

