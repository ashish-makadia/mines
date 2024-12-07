  <form id="step1-form">
    @csrf
    <div class="row">
        <div class="mb-3 col-md-4 col-12">
            <label for="exampleInputPassword1">W / P No. </label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span id="basic-icon-default-fullname2"
                        class="input-group-text">
                        <i class="fa fa-building"></i>
                    </span>
                </div>
                <input type="text" name="wp_no" class="form-control"
                    placeholder="Auto No. Like :- ABC001"
                    id="exampleInputPassword1" value="{{isset($wip->wp_no)?$wip->wp_no:$wipNo}}" readonly>
            </div>
        </div>

        <div class="mb-3 col-md-4 col-12">
            <label for="exampleInputPassword1">Target </label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span id="basic-icon-default-fullname2"
                        class="input-group-text">
                        <i class="fa fa-industry" aria-hidden="true"></i>
                    </span>
                </div>
                <input type="text" name="target" class="form-control"
                    placeholder="140 Ton" id="exampleInputPassword1" value="{{isset($wip->target)?$wip->target:old('target')}}">
            </div>

        </div>

        <div class="form-group  col-md-4 col-12">
            <label>Volume </label>
            <select class="form-control select2 a3" name="quc_id">
                <option value="">Select volume</option>
                @foreach ($quc as $i)
                    <option value="{{ $i->id }}" @if(isset($wip->quc_id) && $wip->quc_id == $i->id) selected @endif>{{ $i->uqc_code }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3 col-md-4 col-12">
            <label for="exampleInputPassword1">No. of Days</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span id="basic-icon-default-fullname2"
                        class="input-group-text">
                        <i class="fa fa-list-ol" aria-hidden="true"></i>
                    </span>
                </div>
                <input type="text" name="no_of_days" class="form-control"
                    placeholder="15" id="exampleInputPassword1" value="{{isset($wip->no_of_days)?$wip->no_of_days:old('no_of_days')}}">
            </div>
        </div>

        <div class="form-group mb-3 col-md-4 col-12">
            <label>In Charge</label>
            <select class="form-control select2 a3" name="incharge_id">
                <option value="" selected>Select User</option>
                @foreach ($emp as $i)
                    <option value="{{ $i->id }}" @if(isset($wip->incharge_id) && $wip->incharge_id == $i->id) selected @endif>{{ $i->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3 col-md-4 col-6">
            <label>Stage 1 Start Date</label>
            <div class="input-group date" id="reservationdate"
                data-target-input="nearest">
                <input type="text" name="start_date"
                    class="form-control datetimepicker-input"
                    data-target="#reservationdate"
                    placeholder="Stage 1 Start Date - IMP- not allowed past date"
                    value= {{isset($wip->start_date)?date('d-m-y',strtotime($wip->start_date)):date('d-m-y')}} />
                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                    <div class="input-group-text"><i
                            class="fa fa-calendar"></i></div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden"  class="wipId" name="wipId" value="{{isset($wip->id)?$wip->id:0}}" />
    <button type="submit" class="btn btn-primary submitBtn">Finish</button>
</form>


