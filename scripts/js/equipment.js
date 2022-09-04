/**
 * Created by Dabiko Blaise on 11-Jul-18.
 */

/**Function for get elements in  input boxes by ID */
function _(id){
    return document.getElementById(id);
}

/**Function for Generating Unique codes for each equipment  */
function generateCode(){
    var chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    var string_length = 8;
    var random_string = '';
    for (var i=0; i<string_length; i++) {
        var rand_num = Math.floor(Math.random() * chars.length);
        random_string += chars.substring(rand_num,rand_num+1);
    }
    var send =
        '<span class="input-group-addon"><i class="icofont icofont-code-alt"></i></span>'+
        '<input  readonly="readonly" type="text"  id="e_code" name="e_code" value="EMS-'+random_string+'" class="form-control required" placeholder="generate Code"/>'+
        '<span onclick="return generateCode();" class="input-group-addon ">Generate</span>';
    $("#gCode").html(send);
}


/**Function for Incrementing  the number of each equipment added in relation to the number in the database */
function increment() {

    var ajax = new XMLHttpRequest();
    ajax.open("GET", "increment", true);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            if (ajax.responseText) {
                var send ='<span class="input-group-addon"><i class="icofont icofont-listing-number"></i></span>'+
                          '<input  type="text"  id="e_num" name="e_num" value="'+ajax.responseText+'" class="form-control required"/>';
                $("#addNum").html(send);
                $("#e_num").attr("readonly",true);
                   }
                }


            };
            ajax.send();
}

/**Time interval that queries the database every 5 seconds for get equipment number for incrementing */
setInterval(function () {
    //increment();
}, 5000);

/**Function to limit the number of words to display in the equipment table */
function limitWords(textToLimit, wordLimit) {

    var finalText = " ";

    var text2 = textToLimit.replace(/\s+/g,' ');

    var text3 = text2.split(' ');

    var numberOfWords = text3.length;

    var i=0;

    if(numberOfWords > wordLimit) {
        for(i=0; i< wordLimit; i++)
            finalText = finalText+" "+ text3[i]+" ";

        return finalText+"....";
    }
    else return textToLimit;
}


/**Function  to format numbers currency values in thousands */
function formatNumber (num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
}

