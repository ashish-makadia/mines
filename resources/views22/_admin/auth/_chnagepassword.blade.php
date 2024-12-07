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
                        <li class="breadcrumb-item">Change Password</li>
                        <li class="breadcrumb-item">Change Password</li>
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

                        </div>
                        <div class="card-body">

                            <form action="{{route('post-change-password')}}" method="POST" id="formAuthentication">
                                @csrf

                                <input type="hidden" name="editid" value="{{@$id}}">
                                <div class="row">

                                    <div class="mb-3 col-md-4 col-12">
                                        <label>Old Password<span class="text-red">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span id="basic-icon-default-fullname2" class="input-group-text"><i class="fa fa-lock"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="old_password" value="{{ old('old_password') }}" placeholder="Old Password" required>
                                        </div>
                                    </div>

                                    <div class="mb-3 col-md-4 col-12">
                                        <label>New Password<span class="text-red">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span id="basic-icon-default-fullname2" class="input-group-text"><i class="fa fa-lock"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="password" value="{{ old('password') }}" placeholder="New Password" required>
                                        </div>
                                    </div>

                                    <div class="mb-3 col-md-4 col-12">
                                        <label>Confirm  Password<span class="text-red">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span id="basic-icon-default-fullname2" class="input-group-text"><i class="fa fa-lock"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="password_confirmation" value="" placeholder="Confirm  Password" required>
                                        </div>
                                    </div>
                                </div>
                                <center>

                                    <button type="submit" class="btn btn-success btn-sm mt-3">Submit</button>
                                    <button type="reset" class="btn btn-warning btn-sm mt-3">Reset</button>
                                </center>
                            </form>
                        </div>
                        <!-- /.card-body -->

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

@endsection