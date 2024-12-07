@extends('layout.app')
@section('title', 'Create ' . $module_name)
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
                            <li class="breadcrumb-item">Add New Mine</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12 col-12">
                        <!-- general form elements -->
                        <div class="card card-outline card-primary">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-10 col-9">
                                        <h4>Edit Role</h4>
                                    </div>
                                    <div class="col-md-2 col-3">
                                        <a href="{{ route('roles.index') }}" class="btn btn btn-primary btn-sm float-right">Mines
                                            List</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <form class='form-horizontal' method="POST"
                                    action="{{ route("{$module_route}.update", $result['id']) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input name="_method" type="hidden" value="PUT">
                                    @include($module_form)
                                    <div class="text-right">
                                        <a href="{{ route("{$module_route}.index") }}"
                                            class="btn btn-danger btn-sm mr-2">Cancel</a>
                                        <button class="btn btn-success btn-sm" type="submit"><i class="fa fa-check"></i>
                                            Save
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
        @endsection
