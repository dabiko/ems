<?php
/**
 * Created by PhpStorm.
 * User: Dabiko Blaise
 * Date: 05-Jul-18
 * Time: 1:33 AM
 */?>
<script>

    /** Function for creating Sub Category*/
    function CreateSubModal() {
//        var ajax = new XMLHttpRequest();
//        ajax.open( "GET", "mainSelect.php",true);
//        ajax.onreadystatechange = function() {
//            if(ajax.readyState == 4 && ajax.status == 200) {
//                if(ajax.responseText){
//                }else {
//
//                }
//
//
//            }
//        };
//        ajax.send();

//                    var jsonData = JSON.parse(ajax.responseText);
//                    for (var i = 0; i < jsonData.length; i++) {
//                        var result = jsonData[i];
//                        var ID = result.main_id;
//                        var mainCat = result.main_cat;
//                        console.log(mainCat);
//
//                    }
        <?php echo '<div class="row"> div class="col-sm-12"
                                <div class="input-group input-group-primary"
                                
                                
                                </div></div> </div>';
        ?>
                    swal({
                        title: 'Create Sub Category',
                        showCancelButton: true,
                        html: '',
                        confirmButtonText: '<i class="icofont icofont-plus-circle"></i>Add',
                        showLoaderOnConfirm: true,
                        showConfirmButton: true,
                        closeOnConfirm: false,
                        allowOutsideClick: false,
                        input: 'select',
                        inputOptions: {
                            'ID': 'ok',
                            'UKR': 'Ukraine',
                            'HRV': 'Croatia'
                        }



                    });


        // swal({
        //     title: 'Create Sub Category',
        //     showCancelButton: true,
        //     confirmButtonText: '<i class="icofont icofont-plus-circle"></i>Add',
        //     showLoaderOnConfirm: true,
        //     showConfirmButton: true,
        //     closeOnConfirm: false,
        //     allowOutsideClick: false
        //
        //     input: 'text',
        //     inputPlaceholder: 'Enter name '
        //
        //
        //
        // });


    }
</script>