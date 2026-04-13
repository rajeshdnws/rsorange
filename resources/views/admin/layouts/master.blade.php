<!doctype html>
<html class="no-js" lang="en">


<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title', 'Laravel Role Admin')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('admin.layouts.partials.styles')
    @yield('styles')
    @stack('css-style')
    
</head>

<body>

 <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
         @include('admin.layouts.partials.sidebar')
            <!-- main content area start -->
                   <div class="layout-page">

                @include('admin.layouts.partials.header')
				
				
				  <div class="content-wrapper">
                  @yield('admin-content')
				
			
                <!-- main content area end -->
                 @include('admin.layouts.partials.footer')
        
   	</div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>
    @include('admin.layouts.partials.scripts')
 <script>
    setTimeout(function () {
        $(".alert").fadeOut("slow");
    }, 3000); // 3 seconds
</script>
    </body>

</html>


