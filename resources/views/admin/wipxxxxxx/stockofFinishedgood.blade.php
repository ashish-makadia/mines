@extends('layout.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Stock of Finished Goods</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{route("wip.index")}}">Work in progress</a></li>
                            <li class="breadcrumb-item active">Stock of Finished Goods</li>
                        </ol>

                    </div>

                </div>
            </div>
            <!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-outline card-primary">
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th> Date</th>
                                            <th> Height </th>
                                            <th> Weight</th>
                                            <th> Width</th>
                                            <th> Gun Foot</th>
                                            <th> No. of Pieces</th>
                                            <th> Photos</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($wip->wip_step3)
                                        @foreach ($wip->wip_step3 as $key => $data)
                                        <tr>
                                            <td>{{date("d-m-Y",strtotime($data->current_date))}}</td>
                                            <td>{{ $data->height }}</td>
                                            <td>{{ $data->weight }}</td>
                                            <td>{{ $data->width }}</td>
                                            <td>{{ $data->gunfoot }}</td>
                                            <td>{{ $data->no_of_pieces }}</td>
                                            <td>@if (isset($data->uploaded_pic) && $data->uploaded_pic != '')
                                                <div class="mb-3 col-md-1 col-12">
                                                    <img src="{{ url('public/uploads/step3/' . $data->wip_id . '/' . $data->uploaded_pic) }}"
                                                        style="width:50px;height:50px" />
                                                </div>
                                            @endif</td>
                                        </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>

                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>

                    <div class="col-12">
                        <div class="card card-outline card-primary">
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th> Name</th>
                                            <th> Date</th>
                                            <th> Quantity </th>
                                            <th> Volume</th>
                                            <th> Photo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($wip)
                                        <tr>
                                            <td>Waste</td>
                                            <td>{{date("d-m-Y",strtotime($wip->finished_current_date))}}</td>
                                            <td>{{$wip->waste_quantity}}</td>
                                            <td>{{$wip->waste_volume->uqc_code}}</td>
                                            <td>
                                                @if(isset($data->waste_uploaded_pic) && $data->waste_uploaded_pic !="")
                                                <img src="{{ url('public/uploads/' . $data->waste_uploaded_pic) }}"
                                                style="width:50px;height:50px" /></td>
                                               @endif
                                                
                                        </tr>
                                        <tr>
                                            <td>luffers</td>
                                            <td>{{date("d-m-Y",strtotime($wip->finished_current_date))}}</td>
                                            <td>{{$wip->luffers_quantity}}</td>
                                            <td>{{$wip->luffers_volume->uqc_code}}</td>
                                            <td>
                                                 @if(isset($data->luffers_uploaded_pic) && $data->luffers_uploaded_pic !="")
                                                <img src="{{ url('public/uploads/' . $data->luffers_uploaded_pic) }}"
                                                style="width:50px;height:50px" />
                                                @endif
                                            </td>
                                        </tr>

                                    @endif
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>

                </div>
            </div>
    </div>
    <!-- /.container-fluid -->
    </section>
    </div>
@endsection
@push('scripts')
   <script>
     $(function() {
         oTable = $('#example1').DataTable({
            processing: true,
            bFilter: true,
            searchable: true,
            bInfo: true,
            paging: true,
        });

        oTable = $('#example2').DataTable({
            processing: true,
            bFilter: true,
            searchable: true,
            bInfo: true,
            paging: true,
        });
    });
   </script>
@endpush
