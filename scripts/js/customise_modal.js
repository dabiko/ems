/**
 * Created by Dabiko Blaise on 01-Jul-18.
*/

// $(document).ready(function() {
//     $('#basic-btn').Tabledit({
//         editButton: false,
//         deleteButton: false,
//         hideIdentifier: true,
//         columns: {
//             identifier: [0, 'id'],
//             editable: [[1, 'Actions'],
//                 [2, 'Main Category'],
//                 [3, 'Date Created'],
//                 [4, 'Date Updated']
//
//             ]
//         }
//     });
//
// });


/** Function for creating Main Category*/
function CreateMainModal() {
    swal({
        title: 'Create Main Category <i style="color:#0078D7; " class="icofont icofont-group"></i>',
        showCancelButton: true,
        confirmButtonText: 'Add' + ' <i class="icofont icofont-plus-circle"></i>',
        cancelButtonText: 'Cancel' + ' <i class="icofont icofont-close-circled"></i>',
        showLoaderOnConfirm: true,
        showConfirmButton: true,
        closeOnConfirm: false,
        allowOutsideClick: false,
        input: 'text',
        inputPlaceholder: 'Enter Category name ',
        inputValidator: function (value) {
            return new Promise(function (resolve, reject) {
                swal.enableLoading();
                var formData = new FormData();
                formData.append("main_cat", value);
                var ajax = new XMLHttpRequest();
                ajax.open("POST", "create_mainCat", true);
                ajax.onreadystatechange = function () {
                    if (ajax.readyState == 4 && ajax.status == 200) {
                        if (ajax.responseText == 1) {
                            reject('<strong>Error!!! </strong> Field can\'t be Empty');
                            setTimeout(function () {
                                swal.disableLoading();
                            }, 1000);
                        }else if(ajax.responseText == 2){
                            reject('<strong>Error!!! </strong> Invalid Category Name');
                            setTimeout(function () {
                                swal.disableLoading();
                            }, 1000);
                        }else if(ajax.responseText == 3){
                            reject('<strong>Error!!! </strong> Category contains Invalid Character(s)');
                            setTimeout(function () {
                                swal.disableLoading();
                            }, 1000);
                        }else if(ajax.responseText == 4){
                            reject('<strong>Error!!! </strong>'+value+' has already been created. Please Choose a different Main Category Name');
                            setTimeout(function () {
                                swal.disableLoading();
                            }, 1000);
                        }else if (ajax.responseText) {

                            var jsonData = JSON.parse(ajax.responseText);
                            var jsonLength = jsonData.results.length;
                            for (var i = 0; i < jsonLength; i++) {
                                var result = jsonData.results[i];
                                var mainID = result.main_id;
                                var mainCat = result.main_cat;
                                var create = result.createdate;
                                var update = result.updatedate;
                                var createAgo = result.createago;
                                var updateAgo = result.updateago;

                            }
                            console.log(result);
                            resolve(
                                swal({
                                    title: value + " Added",
                                    text: "Main Category Added Successfully",
                                    type: 'success',
                                    timer: 3000,
                                    showConfirmButton: false
                                }),
                                setTimeout(function () {

                                    var addRows =
                                        '<tr id="'+mainID +'MainCat"><td>' +
                                        '<label title="Check to Delete '+mainCat+ '" style="width: 30px; height: 30px;" class="btn btn-info btn-info btn-icon">' +
                                        '<input type="checkbox" class="checked"  id="checkedMain" name="checkedMain[]" value="'+mainID+'" aria-label="Checkbox for following text input" />' +
                                        '</label> ' +
                                        '<button    onclick="return mainCat_Delete(' + mainID + ');" title="Delete ' + mainCat + '" style="width: 30px; height: 30px;"  class="btn btn-danger btn-outline-danger btn-icon"><i class="icofont icofont-delete-alt"></i></button>' +
                                        '  <button  onclick="return ViewMainModal(' + mainID + ');" title="View ' + mainCat + '" style="width: 30px; height: 30px;"  class="btn btn-primary btn-outline-primary btn-icon"><i class="icofont icofont-eye-alt"></i></button>' +
                                        '  <button  onclick="return mainModal(' + mainID + ')" title="Edit ' + mainCat + '" style="width: 30px; height: 30px;"  class="btn btn-primary btn-outline-primary btn-icon"><i class="icofont icofont-edit-alt"></i></button>' +
                                        '</td>'+

                                        '<td id="' + mainID + 'ajaxMain">' + mainCat + '</td>'+
                                        '<td id="' + mainID + 'ajaxDate">' + create + ' (' + createAgo + ')</td> '+
                                        '<td id="' + mainID + 'ajaxUpdate">' + update + ' (' + updateAgo + ')</td></tr> ';



                                       /** Adding the Rows,Playing Sound and removing the backgroundColor*/
                                       $('<tr>'+addRows+'</tr>').insertBefore('table > tbody > tr:first');
                                       InsertSound();
                                        $("#"+mainID+"MainCat").animate({ backgroundColor: "#3085d6" }, "slow",function(){
                                        $("#"+mainID+"MainCat").animate({ backgroundColor: "" }, "slow");
                                       });


                                }, 3000)
                            );
                        }


                    }
                };
                ajax.send(formData);

            })
        }
    })
}


