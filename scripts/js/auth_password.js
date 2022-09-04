/**
 * Created by dabiko on 01-Nov-17.
 */


//Function for Getting data from the form using their Id's
function _(id){
    return document.getElementById(id);
}

//Ajax Submit Function
function passwordReset_Form(){
    _("passwordResetBtn").disabled = true;
    var formdata = new FormData();
    formdata.append( "new_password", _("new_password").value );
    formdata.append( "confirm_password", _("confirm_password").value );
    formdata.append( "g-recaptcha-response", _("g-recaptcha-response").value );
    formdata.append( "user_id", _("user_id").value );
    formdata.append( "token", _("token").value );
    var ajax = new XMLHttpRequest();

    ajax.open( "POST","auth_password.php",true);
    ajax.onreadystatechange = function() {
        if(ajax.readyState == 4 && ajax.status == 200) {
            if(ajax.responseText == 1){
          swal({
         title: "Updated :)",
         text: "Password Reset Successful. You can now login with your New Password",
         type: 'success',
         timer: 7000,
         showConfirmButton: false });
         setTimeout(function(){
             _("msgSubmit").innerHTML ='<img src="loginAssets/img/login-bg/ajax-loader.gif" />';
             window.location.href = 'login.php';
           }, 6000);
            } else {
                 _("message").innerHTML = '<div style="text-align: left;" class="alert alert-danger alert-bordered alert-rounded"><button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button><span class="text-semibold"></span>  '+ajax.responseText+'</div>';
                 _("passwordResetBtn").disabled = false;
                setTimeout(function(){
                    $("#msgSubmit").hide();
                }, 3000);
            }
        }
    }
    ajax.send( formdata );
}
