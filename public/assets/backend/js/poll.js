var Poll = (function () { 

	function CreatePoll(){
		$(document).ready(function() {
            $("#CreatePoll").validate({
                rules: {
                    poll_name: {
                        required: true
                    },
                    poll_answer: {
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
    function appendInput(){
        var $newinput = $( '<input type="text" class="form-control"  name="poll_answer[]" placeholder="Answer">' );
        
        $( "#ans-section" ).append( $newinput );
    }

    // function setEditEvents() {
    // }
    function loadSetup(){
        $('#pollEndDate').datetimepicker({
        }); 
        
        $("#addNewPoll").on("click",function(){
            appendInput();
        })
    }

	return {
        init: function () {
            CreatePoll();
            loadSetup();
            
        }, 
    };
}());
$(document).ready(function () { Poll.init(); });