/** Function for creating Sub Category*/
function CreateSubModal() {
    var ajax = new XMLHttpRequest();
    ajax.open( "GET", "mainSelect",true);
    ajax.onreadystatechange = function() {
        if(ajax.readyState == 4 && ajax.status == 200) {
            if(ajax.responseText){
                var Options = ajax.responseText;

                swal({
                    title: 'Create Sub Category <i style="color:#0078D7; " class="icofont icofont-group"></i>',
                    showCancelButton: true,
                    html: '<div class="row">'+
                           '<div class="col-sm-12"><div class="input-group input-group-primary">'+
                           '<select  id="drop-down" name="drop-down" class="swal2-input">' +
                           '<option value="">Select a Main Category...</option>'+
                            Options+
                           '</select>'+
                         '</div></div></div>',
                    confirmButtonText: 'Add'+' <i class="icofont icofont-plus-circle"></i>',
                    cancelButtonText: 'Cancel'+' <i class="icofont icofont-close-circled"></i>',
                    showLoaderOnConfirm: true,
                    showConfirmButton: true,
                    closeOnConfirm: false,
                    allowOutsideClick: false,
                    input: 'text',
                    inputPlaceholder: 'Enter Sub category',
                    inputValidator: function (value) {
                        return new Promise(function (resolve, reject) {
                            swal.enableLoading();
                            var formData = new FormData();
                            var selectID = $('#drop-down').val();

                            formData.append( "main_id", selectID);
                            formData.append( "sub_cat", value);

                            var ajax = new XMLHttpRequest();
                            ajax.open( "POST", "create_subCat",true);
                            ajax.onreadystatechange = function() {
                                if(ajax.readyState == 4 && ajax.status == 200) {

                                    if (ajax.responseText == 1) {
                                        reject('<strong>Error!!! </strong> Sub Category can\'t be Empty');
                                        setTimeout(function () {
                                            swal.disableLoading();
                                        }, 1000);
                                    }else if(ajax.responseText == 2){
                                        reject('<strong>Error!!! </strong> Invalid Sub Category Name');
                                        setTimeout(function () {
                                            swal.disableLoading();
                                        }, 1000);
                                    }else if(ajax.responseText == 3){
                                        reject('<strong>Error!!! </strong>Sub Category contains Invalid Character(s)');
                                        setTimeout(function () {
                                            swal.disableLoading();
                                        }, 1000);
                                    }else if(ajax.responseText == 4){
                                        reject('<strong>Error!!! </strong>Select a Main Category. All Sub Categories must fall under a Main Category');
                                        setTimeout(function () {
                                            swal.disableLoading();
                                        }, 1000);
                                    }else if(ajax.responseText == 5){
                                        reject('<strong>Error!!! </strong>'+value+' has already been created. Please Choose a different Sub Category Name');
                                        setTimeout(function () {
                                            swal.disableLoading();
                                        }, 1000);
                                    }else if(ajax.responseText) {
                                        var jsonData = JSON.parse(ajax.responseText);
                                        var jsonLength = jsonData.results.length;
                                        for (var i = 0; i < jsonLength; i++) {
                                            var result = jsonData.results[i];
                                            var mainID = result.main_id;
                                            var mainCat = result.main_cat;
                                            var subID = result.sub_id;
                                            var subCat = result.sub_cat;
                                            var create = result.createdate;
                                            var update = result.updatedate;
                                            var createAgo = result.createago;
                                            var updateAgo = result.updateago;
                                        }

                                        resolve(
                                            swal({
                                                title: value+" Added",
                                                text: "Sub Category Added Successfully",
                                                type: 'success',
                                                timer: 3000,
                                                showConfirmButton: false }),
                                            setTimeout(function(){
                                                var addRows =
                                                    '<tr id="'+subID +'SubCat"><td>' +
                                                    '  <button   id="'+subID+'ajaxDeleteSub" onclick="return Sub_Delete('+subID+');" title="Delete ' + subCat + '" style="width: 30px; height: 30px;"  class="btn btn-danger btn-outline-danger btn-icon"><i class="icofont icofont-delete-alt"></i></button>' +
                                                    '  <button id="'+subID+'ajaxViewSub"   onclick="return ViewSubModal('+ subID+');" title="View ' + subCat + '" style="width: 30px; height: 30px;"  class="btn btn-primary btn-outline-primary btn-icon"><i class="icofont icofont-eye-alt"></i></button>' +
                                                    '  <button id="'+subID+'ajaxEditSub" onclick="return EditSubModal('+ mainID +','+subID+')" title="Edit ' + subCat + '" style="width: 30px; height: 30px;"  class="btn btn-primary btn-outline-primary btn-icon"><i class="icofont icofont-edit-alt"></i></button>' +
                                                    '</td>'+

                                                    '<td id="' + mainID + 'ajaxMain">' + mainCat + '</td>'+
                                                    '<td id="' + subID + 'ajaxSub">' + subCat + '</td>'+
                                                    '<td id="' + mainID + 'ajaxDate">' + create + ' (' + createAgo + ')</td> '+
                                                    '<td id="' + mainID + 'ajaxUpdate">' + update + ' (' + updateAgo + ')</td></tr>';

                                                /** Adding the Rows,Playing Sound and removing the backgroundColor*/

                                                $('<tr>'+addRows+'</tr>').insertBefore('table > tbody > tr:first');
                                                InsertSound();
                                                $("#"+subID+"SubCat").animate({ backgroundColor: "#3085d6" }, "slow",function(){
                                                    $("#"+subID+"SubCat").animate({ backgroundColor: "" }, "slow");
                                                });

                                            }, 3000)

                                        );
                                    }


                                }
                            };
                            ajax.send( formData );

                        })
                    }


                });

            }else {
                swal({
                    title: 'There was an Error',
                    type: 'error',
                    showConfirmButton: true,
                    confirmButtonText: 'ok'
                });

            }


        }
    };
    ajax.send();

}




