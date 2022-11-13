var userPoll = (function () {
    
    function getMachineId() {
    
        let machineId = localStorage.getItem('MachineId');
        
        if (!machineId) {
            machineId = Math.random().toString(36).slice(2);
            localStorage.setItem('MachineId', machineId);
        }
    
        return machineId;
    }

   


	function CreatePoll(){
		$(document).ready(function() {

            var uuid = getMachineId();
            $("#physical_address").val(uuid);
            
            getVoteData();

            $("#UserAnswer").validate({
                rules: {
                    answer: {
                        required: true
                    }
                },
                submitHandler: function(e) {
                    
                    $('.btn-primary').prop('disabled', true);
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('input[name="_token"]').val()
                        },
                        url:APP_URL+"/submit-poll-answer",
                        method:"POST",  
                        data:$('#UserAnswer').serialize(),  
                        beforeSend:function(){  
                            //
                        },  
                        success:function(res){
                            if(res["status"]) {
                                $('#VotingPercent').html(res['data']);
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

    function getVoteData(){

        var question_id =$("#question_id").val();
        var physical_address = $("#physical_address").val(); 
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            },
            url:APP_URL+"/get-poll-result",
            method:"GET",  
            data:{
                question_id:question_id,
                physical_address:physical_address
            }, 
            dataType:"json", 
            beforeSend:function(){  
                //
            },  
            success:function(res){

                if(res.data != "") {
                    $('#VotingPercent').html(res['data']);
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
    

    // function loadSetup(){
    //     $('#pollEndDate').datetimepicker({
    //         format:	'd-m-Y H:i:s'
    //     }); 
        
    //     $("#addNewPoll").on("click",function(){
    //         appendInput();
    //     });

    //     $("body").on("click",".remove",function(){
    //         $(this).parent('p').remove();
    //     });

    //     var pollTable = $('#PollList').DataTable()
    // }

	return {
        init: function () {
            CreatePoll();
            // loadSetup();
            
        }, 
    };
}());
$(document).ready(function () { userPoll.init(); });