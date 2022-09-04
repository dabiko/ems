/**
 * Created by Dabiko Blaise on 14-Jul-18.
 */

'use strict';

/** Function to Load all Items for sale in the database*/
function loadUp(p) {
    $("#item_id"+p+"").on('change',function(){
        var ID = $(this).val();
        var tr = $(this).parent().parent();

        if (ID === ""){
            swal({
                type: 'error',
                title: 'Oops Error...!!',
                text: 'Please select an Item'
            });
        }else{

            console.log(ID);
            var formData = new FormData();
            formData.append("item_id", ID);

            var http = new XMLHttpRequest();
            http.open("POST", "switch");
            http.onreadystatechange = function () {
                if (http.readyState == 4 && http.status == 200) {
                    if (http.responseText) {
                        var jsonData = JSON.parse(http.responseText);
                        var jsonLength = jsonData.results.length;
                        for (var x = 0; x < jsonLength; x++) {
                            var result = jsonData.results[x];
                            var unitP = result.unit_price;
                            var costP = result.cost_price;
                            var Stocks = result.available_qty;
                            var name = result.item_name;
                            var des = result.item_des;


                        }

                        if(Stocks <= 0){
                            swal({
                        type: 'warning',
                        title: 'Sorry, '+name+' has '+Stocks+' quantity.This Item can\'t be sold. Please notify the manager'
                        });

                            $("#item_name"+p+"").val(" ");
                            $("#hide_des"+p+"").val(" ");
                            $("#hide_up"+p+"").val(" ");
                            $("#up"+p+"").val(" ");
                            $("#cog"+p+"").val(" ");
                            $("#stocks"+p+"").val(" ");
                            $("#qty"+p+"").val(" ");
                            $("#tp"+p+"").val(" ");

                       }else {

                            $("#item_name"+p+"").val(name);
                            $("#hide_des"+p+"").val(des);
                            $("#hide_up"+p+"").val(unitP);
                            $("#up"+p+"").val(unitP);
                            $("#cog"+p+"").val(costP);
                            $("#stocks"+p+"").val(Stocks);
                            $("#qty"+p+"").val(1);
                            $("#tp"+p+"").val(1 * unitP);




                            var sub_total = 0 ;
                            var theTbl = $('#addRows-1');
                            var trs = theTbl.find("input[name='tp']");
                            for(var i=0;i<trs.length;i++)
                            {
                                var sub_price = sub_total+=parseFloat(trs[i].value || 0);
                                $("#sub_total").val(sub_price);
                                $("#t_due").val(sub_price);
                                $("#t_cal").val(formatNumber(sub_price+' FCFA'));
                                $("#t_hide").val(sub_price);

                            }
                        }









                    }

                }
            };
            http.send(formData);

         }

    });

}



/** Function to Load all Items for sale in the database*/
// function load(i) {
//     $("#item_id"+i+"").on('change',function(){
//
//         var ID = $(this).val();
//         //var ID = document.getElementById("item_id"+i+"").value;
//        console.log(ID);
//         var formData = new FormData();
//         formData.append("item_id", ID);
//
//         var http = new XMLHttpRequest();
//         http.open("POST", "see.php", true);
//         http.onreadystatechange = function () {
//             if (http.readyState == 4 && http.status == 200) {
//                  if (http.responseText) {
//                      swal({
//                          type: 'info',
//                          title: http.responseText+ ','
//                      });
//
//                  }
//
//             }
//         };
//         http.send(formData);
//     });
//
// }
//
//
//
// function del(k) {
//
//     var totamt = 0 ;
//     var theTbl = $('#addRows-1');
//     var trs = theTbl.find("select[name='item_id']");
//     for(var i=0;i<trs.length;i++)
//     {
//         var row_ID = document.getElementById("item_id"+k+"").value;
//         var formData = new FormData();
//         formData.append("delete_id", row_ID);
//
//         var http = new XMLHttpRequest();
//         http.open("POST", "see.php", true);
//         http.onreadystatechange = function () {
//             if (http.readyState == 4 && http.status == 200) {
//                 if (http.responseText) {
//                     swal({
//                         type: 'info',
//                         title: 'Message :::'+http.responseText
//                     });
//
//
//                 }
//
//             }
//         };
//         http.send(formData);
//
//     }
//     $('table').on('click', 'button[type="button"]', function(e){
//         $(this).closest('tr').remove();
//     });
//
//
// }