/**Function for Adding new equipment into the System */
function addEquip(){

    _("eBtn").disabled = true;
    _("eLoading").innerHTML = '<i class="ti-reload rotate-refresh"></i>';
    $("#eLoading").show();



    var formData = new FormData();
    formData.append( "e_num", _("e_num").value );
    formData.append( "e_name", _("e_name").value );
    formData.append( "des", _("des").value );
    formData.append( "mainCat_id", _("mainCat_id").value );
    formData.append( "subCat_id", _("subCat_id").value );
    formData.append( "e_manu", _("e_manu").value );
    formData.append( "e_model", _("e_model").value );
    formData.append( "e_code", _("e_code").value );
    formData.append( "qty", _("qty").value );
    formData.append( "cogs", _("cogs").value );
    formData.append( "u_price", _("u_price").value );



    var ajax = new XMLHttpRequest();
    ajax.open( "POST", "add_equipment",true);
    ajax.onreadystatechange = function() {
        if(ajax.readyState == 4 && ajax.status == 200) {

            function responseError(error){
              _("eError").innerHTML = '<div class="alert alert-danger icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="icofont icofont-close-line-circled"></i></button><p><strong>Error!!! </strong> '+error+'</p></div>';
                $("#eError").show(error);
                setTimeout(function () {
                    $("#eError").hide(error);
                    $("#eLoading").hide();
                }, 5000);
                _("eBtn").disabled = false;
            }

            if(ajax.responseText == 1 ){

                responseError('Unknown/Invalid Request');

            }else if(ajax.responseText == 2){

                responseError('Equipment number can\'t be empty. Please do not edit the field');

            }else if(ajax.responseText == 3){

                responseError('Equipment Name is a required Field');

            }else if(ajax.responseText == 4){

                responseError('Equipment description is required');

            }else if(ajax.responseText == 5){

                responseError('Equipment description exceeds 100 words');

            }else if(ajax.responseText == 6){

                responseError('Main Category is a required Field. All equipments must fall under a Main Category');

            }else if(ajax.responseText == 7){

                responseError('Sub Category is a required Field. Else select NONE in the drop-down list');

            }else if(ajax.responseText == 8){

                responseError('Equipments must have Manufacturers');

            }else if(ajax.responseText == 9){

                responseError('The Model of your equipments  is a required Field');

            }else if(ajax.responseText == 10){

                responseError('Equipment code has not been generated. Please click on the generate button to generate the code');

            }else if(ajax.responseText == 11){

                responseError('Quantity is a required Field and it can\'t be Zero');

            }else if(ajax.responseText == 12){

                responseError('Invalid quantity values. Only numbers are allowed');

            }else if(ajax.responseText == 13){

                responseError('Quantity must be 1 and above');

            }else if(ajax.responseText == 14){

                responseError('Cost of goods is a required Field and it can\'t be Zero');

            }else if(ajax.responseText == 15){

                responseError('Invalid C.O.Gs values. Only numbers are allowed');

            }else if(ajax.responseText == 16){

                responseError('Invalid C.O.Gs. Your C.O.Gs can\'t be '+_("cogs").value+' FCFA');

            }else if(ajax.responseText == 17){

                responseError('Unit Price is a required Field and it can\'t be Zero');

            }else if(ajax.responseText == 18){

                responseError('Invalid unit price values. Only numbers are allowed');

            }else if(ajax.responseText == 19){

                responseError('Invalid unit price. Unit price can\'t be '+_("u_price").value+' FCFA');

            }else if(ajax.responseText == 20){

                responseError('Invalid unit price. Unit price can\'t be less than Cost of Goods (C.O.Gs)');

            }else if(ajax.responseText == 21){

                responseError('Invalid Equipment Name - name must be two or more letters');

            }else if(ajax.responseText == 22){

                responseError('Invalid Equipment Name - name too long');

            }else if(ajax.responseText == 23){

                responseError(''+_("e_name").value+' has already been Added. Please  edit the equipment quantity or change the name');

            }else if(ajax.responseText == 24){

                responseError('Invalid model number.The model number belongs to '+_("e_name").value+' This can be resolved by editing '+_("e_name").value+' quantity');

            }else if(ajax.responseText){

                var jsonData = JSON.parse(ajax.responseText);
                var jsonLength = jsonData.results.length;

                for (var i = 0; i < jsonLength; i++) {
                    var result = jsonData.results[i];

                    var e_id = result.equip_id;
                    var name = result.ename;
                    var des = result.des;
                    var model = result.emodel;
                    var manu = result.manu;
                    var code = result.ecode;
                    var qty = result.qty;
                    var tc = result.etc;
                    var up = result.eup;
                    var cogs = result.ecogs;
                    var subCat = result.sub_cat;
                    var mainCat = result.main_cat;
                    var mainId = result.main_id;

                    var dateAdded  = result.dateAdded ;
                    var agoAdded = result.agoAdded;
                    var updatedate = result.updatedate;
                    var updateago  = result.updateago ;
                }

                swal({
                    title: "Added",
                    text: name+" has been Added Successfully",
                    type: 'success',
                    timer: 4000,
                    showConfirmButton: false
                });

                if (qty <= 10){
                  var stocks = '<td id="'+e_id+'ajaxLs"><button type="button" class="btn btn-outline-warning btn-round"> Low Stock</button></td>';

                } else if (qty > 10){

                    var stocks = '<td id="'+e_id+'ajaxIs"><button type="button" class="btn btn-outline-success btn-round"> In Stock</button></td>';
                }

                    setTimeout(function(){
                        var addRows =
                            '<tr id="'+e_id+'Equip"><td id="'+e_id+'AjaxBtn">'+
                            '<button onclick="return equipDelete('+e_id+');" title="Delete '+name+'" style="width: 30px; height: 30px;"  class="btn btn-danger btn-outline-danger btn-icon"><i class="icofont icofont-delete-alt"></i></button>' +
                            '<button onclick="return ViewEquipModal('+e_id+');" title="View '+name+'" style="width: 30px; height: 30px;"  class="btn btn-primary btn-outline-primary btn-icon"><i class="icofont icofont-eye-alt"></i></button>' +
                            '<a onclick="return ViewEquipModal('+e_id+');"><button title="Edit '+name+'" style="width: 30px; height: 30px;"  class="btn btn-primary btn-outline-primary btn-icon"><i class="icofont icofont-edit-alt"></i></button></a>'+
                           '</td>'+
                           ''+stocks+''+
                        '<td id="'+e_id+'ajaxName" class="text-center">'+name+'</td>'+
                        '<td id="'+e_id+'ajaxDes" onclick="return ViewDesModal('+e_id+');">'+limitWords(des,3)+'</td>'+
                        '<td id="'+e_id+'ajaxManu" class="text-center">'+manu+'</td>'+
                        '<td id="'+e_id+'ajaxModel" class="text-center">'+model+'</td>'+
                        '<td id="'+e_id+'ajaxCode" class="text-center">'+code+'</td>'+
                        '<td id="'+e_id+'ajaxMain" class="text-center">'+mainCat+'</td>'+
                        '<td id="'+e_id+'ajaxSub" class="text-center">'+subCat+'</td>'+
                        '<td id="'+e_id+'ajaxQty" class="text-center">'+qty+'</td>'+
                        '<td id="'+e_id+'ajaxUp" class="text-center">'+formatNumber(up+ ' FCFA')+'</td>'+
                         '<td id="'+e_id+'ajaxcpG" class="text-center">'+formatNumber(cogs+ ' FCFA')+'</td>'+
                        '<td id="'+e_id+'ajaxTc" class="text-center">'+formatNumber(tc+ ' FCFA')+'</td>'+
                        '<td id="'+e_id+'ajaxDate" class=text-center>'+dateAdded+' ('+agoAdded+')</td> '+
                        '<td id="'+e_id+'ajaxUpdate" class=text-center>'+updatedate+' ('+updateago+')</td>' +
                        '</tr>';
                        /** Adding the Rows,Playing Sound and removing the backgroundColor*/

                        $('<tr>'+addRows+'</tr>').insertBefore('table > tbody > tr:first');

                        InsertSound();
                        $("#"+e_id+"Equip").animate({ backgroundColor: "#3085d6" }, "slow",function(){
                            $("#"+e_id+"Equip").animate({ backgroundColor: "" }, "slow");
                        });
                        $('#eForm')[0].reset();
                        _("e_code").value = " ";
                    }, 3000);

            }
        }
    };
    ajax.send(formData);
}


/**Function to count the number of wards when briefly describing equipments */
var maxAmount = 30;
function textCounter(textField, showCountField) {
    if (textField.value.length > maxAmount) {
        textField.value = textField.value.substring(0, maxAmount);

        var error = _("eError").innerHTML = '<div class="alert alert-danger icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="icofont icofont-close-line-circled"></i></button><p><strong>Error!!! </strong>You have exceeded 100 characters</p></div>';
        $("#eError").show(error);
        setTimeout(function () {
            $("#eError").hide(error);
            $("#eLoading").hide();
        }, 5000);
        _("eBtn").disabled = false;
    } else {
        showCountField.value = maxAmount - textField.value.length+' Left';
    }
}

/** Function to disable spaces when inputting numbers */
function noSpaces(string){
    if(string.value.match(/\s/g)){
        string.value=string.value.replace(/\s/g,'');
    }
}

