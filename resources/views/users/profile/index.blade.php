@extends('users.layouts.master')

@section('content')
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">{{ __('user.profile') }}</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('admin.home') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('user.profile') }}</li>
                        </ol>
                    </div>
                </div> <!-- end row -->
            </div>
            <!-- end page-title -->

            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="text-center">
                        <h5>{{ __('user.profile') }}</h5>
                    </div>
                </div>
            </div>

            <div class="row m-t-30">
                <div class="col-xl-12 col-md-12">
                    <div class="card pricing-box mt-4">
                        <div class="pricing-icon">
                            <i class="ti-shield bg-primary"></i>
                        </div>
                        <div class="pricing-content">
                            <div class="text-center">
                                <h5 class="text-uppercase mt-5">{{ Auth::user()->name }}</h5>

                            </div>
                            <div class="pricing-features mt-4">
                                <h1 class="font-14 mb-2"><i
                                        class="ti-check-box text-primary mr-3"></i>{{ __('admin.name') }} :
                                    {{ Auth::user()->name }}</h1>
                                <h1 class="font-14 mb-2"><i
                                        class="ti-check-box text-primary mr-3"></i>{{ __('admin.phone') }} :
                                    {{ Auth::user()->phone }}</h1>
                                <h1 class="font-14 mb-2"><i
                                        class="ti-check-box text-primary mr-3"></i>{{ __('admin.email') }} :
                                    {{ Auth::user()->email }}</h1>
                                <h1 class="font-14 mb-2"><i
                                        class="ti-check-box text-primary mr-3"></i>{{ __('admin.user_type') }} :
                                    {{ Auth::user()->user_type }}</h1>
                            </div>

                            <div class="mt-4 pt-3 text-center">
                                <a href="{{ route('profile.edit', Auth::user()->id) }}"
                                    class="btn btn-primary btn-lg w-100 btn-round">{{ __('user.editprofile') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- container-fluid -->

    </div>
    <!-- content -->
@endsection