/** Function for Viewing Main Categories*/
function ViewMainModal(viewID) {

    var formData = new FormData();
    formData.append( "view_id", viewID);
    var ajax = new XMLHttpRequest();
    ajax.open( "POST", "viewMain",true);
    ajax.onreadystatechange = function() {
        if(ajax.readyState == 4 && ajax.status == 200) {
            if(ajax.responseText){
                var jsonData = JSON.parse(ajax.responseText);
                for (var i = 0; i < jsonData.length; i++) {
                    var result = jsonData[i];
                    var viewID = result.main_id;
                    var viewMain = result.main_cat;
                }

                swal({
                    title: 'Viewing Main Category '+viewMain+' <i style="color:#0078D7; " class="icofont icofont-eye-alt"></i>',
                    showCancelButton: false,
                    confirmButtonText: 'Ok',
                    showLoaderOnConfirm: false,
                    showConfirmButton: true,
                    closeOnConfirm: false,
                    allowOutsideClick: true,
                    html:'<input disabled="disabled" value="'+viewMain+'" id="swal-input1" class="swal2-input">'

                });


            }else {

            }


        }
    };
    ajax.send( formData );

}


/** Function for Viewing Main Categories*/
function ViewSubModal(subID) {

    var formData = new FormData();
    formData.append( "view_id", subID);
    var ajax = new XMLHttpRequest();
    ajax.open( "POST", "viewSub",true);
    ajax.onreadystatechange = function() {
        if(ajax.readyState == 4 && ajax.status == 200) {
            if(ajax.responseText){
                var jsonData = JSON.parse(ajax.responseText);
                for (var i = 0; i < jsonData.length; i++) {
                    var result = jsonData[i];
                    var viewMain = result.main_cat;
                    var viewSub = result.sub_cat;
                }

                swal({
                    title: 'Viewing Sub Category '+viewSub+' <i style="color:#0078D7; " class="icofont icofont-eye-alt"></i>',
                    showCancelButton: false,
                    confirmButtonText: 'Ok',
                    showLoaderOnConfirm: false,
                    showConfirmButton: true,
                    closeOnConfirm: false,
                    allowOutsideClick: true,
                    html:'<input disabled="disabled" value="'+viewMain+'" id="swal-input1" class="swal2-input">' +
                         '<input disabled="disabled" value="'+viewSub+'" id="swal-input1" class="swal2-input">'

                });


            }else {

            }


        }
    };
    ajax.send( formData );

}