/** Function for Add Equipments*/
function addModal() {

    var ajax = new XMLHttpRequest();
    ajax.open( "GET", "increment",true);
    ajax.onreadystatechange = function() {
        if(ajax.readyState == 4 && ajax.status == 200) {
            if(ajax.responseText){

                var formData = new FormData();
                formData.append("mainDrop","mainDrop");

                var xhttp = new XMLHttpRequest();
                xhttp.open( "POST", "getMainCat",true);
                xhttp.onreadystatechange = function() {
                    if (xhttp.readyState == 4 && xhttp.status == 200) {
                        if (xhttp.responseText) {

                             var Data = new FormData();
                              Data.append("subDrop","subDrop");

                            var http = new XMLHttpRequest();
                            http.open( "POST", "getSubCat",true);
                            http.onreadystatechange = function() {
                                if (http.readyState == 4 && http.status == 200) {
                                    if (http.responseText) {
                                        var number = ajax.responseText;
                                        var mainCat = xhttp.responseText;
                                        var subCat = http.responseText;



                                        swal({
                                            title: 'Add New Equipment into the System <i style="color:#0078D7; " class="icofont icofont-plus-circle"></i><br>' +
                                            '<h6> <span>All<code>*</code>are Required Fields</span></h6>',
                                            showCancelButton: true,
                                            cancelButtonText: 'Cancel' + ' <i class="icofont icofont-close-circled"></i>',
                                            showLoaderOnConfirm: false,
                                            showConfirmButton: false,
                                            closeOnConfirm: false,
                                            allowOutsideClick: false,
                                            width:'70%',
                                            heightAuto: false,
                                            html:'<form id="eForm"  onsubmit="addEquip(); return false;" method="POST" action="">' +
                                            '<div id="eError"></div><div class="row">'+
                                            '<div class="col-sm-6"><h4  style="text-align: center;" class="sub-title">Equipment Info </h4>'+
                                            '<div class="row"><label style="font-size: small" class="col-sm-4">E-Number <span style="color: red;">*</span></label>'+
                                            '<div class="col-sm-12"><div class="input-group input-group-primary">'+
                                            '<span class="input-group-addon"><i class="icofont icofont-listing-number"></i></span>'+
                                            '<input readonly="readonly"  type="text" id="e_num" name="e_num"  value='+number+'  class="form-control"/>'+
                                            '</div></div></div>'+

                                            '<div class="row"><label style="font-size: small" class="col-sm-4">E-Name <span style="color: red;">*</span></label>'+
                                            '<div class="col-sm-12"><div class="input-group input-group-primary">'+
                                            '<span class="input-group-addon"><i class="icofont icofont-tools-alt-1"></i></span>'+
                                            '<input  type="text" id="e_name" name="e_name" placeholder="equipment name"   class="form-control required"/>'+
                                            '</div></div></div>' +

                                            '<div class="row"><label style="font-size: small" class="col-sm-4">Description <span style="color: red;">*</span></label>' +
                                            '<div class="col-sm-12"><div class="input-group input-group-primary">' +
                                            ' <span class="input-group-addon"><i class="icofont icofont-presentation-alt"></i></span>' +
                                            '<textarea  type="text" id="des" name="des"  onKeyDown="textCounter(this.form.des,this.form.countDisplay);" onKeyUp="textCounter(this.form.des,this.form.countDisplay);"' +
                                            ' placeholder="Briefly describe equipment.Maximum of 100 characters" class="form-control"></textarea>' +
                                            '<br><input disabled="disabled"  class="form-control col-sm-2" type="text" name="countDisplay" value="30 left">' +
                                            '</div></div></div> '+


                                            '<div class="row"><label style="font-size: small" class="col-sm-4">E-MainCat <span style="color: red;">*</span></label>'+
                                            '<div class="col-sm-12"><div class="input-group input-group-primary">'+
                                            '<span class="input-group-addon"><i class="icofont icofont-group"></i></span>'+
                                            '<select  id="mainCat_id" name="mainCat_id" class="form-control required">' +
                                            '<option value="">Select a Main Category...</option>'+mainCat+'' +
                                            '</select>'+
                                            '</div></div></div>'+

                                            '<div class="row"><label style="font-size: small" class="col-sm-4">E-SubCat <span style="color: red;">*</span></label>'+
                                            '<div class="col-sm-12"><div class="input-group input-group-primary">'+
                                            '<span class="input-group-addon"><i class="icofont icofont-sub-listing"></i></span>'+
                                            '<select   id="subCat_id" name="subCat_id" class="form-control required">' +
                                            '<option value="">Select a Sub Category...</option>'+subCat+'' +
                                            '</select>'+
                                            '</div></div></div>'+

                                            '<div class="row"><label style="font-size: small" class="col-sm-4">E-Manufacturer <span style="color: red;">*</span></label>'+
                                            '<div class="col-sm-12"><div class="input-group input-group-primary">'+
                                            '<span class="input-group-addon"><i class="icofont icofont-brand-marvel-app"></i></span>'+
                                            '<input  type="text" id="e_manu" name="e_manu" placeholder="equipment manufacturer" class="form-control required"/>'+
                                            '</div></div> </div></div>'+


                                            '<div class="col-sm-6">'+
                                            '<h4 style="text-align: center;" class="sub-title">Quantity Info <span style="color: red;">*</span></h4><div class="row">'+
                                            '<label style="font-size: small" class="col-sm-4">E-Model <span style="color: red;">*</span></label>'+
                                            '<div class="col-sm-12"><div class="input-group input-group-primary">'+
                                            '<span class="input-group-addon"><i class="icofont icofont-medal-alt"></i></span>'+
                                            '<input  type="text" id="e_model" name="e_model" placeholder="equipment model" class="form-control required"/>'+
                                            '</div> </div></div>'+

                                            '<div class="row"><label style="font-size: small" class="col-sm-4">E-Code <span style="color: red;">*</span></label>'+
                                            '<div class="col-sm-12"><div id="gCode" class="input-group input-group-primary">'+
                                            '<span class="input-group-addon"><i class="icofont icofont-code-alt"></i></span>'+
                                            '<input readonly="readonly" type="text" id="e_code" name="e_code" placeholder="generate Code" class="form-control required"/>' +
                                            '<span onclick="return generateCode();" class="input-group-addon ">Generate Code</span>'+
                                            '</div></div> </div>'+


                                            '<div class="row"><label style="font-size: small" class="col-sm-4">Quantity <span style="color: red;">*</span></label>'+
                                            '<div class="col-sm-12"><div class="input-group input-group-primary">'+
                                            '<span class="input-group-addon"><i class="icofont icofont-stock-search"></i></span>'+
                                            '<input onkeyup=" return noSpaces(this);" type="text" id="qty" name="qty" placeholder="quantity in stock" class="form-control required"/>'+
                                            '</div></div></div>'+


                                            '<div class="row"><label style="font-size: small"  class="col-sm-4">C.O.Gs <span style="color: red;">*</span></label>'+
                                            '<div class="col-sm-12"><div class="input-group input-group-primary">'+
                                            '<span class="input-group-addon"><i class="icofont icofont-price"></i></span>'+
                                            '<input onkeyup=" return noSpaces(this);" type="text"  id="cogs" name="cogs" placeholder="cost of Goods" class="form-control required"/>'+
                                            '<span class="input-group-addon ">FCFA</span>'+
                                            '</div></div></div>'+


                                            '<div class="row"><label style="font-size: small" class="col-sm-4">Unit Price <span style="color: red;">*</span></label>'+
                                            '<div class="col-sm-12"><div class="input-group input-group-primary">'+
                                            '<span class="input-group-addon"><i class="icofont icofont-price"></i></span>'+
                                            '<input onkeyup=" return noSpaces(this);" type="text" id="u_price" name="u_price" placeholder="Unit Price"  class="form-control required"/>'+
                                            '<span class="input-group-addon ">FCFA</span>'+
                                            '</div></div> </div>' +

                                            ' <div class="modal-footer">' +
                                            '<button type="submit" name="eBtn" id="eBtn" class="btn btn-primary">' +
                                            '<i class="icofont icofont-plus-circle"></i>Add <i id="eLoading"></i>' +
                                            '</button></div>' +
                                            '</div></div>' +
                                            '</form>'


                                        });





                                    }
                                }

                            };
                            http.send(Data);

                            }

                        }
                    };
                    xhttp.send(formData);

                }





            }


        };
    ajax.send();

 }


