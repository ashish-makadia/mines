<script>
    $(".vendor_id").on("change",function(){
        var vendorId = $(this).val();
        $.ajax({
                url: "{{route('report.assets-vendor.get-vendor-assets')}}",
                type: 'POST',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data:{
                    id:vendorId
                },
                success: function(result) {
                    var totalUnit = $('input[name="products_block"]').val(result.data);
                    var stockTable = `<table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th> Purchase Date </th>
                                        <th> Assets </th>
                                        <th> Qty</th>
                                        <th> Amount </th>
                                    </tr>
                                </thead>
                                <tbody>`;
                                    var baseUrl = "{{ url('public/uploads/step3') }}";
                                    $.each(result.assets, function(key, value) {
                                        stockTable += `<tr>
                                        <td>${moment(value.date_of_purchase).format("DD-MM-YYYY")}</td>
                                        <td>${value.machine_name}</td>
                                        <td>${value.machine_qty}</td>
                                        <td>${value.total_payble_amount}</td>
                                    </tr>`;
                                    });
                                stockTable +`</tbody>
                            </table>`;
                            // console.log(stockTable);
                            $(".totalAmount").val(result.totalAmount)
                            $("#stock_html").html(stockTable);
                    // location.reload();
                }
            });
    });
    $('input[name="payment_amount"]').on("keyup", function() {
        var totalAmountEdit = "{{isset($assets_vendor->total_amount)?$assets_vendor->total_amount:0}}"
        var paymentAmount = parseFloat($(this).val());
        var totalAmount = $('input[name="total_amount"]').val();
         var remainingAmount = (totalAmountEdit>0?totalAmountEdit:totalAmount) - paymentAmount;
        $('input[name="remaining_amount"]').val(remainingAmount)
    });
</script>
