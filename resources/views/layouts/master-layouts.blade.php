<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')| Kifo</title>
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ URL::asset('/assets/images/favicon.ico') }}">
    @include('layouts.head')
    @yield('link')
</head>

@section('body')

    <body>
        <span class="display-block-btn"></span>
    @show

    <!-- Begin page -->
    <div>
        @include('layouts.top-hor')
        @yield('content')
        @include('layouts.footer')

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->

        <!-- ============================================================== -->
        <!-- End Right content here -->
        <!-- ============================================================== -->
    </div>
    <!-- END wrapper -->

    @include('layouts.footer-script')
</body>

</html>
