/**
 * Created by dabiko on 01-Nov-17.
 */


/**Function for Getting data from the form using their Id's*/
function _(id){
    return document.getElementById(id);
}

//Ajax Submit Function
function loginForm(){
    _("loginBtn").disabled = true;
    _("msgSubmit").innerHTML = '<i class="ti-reload rotate-refresh"></i>';
    $("#msgSubmit").show();



    var formdata = new FormData();
    formdata.append( "email", _("email").value );
    formdata.append( "password", _("password").value );
    if(document.getElementsByName('remember')[0].checked){
      var rememberMe = "yes";
        formdata.append('remember',rememberMe);
    }else {
       var noRemMe = "";
        formdata.append('remember',noRemMe);
    }

    var ajax = new XMLHttpRequest();

    ajax.open( "POST","auth_login",true);
    ajax.onreadystatechange = function() {
        if(ajax.readyState == 4 && ajax.status == 200){
            setTimeout(function () {

                /**Function for Displaying Errors sent back by Ajax*/
                function ajaxResponseError(error) {
                    _("loginError").innerHTML = '<div class="alert alert-danger icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="icofont icofont-close-line-circled"></i></button><p><strong>Error!!! </strong> '+error+'</p></div>';
                    setTimeout(function () {
                        $("#msgSubmit").hide();
                    }, 1000);
                    _("loginBtn").disabled = false;
                }

                    if (ajax.responseText == 1) {
                        ajaxResponseError('Invalid Request');

                    }else if(ajax.responseText == 2){
                        ajaxResponseError('Please Enter Username and Password');

                    }else if(ajax.responseText == 3){
                        ajaxResponseError('Invalid Username');

                    }else if(ajax.responseText == 4){
                     ajaxResponseError('Invalid Password');

                    }else if (ajax.responseText){
                        var jsonData = JSON.parse(ajax.responseText);
                        var jsonLength = jsonData.results.length;
                        for (var i = 0; i < jsonLength; i++) {
                            var result = jsonData.results[i];
                            var AdminName = result.emsname
                        }
                        swal({
                            title: "welcome back "+AdminName,
                            text: "You're being Logged In.",
                            type: 'success',
                            timer: 3000,
                            showConfirmButton: false
                        });
                        setTimeout(function(){
                            $("#msgSubmit").show();
                            window.location.href='index.php';
                        }, 1000);

                    }



            }, 300);


        }
    };
    ajax.send( formdata );

}

