<div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">View Product</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <tr>
                        <td><strong>Product:</strong>{{@$product->product}}</td>
                        <td><strong>Mine Name:</strong>{{@$product->mine->mine_name}}</td>

                    </tr>

                    <tr>
                        <td><strong>Weight:</strong>{{@$product->weight}}</td>
                        <td><strong>Rate:</strong>{{@$product->rate}}/-</td>
                    </tr>
                    <tr>
                        <td><strong>Amount:</strong>{{@$product->amount}}/-</td>
                        <td></td>
                    </tr>

                </table>
            </div>
        </div>
    </div>