
$(document).ready(function(){
    $('#admin_login_form').on('submit',function(event){
     event.preventDefault();
     console.log($(this).serialize());
     $.ajax({
         url:"check_admin_login.php",
         method: "POST",
         data:$(this).serialize(),
         dataType:"json",
         beforeSend:function(){
             $('#admin_login').val('validate...');
             $('#admin_login').attr('disabled','disabled');
         },
         success: function(data){
               if(data.success){
                location.href = window.location.href ;
               }
               if (data.error) {
                   $('#admin_login').val('Login');
                   $('#admin_login').attr('disabled',false);
                   if (data.error_admin_user_name!='') {
                       $('#error_admin_user_name').text(data.error_admin_user_name);
                   }
                   else{
                       $('#error_admin_user_name').text('');
                   }
                   if (data.error_admin_password!='') {
                       $('#error_admin_password').text(data.error_admin_password);
                       
                   } else {
                      $('#error_admin_password').text(''); 
                   }
   
               }
         }
   
     });
   
    });
});

