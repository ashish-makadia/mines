@extends('layout.printlayout')
@push('css')
<style>
@media print {
    #printbutton {
        display: none !important;
    }
    title {
        display: none;
    }
    .hiddenContent {
        display: none;
    }
}
</style>
@endpush
@section('content')

{{-- <div class="content-wrapper"> --}}
    <!-- Content Header (Page header) -->
    {{-- <section class="content-header">
        <div class="container-fluid"> --}}
            <div class="row mb-2">
                <div class="col-sm-6">
                    <a href="{{route("invoice-generate")}}" class="btn btn-primary btn-sm hiddenContent">Invoice List</a>
                    <div class="btn-group">
                        {{-- <button type="button" class="btn btn-secondary btn-sm" id="generate-pdf-btn" >PDF</button> --}}
                        {{-- <button type="button" class="btn btn-secondary btn-sm" onclick="sendEmail()">Email</button>
                        <button type="button" class="btn btn-secondary btn-sm" onclick="shareOnWhatsApp()">Whatsapp</button> --}}
                        <button type="button" class="btn btn-default btn-sm hiddenContent" id="printButton" onclick=" window.print();"><i class="fas fa-print"></i></button>
                    </div>
                </div>
                {{-- <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item">Invoice & Bill</li>
                        <li class="breadcrumb-item">Print</li>
                    </ol>
                </div> --}}
            </div>
        {{-- </div>
        <!-- /.container-fluid -->
    </section> --}}

    {{-- <section class="content">
        <div class="container-fluid"> --}}
            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card">
                        <div class="card-body" id="pdfContent">
                            <center>
                                <h5> <strong>Tax Invoice</strong></h5>
                            </center>
                            <div class="col-md-12 col-12 mt-3"></div>
                            <table class="table table-bordered">
                                <tr>
                                    <td colspan="3" rowspan="3">
                                        <strong class="a5">{{ $invoice_generate->mines->mine_name}}</strong><br>{{$invoice_generate->mines->gps_location}}<br> GSTIN/UIN: 08AEVFS3637Q1ZV<br> State Name : {{$invoice_generate->mines->state->name}},
                                    </td>
                                    <td colspan="2">
                                        <strong class="a10">Invoice No.</strong> <br> {{ $invoice_generate->invoice_no}}
                                    </td>
                                    <td colspan="2">
                                        <strong class="a10"> Date </strong><br> {{date("dd-mm-Y",strtotime($invoice_generate->invoice_date))}}
                                    </td>

                                </tr>

                                <tr>
                                    <td colspan="2">
                                        <strong class="a10">Delivery Note </strong><br> {{ $invoice_generate->delivery_note}}
                                    </td>
                                    <td colspan="2">
                                        <strong class="a10">Mode/Terms of Payment </strong> <br> {{ $invoice_generate->payment_mode}}
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <strong class="a10">Reference No. & Date.</strong> <br> {{date("dd-mm-Y",strtotime($invoice_generate->ref_date))}}
                                    </td>
                                    <td colspan="2">
                                        <strong class="a10">Other References</strong> <br>  {{ $invoice_generate->other_ref}}
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" rowspan="4">
                                        Consignee (Ship to) <br>
                                        <strong class="a5">{{ $invoice_generate->shippers->vendor_name}} <br>
                                        </strong><br> {{ $invoice_generate->shippers->vendor_addr}}<br>   {{ $invoice_generate->shippers->city->name}}<br> {{ $invoice_generate->shippers->vendor_pin}}<br> GSTIN/UIN : 08AAFCM4606E1ZP <br>State Name : {{ $invoice_generate->shippers->state->name}}<br>
                                    </td>
                                    <td colspan="2">
                                        <strong class="a10">Buyer's Order No. </strong><br>{{ $invoice_generate->buyer_order_no}}
                                    </td>
                                    <td colspan="2">
                                        <strong class="a10"> Date </strong><br>{{ date("dd-mm-Y",strtotime($invoice_generate->buyer_order_no))}}
                                    </td>

                                </tr>

                                <tr>
                                    <td colspan="2">
                                        <strong class="a10"> Dispatch Doc No.</strong><br>{{ $invoice_generate->dispatch_doc_no }}
                                    </td>
                                    <td colspan="2">
                                        <strong class="a10"> Delivery Note Date</strong><br>{{ date("dd-mm-Y",strtotime($invoice_generate->delivery_date))}}
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <strong class="a10"> Dispatched through</strong><br>{{ $invoice_generate->dispatch_through }}
                                    </td>
                                    <td colspan="2">
                                        <strong class="a10"> Destination</strong><br>{{ $invoice_generate->destination }}
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="2">
                                        <strong class="a10"> Bill of Lading/LR-RR No. </strong><br> {{ $invoice_generate->bill_land_no }}
                                    </td>
                                    </td>
                                    <td colspan="2">
                                        <strong class="a10"> Motor Vehicle No.</strong> <br> {{ $invoice_generate->motor_vehicle_no }}
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="3" rowspan="4">
                                        Buyer (Bill to)<br>
                                        <strong class="a5">{{ $invoice_generate->buyers->vendor_name}} <br>
                                        </strong><br> {{ $invoice_generate->buyers->vendor_addr}}<br> {{ $invoice_generate->buyers->city->name}}<br> {{ $invoice_generate->buyers->vendor_pin}}<br> GSTIN/UIN : 08AAFCM4606E1ZP <br>State Name : {{ $invoice_generate->buyers->state->name}}<br>

                                    </td>
                                    <td colspan="4" rowspan="4">
                                        {{ $invoice_generate->buyers->delivery_terms}}
                                    </td>
                                </tr>
                            </table>
                            <table class="table table-bordered">
                                <tr>
                                    <th> Sr <br> No.</th>
                                    <th>Height</th>
                                     <th>Weight</th>
                                      <th>Length</th>
                                        <th>GunFoot</th>
                                    <th class="text-center"> HSN/SAC</th>
                                    <th class="text-center"> Qty</th>
                                    <!--<th class="text-center"> Rate</th>-->
                                    <!--<th> Per</th>-->
                                    <!--<th class="text-center"> Amount</th>-->
                                </tr>
                                {{-- @foreach ($wip_step3 as $key => $item) --}}
                                <!--<tr>-->
                                <!--    <td>1</td>-->
                                <!--    <td><strong>Granite</strong> <br> VYNE1060850595 <br> <br> <br>-->
                                <!--        <p class="text-right"> <strong> CGST {{ $invoice_generate->cgst}}% <br> SGST {{ $invoice_generate->sgst}}%</strong></p> <br> <br> <br>-->
                                <!--    </td>-->
                                <!--    <td class="text-center">{{ $invoice_generate->hsn_no}} <br> <br> <br></td>-->
                                <!--    <td class="text-center"><strong>{{ $invoice_generate->wip->sell_qty}} {{ $invoice_generate->wip->quc->uqc_code}} </strong> <br> <br> <br></td>-->
                                <!--    <td class="text-center"> {{ $invoice_generate->wip->rate}} <br> <br> <br> <br>-->
                                <!--        <p class="text-right"> <strong>{{ $invoice_generate->cgst}} <br>{{ $invoice_generate->sgst}} </strong></p> <br> <br> <br>-->
                                <!--    </td>-->
                                <!--    <td> {{ $invoice_generate->wip->quc->uqc_code}} <br> <br> <br> <br>-->
                                <!--        <p> <strong>%<br>%</strong></p> <br> <br> <br>-->
                                <!--    </td>-->
                                <!--    <td class="text-right"><strong>{{ $invoice_generate->sell_amount }}</strong><br> <br> <br> <br>-->
                                <!--        <p class="text-right"> <strong>{{ $invoice_generate->cgst_amount }}<br>{{ $invoice_generate->sgst_amount }}</strong></p> <br> <br> <br>-->
                                <!--    </td>-->
                                <!--</tr>-->
                                {{-- @endforeach --}}
                            
                                @if(count($wip["sell_item"]) > 0)
                                  @foreach ($wip["sell_item"] as $key => $item)
                                <tr>
                                    <td>1</td>
                                    <td><strong>{{$item["wip_step3"]["height"]}}</strong>  
                                    </td>
                                    <td><strong>{{$item["wip_step3"]["weight"]}}</strong> 
                                    </td>
                                    <td><strong>{{$item["wip_step3"]["width"]}}</strong>
                                    </td>
                                     <td><strong>{{$item["wip_step3"]["gunfoot"]}}</strong>
                                    </td>
                                    <td class="text-center">{{ $invoice_generate->hsn_no}}</td>
                                     <td><strong>{{$item["sellQty"]}}</strong>
                                    </td>
                                    
                                    <!--<td class="text-center"><strong>{{ $invoice_generate->wip->sell_qty}} {{ $invoice_generate->wip->quc->uqc_code}} </strong></td>-->
                                    <!--<td class="text-center">-->
                                        
                                    <!--</td>-->
                                    <!--<td> {{ $invoice_generate->wip->quc->uqc_code}} -->
                                       
                                    <!--</td>-->
                                    <!--<td class="text-right"><strong>{{ $invoice_generate->sell_amount }}</strong>-->
                                    <!--    <p class="text-right"> <strong>{{ $invoice_generate->cgst_amount }}<br>{{ $invoice_generate->sgst_amount }}</strong></p>-->
                                    <!--</td>-->
                                </tr>
                               @endforeach
                               <tr>
                                    <td>1</td>
                                    <td><strong>
                                        <p class="text-right"> <strong> CGST {{ $invoice_generate->cgst}}% <br> SGST {{ $invoice_generate->sgst}}%</strong></p> <br> <br> <br>
                                    </td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                    <td class="text-right"> <br> <br> <br> <br>
                                        <p class="text-right"> <strong>{{ $invoice_generate->cgst}}% <br>{{ $invoice_generate->sgst}}%</strong></p> <br> <br> <br>
                                    </td>
                                    <td> <br> <br> <br> <br>
                                       
                                    </td>
                                    <td class="text-right"><strong>{{ $invoice_generate->wip->sell_qty}}{{ $invoice_generate->wip->quc->uqc_code}}<br/><br/><strong> {{ number_format($invoice_generate->sell_amount,2) }}</strong><br> <br> 
                                        <p class="text-right"> <strong>{{ number_format($invoice_generate->cgst_amount,2) }}<br> {{ number_format($invoice_generate->sgst_amount,2) }}</strong></p> <br> <br> <br>
                                    </td>
                                </tr>
