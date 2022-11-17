@extends('users.layouts.master')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">{{ __('user.faqs') }}</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('admin.home') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('user.faqs') }}</li>
                        </ol>
                    </div>
                </div> <!-- end row -->
            </div>
            <!-- end page-title -->

            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="text-center">
                        <h1>{{ __('user.faqs') }}</h1>
                    </div>
                </div>
            </div>

            <div class="row m-t-30">

                        @forelse ($faqs as $key => $item)
                            <div class="col-lg-4">
                                <div class="card faq-box border-primary">
                                    <div class="card-body">
                                        <div class="faq-icon float-right">
                                            <i class="fas fa-question-circle font-24 mt-2 text-primary"></i>
                                        </div>
                                        <h5 class="text-primary">{{ $item->id}}</h5>
                                        <h5 class="font-16 mb-3 mt-4">{{ $item->question }}</h5>
                                        <p class="text-muted mb-0">{!! $item->answer !!}</p>
                                    </div>
                                </div>
                            </div>
                        @empty
                        <div class="col-md-12">
                            <h1 class="text-primary text-center" style="text-align: center">{{ __('user.available') }}</h1>
                        </div>
                        @endforelse

                        <div class="col-md-12">
                            <h5 class="text-primary" style="text-align: center">{!! $faqs->links() !!}</h5>
                        </div>

            </div>


        </div>
        <!-- container-fluid -->

    </div>
@endsection
