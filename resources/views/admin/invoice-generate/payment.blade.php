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
                            <li class="breadcrumb-item">Invoice List</li>
                            <li class="breadcrumb-item">Generate Invoice</li>
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
                                        <h4>Payment</h4>
                                    </div>
                                    <div class="col-md-2 col-3">
                                        <a href="{{ route('invoice-generate') }}"
                                            class="btn btn btn-primary btn-sm float-right">Invoice
                                            List</a>
                                    </div>
                                </div>
                            </div>
                            <form action="{{ route('invoice-generate.payment', $invoice_generate->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3 col-6  mb-3">
                                            <div class="form-group">
                                                <label>Invoice no.</label>
                                                <select name="invoice_id" id="invoice_id" class="form-control select2 a3" disabled>
                                                <option selected>Select Invoice no.</option>
                                                @foreach ($invoice as $item)
                                                        <option value="{{$item->id}}" @if(isset($invoice_generate->id) && $item->id == $invoice_generate->id) selected @endif>{{$item->invoice_no}}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div>
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
                                        <div class="form-group mb-3 col-md-4 col-12">
                                            <label>Pay Amount</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span id="basic-icon-default-fullname2" class="input-group-text">
                                                        <i class="fa fa-money-bill" aria-hidden="true"></i>
                                                        </span>
                                                </div>
                                                <input type="number" name="pay_amount" id="pay_amount" class="form-control" placeholder="Total Tax Amount">
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

                                    </div>
                                    <center>
                                        <button type="submit" class="btn btn-success btn-sm mt-3">Submit</a>
                                        <button type="reset" class="btn btn-warning btn-sm mt-3">Reset</button>
                                    </center>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push("scripts")
<script>
     $("#pay_amount").on("keyup",function(){
        var remainingAmount = "{{$invoice_generate->remaining_amount}}";
        if(parseFloat($(this).val()) > 0){
            var pay_amount = remainingAmount-parseFloat($(this).val());
        var totalAmount = parseFloat($("#total_amount").val());
        $("#remaining_amount").val(pay_amount );
        }

    });
</script>
@endpush