@endif
                                <tr>
                                    <td></td>
                                    <td class="text-right"><strong>Total</strong></td>
                                    <td></td>
                                    <td class="text-center"><strong>{{ $invoice_generate->wip->sell_qty}}{{ $invoice_generate->wip->quc->uqc_code}} </strong></td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-right"><strong>{{ number_format($invoice_generate->total_amount,2) }} </strong></td>
                                </tr>

                            </table>

                            <table class="table table-bordered">

                                <tr>
                                    <td colspan="6">Amount Chargeable (in words)
                                        <br><strong> INR {{ $invoice_generate->rs_word}}  Only</strong>
                                    </td>
                                    <td class="text-right">E. & O.E</td>
                                </tr>
                                <tr>
                                    <td class="text-center">HSN/SAC</td>
                                    <td class="text-center">Taxable <br>Value</td>
                                    <td colspan="2" class="text-center">Central Tax
                                    </td>
                                    <td colspan="2" class="text-center">State Tax
                                    </td>
                                    <td class="text-center">Total <br>Tax Amount</td>
                                </tr>
                                <tr>
                                    <td class="text-left">{{ $invoice_generate->mines->hsn_no}} </td>
                                    <td class="text-center">{{ $invoice_generate->sell_amount}}</td>
                                    <td class="text-right">{{ $invoice_generate->central_tax}}%</td>
                                    <td class="text-right">{{ $invoice_generate->cgst_amount}}</td>
                                    <td class="text-right">{{ $invoice_generate->state_tax}}%</td>
                                    <td class="text-right">{{ $invoice_generate->sgst_amount}}</td>
                                    <td class="text-right">{{ $invoice_generate->total_taxable_amount}}</td>
                                </tr>

                                <tr>
                                    <th class="text-right">Total</th>
                                        <th class="text-center">{{ $invoice_generate->sell_amount}}</th>
                                        <th class="text-right"></th>
                                        <th class="text-right">{{ $invoice_generate->cgst_amount}}</th>
                                        <th class="text-right"></th>
                                        <th class="text-right">{{ $invoice_generate->sgst_amount}}</th>
                                        <th class="text-right">{{ $invoice_generate->total_amount}}</th>
                                    </tr>
                                </tr>
                                <tr>
                                    <td colspan="7">Tax Amount (in words) : <strong> {{ $invoice_generate->rs_word}} Only</strong> <br> </td>
                                </tr>
                                <tr>
                                    <td colspan="2">Declaration <br>
                                        <hr class="a14">
                                        <p class="a15"> {{ $invoice_generate->declaration}}</p>
                                    </td>

                                    <td colspan="5" class="text-right">
                                        <strong>For {{ $invoice_generate->mines->mine_name}}</strong>
                                        <br>  Authorised Signatory
                                    </td>
                                </tr>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        {{-- </div>
    </section> --}}
</div>
@include('layout.script')
@push("scripts")
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
<script>
    // Function to generate a PDF
    // function generatePDF() {
    //     const pdfContent = document.getElementById("pdfContent").innerHTML;
    //     const doc = new jsPDF();
    //     doc.fromHTML(pdfContent, 15, 15);
    //     doc.save("document.pdf");
    // }

    $('#generate-pdf-btn').click(function() {
        const pdfContent = document.getElementById("pdfContent");
html2canvas(pdfContent, {
    scrollX: 0,
    scrollY: -window.scrollY,
    windowWidth: document.documentElement.offsetWidth,
    windowHeight: document.documentElement.offsetHeight,
}).then(canvas => {
    const imgData = canvas.toDataURL('image/png');
    const pdf = new jsPDF('p', 'mm', 'a4');
    const imgProps = pdf.getImageProperties(imgData);
    const pdfWidth = pdf.internal.pageSize.getWidth();
    const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;
    pdf.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight);
    pdf.save('generated.pdf');
});
    });

    // Function to print the content
    function printContent() {
        window.print();
    }
</script>

@endpush
