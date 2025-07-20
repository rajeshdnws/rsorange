<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title', 'Laravel Role Admin')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('backend.layouts.partials.styles')
    @yield('styles')
    @stack('css-style')
</head>

<body>
    <div style="display: none;" id="loading-div">
        <div id="loader"></div>
    </div>
    <div class="dashboard-wrapper">
        <div class="dashboard-wrap">
           
            <!-- main content area start -->
            <div class="dashboard-content dashboard_content container-fluid">
                @yield('admin-content')
                <!-- main content area end -->
            </div>
        </div>
    </div>    <!-- page container area end -->

    @include('backend.layouts.partials.offsets')
    @include('backend.layouts.partials.scripts')
    @yield('scripts')

    @stack('js-script')
    </body>

</html>


