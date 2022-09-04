/**
 * Created by dabiko on 01-Nov-17.
 */


/** Function for Getting data from the form using their Id's*/
function _(id){
    return document.getElementById(id);
}

/** Ajax Submit Function*/
function con_Form(){
    _("BuildBtn").disabled = true;
   // _("msgSubmit").innerHTML ='<img src="loginAssets/img/login-bg/ajax-loader.gif" />';
    var formdata = new FormData();
    formdata.append( "community", _("community").value );
    formdata.append( "country", _("country").value );
    formdata.append( "town", _("town").value );
    formdata.append( "phone", _("phone").value );
    formdata.append( "g-recaptcha-response", _("g-recaptcha-response").value);
    formdata.append( "user_id", _("user_id").value );
    formdata.append( "token", _("token").value );

    var ajax = new XMLHttpRequest();
    ajax.open( "POST", "auth_con.php",true);
    ajax.onreadystatechange = function() {
        if(ajax.readyState == 4 && ajax.status == 200) {
            if(ajax.responseText == 1){
                swal({
                    title: "Email Confirmed",
                    text: "Your email address has been verified, you can now Login with your Email and Password",
                    type: 'success',
                    timer: 6000,
                    showConfirmButton: false });
                setTimeout(function(){
                    //_("msgSubmit").innerHTML ='<img src="loginAssets/img/login-bg/ajax-loader.gif" />';
                 window.location.href = 'login.php';
                }, 5000);
            } else {
                 _("message").innerHTML = '<div style="text-align: left;" class="alert alert-danger alert-bordered alert-rounded"><button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button><span class="text-semibold"></span>  '+ajax.responseText+'</div>';
                 _("BuildBtn").disabled = false;
                setTimeout(function(){
                    $("#msgSubmit").hide();
                }, 3000);
            }
        }
    }
    ajax.send( formdata );
    grecaptcha.reset();

}