/**Function that Deletes a specific row */
function deleteRow(k) {
    var row_price = document.getElementById("tp"+k+"").value;
    if (row_price !== "") {

            var totamt = 0 ;
            var theTbl = $('#addRows-1');
            var trs = theTbl.find("input[name='tp']");
            for(var i=0;i<trs.length;i++){
                var tprice = totamt+=parseFloat(trs[i].value || 0);
               // alert(tprice);
                var deduct = (tprice - row_price);


                if(row_price !== "" && tprice !== ""){

                    $("#sub_total").val(formatNumber(deduct));
                    $("#paid").val(" ");
                    $("#t_due").val(deduct);
                    $("#t_cal").val(formatNumber(deduct+' FCFA'));
                    $("#t_hide").val(deduct);

                    $('table').on('click', 'button[type="button"]', function(e){
                        $(this).closest('tr').remove();
                    });
                }

            }


    }else {

        $('table').on('click', 'button[type="button"]', function(e){
            $(this).closest('tr').remove();
        });
    }




}

/**Function  to format numbers currency values in thousands */
function formatNumber (num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
}

function keypressPaid() {
    var sub_total = document.getElementById("sub_total").value;
    var paid = document.getElementById("paid").value;

    if(isNaN(paid) || paid < 0 ){
        swal({
            type: 'error',
            title: 'Oops Error...!!',
            text: 'Please enter a valid payable amount'
        });

        $("#paid").val(" ");

    }else if (sub_total === "" && paid !== ""){
        swal({
            type: 'error',
            title: 'Oops Error...!!',
            text: 'Sub total is empty. Make sure the invoice has Items'
        });
        $("#paid").val(" ");
    } else if
     ((paid - 0 ) > (sub_total - 0)){
        swal({
            type: 'error',
            title: 'Oops Error...!!',
            text: 'Invalid Payable amount. '+paid+ ' is more than '+sub_total
        });
        $("#paid").val(" ");
    } else{
        $("#t_due").val(sub_total - paid );
        $("#hidden_paid").val(paid );
    }

}


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



function ValueUp(b) {

    var unitePrice = document.getElementById("up"+b+"").value;
    var cogs = document.getElementById("cog"+b+"").value;

   if(isNaN(unitePrice) || unitePrice === "0" || unitePrice < 0){

       _("valueError").innerHTML = '<div class="alert alert-danger icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="icofont icofont-close-line-circled"></i></button><p style="text-align: center;"><strong>Error!!! </strong>Invalid unit price.</p></div>';
       $("#valueError").show();
       setTimeout(function () {
           $("#valueError").fadeOut();

           $("#up"+b+"").val(hidden_up);
           var unitePrice = document.getElementById("up"+b+"").value;
           var Qty = document.getElementById("qty"+b+"").value;
           $("#tp"+b+"").val(Qty * unitePrice);

           var sub_total = 0 ;
           var theTbl = $('#addRows-1');
           var trs = theTbl.find("input[name='tp']");
           for(var x=0; x<trs.length;x++)
           {
               var sub_price = sub_total+=parseFloat(trs[x].value || 0);
               $("#sub_total").val(sub_price);
               $("#t_due").val(sub_price);
               $("#t_cal").val(formatNumber(sub_price+' FCFA'));
               $("#t_hide").val(sub_price);
           }


       }, 5000);
    }else {
       if ((unitePrice - 0) < (cogs - 0)) {
           var hidden_up = document.getElementById("hide_up"+b+"").value;
           var item_name = document.getElementById("item_name"+b+"").value;

           _("valueError").innerHTML = '<div class="alert alert-danger icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="icofont icofont-close-line-circled"></i></button><p style="text-align: center;"><strong>Error!!! </strong>Invalid unit price. '+item_name+' can\'t be sold below '+hidden_up+' FCFA</p></div>';
           $("#valueError").show();
           setTimeout(function () {
               $("#valueError").fadeOut();

               $("#up"+b+"").val(hidden_up);
               var unitePrice = document.getElementById("up"+b+"").value;
               var Qty = document.getElementById("qty"+b+"").value;
               $("#tp"+b+"").val(Qty * unitePrice);

               var sub_total = 0 ;
               var theTbl = $('#addRows-1');
               var trs = theTbl.find("input[name='tp']");
               for(var x=0; x<trs.length;x++)
               {
                   var sub_price = sub_total+=parseFloat(trs[x].value || 0);
                   $("#sub_total").val(sub_price);
                   $("#t_due").val(sub_price);
                   $("#t_cal").val(formatNumber(sub_price+' FCFA'));
                   $("#t_hide").val(sub_price);
               }


           }, 5000);

       }else{

           var Qty = document.getElementById("qty"+b+"").value;
           var unite_price = document.getElementById("up"+b+"").value;
           $("#tp"+b+"").val(Qty * unite_price);

           var totamt = 0 ;
           var theTbl = $('#addRows-1');
           var trs = theTbl.find("input[name='tp']");
           for(var x=0; x<trs.length;x++)
           {
               var tprice = totamt+=parseFloat(trs[x].value || 0);
               $("#sub_total").val(tprice);
               $("#t_due").val(tprice);
               $("#t_cal").val(formatNumber(tprice+' FCFA'));
               $("#t_hide").val(tprice);
           }

       }
   }


}


