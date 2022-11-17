@extends('users.layouts.master')

@section('content')
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">{{ __('user.usersgate') }}</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('admin.home') }}</a></li>
                            <li class="breadcrumb-item">{{ __('user.usersgate') }}</li>
                        </ol>
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end page-title -->

            <div class="row">

                <div class="col-sm-6 col-xl-6">
                    <div class="card">
                        <div class="card-heading p-4">
                            <div class="mini-stat-icon float-right">
                                <i class="mdi mdi-cloud-question bg-primary  text-white"></i>
                            </div>
                            <div>
                                <h5 class="font-16">{{ __('admin.faqs') }}</h5>
                            </div>
                            <h3 class="mt-4">{{ \App\Models\Faq::where('active',true)->count() }}</h3>
                            <div class="progress mt-4" style="height: 4px;">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: {{ \App\Models\Faq::where('active',true)->count() }}"
                                    aria-valuenow="{{ \App\Models\Faq::where('active',true)->count() }}" aria-valuemin="0" aria-valuemax="{{ \App\Models\Faq::where('active',true)->count() }}"></div>
                            </div>
                            <p class="text-muted mt-2 mb-0">{{ __('admin.faqs') }}<span class="float-right">{{ \App\Models\Faq::where('active',true)->count() }}</span></p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-xl-6">
                    <div class="card">
                        <div class="card-heading p-4">
                            <div class="mini-stat-icon float-right">
                                <i class="mdi mdi-comment-multiple bg-danger text-white"></i>
                            </div>
                            <div>
                                <h5 class="font-16">{{ __('user.special') }}</h5>
                            </div>
                            <h3 class="mt-4">{{ \App\Models\Complaint::where(['user_id' => Auth::user()->id])->count() }}</h3>
                            <div class="progress mt-4" style="height: 4px;">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: {{ \App\Models\Complaint::where(['user_id' => Auth::user()->id])->count() }}" aria-valuenow="82"
                                    aria-valuemin="{{ \App\Models\Complaint::where(['user_id' => Auth::user()->id])->count() }}" aria-valuemax="{{ \App\Models\Complaint::where(['user_id' => Auth::user()->id])->count() }}"></div>
                            </div>
                            <p class="text-muted mt-2 mb-0">{{ __('user.special') }}<span class="float-right">{{ \App\Models\Complaint::where(['user_id' => Auth::user()->id])->count() }}</span></p>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <!-- container-fluid -->

    </div>
    <!-- content -->
@endsection
