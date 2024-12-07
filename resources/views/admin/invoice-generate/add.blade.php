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
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item">Invoice List</li>
                            <li class="breadcrumb-item">Generate Invoice</li>
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
                                        <h4>Generate Invoice</h4>
                                    </div>
                                    <div class="col-md-2 col-3">
                                        <a href="{{ route('invoice-generate') }}"
                                            class="btn btn btn-primary btn-sm float-right">Invoice
                                            List</a>
                                    </div>
                                </div>
                            </div>
                            <form action="{{ route('invoice-generate.store') }}" method="post"
                                enctype="multipart/form-data" id="invoice-generate-form">
                                @csrf
                               @include('admin.invoice-generate._form')
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push("scripts")
@include('admin.invoice-generate.script')
@endpush
