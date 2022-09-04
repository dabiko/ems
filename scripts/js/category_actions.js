/**
 * Created by dabik on 21-Dec-17.
 */

function _(id){
    return document.getElementById(id);
}



/**Function for Deleting Main Category **/
function mainCat_Delete(id) {
    swal({
        title: 'Are you sure?',
        text: "Your are about to delete a Main Category from System",
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
        ajax.open("POST", "main_delete", true);
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 4 && ajax.status == 200) {
                if (ajax.responseText == 1) {
                    swal({
                        title: "Deleted !!!",
                        text: "Main Category deleted Successfully.",
                        type: 'success',
                        timer: 3000,
                        showConfirmButton: false
                    });
                    setTimeout(function () {

                        // Removing row from HTML DataTable
                        $("#"+id+"MainCat").closest('tr').css('background','#CD2A19');
                        $("#"+id+"MainCat").closest('tr').fadeOut(800, function(){
                            $("#"+id+"MainCat").remove();
                        });


                       // window.location.href = 'main_table.php';
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
                'Main Category not Deleted :)',
                'info'
            )
        }
    })

}


/**Function for Deleting Sub Category */
function Sub_Delete(id) {
    swal({
        title: 'Are you sure?',
        text: "Your are about to delete a Sub Category from System",
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
        ajax.open("POST", "sub_delete", true);
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 4 && ajax.status == 200) {
                if (ajax.responseText == 1) {
                    swal({
                        title: "Deleted !!!",
                        text: "Sub Category deleted Successfully.",
                        type: 'success',
                        timer: 3000,
                        showConfirmButton: false
                    });
                    setTimeout(function () {

                        // Removing row from HTML DataTable
                        $("#"+id+"SubCat").closest('tr').css('background','#CD2A19');
                        $("#"+id+"SubCat").closest('tr').fadeOut(800, function(){
                            $("#"+id+"SubCat").remove();
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
                'Sub Category not Deleted :)',
                'info'
            )
        }
    })

}






/**Functions to Delete Multiple rows from the Database */
function deleteMultipleMain(){
    _("deleteMulError").innerHTML = '<div class="alert alert-danger icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="icofont icofont-close-line-circled"></i></button><p style="text-align: center;"><strong>Error!!! </strong> Nothing selected, Please Select one or more Checkboxes to Delete</p></div>';

        var id = [];
        $(':checkbox:checked').each(function (i) {
            id[i] = $(this).val();
        });
        if(id.length === 0){
            $("#deleteMulError").show();
            setTimeout(function () {
                $("#deleteMulError").fadeOut();
            }, 5000);
        }else {

            /**Getting the Name of the specific Checkbox that has been clicked**/
            var items = document.getElementsByClassName('checked');
            for (var i = 0; i < items.length; i++)
                var OptionSelected = items[i].name;
               // console.log(OptionSelected);

            swal({
                title: 'Are you sure?',
                text: "Your are about to delete Categories from the System",
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



            var formData = new FormData();
            if(id && OptionSelected === 'checkedMain[]'){
                var rowId = 'MainCat';
                var table_id = 'main_id';
                var databaseMain = 'main_category';

                formData.append('databaseTable',databaseMain);
                formData.append('tableID',table_id);
            }else if(id && OptionSelected === 'checkedSub[]'){
                var rowId = 'SubCat';
                var table_id = 'sub_id';
                var databaseSub = 'sub_category';

                formData.append('databaseTable',databaseSub);
                formData.append('tableID',table_id);
            }

            //alert(id);
                formData.append("deleted_id", id);
                var ajax = new XMLHttpRequest();
                ajax.open("POST", "deleteMultiple", true);
                ajax.onreadystatechange = function () {
                    if (ajax.readyState == 4 && ajax.status == 200) {
                        if (ajax.responseText == 1) {
                            swal({
                                title: "Deleted",
                                text: "Categories deleted Successfully.",
                                type: 'success',
                                timer: 3000,
                                showConfirmButton: false
                            });
                            setTimeout(function () {

                                // Removing rows from HTML DataTable
                                for (var i = 0; i < id.length; i++){
                                    var SelectedID = id[i];
                                    $("#"+SelectedID+rowId).closest('tr').css('background','#CD2A19');
                                    $("#"+SelectedID+rowId).closest('tr').fadeOut(800, function(){
                                        $("#"+SelectedID+rowId).remove();
                                    });
                                }

                            }, 3000);
                        }else {
                            swal({
                                title: "Error",
                                text: "There was an Error. " +ajax.responseText,
                                type: 'error',
                                showConfirmButton: true
                            });
                        }
                    }

                };
                ajax.send(formData)

            }, function (dismiss) {
                // dismiss can be 'cancel', 'overlay',
                // 'close', and 'timer'
                if (dismiss === 'cancel') {
                    swal(
                        'Cancelled',
                        'Categories not Deleted :)',
                        'info'
                    )
                }
            })



        }


    //}




}




function Switch_Categories() {
    $('#mainCat').on('change',function(){
        var categoryID = $(this).val();
        //alert(categoryID);
        var formData = new FormData();

        formData.append("mainCategory_id", categoryID);

        var ajax = new XMLHttpRequest();
        ajax.open("POST", "ajaxSwitch.php", true);
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 4 && ajax.status == 200) {
                if (ajax.responseText) {
                    $("#Drop_down").html(ajax.responseText);
                }

            }
        };
        ajax.send(formData);
    });
}