/** Function Modal for Edit Equipments*/
function editEquipModal(ID) {

    var formData = new FormData();
    var encodeID = encodeURIComponent(window.btoa(ID));

    formData.append( "edit_id", encodeID);

    var ajax = new XMLHttpRequest();
    ajax.open( "POST", "getEquipEdit",true);
    ajax.onreadystatechange = function() {
        if(ajax.readyState == 4 && ajax.status == 200) {
            if(ajax.responseText == 1){

                swal({
                    title: "Opps !!! Error",
                    text: "Your request originates form an Unknown Source",
                    type: 'error',
                    timer: 4000,
                    showConfirmButton: false
                });

            }else if(ajax.responseText){

                var jsonData = JSON.parse(ajax.responseText);
                var jsonLength = jsonData.results.length;

                for (var i = 0; i < jsonLength; i++) {
                    var result = jsonData.results[i];

                    var e_id = result.equip_id;
                    var name = result.ename;
                    var des = result.des;
                    var num = result.e_number;
                    var model = result.emodel;
                    var manu = result.manu;
                    var code = result.ecode;
                    var qty = result.qty;
                    var cogs = result.perCost;
                    var up = result.eup;
                    var subCat = result.sub_cat;
                    var mainCat = result.main_cat;
                    var mainId = result.main_id;


                }

                var Data = new FormData();
                Data.append( "mainEdit", mainCat);
                var xhttp = new XMLHttpRequest();
                xhttp.open( "POST", "getMainCat",true);
                xhttp.onreadystatechange = function() {
                    if (xhttp.readyState == 4 && xhttp.status == 200) {
                        if (xhttp.responseText) {

                            var mainSelect = xhttp.responseText;

                            var form_data = new FormData();
                            form_data.append( "subEdit", subCat);
                            var http = new XMLHttpRequest();
                            http.open( "POST", "getSubCat",true);
                            http.onreadystatechange = function() {
                                if (http.readyState == 4 && http.status == 200) {
                                    if (http.responseText) {
                                        var subSelect = http.responseText;


                                        swal({
                                            title: 'Editing '+name+'<i style="color:#0078D7; " class="icofont icofont-ui-edit"></i><br>' +
                                            '<h6> <span>All<code>*</code>are Required Fields</span></h6>',
                                            showCancelButton: true,
                                            cancelButtonText: 'Cancel' + ' <i class="icofont icofont-close-circled"></i>',
                                            showLoaderOnConfirm: false,
                                            showConfirmButton: false,
                                            closeOnConfirm: false,
                                            allowOutsideClick: false,
                                            width:'70%',
                                            heightAuto: false,
                                            html:'<form  onsubmit="editEquip(); return false;" method="POST" action="">' +
                                            '<div id="editError"></div><div class="row">'+
                                            '<div class="col-sm-6"><h4  style="text-align: center;" class="sub-title">Equipment Info </h4>'+
                                            '<div class="row"><label style="font-size: small" class="col-sm-4">E-Number <span style="color: red;">*</span></label>'+
                                            '<div class="col-sm-12"><div class="input-group input-group-primary">'+
                                            '<span class="input-group-addon"><i class="icofont icofont-listing-number"></i></span>'+
                                            '<input readonly="readonly"  type="text" id="e_num" name="e_num"  value="'+num+'"  class="form-control"/>'+
                                            '</div></div></div>'+

                                            '<div class="row"><label style="font-size: small" class="col-sm-4">E-Name <span style="color: red;">*</span></label>'+
                                            '<div class="col-sm-12"><div class="input-group input-group-primary">'+
                                            '<span class="input-group-addon"><i class="icofont icofont-tools-alt-1"></i></span>'+
                                            '<input  type="text" id="e_name" name="e_name"  value="'+name+'"  class="form-control required"/>'+
                                            '<input  type="hidden" id="e_id" name="e_id"  value="'+e_id+'"  class="form-control required"/>'+
                                            '</div></div></div>' +

                                            '<div class="row"><label style="font-size: small" class="col-sm-4">Description <span style="color: red;">*</span></label>' +
                                            '<div class="col-sm-12"><div class="input-group input-group-primary">' +
                                            ' <span class="input-group-addon"><i class="icofont icofont-presentation-alt"></i></span>' +
                                            '<textarea  type="text" id="des" name="des"  onKeyDown="textCounter(this.form.des,this.form.countDisplay);" onKeyUp="textCounter(this.form.des,this.form.countDisplay);"' +
                                            ' placeholder="Briefly describe equipment.Maximum of 100 characters" class="form-control">'+des+'</textarea>' +
                                            '<br><input disabled="disabled"  class="form-control col-sm-2" type="text" name="countDisplay" value="30">' +
                                            '</div></div></div> '+


                                            '<div class="row"><label style="font-size: small" class="col-sm-4">E-MainCat <span style="color: red;">*</span></label>'+
                                            '<div class="col-sm-12"><div class="input-group input-group-primary">'+
                                            '<span class="input-group-addon"><i class="icofont icofont-group"></i></span>'+
                                            '<select  id="mainCat_id" name="mainCat_id" class="form-control required">' +
                                            ''+mainSelect+'' +
                                            '</select>'+
                                            '</div></div></div>'+

                                            '<div class="row"><label style="font-size: small" class="col-sm-4">E-SubCat <span style="color: red;">*</span></label>'+
                                            '<div class="col-sm-12"><div class="input-group input-group-primary">'+
                                            '<span class="input-group-addon"><i class="icofont icofont-sub-listing"></i></span>'+
                                            '<select   id="subCat_id" name="subCat_id" class="form-control required">' +
                                            ''+subSelect+'' +
                                            '</select>'+
                                            '</div></div></div>'+

                                            '<div class="row"><label style="font-size: small" class="col-sm-4">E-Manufacturer <span style="color: red;">*</span></label>'+
                                            '<div class="col-sm-12"><div class="input-group input-group-primary">'+
                                            '<span class="input-group-addon"><i class="icofont icofont-brand-marvel-app"></i></span>'+
                                            '<input  type="text" id="e_manu" name="e_manu"  value="'+manu+'"  class="form-control required"/>'+
                                            '</div></div> </div></div>'+


                                            '<div class="col-sm-6">'+
                                            '<h4 style="text-align: center;" class="sub-title">Quantity Info <span style="color: red;">*</span></h4><div class="row">'+
                                            '<label style="font-size: small" class="col-sm-4">E-Model <span style="color: red;">*</span></label>'+
                                            '<div class="col-sm-12"><div class="input-group input-group-primary">'+
                                            '<span class="input-group-addon"><i class="icofont icofont-medal-alt"></i></span>'+
                                            '<input  type="text" id="e_model" name="e_model"  value="'+model+'"  class="form-control required"/>'+
                                            '</div> </div></div>'+

                                            '<div class="row"><label style="font-size: small" class="col-sm-4">E-Code <span style="color: red;">*</span></label>'+
                                            '<div class="col-sm-12"><div id="gCode" class="input-group input-group-primary">'+
                                            '<span class="input-group-addon"><i class="icofont icofont-code-alt"></i></span>'+
                                            '<input  type="text" id="e_code" name="e_code"  value="'+code+'"  class="form-control required"/>' +
                                            '<span onclick="return generateCode();" class="input-group-addon ">Generate New Code</span>'+
                                            '</div></div> </div>'+


                                            '<div class="row"><label style="font-size: small" class="col-sm-4">Quantity <span style="color: red;">*</span></label>'+
                                            '<div class="col-sm-12"><div class="input-group input-group-primary">'+
                                            '<span class="input-group-addon"><i class="icofont icofont-stock-search"></i></span>'+
                                            '<input onkeyup=" return noSpaces(this);" type="text" id="qty" name="qty"  value="'+qty+'"  class="form-control required"/>'+
                                            '</div></div></div>'+


                                            '<div class="row"><label style="font-size: small"  class="col-sm-4">C.O.Gs <span style="color: red;">*</span></label>'+
                                            '<div class="col-sm-12"><div class="input-group input-group-primary">'+
                                            '<span class="input-group-addon"><i class="icofont icofont-price"></i></span>'+
                                            '<input onkeyup=" return noSpaces(this);" type="text"  id="cogs" name="cogs"  value="'+cogs+'"  class="form-control required"/>'+
                                            '<span class="input-group-addon ">FCFA</span>'+
                                            '</div></div></div>'+


                                            '<div class="row"><label style="font-size: small" class="col-sm-4">Unit Price <span style="color: red;">*</span></label>'+
                                            '<div class="col-sm-12"><div class="input-group input-group-primary">'+
                                            '<span class="input-group-addon"><i class="icofont icofont-price"></i></span>'+
                                            '<input onkeyup=" return noSpaces(this);" type="text" id="u_price" name="u_price"  value="'+up+'"  class="form-control required"/>'+
                                            '<span class="input-group-addon ">FCFA</span>'+
                                            '</div></div> </div>' +

                                            ' <div class="modal-footer">' +
                                            '<button type="submit" name="editBtn" id="editBtn" class="btn btn-primary">' +
                                            '<i class="icofont icofont-edit-alt"></i>Edit <i id="eLoading"></i>' +
                                            '</button></div>' +
                                            '</div></div>' +
                                            '</form>'


                                        });





                                    }
                                }

                            };
                            http.send(form_data);

                        }

                    }
                };
                xhttp.send(Data);

            }





        }


    };
    ajax.send(formData);
}


