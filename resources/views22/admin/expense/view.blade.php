<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">View Expense</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>


        <div class="modal-body">
            <table class="table">
                <tr>
                    <td><strong>Date:</strong>{{date('d-m-Y', strtotime($data->expense_date)) }}</td>
                    <td><strong>Category:</strong>{{$data->category->exp_cat}}</td>
                </tr>
                <tr>
                    <td><strong>Amount:</strong>{{$data->amount}}/-</td>
                    <td><strong>Attachment:</strong><a href="{{ asset('public/attachment/' . $data->file) }}" target="_blank">Click Here</a></td>
                </tr>
                <tr>
                    <td><strong>Details:</strong>{{$data->details}}</td>
                    <td></td>
                </tr>

            </table>
        </div>
    </div>
</div>