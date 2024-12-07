<script>
      $.validator.setDefaults({
            submitHandler: function (form) {
                // Your AJAX code to submit the form can go here
                form.submit();
            }
        });

        $('#invoice-generate-form').validate({
            rules: {
                wip_id: {
                    required: true,
                },
                mine_id: {
                    required:true
                },
                invoice_no: {
                    required: true,
                },
                consignee_id: {
                    required: true,
                },
                buyer_order_no: {
                    required: true,
                },
                delivery_date: {
                    required: true,
                },
                dispatch_through: {
                    required: true,
                },
                buyer_order_no: {
                    required: true,
                },
                buyer_id: {
                    required: true,
                },
                customer_id: {
                    required: true,
                },
                bill_type: {
                    required: true,
                },
                hsn: {
                    required: true,
                },
                volume: {
                    required: true,
                },
                sell_amount: {
                    required: true,
                },
                 total_amount: {
                    required: true,
                },
                Pay_amount: {
                    required: true,
                },
            },
            messages: {
                sales_date: {
                    required: "Please select a date of sale.",
                },
                assets_type: {
                    required: "Please select a assets type.",
                },
                assets_name: {
                    required: "Please Enter Asset name.",
                },
                quantity: {
                    required: "Please Enter quantity.",
                },
                transfer_mine_name: {
                    required: "Please Enter transfer mine name.",
                },
                assets_category: {
                    required: "Please select an asset category.",
                }
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
        
    $("#mine_id").on("change",function(){
        mineID = $(this).val();
        $.ajax({
            url: "{{ route('get-hsn-code')}}",
            type: 'post',
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:{id:mineID},
            success: function(data) {
                $("#hsn").val(data.hsn)
            }
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
    $("#bill_type").on("change",function(){
        console.log($(this).val());
        var billType = $(this).val();
        $(".gst_row").addClass("d-none");
        if(billType === "gst_bill"){
            $(".gst_row").removeClass("d-none");
        }
    });
    $("#wip_no").on("change",function(){
        mineID = $(this).val();
        $.ajax({
            url: "{{ route('get-sell-amount')}}",
            type: 'post',
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:{id:mineID},
            success: function(data) {
                $("#sell_amount").val(data.rate);
                $("#taxable_amount").val(data.rate);
                $("#total_amount").val(data.rate);
                calculateTaxAmount();
            }
        });
    });

    function calculateTaxAmount(){
        var cgst = parseFloat($("#cgst").val());
        var sgst = parseFloat($("#sgst").val());
        var sellAmount = parseFloat($("#sell_amount").val());
        var cgstAmount = 0;
        var sgstAmount = 0;
        if(cgst > 0 && sgst > 0){
            $("#central_tax").val(cgst);
            $("#state_tax").val(sgst);

            cgstAmount = (sellAmount * cgst)/100;
            sgstAmount = (sellAmount * sgst)/100;

            $("#cgst_amount").val(cgstAmount);
            $("#sgst_amount").val(sgstAmount);

            $("#central_tax").val(cgstAmount);
            $("#state_tax").val(sgstAmount);
        }
        $("#total_taxAmount").val(cgstAmount+sgstAmount);
        var totalAmount = (cgstAmount+sgstAmount) + sellAmount;
        $("#total_amount").val(totalAmount);
        $("#rs_word").val(price_in_words(totalAmount));
    }

    $("#pay_amount").on("keyup",function(){
        var pay_amount = parseFloat($(this).val());
        var totalAmount = parseFloat($("#total_amount").val());
        $("#remaining_amount").val(totalAmount-pay_amount );
    });

</script>

