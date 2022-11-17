@extends('admin.layouts.master')
@section('content')
    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">{{ __('admin.dashboard') }}</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('adminhome') }}">{{ __('admin.home') }}</a>
                            </li>
                            <li class="breadcrumb-item">{{ __('admin.dashboard') }}</li>
                        </ol>
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end page-title -->

            <div class="row">

                <div class="col-sm-6 col-xl-4">
                    <div class="card">
                        <div class="card-heading p-4">
                            <div class="mini-stat-icon float-right">
                                <i class="mdi mdi-account-group bg-primary  text-white"></i>
                            </div>
                            <div>
                                <h5 class="font-16">{{ __('admin.users') }}</h5>
                            </div>
                            <h3 class="mt-4">{{ \App\Models\User::count() }}</h3>
                            <div class="progress mt-4" style="height: 4px;">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 75%"
                                    aria-valuenow="{{ \App\Models\User::count() }}" aria-valuemin="0" aria-valuemax="{{ \App\Models\User::count() }}"></div>
                            </div>
                            <p class="text-muted mt-2 mb-0">{{ __('admin.users') }}<span class="float-right">{{ \App\Models\User::count() }}</span></p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-xl-4">
                    <div class="card">
                        <div class="card-heading p-4">
                            <div class="mini-stat-icon float-right">
                                <i class="mdi mdi-key-outline bg-primary text-white"></i>
                            </div>
                            <div>
                                <h5 class="font-16">{{ __('admin.admins') }}</h5>
                            </div>
                            <h3 class="mt-4">{{ \App\Models\Admin::count() }}</h3>
                            <div class="progress mt-4" style="height: 4px;">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: {{ \App\Models\Admin::count() }}%"
                                    aria-valuenow="{{ \App\Models\Admin::count() }}" aria-valuemin="0" aria-valuemax="{{ \App\Models\Admin::count() }}"></div>
                            </div>
                            <p class="text-muted mt-2 mb-0">{{ __('admin.admins') }}<span class="float-right">{{ \App\Models\Admin::count() }}</span></p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-xl-4">
                    <div class="card">
                        <div class="card-heading p-4">
                            <div class="mini-stat-icon float-right">
                                <i class="mdi mdi-message-plus bg-danger text-white"></i>
                            </div>
                            <div>
                                <h5 class="font-16">{{ __('admin.complaints') }}</h5>
                            </div>
                            <h3 class="mt-4">{{ \App\Models\Complaint::count() }}</h3>
                            <div class="progress mt-4" style="height: 4px;">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: {{ \App\Models\Complaint::count() }}%" aria-valuenow="{{ \App\Models\Complaint::count() }}"
                                    aria-valuemin="0" aria-valuemax="{{ \App\Models\Complaint::count() }}"></div>
                            </div>
                            <p class="text-muted mt-2 mb-0">{{ __('admin.complaints') }}<span class="float-right">{{ \App\Models\Complaint::count() }}</span></p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-xl-4">
                    <div class="card">
                        <div class="card-heading p-4">
                            <div class="mini-stat-icon float-right">
                                <i class="mdi mdi-message-reply bg-primary  text-white"></i>
                            </div>
                            <div>
                                <h5 class="font-16">{{ __('admin.dailycomplaints') }}</h5>
                            </div>
                            <h3 class="mt-4">{{ \App\Models\Complaint::whereDay('created_at', now()->day)->count() }}</h3>
                            <div class="progress mt-4" style="height: 4px;">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 75%"
                                    aria-valuenow="{{ \App\Models\Complaint::whereDay('created_at', now()->day)->count() }}" aria-valuemin="{{ \App\Models\Complaint::whereDay('created_at', now()->day)->count() }}" aria-valuemax="{{ \App\Models\Complaint::whereDay('created_at', now()->day)->count() }}"></div>
                            </div>
                            <p class="text-muted mt-2 mb-0">{{ __('admin.dailycomplaints') }}<span class="float-right">{{ \App\Models\Complaint::whereDay('created_at', now()->day)->count() }}</span></p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-xl-4">
                    <div class="card">
                        <div class="card-heading p-4">
                            <div class="mini-stat-icon float-right">
                                <i class="mdi mdi-message-bulleted-off bg-primary text-white"></i>
                            </div>
                            <div>
                                <h5 class="font-16">{{ __('admin.finishedcomplaints') }}</h5>
                            </div>
                            <h3 class="mt-4">{{ \App\Models\Complaint::where('status','finished')->count() }}</h3>
                            <div class="progress mt-4" style="height: 4px;">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: {{ \App\Models\Complaint::where('status','finished')->count() }}"
                                    aria-valuenow="{{ \App\Models\Complaint::where('status','finished')->count() }}" aria-valuemin="0" aria-valuemax="{{ \App\Models\Complaint::where('status','finished')->count() }}"></div>
                            </div>
                            <p class="text-muted mt-2 mb-0">{{ __('admin.finishedcomplaints') }}<span class="float-right">{{ \App\Models\Complaint::where('status','finished')->count() }}</span></p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-xl-4">
                    <div class="card">
                        <div class="card-heading p-4">
                            <div class="mini-stat-icon float-right">
                                <i class="mdi mdi-message-alert bg-danger text-white"></i>
                            </div>
                            <div>
                                <h5 class="font-16">{{ __('admin.pendinngcomplaints') }}</h5>
                            </div>
                            <h3 class="mt-4">{{ \App\Models\Complaint::where('status','pending')->count() }}</h3>
                            <div class="progress mt-4" style="height: 4px;">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: {{ \App\Models\Complaint::where('status','pending')->count() }}" aria-valuenow="{{ \App\Models\Complaint::where('status','pending')->count() }}"
                                    aria-valuemin="0" aria-valuemax="{{ \App\Models\Complaint::where('status','pending')->count() }}"></div>
                            </div>
                            <p class="text-muted mt-2 mb-0">{{ __('admin.pendinngcomplaints') }}<span class="float-right">{{ \App\Models\Complaint::where('status','pending')->count()}}</span></p>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <!-- container-fluid -->

    </div>
    <!-- content -->
    <!-- ============================================================== -->
    <!-- End Right content here -->
    <!-- ============================================================== -->
@endsection
