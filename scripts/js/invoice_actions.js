/**
 * Created by Dabiko Blaise on 30-Jul-18.
 */

function RedirectToPage(page) {
    window.location.href=page+'.php';
}

function RedirectToPageId(page,ID) {
    window.location.href=page+'.php?invoice='+ID;
}


function viewInvoice(id) {

    var formData = new FormData();
    var encodeID = encodeURIComponent(window.btoa(id));

    formData.append( "view_id", encodeID);
    var ajax = new XMLHttpRequest();
    ajax.open( "POST", "InvoiceView",true);
    ajax.onreadystatechange = function() {
        if(ajax.readyState == 4 && ajax.status == 200) {
            if (ajax.responseText) {
                swal({
                    title: 'Invoice <i style="color:#0078D7; " class="icofont icofont-eye-alt"></i>',
                    showCancelButton: false,
                    confirmButtonText: 'Ok',
                    showLoaderOnConfirm: false,
                    showConfirmButton: true,
                    closeOnConfirm: false,
                    allowOutsideClick: true,
                    width:'75%',
                    heightAuto: false,
                    html:ajax.responseText

                })

            }
        }
            };
    ajax.send(formData);
}



function restrictPrint(id) {

    var formData = new FormData();
    var encodeID = encodeURIComponent(window.btoa(id));

    formData.append( "restrict_print", encodeID);

    var ajax = new XMLHttpRequest();
    ajax.open( "POST", "restrict",true);
    ajax.onreadystatechange = function() {
        if(ajax.readyState == 4 && ajax.status == 200) {
            if (ajax.responseText == 1) {
                swal({
                    type: 'error',
                    title: 'Opps..!! Possible reasons :)',
                    text: 'This Invoice has an unpaid balance or it has already been printed.' +
                           ' All receipt are printed once :). View invoice if status has been validated',
                    showConfirmButton: true
                })
            }else {
                var Data = new FormData();
                var encodeID = encodeURIComponent(window.btoa(id));

                Data.append( "print_id", encodeID);

                var xhttp = new XMLHttpRequest();
                xhttp.open( "POST", "print_invoice",true);
                xhttp.onreadystatechange = function() {
                    if(xhttp.readyState == 4 && xhttp.status == 200) {
                        if (xhttp.responseText) {
                            swal({
                                title: 'Print Invoice <i style="color:#0078D7; " class="icofont icofont-printer"></i>',
                                showCancelButton: true,
                                showLoaderOnConfirm: false,
                                showConfirmButton: true,
                                closeOnConfirm: false,
                                allowOutsideClick: true,
                                width:'75%',
                                heightAuto: false,
                                confirmButtonText: 'Print'+' <i class="icofont icofont-download-alt"></i>',
                                cancelButtonText: 'Cancel !!'+' <i class="icofont icofont-close-circled"></i>',
                                html:xhttp.responseText

                            }).then(function () {

                                var formData = new FormData();
                                formData.append("print_id", id);
                                var ajax = new XMLHttpRequest();
                                ajax.open("POST", "pdfInvoice", true);
                                ajax.onreadystatechange = function () {
                                    if (ajax.readyState == 4 && ajax.status == 200) {
                                        if (ajax.responseText == 1) {
                                            swal({
                                                title: "Hmmm... !!!",
                                                imageUrl: 'scripts/img/robot.jpg',
                                                text: "You Must be a Robot.",
                                                type: 'error',
                                                timer: 9000,
                                                imageAlt: 'Custom image',
                                                animation: true,
                                                showConfirmButton: false,
                                                allowOutsideClick: false
                                            });
                                            setInterval(function () {
                                               RedirectToPage('logOut');
                                            }, 8000) ;

                                        }else if (ajax.responseText == 2){
                                            swal({
                                                title: "Opss. !!!",
                                                text: "There was an Error.",
                                                type: 'error',
                                                showConfirmButton: true,
                                                allowOutsideClick: false
                                            });
                                        }
                                    }

                                };
                                ajax.send(formData);


                            }, function (dismiss) {
                                // dismiss can be 'cancel', 'overlay',
                                // 'close', and 'timer'
                                if (dismiss === 'cancel') {
                                    swal(
                                        'Cancelled',
                                        'Request Cancelled:)',
                                        'info'
                                    )
                                }
                            })
                        }

                        }
                    };
                xhttp.send(Data);


            }
        }
    };
    ajax.send(formData);
}

/**Function the gets called when there is an error in the invoice during editing*/
function responseError(error) {
    _("editInError").innerHTML = '<div class="alert alert-danger icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="icofont icofont-close-line-circled"></i></button><p style="text-align: center;"><strong>Error!!! </strong> '+error+'</p></div>';
    $("#editInError").show();
    setTimeout(function () {
        $("#editInError").fadeOut();
    }, 5000);
}

/**Function  to format numbers currency values in thousands */
function formatNumber (num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
}

function keypressPaidEdit() {
    var sub_total = document.getElementById("editSub_total").value;
    var paid = document.getElementById("editPaid").value;
    var hide_due = document.getElementById("hide_due").value;
    var hide_paid = document.getElementById("hide_paid").value;

    if(isNaN(paid) || paid < 0 ){
        responseError('Please enter a valid payable amount');
        $("#editPaid").val(hide_paid);
        $("#edit_due").val(hide_due);

    }else if (sub_total === "" && paid !== ""){
        responseError('Sub total is empty. Make sure the invoice has Items');
        $("#editPaid").val(" ");
    } else if
    ((paid - 0 ) > (sub_total - 0)){
        responseError('Invalid Payable amount. '+paid+ ' is more than '+sub_total+'');
        $("#editPaid").val(hide_paid);
        $("#edit_due").val(hide_due);
    } else{
        $("#edit_due").val(sub_total - paid );
        $("#hidden").val(paid );
    }

}




/** Function to disable spaces when inputting numbers */
function noSpacesEdit(string){
    if(string.value.match(/\s/g)){
        string.value=string.value.replace(/\s/g,'');
    }
}




function restrictEdit(id) {
    var formData = new FormData();
    var encodeID = encodeURIComponent(window.btoa(id));
    formData.append( "restrict_edit", encodeID);

    var ajax = new XMLHttpRequest();
    ajax.open( "POST", "restrict",true);
    ajax.onreadystatechange = function() {
        if(ajax.readyState == 4 && ajax.status == 200) {
            if (ajax.responseText == 1) {
                swal({
                    type: 'error',
                    title: 'Opp..!!! Error',
                    text: 'This Invoice can\'t be edited because it has already been printed.' +
                            'It can only be viewed :)',
                    showConfirmButton: true
                })

            }else {

                var Data = new FormData();
                var encodeID = encodeURIComponent(window.btoa(id));

                Data.append( "edit_id", encodeID);

                var xhttp = new XMLHttpRequest();
                xhttp.open( "POST", "edit_invoice",true);
                xhttp.onreadystatechange = function() {
                    if(xhttp.readyState == 4 && xhttp.status == 200) {
                        if (xhttp.responseText) {
                            swal({
                                title: 'Edit Invoice <i style="color:#0078D7; " class="icofont icofont-edit-alt"></i>',
                                showCancelButton: true,
                                showLoaderOnConfirm: false,
                                showConfirmButton: false,
                                closeOnConfirm: false,
                                allowOutsideClick: false,
                                width:'75%',
                                heightAuto: false,
                                html:xhttp.responseText
                            })
                        }

                    }
                };
                xhttp.send(Data);

            }
        }
    };
    ajax.send(formData);
}