/**Function for Adding new equipment into the System */
function editEquip(){

    _("editBtn").disabled = true;
    _("eLoading").innerHTML = '<i class="ti-reload rotate-refresh"></i>';
    $("#eLoading").show();



    var formData = new FormData();
    formData.append( "e_num", _("e_num").value );
    formData.append( "e_name", _("e_name").value );
    formData.append( "e_id", _("e_id").value );
    formData.append( "des", _("des").value );
    formData.append( "mainCat_id", _("mainCat_id").value );
    formData.append( "subCat_id", _("subCat_id").value );
    formData.append( "e_manu", _("e_manu").value );
    formData.append( "e_model", _("e_model").value );
    formData.append( "e_code", _("e_code").value );
    formData.append( "qty", _("qty").value );
    formData.append( "cogs", _("cogs").value );
    formData.append( "u_price", _("u_price").value );


    var ajax = new XMLHttpRequest();
    ajax.open( "POST", "edit_equipment",true);
    ajax.onreadystatechange = function() {
        if(ajax.readyState == 4 && ajax.status == 200) {

            function responseError(error) {
               _("editError").innerHTML = '<div class="alert alert-danger icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="icofont icofont-close-line-circled"></i></button><p><strong>Error!!! </strong> '+error+'</p></div>';
                $("#editError").show(error);
                setTimeout(function () {
                    $("#editError").hide(error);
                    $("#eLoading").hide();
                }, 5000);
                _("editBtn").disabled = false;
            }
            if(ajax.responseText == 1){

                responseError('Unknown/Invalid Request');
            }else if (ajax.responseText == 2){

                responseError('Equipment number can\'t be empty. Please do not edit the field');
            }else if (ajax.responseText == 3){

                responseError('Equipment Name is a required Field');
            }else if (ajax.responseText == 4){

                responseError('Description is a required Field');
            }else if (ajax.responseText == 5){

                responseError('Description maximum character exceeded. Maximum should be 100 characters');
            }else if (ajax.responseText == 6){

                responseError('Main Category is a required Field. All equipments must fall under a Main Category');
            }else if (ajax.responseText == 7){

                responseError('Sub Category is a required Field. Else select NONE in the dropdown list');
            }else if (ajax.responseText == 8){

                responseError('Equipments must have Manufacturers');
            }else if (ajax.responseText == 9){

                responseError('The Model of your equipments  is a required Field');
            }else if (ajax.responseText == 10){

                responseError('Equipment code has not been removed. Please click generate new code');
            }else if (ajax.responseText == 11){

                responseError('Quantity is a required Field and it can\'t be Zero');
            }else if (ajax.responseText == 12){

                responseError('Invalid quantity values. Only numbers are allowed');
            }else if (ajax.responseText == 13){

                responseError('Quantity must be 1 and above');
            }else if (ajax.responseText == 14){

                responseError('Cost of goods is a required Field and it can\'t be Zero');
            }else if (ajax.responseText == 15){

                responseError('Invalid C.O.Gs values. Only numbers are allowed');
            }else if (ajax.responseText == 16){

                responseError('Invalid C.O.Gs. Your C.O.Gs can\'t be '+_("cogs").value+' FCFA');
            }else if (ajax.responseText == 17){

                responseError('Unit Price is a required Field and it can\'t be Zero');
            }else if (ajax.responseText == 18){

                responseError('Invalid unit price values. Only numbers are allowed');
            }else if (ajax.responseText == 19){

                responseError('Invalid unit price. Unit price can\'t be '+_("u_price").value+' FCFA');
            }else if (ajax.responseText == 20){

                responseError('Invalid Equipment Name - name must be two or more letters');
            }else if (ajax.responseText == 21){

                responseError('Invalid Equipment Name - name too long');
            }else if (ajax.responseText == 22){

                responseError('Invalid Unit price. Unit Price ('+_("u_price").value+') must be greater than the Cost of Goods ('+_("cogs").value+')');

            }else if(ajax.responseText){

                var jsonData = JSON.parse(ajax.responseText);
                var jsonLength = jsonData.results.length;

                for (var i = 0; i < jsonLength; i++) {
                    var result = jsonData.results[i];

                    var e_id = result.equip_id;
                    var name = result.ename;
                    var des = result.des;
                    var model = result.emodel;
                    var manu = result.manu;
                    var code = result.ecode;
                    var qty = result.qty;
                    var tc = result.etc;
                    var up = result.eup;
                    var cogs = result.ecogs;
                    var subCat = result.sub_cat;
                    var mainCat = result.main_cat;
                    var mainId = result.main_id;

                    var dateAdded  = result.dateAdded ;
                    var agoAdded = result.agoAdded;
                    var updatedate = result.updatedate;
                    var updateago  = result.updateago ;
                }

                swal({
                    title: "Updated",
                    text: name+" has been Updated Successfully",
                    type: 'success',
                    timer: 4000,
                    showConfirmButton: false
                });


                if (qty <= 10){
                    var stocks = '<td id="'+e_id+'ajaxLs"><button type="button" class="btn btn-outline-warning btn-round"> Low Stock</button></td>';

                } else if (qty > 10){

                    var stocks = '<td id="'+e_id+'ajaxIs"><button type="button" class="btn btn-outline-success btn-round"> In Stock</button></td>';
                }

                setTimeout(function(){
                    $("#editBtn").disabled = true;
                    var addRows =
                        '<td id="'+e_id+'AjaxBtn">'+
                        '<button onclick="return equipDelete('+e_id+');" title="Delete '+name+'" style="width: 30px; height: 30px;"  class="btn btn-danger btn-outline-danger btn-icon"><i class="icofont icofont-delete-alt"></i></button>' +
                        '<button onclick="return ViewEquipModal('+e_id+');" title="View '+name+'" style="width: 30px; height: 30px;"  class="btn btn-primary btn-outline-primary btn-icon"><i class="icofont icofont-eye-alt"></i></button>' +
                        '<a onclick="return editEquipModal('+e_id+');"><button title="Edit '+name+'" style="width: 30px; height: 30px;"  class="btn btn-primary btn-outline-primary btn-icon"><i class="icofont icofont-edit-alt"></i></button></a>'+
                        '</td>'+
                        ''+stocks+''+
                        '<td id="'+e_id+'ajaxName" class="text-center">'+name+'</td>'+
                        '<td id="'+e_id+'ajaxDes" onclick="return ViewDesModal('+e_id+');">'+limitWords(des,3)+'</td>'+
                        '<td id="'+e_id+'ajaxManu" class="text-center">'+manu+'</td>'+
                        '<td id="'+e_id+'ajaxModel" class="text-center">'+model+'</td>'+
                        '<td id="'+e_id+'ajaxCode" class="text-center">'+code+'</td>'+
                        '<td id="'+e_id+'ajaxMain" class="text-center">'+mainCat+'</td>'+
                        '<td id="'+e_id+'ajaxSub" class="text-center">'+subCat+'</td>'+
                        '<td id="'+e_id+'ajaxQty" class="text-center">'+qty+'</td>'+
                        '<td id="'+e_id+'ajaxUp" class="text-center">'+formatNumber(up+ ' FCFA')+'</td>'+
                        '<td id="'+e_id+'ajaxcpG" class="text-center">'+formatNumber(cogs+ ' FCFA')+'</td>'+
                        '<td id="'+e_id+'ajaxTc" class="text-center">'+formatNumber(tc+ ' FCFA')+'</td>'+
                        '<td id="'+e_id+'ajaxDate" class=text-center>'+dateAdded+' ('+agoAdded+')</td> '+
                        '<td id="'+e_id+'ajaxUpdate" class=text-center>'+updatedate+' ('+updateago+')</td>';

                    /** Adding the Rows,Playing Sound and removing the backgroundColor*/

                    $("#"+e_id+"Equip").html(addRows);

                    $("#"+e_id+"Equip").animate({ backgroundColor: "#3085d6" }, "slow",function(){
                        $("#"+e_id+"Equip").animate({ backgroundColor: "" }, "slow");
                    });

                }, 3000);



            }
        }
    };
    ajax.send(formData);
}





