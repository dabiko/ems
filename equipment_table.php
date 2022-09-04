<?php
$page_title = 'EMS-Equipments';
/**
 * Created by PhpStorm.
 * User: Dabiko Blaise
 * Date: 29-Jun-18
 * Time: 9:02 AM
 */
require_once 'header.php';
?>


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
                                        <h4>EMS - Equipments </h4>
                                    </div>

                                    <div class="page-header-breadcrumb">
                                        <ul class="breadcrumb-title">
                                            <li class="breadcrumb-item">
                                                <a href="index.php">
                                                    <i class="icofont icofont-home"></i>
                                                </a>
                                            </li>
                                            <li class="breadcrumb-item"><a style="cursor: pointer;" onclick="return void(0);">Equipment Table</a>
                                            </li>
                                            <li class="breadcrumb-item"><a style="cursor: pointer;" onclick="return RedirectToPage('equip_add');">Add Equipments</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>


                                <div class="card">
                                    <div class="card-header table-card-header">
                                        <div id="OFSError"></div>
                                        <h5>Equipment Table</h5>
                                        <div class="card-header-right">
                                            <i class="icofont icofont-rounded-down"></i>
                                            <i class="icofont icofont-refresh"></i>
                                        </div>
                                    </div>


                                    <div class="card-block ">
                                        <div class="dt-responsive table-responsive">
                                            <button  onclick="return addModal();" type="button"  class="btn btn-primary m-b-20"><i class="icofont icofont-plus-circle"></i> Add Equipment</button>
                                            <button  onclick="return printEquipments();" type="button"  title="Request Equipments in PDF"   class="btn btn-primary m-b-20"><i class="icofont icofont-download-alt"></i> Request PDF</button>
                                            <table id="basic-btn" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                <tr  style="color: white;" class="table-primary">
                                                    <th>Actions </th>
                                                    <th>Status </th>
                                                    <th>Item Name</th>
                                                    <th>Description</th>
                                                    <th>Manufacturer</th>
                                                    <th>Model Number</th>
                                                    <th>Code</th>
                                                    <th>Main Category </th>
                                                    <th>Sub Category </th>
                                                    <th>Quantity(Qty) </th>
                                                    <th>Unit Price(UP) </th>
                                                    <th>Cost per Good </th>
                                                    <th>Total Cost(TC)</th>
                                                    <th>Date Added </th>
                                                    <th>Date Updated </th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                <?php

                                                /** Creating the Edit form for Main categories */

                                                $SelectData = "SELECT * FROM equipments".
                                                " LEFT JOIN main_category AS ma USING(main_id)".
                                                " LEFT JOIN sub_category AS su USING(sub_id) ORDER BY e_id DESC";
                                                $statement = $adb->prepare($SelectData);
                                                $statement->execute();

                                                if ($statement->rowCount() > 0) {
                                                    while ($row = $statement->fetch()) {

                                                        $equip_id = $row['e_id'];
                                                        $name = $row['e_name'];
                                                        $des = $row['des'];
                                                        $number = $row['e_num'];
                                                        $model = $row['e_model'];
                                                        $manu = $row['e_manu'];
                                                        $code = $row['e_code'];
                                                        $qty = $row['qty'];
                                                        $u_price = $row['u_price'];
                                                        $cp_goods = $row['cogs'];
                                                        $TC = ($cp_goods * $qty);

                                                        $sub_cat = $row['sub_cat'];
                                                        $main_cat = $row['main_cat'];
                                                        $main_id = $row['main_id'];


                                                        $added_on = $row['add_date'];
                                                        $updated_on = $row['updated'];


                                                        /**Limiting the number of text that displays on the description row */
                                                        $description = implode(' ', array_slice(explode(' ', $des), 0, 3));
                                                        $Des = $description . "....";


                                                        /** implementing the Ago time*/
                                                        $date = $added_on;
                                                        $posted_at = $date;
                                                        $Ago = new convertToAgo();
                                                        $unit_timestamp = $Ago->convert_datetime($posted_at);
                                                        $ago = $Ago->makeAgo($unit_timestamp);

                                                        $update = $updated_on;
                                                        $update_at = $update;
                                                        $upAgo = new convertToAgo();
                                                        $unitTimestamp = $upAgo->convert_datetime($update_at);
                                                        $update_Ago = $upAgo->makeAgo($unitTimestamp);


                                                        /** Formatting the join date and today's date */
                                                        $add_date = strftime("%b %d, %Y", strtotime($added_on));
                                                        $update_date = strftime("%b %d, %Y", strtotime($updated_on));

                                                        $encode_id = base64_encode("equipmentID{$equip_id}");


                                                        echo '<tr id="'.$equip_id.'Equip">';

                                                        echo '<td id="'.$equip_id.'AjaxBtn""> 
                                                                  <button onclick="return equipDelete('.$equip_id.');" title="Delete ' . $name . '" style="width: 30px; height: 30px;"  class="btn btn-danger btn-outline-danger btn-icon"><i class="icofont icofont-delete-alt"></i></button>
                                                                  <button onclick="return ViewEquipModal('.$equip_id.');" title="View ' . $name . '" style="width: 30px; height: 30px;"  class="btn btn-primary btn-outline-primary btn-icon"><i class="icofont icofont-eye-alt"></i></button>
                                                                  <a onclick="return editEquipModal('.$equip_id.');"><button title="Edit ' . $name . '" style="width: 30px; height: 30px;"  class="btn btn-primary btn-outline-primary btn-icon"><i class="icofont icofont-edit-alt"></i></button></a>
                                                              </td>';


                                                        /**Checking if equipments are in Stock or out of Stock */
                                                        if ($row['qty'] == 0){
                                                            echo $status ='<td id="'.$equip_id.'ajaxOs"><button onclick="return outofStock();"  type="button" class="btn btn-outline-danger btn-round"> Out of Stock</button></td>';

                                                        }elseif($row['qty'] <= 10){
                                                            echo $status ='<td id="'.$equip_id.'ajaxLs"><button type="button" class="btn btn-outline-warning btn-round"> Low Stock</button></td>';

                                                        }elseif($row['qty'] > 10){
                                                            echo $status ='<td id="'.$equip_id.'ajaxIs"><button type="button" class="btn btn-outline-success btn-round"> In Stock</button></td>';

                                                        }

                                                        echo '<td id="'.$equip_id.'ajaxName" class="text-center">'.$name.'</td>';
                                                        echo '<td id="'.$equip_id.'ajaxDes" onclick="return ViewDesModal('.$equip_id.');">'.$Des.'</td>';
                                                        echo '<td id="'.$equip_id.'ajaxManu" class="text-center">'.$manu.'</td>';
                                                        echo '<td id="'.$equip_id.'ajaxModel" class="text-center">'.$model.'</td>';
                                                        echo '<td id="'.$equip_id.'ajaxCode" class="text-center">'.$code.'</td>';
                                                        echo '<td id="'.$equip_id.'ajaxMain" class="text-center">'.$main_cat.'</td>';
                                                        echo '<td id="'.$equip_id.'ajaxSub" class="text-center">'.$sub_cat.'</td>';
                                                        echo '<td id="'.$equip_id.'ajaxQty" class="text-center">'.$qty.'</td>';
                                                        echo '<td id="'.$equip_id.'ajaxUp" class="text-center">'.number_format($u_price).' FCFA</td>';
                                                        echo '<td id="'.$equip_id.'ajaxcpG" class="text-center">'.number_format($cp_goods).' FCFA</td>';
                                                        echo '<td id="'.$equip_id.'ajaxTc" class="text-center">'.number_format($TC).' FCFA</td>';
                                                        echo '<td id="'.$equip_id.'ajaxDate" class=text-center>'.$add_date.' ('.$ago.')</td> ';
                                                        echo '<td id="'.$equip_id.'ajaxUpdate" class=text-center>'.$update_date.' ('.$update_Ago.')</td> ';
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