function ValueQty(i) {
    var quantity = document.getElementById("qty"+i+"").value;
    var stocks = document.getElementById("stocks"+i+"").value;

    if(isNaN(quantity) ||  quantity === "0" || quantity < 0){
        _("valueError").innerHTML = '<div class="alert alert-danger icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="icofont icofont-close-line-circled"></i></button><p style="text-align: center;"><strong>Error!!! </strong>Quantity not valid. Make sure your quantity are valid (Form 1 and above)</p></div>';

        $("#valueError").show();
        setTimeout(function () {
            $("#valueError").fadeOut();
            $("#qty"+i+"").val(1);
            var qty = document.getElementById("qty"+i+"").value;
            var unit = document.getElementById("up"+i+"").value;
            var amnt = (qty * unit);
            $("#tp"+i+"").val(amnt);

            var totamt = 0 ;
            var theTbl = $('#addRows-1');
            var trs = theTbl.find("input[name='tp']");
            for(var x=0; x<trs.length; x++)
            {
                var tprice = totamt+=parseFloat(trs[x].value || 0);
                $("#sub_total").val(tprice);
                $("#t_due").val(tprice);
                $("#t_cal").val(formatNumber(tprice+' FCFA'));
                $("#t_hide").val(tprice);

            }
        }, 5000);

    }else {

        if ((quantity - 0) > (stocks - 0)) {
            var item_name = document.getElementById("item_name"+i+"").value;
            _("valueError").innerHTML = '<div class="alert alert-danger icons-alert">' +
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                '<i class="icofont icofont-close-line-circled"></i></button>' +
                '<p style="text-align: center;">' +
                '<strong>Error!!! </strong>Invalid Quantity. Available stocks for ' + item_name + ' is ' + stocks + ' ' +
                '</p></div>';

            $("#valueError").show();
            setTimeout(function () {
                $("#valueError").fadeOut();
                $("#qty"+i+"").val(1);
                var qty = document.getElementById("qty"+i+"").value;
                var unit = document.getElementById("up"+i+"").value;
                var amnt = (qty * unit);
                $("#tp"+i+"").val(amnt);

                var totamt = 0 ;
                var theTbl = $('#addRows-1');
                var trs = theTbl.find("input[name='tp']");
                for(var x=0; x<trs.length; x++)
                {
                    var tprice = totamt+=parseFloat(trs[x].value || 0);
                    $("#sub_total").val(tprice);
                    $("#t_due").val(tprice);
                    $("#t_cal").val(formatNumber(tprice+' FCFA'));
                    $("#t_hide").val(tprice);
                }
            }, 5000);

        }else{


             var qty = document.getElementById("qty"+i+"").value;
             var unit = document.getElementById("up"+i+"").value;
             var amnt = (qty * unit);
                $("#tp"+i+"").val(amnt);

                var totamt = 0 ;
                var theTbl = $('#addRows-1');
                var trs = theTbl.find("input[name='tp']");
                for(var x=0; x<trs.length; x++)
                {
                    var tprice = totamt+=parseFloat(trs[x].value || 0);
                    $("#sub_total").val(tprice);
                    $("#t_due").val(tprice);
                    $("#t_cal").val(formatNumber(tprice+' FCFA'));
                    $("#t_hide").val(tprice);
                }
        }
    }

}

