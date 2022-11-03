<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    @include('frontend/common/stylesheets')
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_horizontal-navbar.html -->
      @include('frontend/common/topnav')
      <!-- partial -->
      @yield('content')
      <!-- page-body-wrapper ends -->
    </div>
    @include('frontend/common/scripts')
    @yield('script')
  </body>
</html>