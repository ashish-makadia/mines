@extends('layout.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">

                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item">Mines</li>
                        <li class="breadcrumb-item">Add Machinery / Assets </li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-10 col-9">
                                    <h4>Add Machinery / Assets</h4>
                                </div>
                                <div class="col-md-2 col-3">
                                    <a href="{{route('mine-machinary-assets-list-managment')}}" class="btn btn btn-primary btn-sm float-right">Machinery / Asset
                                        List</a>
                                </div>
                            </div>
                        </div>
                        <form action="{{route('mine-machinary-assets-store-managment')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">

                                    <div class="mb-3 col-md-4 col-12">
                                        <label for="exampleInputPassword1">Owner Name<span class="text-red">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span id="basic-icon-default-fullname2" class="input-group-text">
                                                    <i class="fa fa-building"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Owner Name" name="owner_name" value="{{old('owner_name')}}" id="exampleInputPassword1" >
                                        </div>
                                        @error('owner_name')
                                        <div class="text-red">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    <div class="form-group  col-md-4 col-12">
                                        <label>Assets Category<span class="text-red">*</span></label>
                                        <select class="form-control select2 a3" name="asset_category_id" >
                                            <option value="" selected>Select Assets</option>
                                            @foreach($assetCategorys as $assetCategory)
                                         <option value="{{$assetCategory->id}}" {{ old('asset_category_id') == $assetCategory->id ? 'selected' : '' }}>
            {{$assetCategory->category_name}}
        </option>
                                            @endforeach
                                        </select>
                                        @error('asset_category_id')
                                        <div class="text-red">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3 col-md-4 col-12">
                                        <label for="exampleInputPassword1">Machine Name<span class="text-red">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span id="basic-icon-default-fullname2" class="input-group-text">
                                                    <i class="fa fa-industry" aria-hidden="true"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" name="machine_name" value="{{old('machine_name')}}" placeholder="Machine Name" id="exampleInputPassword1" >
                                        </div>
                                        @error('machine_name')
                                        <div class="text-red">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3 col-md-4 col-12">
                                        <label for="exampleInputPassword1">Machine Quantity<span class="text-red">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span id="basic-icon-default-fullname2" class="input-group-text">
                                                    <i class="fa fa-list-ol" aria-hidden="true"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" name="machine_qty" value="{{old('machine_qty')}}" placeholder="Machine Quantity" id="exampleInputPassword1" >
                                        </div>
                                        @error('machine_qty')
                                        <div class="text-red">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3 col-md-4 col-12">
                                        <label for="exampleInputPassword1">Machine/Assets Bill<span class="text-red">*</span></label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="machine_assets_bill" value="{{old('machine_assets_bill')}}" id="customFile" >
                                            <label class="custom-file-label" for="customFile">Machine
                                                Bill</label>
                                        </div>
                                        @error('machine_assets_bill')
                                        <div class="text-red">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3 col-md-4 col-12">
                                        <label for="exampleInputPassword1">Insurance Documents<span class="text-red">*</span></label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="insurance_file" id="customFile" >
                                            <label class="custom-file-label" for="customFile">insurance
                                                documents</label>
                                        </div>
                                        @error('insurance_file')
                                        <div class="text-red">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3 col-md-4 col-6">
                                        <label>Date Of Purchased<span class="text-red">*</span></label>
                                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input" name="date_of_purchase" value="{{old('date_of_purchase')}}" data-target="#reservationdate" placeholder="Date Of Purchased" />
                                            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i>
                                                </div>
                                            </div>
                                        
                                        </div>
                                        @error('date_of_purchase')
                                        <div class="text-red">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    

                                    <div class="form-group mb-3 col-md-4 col-6">
                                        <label>Warranty Expiration<span class="text-red">*</span></label>
                                        <div class="input-group date" id="reservationdate1" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input" name="warranty_expiration" value="{{old('warranty_expiration')}}" data-target="#reservationdate1" placeholder="Warranty Expiration" />
                                            <div class="input-group-append" data-target="#reservationdate1" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i>
                                                </div>
                                            </div>
                                        
                                        </div>
                                        @error('warranty_expiration')
                                        <div class="text-red">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3 col-md-4 col-12">
                                        <label for="exampleInputPassword2">Model Number<span class="text-red">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span id="basic-icon-default-company2" class="input-group-text"><i class="fa fa-box" aria-hidden="true"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="model_number" value="{{old('model_number')}}" id="exampleInputPassword2" placeholder="Model Number" >
                                        </div>
                                        @error('model_number')
                                        <div class="text-red">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3 col-md-4 col-6">
                                        <label for="exampleInputPassword4"> Machine/Assets Price<span class="text-red">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-money-check"></i></span>
                                            </div>
                                            <input type="number" class="form-control" name="achine_asset_price" value="{{old('achine_asset_price')}}" id="exampleInputPassword4" placeholder="Price" >
                                        </div>
                                        @error('achine_asset_price')
                                        <div class="text-red">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-4 col-6">
                                        <label for="exampleInputPassword5">Tax Rate<span class="text-red">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-percent"></i></span>
                                            </div>
                                            <input type="number" class="form-control" name="tax_rate" value="{{old('tax_rate')}}" id="exampleInputPassword5" min="0"  placeholder="Tax Rate" >
                                        </div>
                                        @error('tax_rate')
                                        <div class="text-red">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3 col-md-4 col-12">
                                        <label for="exampleInputPassword5">Total Payble Ammount<span class="text-red">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-book"></i></span>
                                            </div>
                                            <input type="number" class="form-control" name="total_payble_amount" value="{{old('total_payble_amount')}}" id="exampleInputPassword5" min="0" placeholder="Total Payment" >
                                        </div>
                                        @error('total_payble_amount')
                                        <div class="text-red">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3 col-md-3 col-12">
                                        <label>Customs Code<span class="text-red">*</span></label>
                                        <select class="form-control select2 a3" name="customs_code_id" >
                                            <option value="" selected>Select Code<span class="text-red">*</span></option>
                                          <option value="1" {{ old('customs_code_id') == 1 ? 'selected' : '' }}>HSN</option>
    <option value="2" {{ old('customs_code_id') == 2 ? 'selected' : '' }}>SAC</option>
                                        </select>
                                        @error('customs_code_id')
                                        <div class="text-red">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-3 col-12">
                                        <label for="exampleInputPassword7">Code Number<span class="text-red">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-list-ol" aria-hidden="true"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="code_number" value="{{old('code_number')}}" placeholder="code number type" id="exampleInputPassword7" >
                                        </div>
                                        @error('code_number')
                                        <div class="text-red">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    <div class="mb-3 col-md-3 col-12">
                                        <label class="form-label" for="exampleInputPassword8">UQC<span class="text-red">*</span></label>
                                        <select class="form-control select2 a3" id="exampleInputPassword8" name="uqc_id" >
                                            <option value="">Select Unique Quantity Code<span class="text-red">*</span></option>
                                            @foreach($qucs as $quc)
                                            <option value="{{$quc->id}}" {{ old('uqc_id') == $quc->id ? 'selected' : '' }}>{{$quc->uqc_code}}</option>
                                            @endforeach
                                        </select>
                                        @error('uqc_id')
                                        <div class="text-red">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3 col-md-3 col-12">
                                        <label class="form-label" for="exampleInputPassword9">Unique Code
                                        <span class="text-red">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-barcode" aria-hidden="true"></i></span>
                                            </div>
                                            <input type="number" class="form-control" name="unique_code" value="{{old('unique_code')}}" placeholder="Barcode" id="exampleInputPassword9" >
                                        </div>
                                        </select>
                                        @error('unique_code')
                                        <div class="text-red">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    <div class="mb-3 col-md-12 col-12">
                                        <label for="exampleInputPassword3"> Description</label>
                                        <textarea class="form-control" id="exampleInputPassword3" name="description" placeholder="descripation">{{old('description')}}</textarea>
                                    </div>
                                    <div class="form-group  col-md-3 col-12">
                                        <label>Vendor<span class="text-red">*</span></label>
                                        <select class="form-control  select2 a3" name="vendor_id" >
                                            <option value="">Select Vendor</option>
                                            @foreach($vendors as $vendor)
                                            <option value="{{$vendor->id}}" {{ old('vendor_id') == $vendor->id ? 'selected' : '' }}>{{$vendor->vendor_name}}</option>
                                            @endforeach
                                        </select>
                                        @error('vendor_id')
                                        <div class="text-red">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>
                                <center>
                                    <!-- <a href="machinerylist.html" class="btn btn-success btn-sm mt-3 ">Submit</a> -->
                                    <button class="btn btn-success btn-sm mt-3 " type="submit">Submit</button>
                                    <button type="reset" class="btn btn-warning btn-sm mt-3">Reset</button>
                                </center>

                                <!-- /.card-body -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


</div>

@endsection