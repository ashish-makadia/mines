








<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th> Date </th>
            <th> Height </th>
            <th> Weight</th>
            <th> Width</th>
            <th> Gun Foot</th>
            <th> sell Qty</th>
        </tr>
    </thead>
    <tbody>
        @if($sellItem)
        @foreach ($sellItem as $key => $data)
        <tr>
            <td>{{ date("d-m-Y",strtotime($data->created_at)) }}</td>
            <td>{{ $data->wip_step3->height }}</td>
            <td>{{ $data->wip_step3->weight }}</td>
            <td>{{ $data->wip_step3->width }}</td>
            <td>{{ $data->wip_step3->gunfoot }}</td>
            <td>{{ $data->sellQty }}</td>
        </tr>
        @endforeach
    @endif
    </tbody>
</table>
