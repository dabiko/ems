/**
 * Created by Dabiko Blaise on 12-Jul-18.
 */
// function notification(){
//     // $("#invoiceForm")[0].reset();
//     // $('#resetInvoice').trigger(function(){
//     //     $("#addRows-1").find("tr:gt(0)").remove();
//     // });
//     $("#invoiceForm").trigger("reset");
//     $("#addRows-1").find("tr:gt(1)").remove();
//     // $("#resetInvoice").click(function(){
//     //     $("#addRows-1").find("tr:gt(0)").remove();
//     // });
// }




function unpaidNotifaction() {

    var formData = new FormData();
    var http = new XMLHttpRequest();
    var balance = 'balance';
    formData.append( "balance",balance);
    http.open("POST", "balance_notify", true);
    http.onreadystatechange = function () {
        if (http.readyState == 4 && http.status == 200) {
            if (http.responseText > 0) {

                    function notify(message,type){
                        $.growl({message:message},
         {type:type,allow_dismiss:true,label:'Cancel',className:'btn-xs btn-inverse',
        placement:{from:'top',align:'right'},
        delay:5000,animate:{enter:'animated bounceIn',exit:'animated bounceOut'},
        offset:{x:30,y:30}});};
        notify( http.responseText+ ' Invoices has unpaid Balance','inverse');


            }

        }
    };
    http.send(formData);
}

function printNotifaction() {
    var formData = new FormData();
    var http = new XMLHttpRequest();

    formData.append( "print","print");
    http.open("POST", "print_notify", true);
    http.onreadystatechange = function () {
        if (http.readyState == 4 && http.status == 200) {
            if (http.responseText > 0) {
                function notify(message,type){
                    $.growl({message:message},
                        {type:type,allow_dismiss:true,label:'Cancel',className:'btn-xs btn-inverse',
                            placement:{from:'top',align:'right'},
                            delay:5000,animate:{enter:'animated bounceIn',exit:'animated bounceOut'},
                            offset:{x:30,y:30}});};
                notify( http.responseText+ ' Invoices needs to be printed','inverse');
            }

        }
    };
    http.send(formData);
}


setInterval(function () {
   // unpaidNotifaction();
    //printNotifaction();
},500000);

/**Function for get elements in  input boxes by ID */
function _(id){
    return document.getElementById(id);
}

/**Function  to format numbers currency values in thousands */
function formatNumber (num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
}

/**Function that submits all invoice details into the database */
function submitInvoice() {
    var TableData=[];
    $('#addRows-1 tr').each(function(row,tr){
          TableData[row]={
            "Item_Id" : $(tr).find('select[name="item_id"]').val(),
            "Item_name" : $(tr).find('option:selected').text(),
            "Stocks" : $(tr).find('input[name="stocks"]').val(),
            "Quantity" :$(tr).find('input[name="qty"]').val(),
            "Cogs" :$(tr).find('input[name="cog"]').val(),
            "Unit_Price" : $(tr).find('input[name="up"]').val(),
            "Total" : $(tr).find('input[name="tp"]').val(),
            "Description" : $(tr).find('input[name="hide_des"]').val()
        }
    });



    /** first row is the table header - so remove.
     * Since the header row is not needed,
     * shift is used to pop it off the array */
    TableData.shift();
    var JsonData = JSON.stringify(TableData);
    var order_number = document.getElementById("orderID").innerText;
    var invoice_number = document.getElementById("inNum").innerText;






    function responseError(error) {
        _("valueError").innerHTML = '<div class="alert alert-danger icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="icofont icofont-close-line-circled"></i></button><p style="text-align: center;"><strong>Error!!! </strong> '+error+'</p></div>';
        $("#valueError").show();
        setTimeout(function () {
            $("#valueError").fadeOut();
        }, 5000);
    }

    function InvoiceError(error) {
        swal({
            type: 'error',
            title: 'Oops Error...!!',
            text: error
        });
    }

    var formData = new FormData();
    formData.append( "c_name", _("c_name").value );
    formData.append( "c_address", _("c_address").value );
    formData.append( "c_num", _("c_num").value );
    formData.append( "c_email", _("c_email").value );
    formData.append( "order_id", order_number);
    formData.append( "in_num", invoice_number);
    formData.append( "p_method", _("p_method").value );
    formData.append( "sub_total", _("sub_total").value );
    formData.append( "paid", _("paid").value );
    formData.append( "hidden_paid", _("hidden_paid").value );
    formData.append( "t_due", _("t_due").value );
    formData.append( "t_cal", _("t_hide").value);
    formData.append( "rowData",JsonData);

    var ajax = new XMLHttpRequest();
    ajax.open("POST", "invoice_process");
    ajax.onreadystatechange = function () {

        if(ajax.responseText == 1){
            responseError('Invalid Request!!');
        }else if(ajax.responseText == 2){
            responseError('Missing client information. Please make sure that all client info fields are inputted correctly!!');
        }else if(ajax.responseText == 3){
            responseError('Invalid name. Name too short, names must be above 2 letters!!');
        }else if(ajax.responseText == 4){
            responseError('Invalid name.Name too long, names cant exceed 15 letters!!');
        }else if(ajax.responseText == 5){
            responseError('Invalid number. Only integers are allowed!!');
        }else if(ajax.responseText == 6){
            responseError('Invalid email address!!');
        }else if(ajax.responseText == 7){
            swal({
                type: 'error',
                title: 'Oops Error...!!',
                text: 'Error code EiD&In#'
            });
        }else if(ajax.responseText == 8){
            swal({
                type: 'error',
                title: 'Oops Error...!!',
                text: 'Payment method is required'
            });
        }else if(ajax.responseText == 9){
        swal({
            type: 'error',
            title: 'Oops Error...Possible reasons!!',
            text: 'Either total or sub total is empty.Make sure all values are inputted correctly'
        });
    }else if(ajax.responseText == 10){
            swal({
                type: 'error',
                title: 'Oops Error...!!',
                text: 'Total of Invoice is not correct'
            });
        }
        else if(ajax.responseText == 11){
            swal({
                type: 'error',
                title: 'Oops Error...!!',
                text: 'Invalid Payable amount. Payable amount ('+formatNumber(_("paid").value)+') FCFA) is more than Sub total ('+formatNumber(_("sub_total").value)+' FCFA)'
            });
        }else if(ajax.responseText == 12){
            swal({
                type: 'error',
                title: 'Oops Error...Possible reasons!!',
                text: 'Paid amount is empty.Make sure all values are inputted correctly'
            });
        }else if(ajax.responseText == 14){
            swal({
                type: 'error',
                title: 'Oops Error...!!',
                text: 'This Invoice still have a balance of '+formatNumber(_("t_due").value)+' FCFA. The Payment Method should be Credit'
            });
        }else if(ajax.responseText == 15){
            swal({
                type: 'error',
                title: 'Oops Error...!!',
                text: 'This Invoice  has no balance. The Payment Method should be Cash or Check'
            });
        }else if(ajax.responseText == 13){
            swal({
                type: 'success',
                title: 'Invoice Successfully processed',
                text: 'Go ahead and print the Invoice'
            });

            $("#invoiceForm").trigger("reset");
            $("#addRows-1").find("tr:gt(1)").remove();

            $(document).ready(function () {
                var chars = "0123456789";
                var string_length = 10;
                var random_string = '';
                for (var i=0; i<string_length; i++) {
                    var rand_num = Math.floor(Math.random() * chars.length);
                    random_string += chars.substring(rand_num,rand_num+1);
                }
                $("#inNum").text("#"+random_string);
            });


            $(document).ready(function () {
                var number = "ABCDEFGHIJK0123456789LMOPQRSTUVWXYZ";
                var string_length = 6;
                var random_string = '';
                for (var i=0; i<string_length; i++) {
                    var rand_num = Math.floor(Math.random() * number.length);
                    random_string += number.substring(rand_num,rand_num+1);
                }
                $("#orderID").text("#"+random_string);
            });

            $("#refreshPage").trigger("click");





        }else if(ajax.responseText){
            swal({
                type: 'error',
                title: 'Oops Error...!!',
                text: ajax.responseText
            });
        }



    };
    ajax.send(formData);


}


