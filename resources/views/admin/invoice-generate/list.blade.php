@extends('layout.app')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <a href="{{route('invoice-generate.create')}}" class="btn btn-primary btn-sm">Generate Invoice</a>

                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Invoice Generate</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-outline card-primary">
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Sr No.</th>
                                        <th>Invoice No.</th>
                                        <th>Date</th>
                                        <th>Customer Name</th>
                                        <th>Paid amount</th>
                                        <th>Total</th>
                                        <th>Payment Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>

            </div>
        </div>
    </section>
</div>

@endsection
@section('other-scripts')
<script type="text/javascript">
var oTable = "";
    $(function() {
        oTable = $('#example1').DataTable({
            processing: true,
            serverSide: true,
            bFilter: true,
            bInfo: true,
            paging: true,

            ajax: "{{ route('invoice-generate') }}",
           method:"get",
            columns: [{
                    "data": 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'invoice_no',
                    name: 'invoice_no'
                },
                {
                    data: 'invoice_date',
                    name: 'invoice_date',
                    render: (row, index) => {
                        return moment(row).format("DD-MM-YYYY");
                    }
                },
                {
                    data: null,
                    name: null,
                    render: (row, index) => {
                        return row.customer_id > 0 ? row.customers.customer_name : "";
                    }
                },
                {
                    data: 'pay_amount',
                    name: 'pay_amount'
                },
                {
                    data: 'total_amount',
                    name: 'total_amount'
                },

                {
                    data: 'payment_status',
                    name: 'payment_status'
                },
                {
                    data: null,
                    name: null,
                    orderable: false,
                    searchable: false,
                    render: (row, index) => {
                        let deleteUrl = "{{ route('invoice-generate.destroy', ':invoice_generate') }}";
                        deleteUrl = deleteUrl.replace(":invoice_generate", row.id);

                        let editUrl = "{{ route('invoice-generate.edit', ':invoice_generate') }}";
                        editUrl = editUrl.replace(":invoice_generate", row.id);

                        let printUrl = "{{ route('invoice-generate.show', ':invoice_generate') }}";
                        printUrl = printUrl.replace(":invoice_generate", row.id);

                        let paymentUrl = "{{ route('invoice-generate.payment', ':id') }}";
                        paymentUrl = paymentUrl.replace(":id", row.id);

                      var linkHtml = `<div class="d-flex action-btn-div">
                            <a href=${editUrl} class="btn btn-info btn-sm" > <i class="fas fa-pencil-alt"></i></a>&nbsp;`;
                            if (row.payment_status ==='completed')
                            linkHtml +=`<a href=${printUrl} target="_blank" class="btn btn-info btn-sm"><i class="fas fa-print"></i></a>&nbsp;`;
                            if (row.payment_status ==='pending')
                            linkHtml +=`<a href=${paymentUrl} class="btn btn-info btn-sm">Payment</a>&nbsp;`;
                            linkHtml +=`<a href="javascript:void(0);" onclick="deleteInvoice(${row.id})" class="btn btn-danger btn-sm" > <i class="fas fa-trash-alt"></i></a> </div>`;
                            return linkHtml;

                    }
                },
            ]
        });
    });
    
 function deleteInvoice(id){
        let deleteUrl = "{{ route('invoice-generate.destroy', ':invoice_generate') }}";
        deleteUrl = deleteUrl.replace(":invoice_generate", id);
        console.log("deleteUrl:: ",deleteUrl);
        if(confirm("Are you sure to delete this record?")){
                $.ajax({
                url: deleteUrl,
                type: 'DELETE',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    if(data.message){
                        toastr.success(data.message);
                    }
                    if(data.error){
                        toastr.error(data.error);
                    }
                    oTable.draw();
                    // location.reload();
                }
            });
        }

    }
</script>
@endsection
