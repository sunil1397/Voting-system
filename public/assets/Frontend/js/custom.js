$('#register-form').validate({
    rules:{
      email: {
        required: true,
        email: true
      },
      password:{
        required: true,
        strongPassword: true
      },
     
      phone: {
        required: true,
        digits: true,
        phonesUK: true
      }, 
      name:{
        required:true 
      }
    },
    messages: {
      email: {
        required: 'Please enter an email address',
        email: 'Please enter a <i>valid</i> email address,'
      },
      mobileNumber:{
        required: 'Please enter a mobile number <b>(digits only)</b>',
        mobileNumber: "Please enter a <i>valid</i> UK mobile number"
      } 
    },
    success:function(){
        $(this).submit();
    }

}); 
          
          
          
$('#login-form').validate({
    rules:{
      email: {
        required: true,
        email: true
      },
      password:{
        required: true,
        strongPassword: true
      }
      
    },
    messages: {
      email: {
        required: 'Please enter an email address',
        email: 'Please enter a <i>valid</i> email address,'
      }
      
    },
    success:function(){
        $(this).submit();
    }

}); 

$('#ticket-generate').validate({
    rules:{
      description: {
         required: true,
         minlength: 5,
         maxlength: 250,
         
      },
      title: {
         required: true,
    
      },
    },
    
    success:function(){
        $(this).submit();
    }

}); 
          
           
          
