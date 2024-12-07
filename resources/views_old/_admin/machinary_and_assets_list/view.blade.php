<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">View Machinery</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">
            <table class="table">
                <tr>
                    <td><strong>Owner Name:</strong>{{@$data->owner_name}}</td>
                    <td><strong>Assets Category:</strong>{{@$data->category->category_name}}</td>
                </tr>
                <tr>
                    <td><strong>Machine Name:</strong>{{@$data->machine_name}}</td>
                    <td><strong>Machine Quantity:</strong>{{@$data->machine_qty}}</td>
                </tr>
                <tr>
                    <td><strong>Machine/Assets Bill:</strong><a href="{{ asset('public/machineassetsbill/' . $data->machine_assets_bill) }}" target="_blank">{{ $data->machine_assets_bill }}</a></td>
                    <td><strong>Insurance Documents:</strong><a href="{{ asset('public/insurancefile/' . $data->insurance_file) }}" target="_blank">{{ $data->insurance_file }}</a></td>
                </tr>
                <tr>
                    <td><strong>Date Of Purchased:</strong>{{date('d-m-Y', strtotime($data->date_of_purchase)) }}</td>
                    <td><strong>Warranty Expiration:</strong>{{date('d-m-Y', strtotime($data->warranty_expiration)) }}</td>
                </tr>

                <tr>
                    <td><strong>Model Number:</strong>{{@$data->model_number}}</td>
                    <td><strong>Machine/Assets Price:</strong>{{@$data->achine_asset_price}}</td>
                </tr>
                <tr>
                    <td><strong>Tax Rate:</strong>{{@$data->tax_rate}}%</td>
                    <td><strong>Total Payble Ammount:</strong>{{@$data->total_payble_amount}}/-</td>
                </tr>
                <tr>
                    <td><strong>Customs Code:</strong>@if(@$data->customs_code_id == 1)
                        HSN
                        @else

                        SAC
                        @endif
                    </td>
                    <td><strong>Code Number:</strong>{{@$data->code_number}}</td>
                </tr>
                <tr>
                    <td><strong>Uqc:</strong>{{@$data->uqc->uqc_code}}</td>
                    <td><strong>Unique Code:</strong>{{@$data->unique_code}}</td>
                </tr>
                <tr>
                    <td><strong>Vendor:</strong>{{@$data->vendore->vendor_name}}</td>
                </tr>
            </table>
        </div>
    </div>
</div>