/** Function for Viewing Equipments*/
function ViewDesModal(ID) {

    var formData = new FormData();
    formData.append("view_id", ID);
    var ajax = new XMLHttpRequest();
    ajax.open("POST", "viewEquip", true);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            if (ajax.responseText) {
                var jsonData = JSON.parse(ajax.responseText);
                for (var i = 0; i < jsonData.length; i++) {
                    var result = jsonData[i];
                    var viewName = result.e_name;
                }

                swal({
                    title: 'Viewing Description for '+viewName+' <i style="color:#0078D7; " class="icofont icofont-eye-alt"></i>',
                    showCancelButton: false,
                    confirmButtonText: 'Ok',
                    showLoaderOnConfirm: false,
                    showConfirmButton: true,
                    closeOnConfirm: false,
                    allowOutsideClick: true,
                    html:'<div class="row">'+
                    '<div class="col-sm-12"><div class="input-group input-group-primary">' +
                    '<span class="input-group-addon"><i class="icofont icofont-presentation-alt"></i></span>'+
                    '<textarea disabled="disabled" type="text" class="form-control">'+result.des+'</textarea>' +
                    '</div></div></div>'

                });



            }

        }

    };
    ajax.send(formData);

}



/** Function for Viewing Equipments*/
function ViewEquipModal(ID) {

    var formData = new FormData();
    formData.append( "view_id", ID);
    var ajax = new XMLHttpRequest();
    ajax.open( "POST", "viewEquip",true);
    ajax.onreadystatechange = function() {
        if(ajax.readyState == 4 && ajax.status == 200) {
            if(ajax.responseText){
                var jsonData = JSON.parse(ajax.responseText);
                for (var i = 0; i < jsonData.length; i++) {
                    var result = jsonData[i];
                    var viewName = result.e_name;
                    var viewSub = result.sub_cat;
                }

                swal({
                    title: 'Viewing ' +viewName+' <i style="color:#0078D7; " class="icofont icofont-eye-alt"></i>',
                    showCancelButton: false,
                    confirmButtonText: 'Ok',
                    showLoaderOnConfirm: false,
                    showConfirmButton: true,
                    closeOnConfirm: false,
                    allowOutsideClick: true,
                    width:'70%',
                    heightAuto: false,
                    html:'<div class="row">'+
                    '<div class="col-sm-6"><h4  style="text-align: center;" class="sub-title">Equipment Info </h4>'+
                    '<div class="row"><label style="font-size: small" class="col-sm-4">E-Number</label>'+
                    '<div class="col-sm-12"><div class="input-group input-group-primary">'+
                    '<span class="input-group-addon"><i class="icofont icofont-listing-number"></i></span>'+
                    '<input  readonly="readonly" type="text"  value="'+result.e_num+'"  class="form-control required"/>'+
                    '</div></div></div>'+

                    '<div class="row"><label style="font-size: small" class="col-sm-4">E-Name</label>'+
                    '<div class="col-sm-12"><div class="input-group input-group-primary">'+
                    '<span class="input-group-addon"><i class="icofont icofont-tools-alt-1"></i></span>'+
                    '<input  readonly="readonly" type="text"  value="'+result.e_name+'"  class="form-control required"/>'+
                    '</div></div></div>'+

                    '<div class="row"><label style="font-size: small" class="col-sm-4">Description</label>'+
                    '<div class="col-sm-12"><div class="input-group input-group-primary">'+
                    '<span class="input-group-addon"><i class="icofont icofont-tools-alt-1"></i></span>'+
                    '<textarea  readonly="readonly" type="text" class="form-control">"'+result.des+'"</textarea>'+
                    '</div></div></div>'+

                    '<div class="row"><label style="font-size: small" class="col-sm-4">E-main category</label>'+
                    '<div class="col-sm-12"><div class="input-group input-group-primary">'+
                    '<span class="input-group-addon"><i class="icofont icofont-group"></i></span>'+
                    '<input readonly="readonly" type="text" value="'+result.main_cat+'" class="form-control required"/>'+
                    '</div></div></div>'+

                    '<div class="row"><label style="font-size: small" class="col-sm-4">E-Sub Category </label>'+
                    '<div class="col-sm-12"><div class="input-group input-group-primary">'+
                    '<span class="input-group-addon"><i class="icofont icofont-sub-listing"></i></span>'+
                    '<input readonly="readonly" type="text" value="'+result.sub_id+'" class="form-control required"/>'+
                    '</div></div></div>'+

                    '<div class="row"><label style="font-size: small" class="col-sm-4">E-Manufacturer</label>'+
                    '<div class="col-sm-12"><div class="input-group input-group-primary">'+
                    '<span class="input-group-addon"><i class="icofont icofont-brand-marvel-app"></i></span>'+
                    '<input  readonly="readonly" type="text"  value="'+result.e_manu+'" class="form-control required"/>'+
                    '</div></div> </div></div>'+


                    '<div class="col-sm-6">'+
                    '<h4 style="text-align: center;" class="sub-title">Quantity Info</h4><div class="row">'+
                    '<label style="font-size: small" class="col-sm-4">E-Model</label>'+
                    '<div class="col-sm-12"><div class="input-group input-group-primary">'+
                    '<span class="input-group-addon"><i class="icofont icofont-medal-alt"></i></span>'+
                    '<input readonly="readonly"  type="text"  value="'+result.e_model+'" class="form-control required"/>'+
                    '</div> </div></div>'+

                    '<div class="row"><label style="font-size: small"  class="col-sm-4">E-Unique Code</label>'+
                    '<div class="col-sm-12"><div id="gCode" class="input-group input-group-primary">'+
                    '<span class="input-group-addon"><i class="icofont icofont-code-alt"></i></span>'+
                    '<input readonly="readonly"  type="text"  value="'+result.e_code+'" class="form-control required"/>'+
                    '</div></div> </div>'+


                    '<div class="row"><label style="font-size: small"  class="col-sm-4">Quantity</label>'+
                    '<div class="col-sm-12"><div class="input-group input-group-primary">'+
                    '<span class="input-group-addon"><i class="icofont icofont-stock-search"></i></span>'+
                    '<input readonly="readonly"  type="text"  value="'+result.qty+'" class="form-control required"/>'+
                    '</div></div></div>'+


                    '<div class="row"><label style="font-size: small"  class="col-sm-4">C.O.Gs</label>'+
                    '<div class="col-sm-12"><div class="input-group input-group-primary">'+
                    '<span class="input-group-addon"><i class="icofont icofont-price"></i></span>'+
                    '<input readonly="readonly"  type="text" value="'+result.cogs+'" class="form-control required"/>'+
                    '<span class="input-group-addon ">FCFA</span>'+
                    '</div></div></div>'+


                    '<div class="row"><label style="font-size: small" class="col-sm-4">Unit Price</label>'+
                    '<div class="col-sm-12"><div class="input-group input-group-primary">'+
                    '<span class="input-group-addon"><i class="icofont icofont-price"></i></span>'+
                    '<input readonly="readonly" type="text" value="'+result.u_price+'" class="form-control required"/>'+
                    '<span class="input-group-addon ">FCFA</span>'+
                    '</div></div> </div></div></div>'

                });


            }else {

            }


        }
    };
    ajax.send( formData );

}









