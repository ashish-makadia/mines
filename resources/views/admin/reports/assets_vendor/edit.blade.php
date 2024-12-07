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
                                        <h4>Edit Assets Vendor</h4>
                                    </div>
                                    <div class="col-md-2 col-3">

                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                            <form action="{{route('reports-assets-vendor.update', $assets_vendor->id)}}" method="post" enctype="multipart/form-data" id="editassign">
                                @csrf
                                @method('PATCH')
                                @include('admin.reports.assets_vendor._form');
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
    @include('admin.reports.assets_vendor.script')
@endsection