/** Function to disable spaces when inputting numbers */
function noSpaces(string){
    if(string.value.match(/\s/g)){
        string.value=string.value.replace(/\s/g,'');
    }
}




$(document).ready(function(){
    var i = 1;
    $('#addRows-1').Tabledit({editButton:false,
        deleteButton:false,hideIdentifier:true,
        columns:{identifier:[0,'id'],
            editable:[[1,'#No'],
                [2,'Item Name'],
                [3,'Stocks'],
                [4,'Quantity'],
                [5,'Cost Price'],
                [6,'Unit Price'],
                [7,'Total'],
                [8,'Action']
            ]}});

    var ajax = new XMLHttpRequest();
    ajax.open("GET", "list_items", true);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200){
            if (ajax.responseText) {
                var dropDrown = ajax.responseText;

                var table=document.getElementById("addRows-1");
                var t1=(table.rows.length);
                var row=table.insertRow(t1);
                var cell1=row.insertCell(0);
                var cell2=row.insertCell(1);
                var cell3=row.insertCell(2);
                var cell4=row.insertCell(3);
                var cell5=row.insertCell(4);
                var cell6=row.insertCell(5);
                var cell7=row.insertCell(6);
                var cell8=row.insertCell(7);
                var cell9=row.insertCell(8);
                var cell10=row.insertCell(9);


                cell1.className='abc';
                cell2.className='abc';
                cell3.className='abc';
                cell4.className='abc';
                cell5.className='abc';
                cell6.className='abc';
                cell7.className='abc';
                cell8.className='abc';
                cell9.className='abc';
                cell10.className='abc';




                $('<button  disabled=disabled style="width: 30px; height: 30px;" name="deleteBtn" id="deleteBtn" class="btn btn-primary btn-outline-primary btn-icon">'+i+'</button>').appendTo(cell1);
                $('<select style="color: black;"  onclick="loadUp('+i+');"  name="item_id" id="item_id'+i+'" class="form-control input-sm"><option value="">Select Item....</option>'+dropDrown+'</select>').appendTo(cell2);
                $('<input style="color: black;"  readonly="readonly" class="form-control input-sm" type="text" name="stocks" id="stocks'+i+'" placeholder="qty in stock">').appendTo(cell3);
                $('<input style="color: black;"  class="form-control input-sm" onKeyPress="ValueQty('+i+'); noSpaces(this);" onKeyUp="ValueQty('+i+'); noSpaces(this);" type="text" name="qty" id="qty'+i+'" placeholder="quantity">').appendTo(cell4);
                $('<input style="color: black;"  readonly="readonly" class="form-control input-sm"  type="text" name="cog" id="cog'+i+'" placeholder="cost of good">').appendTo(cell5);
                $('<input style="color: black;"  class="form-control input-sm" onKeyPress="ValueUp('+i+'); noSpaces(this);" onKeyUp="ValueUp('+i+'); noSpaces(this);" type="text" name="up" id="up'+i+'" placeholder="unit price">').appendTo(cell6);
                $('<input style="color: black;"  readonly="readonly" class="form-control input-sm" type="text" name="tp" id="tp'+i+'" placeholder="total">').appendTo(cell7);
                $('<input  class="form-control input-sm" type="hidden" name="item_name" id="item_name'+i+'">').appendTo(cell8);
                $('<input  class="form-control input-sm" type="hidden" name="hide_up" id="hide_up'+i+'">').appendTo(cell9);
                $('<input  class="form-control input-sm" type="hidden" name="hide_des" id="hide_des'+i+'">').appendTo(cell10);



            }

        }

    };
    ajax.send();


});


