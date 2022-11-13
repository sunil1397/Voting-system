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
                            'X-CSRF-TOKEN': $('input[name="_token"]').val()
                        },
                        url:APP_URL+"/save-poll",
                        method:"POST",  
                        data:$('#CreatePoll').serialize(),  
                        beforeSend:function(){  
                            //
                        },  
                        success:function(res){
                            if(res["status"]) {
                                swal({
                                    title: "Success",
                                    text: "Poll Created Successfully",
                                    icon: "success",
                                    buttons: [
                                      'NO',
                                      'YES'
                                    ],
                                  }).then(function(isConfirm) {
                                    if (isConfirm) {
                                      location.reload();
                                    } else {
                                      //if no clicked => do something else
                                    }
                                  });
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
        var $newinput = $( '<p style="position: relative;"><input type="text" class="form-control"  name="poll_answer[]" placeholder="Answer"><i style="position: absolute; right: -5px; top: -11px;" class="mdi mdi-close remove"></i></p>' );
        
        $( "#ans-section" ).append( $newinput );
    }

    function loadSetup(){
        $('#pollEndDate').datetimepicker({
            format:	'd-m-Y H:i:s'
        }); 
        
        $("#addNewPoll").on("click",function(){
            appendInput();
        });

        $("body").on("click",".remove",function(){
            $(this).parent('p').remove();
        });

        var pollTable = $('#PollList').DataTable();

        

        }

        

    

    function stopPoll(){

        $("body").on("click", "a.stop-question", function(e) {  

            var obj = $(this);
            var id = obj.data("id");
            console.log(id,"Hello")
            var status = obj.data("status");
            swal({
                title: "Are you sure?",
                text: "You want to stop this poll",
                type: "warning",
                showCancelButton: !0,
                confirmButtonText: "Yes.",
                cancelButtonText: "No!",
                confirmButtonClass: "btn btn-success mr-5",
                cancelButtonClass: "btn btn-danger",
                buttonsStyling: !1
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('input[name="_token"]').val()
                        },
                        url:APP_URL+"/stop-poll",  
                        type: "POST",
                        data:  {id:id,status: status},
                        beforeSend:function(){  
                            //$('#pageOverlay').css('display', 'block');
                        },  
                        success:function(res){
                            if(res["status"]) {
                                swal({
                                    title: "Success!",
                                    text: "Stop Successful.",
                                    type: "success"
                                }).then(function() {
                                    location.reload();
                                });
                            }else {
                                //$('#pageOverlay').css('display', 'none');
                                swal("Opps!", res["msg"], "error");
                            }
                        },
                        error: function(e) {
                            //$('#pageOverlay').css('display', 'none');
                            swal("Opps!", "There is an error", "error");
                        },
                        complete: function(c) {
                            //$('#pageOverlay').css('display', 'none');
                        }
                    });
                } else if (
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swal("Cancelled", "Data is safe :)", "error")
                }
            })
        });
        
    }


	return {
        init: function () {
            CreatePoll();
            loadSetup();
            stopPoll();
            
        }, 
    };
}());
$(document).ready(function () { Poll.init(); });