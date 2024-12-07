<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Uqc Edit</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">
            <form action="{{route('quc-update-managment')}}" method="post">
                @csrf

                <input type="hidden" name="editid" value="{{@$uqc->id}}">
                <div class="d-flex w-100 justify-content-between row">

                    <div class="col-md-12 col-12  mb-3">
                        <div class="form-group">
                            <label>UQC</label>
                            <input type="text" class="form-control" name="uqc_code" value="{{@$uqc->uqc_code}}" placeholder="BOX(BOX)" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer a18">
                    <button type="submit" class="btn btn-success btn-sm" >Submit</button>
                </div>
            </form>

        </div>
    </div>
</div>