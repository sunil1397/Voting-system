<!-- container-scroller -->
    <!-- plugins:js -->
    <script type="text/javascript">
    var APP_URL = {!! json_encode(url('/')) !!}
    console.log(APP_URL);
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    
    <script src="{{URL::asset('public/assets/frontend/vendors/js/vendor.bundle.base.js')}}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{URL::asset('public/assets/frontend/vendors/jquery-bar-rating/jquery.barrating.min.js')}}"></script>
    <script src="{{URL::asset('public/assets/frontend/vendors/chart.js/Chart.min.js')}}"></script>
    <script src="{{URL::asset('public/assets/frontend/vendors/flot/jquery.flot.js')}}"></script>
    <script src="{{URL::asset('public/assets/frontend/vendors/flot/jquery.flot.resize.js')}}"></script>
    <script src="{{URL::asset('public/assets/frontend/vendors/flot/jquery.flot.categories.js')}}"></script>
    <script src="{{URL::asset('public/assets/frontend/vendors/flot/jquery.flot.fillbetween.js')}}"></script>
    <script src="{{URL::asset('public/assets/frontend//vendors/flot/jquery.flot.stack.js')}}"></script>
    <script src="{{URL::asset('public/assets/frontend/js/jquery.cookie.js')}}" type="text/javascript"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{URL::asset('public/assets/frontend/js/off-canvas.js')}}"></script>
    <script src="{{URL::asset('public/assets/frontend/js/hoverable-collapse.js')}}"></script>
    <script src="{{URL::asset('public/assets/frontend/js/misc.js')}}"></script>
    <script src="{{URL::asset('public/assets/frontend/js/settings.js')}}"></script>
    <script src="{{URL::asset('public/assets/frontend/js/todolist.js')}}"></script>
    <script src="{{URL::asset('public/assets/frontend/js/device-uuid.js')}}"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="{{URL::asset('public/assets/frontend/js/dashboard.js')}}"></script>
    <script src="{{URL::asset('public/assets/frontend/js/index.js')}}"></script>
    <script src="{{URL::asset('public/assets/frontend/js/userPoll.js')}}"></script>
    
    <script src="{{ URL::asset('public/assets/backend/js/jquery.validate.js')}}"></script>
    <script src="{{ URL::asset('public/assets/backend/sweetalert2/js/sweetalert2.all.min.js')}}"></script> 
    <script src="{{ URL::asset('public/assets/backend/js/jquery.dataTables.min.js')}}"></script> 
<script>
    
    </script>
    <!-- End custom js for this page -->