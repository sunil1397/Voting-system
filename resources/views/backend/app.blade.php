<!DOCTYPE html>
<html lang="en">
  <head>
  @include('backend/common/stylesheets')
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
          <a class="navbar-brand brand-logo" href="index.html"><img src="{{URL::asset('public/assets/backend/images/logo.svg')}}" alt="logo" /></a>
          <a class="navbar-brand brand-logo-mini" href="index.html"><img src="{{URL::asset('public/assets/backend/images/logo-mini.svg')}}" alt="logo" /></a>
        </div>
        @include('backend/common/navbar')
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        @include('backend/common/sidebar')
        <!-- partial -->
        <div class="main-panel">
        @yield('content')
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          @include('backend/common/footer')
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    @include('backend/common/scripts')
    @yield('contentVotingDetails')
    @yield('contentPollList')
  </body>
</html>