/**Function for Editing Main Category */
function mainModal(id) {
    var modalData = new FormData();
    modalData.append("main_id", id);
    var ajax = new XMLHttpRequest();
    ajax.open("POST", "main_modal", true);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var jsonData = JSON.parse(ajax.responseText);
            var jsonLength = jsonData.length;
            for (var i = 0; i < jsonLength; i++) {
                var result = jsonData[i];

            }

            if (ajax.responseText) {
                var mainID = result.main_id;
                var mainCat = result.main_cat;


                swal({
                    title: 'Editing ' + mainCat+ ' <i style="color:#0078D7;" class="icofont icofont-edit-alt"></i>',
                    html: '<label class="col-sm-4">Main Category</label>',
                    showCancelButton: true,
                    confirmButtonText: 'Edit'+' <i class="icofont icofont-edit-alt"></i>',
                    cancelButtonText: 'Cancel'+' <i class="icofont icofont-close-circled"></i>',
                    showLoaderOnConfirm: true,
                    showConfirmButton: true,
                    allowOutsideClick: false,
                    closeOnConfirm: false,
                    input: 'text',
                    inputValue: mainCat,
                    preConfirm: function (inputValue) {
                        return new Promise(function (resolve, reject) {

                            var formdata = new FormData();
                            formdata.append( "main_cat", inputValue);
                            formdata.append( "main_id", mainID);


                            var ajax = new XMLHttpRequest();
                            ajax.open( "POST", "edit_mainCat",true);
                            ajax.onreadystatechange = function() {
                                if(ajax.readyState == 4 && ajax.status == 200) {
                                    setTimeout(function () {
                                        if (ajax.responseText == 1) {
                                            reject('<strong>Error!!! </strong> Main Category can\'t be Empty');
                                            setTimeout(function () {
                                                swal.disableLoading();
                                            }, 1000);

                                        }else if(ajax.responseText == 2){
                                            reject('<strong>Error!!! </strong> Invalid Main Category Name');
                                            setTimeout(function () {
                                                swal.disableLoading();
                                            }, 1000);

                                        }else if(ajax.responseText == 3){
                                            reject('<strong>Error!!! </strong> Sub Category contains Invalid Character(s)');
                                            setTimeout(function () {
                                                swal.disableLoading();
                                            }, 1000);

                                        }else if(ajax.responseText == 4){
                                            reject('<strong>Error!!! </strong>'+inputValue+' already Exits as a Main Category. Please try another Name');
                                            setTimeout(function () {
                                                swal.disableLoading();
                                            }, 1000);

                                        }else if(ajax.responseText) {
                                            var jsonData = JSON.parse(ajax.responseText);
                                            var jsonLength = jsonData.results.length;
                                            for (var i = 0; i < jsonLength; i++) {
                                                var result = jsonData.results[i];
                                                var mainCat = result.main_cat;
                                                var update = result.updatedate;
                                                var updateAgo = result.updateago;
                                            }


                                            resolve(
                                                swal({
                                                    title: "Updated",
                                                    text: "Main Category Updated to "+inputValue,
                                                    type: 'success',
                                                    timer: 3000,
                                                    showConfirmButton: false }),
                                            setTimeout(function(){
                                                $("#"+mainID+"ajaxMain").html(mainCat);
                                                $("#"+mainID+"ajaxUpdate").html(update + '('+updateAgo+')');

                                                $("#"+mainID+"MainCat").animate({ backgroundColor: "#3085d6" }, "slow",function(){
                                                    $("#"+mainID+"MainCat").animate({ backgroundColor: "" }, "slow");
                                                });
                                            }, 3000)
                                        )
                                        }
                                    }, 1000)
                                }

                            };
                            ajax.send(formdata);



                        })
                    }
                });

            }

        }
    };
    ajax.send(modalData)
}




