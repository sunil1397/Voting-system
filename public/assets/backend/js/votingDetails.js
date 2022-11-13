var votingDetails = (function () {


    function getMachineId() {
    
        let machineId = localStorage.getItem('MachineId');
        
        if (!machineId) {
            machineId = Math.random().toString(36).slice(2);
            localStorage.setItem('MachineId', machineId);
        }
    
        return machineId;
    }

    function loadSetUp(){
        var uuid = getMachineId();
        $("#physical_address").val(uuid);
        getVoteData();
    }
    function getVoteData(){

        var question_id =$("#question_id").val();
        var physical_address = $("#physical_address").val(); 
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            },
            url:APP_URL+"/get-poll-result-admin",
            method:"POST",  
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
                    $('#votingDetails').html(res['data']);
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

	return {
        init: function () {
            loadSetUp();
            
            
        }, 
    };
}());
$(document).ready(function () { votingDetails.init(); });