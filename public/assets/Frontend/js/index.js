var userPoll = (function () { 
    function loadSetup(){
        // var pollTable = $('#PollList-user').DataTable({
        //     dom: 'Bfrtip'
        // })
    }

	return {
        init: function () {
            loadSetup();
        }, 
    };
}());
$(document).ready(function () { userPoll.init(); });