/**Function that Adds row on button click */
var i = 2;
// var num = $("#addRows-1 td").closest("tr").length;
// var i = num ;
function add_row(){

        var ajax = new XMLHttpRequest();
        ajax.open("GET", "list_items", true);
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 4 && ajax.status == 200) {
                if (ajax.responseText) {
                    var dropDrown = ajax.responseText;

                    var table=document.getElementById("addRows-1");
                    var t1=(table.rows.length);
                    var row=table.insertRow(t1);
                    var cell1=row.insertCell(0);
                    var cell2=row.insertCell(1);
                    var cell3=row.insertCell(2);
                    var cell4=row.insertCell(3);
                    var cell5=row.insertCell(4);
                    var cell6=row.insertCell(5);
                    var cell7=row.insertCell(6);
                    var cell8=row.insertCell(7);
                    var cell9=row.insertCell(8);
                    var cell10=row.insertCell(9);
                    var cell11=row.insertCell(10);

                    cell1.className='abc';
                    cell2.className='abc';
                    cell3.className='abc';
                    cell4.className='abc';
                    cell5.className='abc';
                    cell6.className='abc';
                    cell7.className='abc';
                    cell8.className='abc';
                    cell9.className='abc';
                    cell10.className='abc';
                    cell11.className='abc';


                    $("#paid").val(" ");

                    $('<button disabled="disabled" style="width: 30px; height: 30px;" name="deleteBtn" id="deleteBtn" class="btn btn-primary btn-outline-primary btn-icon">'+i+'</button>').appendTo(cell1);
                    $('<select style="color: black;" onclick="loadUp('+i+');"  name="item_id" id="item_id'+i+'" class="form-control input-sm"><option value="">Select Item....</option>'+dropDrown+'</select>').appendTo(cell2);
                    $('<input style="color: black;"  readonly="readonly" class="form-control input-sm" type="text" name="stocks" id="stocks'+i+'" placeholder="qty in stock">').appendTo(cell3);
                    $('<input style="color: black;"  class="form-control input-sm" onKeyPress="ValueQty('+i+'); noSpaces(this);" onKeyUp="ValueQty('+i+'); noSpaces(this);" type="text" name="qty" id="qty'+i+'" placeholder="quantity">').appendTo(cell4);
                    $('<input style="color: black;"  readonly="readonly" class="form-control input-sm"  type="text" name="cog" id="cog'+i+'" placeholder="cost of good">').appendTo(cell5);
                    $('<input style="color: black;"  class="form-control input-sm" onKeyPress="ValueUp('+i+'); noSpaces(this);" onKeyUp="ValueUp('+i+'); noSpaces(this);" type="text" name="up" id="up'+i+'" placeholder="unit price">').appendTo(cell6);
                    $('<input style="color: black;"  readonly="readonly" class="form-control input-sm" type="text" name="tp" id="tp'+i+'" placeholder="total">').appendTo(cell7);
                    $('<button onclick="return deleteRow('+i+');"  style="width: 30px; height: 30px;" title="Delete" class="btn btn-danger btn-danger btn-icon" type="button" id="DeleteBtn" name="DeleteBtn"><i class="icofont icofont-trash"></i></button>').appendTo(cell8);
                    $('<input  class="form-control input-sm" type="hidden" name="item_name" id="item_name'+i+'">').appendTo(cell9);
                    $('<input  class="form-control input-sm" type="hidden" name="hide_up" id="hide_up'+i+'">').appendTo(cell10);
                    $('<input  class="form-control input-sm" type="hidden" name="hide_des" id="hide_des'+i+'">').appendTo(cell11);


                    i++;
                }

            }

        };
        ajax.send();


}