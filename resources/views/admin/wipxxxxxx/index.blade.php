@extends('layout.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Work In Progress Form</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Work In Progress Form</li>
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
                    <div class="col-md-12">
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title">-</h3>
                            </div>
                            <div class="card-body p-0">
                                <div class="bs-stepper">
                                    <div class="bs-stepper-header" role="tablist">
                                        <div class="step" data-target="#logins-part">
                                            <button type="button" class="step-trigger" role="tab"
                                                aria-controls="logins-part" id="logins-part-trigger">
                                                <span class="bs-stepper-circle">1</span>
                                                <span class="bs-stepper-label">Target Form</span>
                                            </button>
                                        </div>
                                        <div class="line"></div>
                                        <div class="step" data-target="#information-part">
                                            <button type="button" class="step-trigger" role="tab"
                                                aria-controls="information-part" id="information-part-trigger">
                                                <span class="bs-stepper-circle">2</span>
                                                <span class="bs-stepper-label">Finish Stage</span>
                                            </button>
                                        </div>
                                        <div class="line"></div>
                                        <div class="step active" data-target="#information-part-2">
                                            <button type="button" class="step-trigger" role="tab"
                                                aria-controls="information-part-2" id="information-part-2-trigger">
                                                <span class="bs-stepper-circle">3</span>
                                                <span class="bs-stepper-label">Final Finish Stage</span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="bs-stepper-content">
                                        <div id="logins-part" class="content" role="tabpanel"
                                            aria-labelledby="logins-part-trigger">
                                            @include('admin.wip._step1_form')
                                        </div>
                                        <div id="information-part" class="content" role="tabpanel"
                                            aria-labelledby="information-part-trigger">
                                            @include('admin.wip._step2_form')
                                        </div>
                                        <div id="information-part-2" class="content active" role="tabpanel"
                                            aria-labelledby="information-part-2-trigger">
                                            @include('admin.wip._step3_form')
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->

                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->

    </div>
    <!-- /.container-fluid -->
    </section>
    </div>
@endsection
@push('scripts')
    @include('admin.wip.script ')
@endpush
