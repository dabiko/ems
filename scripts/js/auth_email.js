/**
 * Created by dabiko on 01-Nov-17.
 */


//Function for Getting data from the form using their Id's
function _(id){
    return document.getElementById(id);
}

//Ajax Submit Function
function emailForm(){
    _("emailBtn").disabled = true;
    _("msgSubmit").innerHTML ='<img src="loginAssets/img/login-bg/ajax-loader.gif" />';
    var formdata = new FormData();
    formdata.append( "email", _("email").value );
    formdata.append( "token", _("token").value );
    var ajax = new XMLHttpRequest();

    ajax.open( "POST","auth_email.php",true);
    ajax.onreadystatechange = function() {
        if(ajax.readyState == 4 && ajax.status == 200) {
            if(ajax.responseText == 1){
                swal({
                    title: "Password Recovery",
                    text: "Password Reset link sent Successfully. Please check your email address",
                    type: 'success',
                    timer: 7000,
                    showConfirmButton: false });
                setTimeout(function(){
                _("msgSubmit").innerHTML ='<img src="loginAssets/img/login-bg/ajax-loader.gif" />';
                }, 6000);
                $('#email_Form')[0].reset();
                _("emailBtn").disabled = false;
            } else {
                 _("message").innerHTML = '<div style="text-align: left;" class="alert alert-danger alert-bordered alert-rounded"><button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button><span class="text-semibold"></span>  '+ajax.responseText+'</div>';
                 _("emailBtn").disabled = false;
                setTimeout(function(){
                    $("#msgSubmit").hide();
                }, 3000);
            }
        }
    }
    ajax.send( formdata );


}
