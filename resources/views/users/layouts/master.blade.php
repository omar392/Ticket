<!DOCTYPE html>
<html>
@include('users.layouts.head')

<body>
    <!-- Begin page -->
    <div id="wrapper">
        @include('users.layouts.header')
        @include('users.layouts.sidebar')
        <div class="content-page">
            @yield('content')
            @include('users.layouts.footer')
        </div>
    </div>
    <!-- END wrapper -->
    @yield('js')
    @include('users.layouts.script')
</body>

</html>
