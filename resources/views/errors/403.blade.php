<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>{{ __('admin.dashboard') }}</title>
    <meta content="Responsive admin theme build on top of Bootstrap 4" name="description" />
    <meta content="Themesdesign" name="author" />
    @if (app()->getLocale() == 'ar')
    <link href="{{asset('dashboard/assets_ar/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('dashboard/assets_ar/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('dashboard/assets_ar/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('dashboard/assets_ar/css/metismenu.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('dashboard/assets_ar/css/icons.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('dashboard/assets_ar/css/style.css')}}" rel="stylesheet" type="text/css">

    @endif
    @if (app()->getLocale() == 'en')
    <link href="{{asset('dashboard/assets_en/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('dashboard/assets_en/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('dashboard/assets_en/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('dashboard/assets_en/css/metismenu.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('dashboard/assets_en/css/icons.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('dashboard/assets_en/css/style.css')}}" rel="stylesheet" type="text/css">
    @endif

</head>

<body>

    <!-- Begin page -->
    <div class="error-bg" style="background-color: #E6554F"></div>
    <div class="home-btn d-none d-sm-block">
        <a href="{{ route('home') }}" class="text-white"><i class="fas fa-home h2"></i></a>
    </div>

    <div class="account-pages">

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-8">
                    <div class="card shadow-lg">
                        <div class="card-block">
                            <div class="text-center p-3">

                                <h1 class="error-page mt-4"><span>403</span></h1>
                                <h4 class="mb-4 mt-5">{{ __('user.403') }}</h4>
                                <a class="btn btn-primary mb-4 waves-effect waves-light" href="{{ route('home') }}"><i class="mdi mdi-home"></i> Back to Dashboard</a>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
            <!-- end row -->
        </div>
    </div>
    <!-- END wrapper -->

    <!-- jQuery  -->
    <script src="{{ asset('dashboard/assets_ar/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('dashboard/assets_ar/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dashboard/assets_ar/assets/js/metismenu.min.js') }}"></script>
    <script src="{{ asset('dashboard/assets_ar/assets/js/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('dashboard/assets_ar/assets/js/waves.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('dashboard/assets_ar/assets/js/app.js') }}"></script>

</body>



</html>
