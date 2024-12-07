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
                        <li class="breadcrumb-item">Mines</li>
                        <li class="breadcrumb-item">Edit Machinery / Assets </li>
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
                                    <h4>Edit Invoice Generate</h4>
                                </div>
                                <div class="col-md-2 col-3">
                                    <a href="{{route('invoice-generate')}}" class="btn btn btn-primary btn-sm float-right">Machinery / Asset List</a>
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('invoice-generate.update', $invoice_generate->id) }}" method="post" id="invoice-generate-form" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            {{-- <input type="hidden" name="editid" id="" value="{{@$data->id}}"> --}}
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
