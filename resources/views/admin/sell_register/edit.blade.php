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
                             <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('sell-register')}}">Sell Register</a></li>
                            <li class="breadcrumb-item">Edit Sell Register </li>
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
                                        <h4>Edit Sell Register</h4>
                                    </div>
                                    <div class="col-md-2 col-3">
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                            <form action="{{route('sell-register.update', $sell_register->id)}}" method="post" enctype="multipart/form-data" id="editassign">
                                @csrf
                                @method('PATCH')
                                @include('admin.sell_register._form')
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('other-scripts')
<script>
 $(".wipId").on("change",function(){
            var wipId = $(this).val();
            $.ajax({
                    url: "{{route("sell-register.get-stock")}}",
                    type: 'POST',
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data:{
                        wipId:wipId
                    },
                    success: function(result) {
                        var totalUnit = $('input[name="products_block"]').val(result.data);
                        var stockTable = `<table class="table table-bordered table-striped">
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
                                    <tbody>`;
                                        var baseUrl = "{{ url('public/uploads/step3') }}";
                                        $.each(result.wip, function(key, value) {
                                            stockTable += `<tr>
                                            <td>${value.height}</td>
                                            <td>${value.weight}</td>
                                            <td>${value.width}
                                                <input type="hidden" name="item_id[]" value=${value.id} />
                                                </td>
                                            <td><input type="number" name="total_item_qty[]" class="form-control total_item_qty" readonly value=${value.remQty}></td>
                                            <td><input type="number" name="sell_item_qty[]" class="form-control sell_item_qty"></td>
                                            <td><input type="number" name="rem_item_qty[]" readonly class="form-control rem_item_qty" value=${value.remQty}></td>`;

                                            // if (value.uploaded_pic && value.uploaded_pic != ''){
                                            //     stockTable += `<td>
                                            //         <div class="mb-3 col-md-1 col-12">
                                            //             <img src="${baseUrl}/${value.wip_id}/${value.uploaded_pic}"
                                            //                 style="width:50px;height:50px" />
                                            //         </div>
                                            //     </td>`;
                                            //  }
                                            stockTable += ` </tr>`;
                                        });
                                    stockTable +`</tbody>
                                </table>`;
                                // console.log(stockTable);
                                $("#stock_html").html(stockTable);
                        // location.reload();
                    }
                });
        });

        $(".sell_qty").on("keyup",function(){
            var sellQty = $(this).val();
            var totalQty = $('input[name="products_block"]').val();
            var pendQty = totalQty - sellQty;
            console.log(sellQty," !",totalQty," p ",pendQty);
            $(".qty_err").text("");
            if (parseFloat(sellQty) > parseFloat(totalQty)) {
                $(".qty_err").text("Quantity doen't allow greater than " + totalQty)
            }
                $('input[name="pending_qty"]').val(pendQty);


        })
        $(document).on('keyup', '.sell_item_qty', function(event) {
           var totalItemQty = $(this).closest("tr").find(".total_item_qty").val();
           var sellItemQty = $(this).closest("tr").find(".sell_item_qty").val();
           var remItemQty = parseFloat(totalItemQty) - parseFloat(sellItemQty);
           console.log(parseFloat(totalItemQty)," ",parseFloat(sellItemQty)," ",remItemQty);
           if(sellItemQty > 0)
           $(this).closest("tr").find(".rem_item_qty").val(remItemQty);
           var totalSellQty = 0;
           var totalRemQty = 0;
           $('.sell_item_qty').each(function(index) {
            console.log("sell_item_qty",($(this).val()));
                if($(this).val()>0){
                    totalSellQty += parseFloat($(this).val());
                }
           });
           $('.rem_item_qty').each(function(index) {
            console.log("rem_item_qty",($(this).val()));
            if($(this).val()>0){
                totalRemQty += parseFloat($(this).val());
            }
           });
           $(".sell_qty").val(totalSellQty);
           var totalQty = $('input[name="products_block"]').val();
           $('input[name="pending_qty"]').val(totalRemQty)

        });
</script>
@endsection