/**Function that submits all invoice details into the database */
function EditedInvoice() {



    var formData = new FormData();
    formData.append( "c_name", _("editC_name").value );
    formData.append( "c_address", _("editC_address").value );
    formData.append( "c_num", _("editC_num").value );
    formData.append( "c_email", _("editC_email").value );
    formData.append( "invoice_id", _("invoice_id").value );

    formData.append( "edit_method", _("edit_method").value );
    formData.append( "hidden", _("hidden").value );
    formData.append( "sub_total", _("editSub_total").value );
    formData.append( "edit_due", _("edit_due").value );

    function responseError(error) {
        _("editInError").innerHTML = '<div class="alert alert-danger icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="icofont icofont-close-line-circled"></i></button><p style="text-align: center;"><strong>Error!!! </strong> '+error+'</p></div>';
        $("#editInError").show();
        setTimeout(function () {
            $("#editInError").fadeOut();
        }, 7000);
    }

    var ajax = new XMLHttpRequest();
    ajax.open( "POST","editInvoice_process",true);
    ajax.onreadystatechange = function() {
        if(ajax.responseText == 1){
            responseError('Invalid Request!!');
        }else if(ajax.responseText == 2){
            responseError('Missing client information. Please make sure that all client info fields are inputted correctly!!');
        }else if(ajax.responseText == 3){
            responseError('Invalid name. Name too short, names must be above 2 letters!!');
        }else if(ajax.responseText == 4){
            responseError('Invalid name.Name too long, names cant exceed 15 letters!!');
        }else if(ajax.responseText == 5){
            responseError('Invalid number. Only integers are allowed!!');
        }else if(ajax.responseText == 6){
            responseError('Invalid email address!!');

        }else if(ajax.responseText == 7){

            responseError('There\'s an error.!!! XlCinIDsXS#');

        }else if(ajax.responseText == 8){
            responseError('Unpaid Balance is empty.Input Zero (0) as default value if there\'s no unpaid balance.NOTE, no negative values allowed!!!');

        }else if(ajax.responseText == 11){
            responseError('Paid field is empty. Make sure you enter amount');

        }else if(ajax.responseText == 12){
            responseError('This Invoice still have a balance of '+formatNumber(_("edit_due").value)+' FCFA. The Payment Method should be Credit');

        }else if(ajax.responseText == 13){
            responseError('This Invoice  has no balance. The Payment Method should be Cash or Check');

        }else if(ajax.responseText == 9){
            swal({
                type: 'success',
                timer: 4000,
                showConfirmButton: false,
                title: 'Update was successful',
                text: 'Balance has been successfully paid. Receipt is available for printing',
                footer: '<a href="javascript:void()">Validated :)</a>'
            });
            $("#refreshPage").trigger("click");

        }else if(ajax.responseText == 10){
            swal({
                type: 'info',
                timer: 4000,
                showConfirmButton: false,
                title: 'Update was successful',
                text: 'There\'s still an unpaid balance '+formatNumber(_("edit_due").value)+' FCFA',
                footer: '<a href="javascript:void()">Pending Validation :)</a>'
            });
            $("#refreshPage").trigger("click");

        }



    };
    ajax.send(formData);



}






