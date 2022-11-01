var AdminLogin = (function () { 

	function adminLogin(){
		$(document).ready(function() {
            $("#loginForm").validate({
                rules: {
                    email: {
                        required: true
                    },
                    password: {
                        required: true
                    }
                },
                submitHandler: function() {
                    // e.preventDefault();
                    $('.btn-primary').prop('disabled', true);
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url:APP_URL+"/check-auth",
                        method:"POST",  
                        data:$('#loginForm').serialize(),  
                        beforeSend:function(){  
                            //
                        },  
                        success:function(res){
                            if(res["status"]) {
                                $('.btn-primary').prop('disabled', false);
                                window.location.href= APP_URL+"/dashboard";
                            }else {
                                swal("Opps!", res["msg"], "error");
                                $('.btn-primary').prop('disabled', false);
                            }
                        },
                        error: function(e) {
                            $('.btn-primary').prop('disabled', false);
                            swal("Opps!", "There is an error", "error");
                        },
                        complete: function(c) {
                            $('.btn-primary').prop('disabled', false);
                        }
                    });  
                }
            });
        });
	}

    // function setEditEvents() {
    // }

	return {
        init: function () {
            adminLogin();
        }, 
    };
}());
$(document).ready(function () { AdminLogin.init(); });