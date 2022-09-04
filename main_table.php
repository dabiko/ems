<?php
$page_title = 'EMS-Categories';
/**
 * Created by PhpStorm.
 * User: Dabiko Blaise
 * Date: 29-Jun-18
 * Time: 9:02 AM
 */
require_once 'header.php';
?>



<div class="theme-loader">
    <div class="ball-scale">
        <div></div>
    </div>
</div>


<div id="pcoded" class="pcoded">
    <div class="pcoded-overlay-box"></div>
    <div class="pcoded-container navbar-wrapper">

        <?php require_once 'horizontal_menu.php';?>

        <div class="pcoded-main-container">
            <div class="pcoded-wrapper">

                <?php require_once 'left_menu.php';?>


                <div class="pcoded-content">
                    <div class="pcoded-inner-content">
                        <div class="main-body">
                            <div class="page-wrapper">
                                <div class="page-header">
                                    <div class="page-header-title">
                                        <h4>EMS - Categories </h4>
                                    </div>

                                    <div class="page-header-breadcrumb">
                                        <ul class="breadcrumb-title">
                                            <li class="breadcrumb-item">
                                                <a href="index.php">
                                                    <i class="icofont icofont-home"></i>
                                                </a>
                                            </li>
                                            <li class="breadcrumb-item"><a href="#!">Main Categories</a>
                                            </li>
                                            <li class="breadcrumb-item"><a href="#!">Category Table</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="page-body button-page">
                                    <div class="row">

                                        <div class="col-sm-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Create Categories</h5>
                                                <span>Main Categories - Sub Categories</span>
                                                <div class="card-header-right">
                                                    <i class="icofont icofont-rounded-down"></i>
                                                    <i class="icofont icofont-refresh"></i>
                                                </div>
                                            </div>

                                            <div class="card-block">
                                                <div class="row modal-mob-btn">
                                                    <div class="col-sm-6">
                                                        <button onclick="return CreateMainModal();"  class="btn btn-primary btn-outline-primary btn-block"><i class="icofont icofont-plus-circle"></i>Main Category</button>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <button onclick="return CreateSubModal();" class="btn btn-primary btn-outline-primary btn-block"><i class="icofont icofont-plus-circle"></i>Sub Category </button>
                                                    </div>

                                                    <button class="btn btn-primary waves-effect" data-type="inverse" data-from="top" data-align="right" data-icon="fa fa-comments">Top Right </button>
                                                </div>
                                            </div>
                                        </div>
                                        </div>

                                    </div>
                                </div>



                                <div class="card">
                                    <div class="card-header table-card-header">
                                        <h5>Main Category Table</h5>
                                        <div class="card-header-right">
                                            <i class="icofont icofont-rounded-down"></i>
                                            <i class="icofont icofont-refresh"></i>
                                        </div>
                                    </div>


                                    <div class="card-block ">
                                        <div class="dt-responsive table-responsive">
                                            <div id="deleteMulError"></div>
                                            <button  onclick="return deleteMultipleMain();" type="button" name="btn_delete" id="btn_delete"  class="btn btn-danger m-b-20">Delete Selected</button>
                                            <button  onclick="return printMain();" type="button" title="Request Main Categories in PDF"   class="btn btn-primary m-b-20"><i class="icofont icofont-download-alt"></i> Request PDF</button>
                                            <table id="basic-btn" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                <tr  style="color: white;" class="table-primary">
<!--                                                    <th># </th>-->
                                                    <th>Actions </th>
                                                    <th>Main Category </th>
                                                    <th>Date Created </th>
                                                    <th>Date Updated </th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                <?php

                                                /** Creating the Edit form for Main categories */

                                                $SelectData = "SELECT * FROM main_category ORDER BY main_id DESC";
                                                $statement = $adb->prepare($SelectData);
                                                $statement->execute();

                                                if ($statement->rowCount() > 0) {
                                                    while ($row = $statement->fetch()) {

                                                        $main_id = $row['main_id'];
                                                        $main_cat = $row['main_cat'];

                                                        $created_on = $row['created_on'];
                                                        $updated_on = $row['updated_on'];


                                                        /** implementing the Ago time*/
                                                        $date = $row['created_on'];
                                                        $posted_at = $date;
                                                        $Ago = new convertToAgo();
                                                        $unit_timestamp = $Ago->convert_datetime($posted_at);
                                                        $ago = $Ago->makeAgo($unit_timestamp);

                                                        $update = $row['updated_on'];
                                                        $update_at = $update;
                                                        $upAgo = new convertToAgo();
                                                        $unitTimestamp = $upAgo->convert_datetime($update_at);
                                                        $update_Ago = $upAgo->makeAgo($unitTimestamp);


                                                        /** Formatting the join date and today's date */
                                                        $create_date = strftime("%b %d, %Y", strtotime($created_on));
                                                        $update_date = strftime("%b %d, %Y", strtotime($updated_on));


                                                        echo '<tr id="'.$main_id.'MainCat">';

                                                        echo '<td> 
                                                                  <label title="Check to Delete ' . $main_cat . '" style="width: 30px; height: 30px;" class="btn btn-info btn-info btn-icon">
                                                                  <input type="checkbox" class="checked"  id="checkedMain" name="checkedMain[]" value="'.$main_id.'" aria-label="Checkbox for following text input" />
                                                                  </label>
                                                                  
                                                                  <button onclick="return mainCat_Delete('.$main_id.');" title="Delete ' . $main_cat . '" style="width: 30px; height: 30px;"  class="btn btn-danger btn-outline-danger btn-icon"><i class="icofont icofont-delete-alt"></i></button>
                                                                  <button onclick="return ViewMainModal('.$main_id.');" title="View ' . $main_cat . '" style="width: 30px; height: 30px;"  class="btn btn-primary btn-outline-primary btn-icon"><i class="icofont icofont-eye-alt"></i></button>
                                                                  <button onclick="return mainModal('.$main_id.')" title="Edit ' . $main_cat . '" style="width: 30px; height: 30px;"  class="btn btn-primary btn-outline-primary btn-icon"><i class="icofont icofont-edit-alt"></i></button>
                                                              </td>';

                                                        echo '<td id="'.$main_id.'ajaxMain">'.$main_cat.'</td>';
                                                        echo '<td id="'.$main_id.'ajaxDate">'.$create_date.' ('.$ago.')</td> ';
                                                        echo '<td id="'.$main_id.'ajaxUpdate">'.$update_date.' ('.$update_Ago.')</td> ';
                                                        echo '</tr>';

                                                    }
                                                }else{
                                                    echo '<tr>
                                                           <td colspan="6" style="text-align: center;">
                                                          <div class="alert alert-info icons-alert">
                                                               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                               <i class="icofont icofont-close-line-circled"></i>
                                                               </button>
                                                               <p><strong>Oops!!! </strong> No Data Available</p>
                                                               </div>
                                                         </td>
                                                         </tr>';
                                                }
                                                ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php require_once 'footer.php'; ?>

