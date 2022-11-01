<!-- container-scroller -->
    <!-- plugins:js -->
    <script type="text/javascript">
    var APP_URL = {!! json_encode(url('/')) !!}
    console.log(APP_URL);
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="{{URL::asset('public/assets/backend/vendors/js/vendor.bundle.base.js')}}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{URL::asset('public/assets/backend/vendors/chart.js/Chart.min.js')}}"></script>
    <script src="{{URL::asset('public/assets/backend/js/jquery.cookie.js')}}" type="text/javascript"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{URL::asset('public/assets/backend/js/off-canvas.js')}}"></script>
    <script src="{{URL::asset('public/assets/backend/js/hoverable-collapse.js')}}"></script>
    <script src="{{URL::asset('public/assets/backend/js/misc.js')}}"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="{{URL::asset('public/assets/backend/js/todolist.js')}}"></script>
    <!-- End custom js for this page -->
    <!-- ====================
    Validation JS
==================== -->
<script src="{{ URL::asset('public/assets/backend/js/jquery.validate.js')}}"></script>
<!-- ====================
    Sweetalert JS
==================== -->
<script src="{{ URL::asset('public/assets/backend/sweetalert2/js/sweetalert2.all.min.js')}}"></script> 
<script src="{{ URL::asset('public/assets/backend/js/jquery.datetimepicker.full.js')}}"></script> 
<script src="{{ URL::asset('public/assets/backend/js/poll.js')}}"></script> 

  <script type="text/javascript">  
    
</script>