/**Function for Editing Sub Category */
function EditSubModal(main_ID,subID) {

    var modalData = new FormData();

    modalData.append("main_id", main_ID);
    modalData.append("sub_id", subID);

    var xhttp = new XMLHttpRequest();
    xhttp.open("POST", "sub_modal", true);
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            if (xhttp.responseText) {
                var jsonData = JSON.parse(xhttp.responseText);
                var jsonLength = jsonData.results.length;
                for (var i = 0; i < jsonLength; i++) {
                    var result = jsonData.results[i];
                    var subID = result.sub_id;
                    var subCat = result.sub_cat;
                    var mainID = result.main_id;
                    var mainCat = result.main_cat;
                   var updateDate = result.update;
                   var Ago =  result.agoTime;
                }

                var Data = new FormData();
                Data.append("selected", mainCat);

                var ajax = new XMLHttpRequest();
                ajax.open("POST", "main_list", true);
                ajax.onreadystatechange = function () {
                    if (ajax.readyState == 4 && ajax.status == 200) {
                        if (ajax.responseText) {
                            var Options = ajax.responseText;


                            swal({
                                title: 'Editing Sub Category <i style="color:#0078D7; " class="icofont icofont-edit-alt"></i>',
                                html: '<di id="editSubError"></di><div class="row">'+
                                '<div class="col-sm-12"><div class="input-group input-group-primary">'+
                                '<select  id="main-cat" name="main-cat" class="swal2-input">'+
                                 Options+
                                '</select>' +
                                '</div></div></div>',
                                showCancelButton: true,
                                confirmButtonText: 'Edit'+' <i class="icofont icofont-edit-alt"></i>',
                                cancelButtonText: 'Cancel'+' <i class="icofont icofont-close-circled"></i>',
                                showLoaderOnConfirm: true,
                                showConfirmButton: true,
                                closeOnConfirm: false,
                                allowOutsideClick: false,
                                input: 'text',
                                inputValue: subCat,
                                preConfirm: function (inputValue) {
                                    swal.enableLoading();
                                    var selectID = $('#main-cat').val();
                                    return new Promise(function (resolve, reject) {

                                        var formdata = new FormData();
                                        formdata.append( "sub_id", subID);
                                        formdata.append( "main_id", main_ID);
                                        formdata.append( "selectedID", selectID);
                                        formdata.append( "sub_cat", inputValue );

                                        var ajax = new XMLHttpRequest();
                                        ajax.open( "POST", "edit_subCat",true);
                                        ajax.onreadystatechange = function() {
                                            if (ajax.readyState == 4 && ajax.status == 200) {
                                                setTimeout(function () {
                                                    if (ajax.responseText == 1) {
                                                        reject('<strong>Error!!! </strong> Sub Category can\'t be Empty');
                                                        setTimeout(function () {
                                                            swal.disableLoading();
                                                        }, 1000);
                                                    }else if(ajax.responseText == 2){
                                                        reject('<strong>Error!!! </strong> Invalid Sub Category Name');
                                                        setTimeout(function () {
                                                            swal.disableLoading();
                                                        }, 1000);
                                                    }else if(ajax.responseText == 3){
                                                        reject('<strong>Error!!! </strong> Invalid Sub Category Name');
                                                        setTimeout(function () {
                                                            swal.disableLoading();
                                                        }, 1000);
                                                    }else if(ajax.responseText == 4){
                                                        reject('<strong>Error!!! </strong>Sub Category contains Invalid Character(s)');
                                                        setTimeout(function () {
                                                            swal.disableLoading();
                                                        }, 1000);
                                                    }

                                                    else if(ajax.responseText == 6){
                                                        reject('<strong>Error!!! </strong>'+inputValue+' has already been created. Please Choose a different Sub Category Name');
                                                        setTimeout(function () {
                                                            swal.disableLoading();
                                                        }, 1000);

                                                    }else if(ajax.responseText) {
                                                        var jsonData = JSON.parse(ajax.responseText);
                                                        var jsonLength = jsonData.results.length;
                                                        for (var i = 0; i < jsonLength; i++) {
                                                            var result = jsonData.results[i];
                                                            var mainID = result.main_id;
                                                            var mainCat = result.main_cat;
                                                            var subID = result.sub_id;
                                                            var subCat = result.sub_cat;
                                                            var create = result.createdate;
                                                            var update = result.updatedate;
                                                            var createAgo = result.createago;
                                                            var updateAgo = result.updateago;
                                                        }
                                                        resolve(
                                                            swal({
                                                                title: "Updated",
                                                                text: "Sub Category "+inputValue+" has been Updated",
                                                                type: 'success',
                                                                timer: 3000,
                                                                showConfirmButton: false }),
                                                            setTimeout(function(){
                                                                var editedRow =
                                                                    '<td>' +
                                                                    '<button   id="'+subID+'ajaxDeleteSub" onclick="return Sub_Delete('+subID+');" title="Delete ' + subCat + '" style="width: 30px; height: 30px;"  class="btn btn-danger btn-outline-danger btn-icon"><i class="icofont icofont-delete-alt"></i></button>' +
                                                                    '  <button id="'+subID+'ajaxViewSub"   onclick="return ViewSubModal('+ subID+');" title="View ' + subCat + '" style="width: 30px; height: 30px;"  class="btn btn-primary btn-outline-primary btn-icon"><i class="icofont icofont-eye-alt"></i></button>' +
                                                                    '  <button id="'+subID+'ajaxEditSub" onclick="return EditSubModal('+ mainID +','+subID+')" title="Edit ' + subCat + '" style="width: 30px; height: 30px;"  class="btn btn-primary btn-outline-primary btn-icon"><i class="icofont icofont-edit-alt"></i></button>' +
                                                                    '</td>'+

                                                                    '<td id="' + subID + 'ajaxMain">' + mainCat + '</td>'+
                                                                    '<td id="' + subID + 'ajaxSub">' + subCat + '</td>'+
                                                                    '<td id="' + subID + 'ajaxDate">' + create + ' (' + createAgo + ')</td> '+
                                                                    '<td id="' + subID + 'ajaxUpdate">' + update + ' (' + updateAgo + ')</td> ';

                                                                   $("#"+subID+"SubCat").html(editedRow);
                                                                    $("#"+subID+"SubCat").animate({ backgroundColor: "#3085d6" }, "slow",function(){
                                                                    $("#"+subID+"SubCat").animate({ backgroundColor: "" }, "slow");
                                                                });

                                                                //$("#editSubCat").html(addRows);
                                                            }, 3000)
                                                        )
                                                    }
                                                }, 1000)



                                                }
                                             };
                                        ajax.send(formdata);

                                    })
                                }


                            });

                        }
                           }
                        };
                ajax.send(Data);

            }else {
                console.log('Something went wrong')
            }

        }
    };
    xhttp.send(modalData);


}