/**Function for Deleting Equipments */
function equipDelete(id) {
    swal({
        title: 'Are you sure?',
        text: "Your are about to delete an Equipment from System",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes!!'+' <i class="icofont icofont-trash"></i>',
        cancelButtonText: 'No!!'+' <i class="icofont icofont-close-circled"></i>',
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger',
        buttonsStyling: true
    }).then(function () {
        var formdata = new FormData();
        formdata.append("deleted_id", id);

        var ajax = new XMLHttpRequest();
        ajax.open("POST", "equip_delete", true);
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 4 && ajax.status == 200) {
                if (ajax.responseText == 1) {
                    swal({
                        title: "Deleted !!!",
                        text: "Equipment deleted Successfully.",
                        type: 'success',
                        timer: 3000,
                        showConfirmButton: false
                    });
                    setTimeout(function () {

                        // Removing row from HTML DataTable
                        $("#"+id+"equip").closest('tr').css('background','#CD2A19');
                        $("#"+id+"equip").closest('tr').fadeOut(800, function(){
                            $("#"+id+"equip").remove();
                        });


                    }, 3000);
                }
            }

        };
        ajax.send(formdata)

    }, function (dismiss) {
        // dismiss can be 'cancel', 'overlay',
        // 'close', and 'timer'
        if (dismiss === 'cancel') {
            swal(
                'Cancelled',
                'Equipment not Deleted :)',
                'info'
            )
        }
    })

}

/**Functions when items are out of Stock */
function outofStock() {
    _("OFSError").innerHTML = '<div class="alert alert-danger icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="icofont icofont-close-line-circled"></i></button><p style="text-align: center;"><strong>Error!!! </strong>This Item can\'t be sold because it\'s out of Stock</p></div>';
    $("#OFSError").show();
    setTimeout(function () {
        $("#OFSError").fadeOut();
    }, 5000);

}


