/**
 * Created by dabiko on 01-Nov-17.
 */

// <link rel="stylesheet" href="assets/css/sweetalert2.min.css">
// <script src="assets/js/sweetalert2.all.min.js"></script>
//Function for Getting data from the form using their Id's
function _(id){
    return document.getElementById(id);
}

//Ajax Submit Function
function reg_Form(){
    _("regBtn").disabled = true;
    _("msgSubmit").innerHTML ='<img src="loginAssets/img/login-bg/ajax-loader.gif" />';
    var formdata = new FormData();
    formdata.append( "Firstname", _("Firstname").value );
    formdata.append( "Lastname", _("Lastname").value );
    formdata.append( "Email", _("Email").value );
    formdata.append( "password", _("password").value );
    formdata.append( "month", _("month").value );
    formdata.append( "day", _("day").value );
    formdata.append( "year", _("year").value );
    formdata.append( "g-recaptcha-response", _("g-recaptcha-response").value );
    formdata.append( "token", _("token").value );




    var ajax = new XMLHttpRequest();
    ajax.open( "POST", "auth_registration.php",true);
    ajax.onreadystatechange = function() {
        if(ajax.readyState == 4 && ajax.status == 200) {
            if(ajax.responseText == 1){
                //$("#message").hide();
                swal({
                    title: "Registration Successful (:",
                    text: "Please Check you Mail-Box for Confirmation Link",
                    type: 'success',
                    timer: 6000,
                    showConfirmButton: false });
                setTimeout(function(){
                }, 5000);
                $('#reg_Form')[0].reset();
            } else {
                 _("message").innerHTML = '<div style="text-align: left;" class="alert alert-danger alert-bordered alert-rounded"><button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button><span class="text-semibold"></span>  '+ajax.responseText+'</div>';
                 _("regBtn").disabled = false;
                setTimeout(function(){
                    $("#msgSubmit").hide();
                }, 3000);
            }
        }
    }
    ajax.send( formdata );
    grecaptcha.reset();

}
