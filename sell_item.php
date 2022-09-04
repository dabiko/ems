<?php
$page_title = 'EMS-Sell Items';
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
                                        <h4>EMS - Sell Equipments </h4>
                                    </div>

                                    <div class="page-header-breadcrumb">
                                        <ul class="breadcrumb-title">
                                            <li class="breadcrumb-item">
                                                <a href="index.php">
                                                    <i class="icofont icofont-home"></i>
                                                </a>
                                            </li>
                                            <li class="breadcrumb-item"><a onclick="return void(0); ">Equipment Table</a>
                                            </li>
                                            <li class="breadcrumb-item"><a href="equipment_table.php">Add Equipments</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>


                                <div class="card">
                                    <div class="card-header table-card-header">
                                        <div id="OFSError"></div>
                                        <h5>Sales Dashboard</h5>
                                        <div class="card-header-right">
                                            <i class="icofont icofont-rounded-down"></i>
                                            <i class="icofont icofont-refresh"></i>
                                        </div>
                                    </div>


                                    <div class="card-block ">
                                        <div class="dt-responsive table-responsive">
                                            <table id="basic-btn" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                <tr  style="color: white;" class="table-primary">
                                                    <th><i class="icofont icofont-numbered"></i>#No </th>
                                                    <th>Sell Items </th>
                                                    <th>Status </th>
                                                    <th>Item Name</th>
                                                    <th>Manufacturer</th>
                                                    <th>Model Number</th>
                                                    <th>Code</th>
                                                    <th>Quantity(Qty) </th>
                                                    <th>Unit Price(UP) </th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                <?php

                                                /** Creating the Edit form for Main categories */

                                                $SelectData = "SELECT * FROM equipments".
                                                " LEFT JOIN main_category AS ma USING(main_id)".
                                                " LEFT JOIN sub_category AS su USING(sub_id) ORDER BY e_id ASC";
                                                $statement = $adb->prepare($SelectData);
                                                $statement->execute();

                                                if ($statement->rowCount() > 0) {
                                                    while ($row = $statement->fetch()) {

                                                        $equip_id = $row['e_id'];
                                                        $name = $row['e_name'];
                                                        $number = $row['e_num'];
                                                        $model = $row['e_model'];
                                                        $manu = $row['e_manu'];
                                                        $code = $row['e_code'];
                                                        $qty = $row['qty'];
                                                        $u_price = $row['u_price'];
                                                        $TC = ($u_price * $qty);

                                                        $sub_cat = $row['sub_cat'];
                                                        $main_cat = $row['main_cat'];
                                                        $main_id = $row['main_id'];

                                                        $added_on = $row['add_date'];
                                                        $updated_on = $row['updated'];





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


                                                        echo '<tr id="'.$equip_id.'equip">';

                                                        echo '<td id="'.$equip_id.'ajaxMain"><button style="width: 30px; height: 30px;"  class="btn btn-primary btn-outline-primary btn-icon">'.$number.'</button></td>';

                                                        /**Checking if equipments are in Stock or out of Stock */
                                                        if ($row['qty'] == 0){
                                                            echo '<td id="'.$equip_id.'ajaxMain"><button onclick="return outofStock();" class="btn btn-primary btn-outline-primary btn-round">Unavailable</button></td>';
                                                            echo $status ='<td><button  type="button" class="btn btn-outline-danger btn-round"> Out of Stock</button></td>';

                                                        }elseif($row['qty'] <= 10){
                                                            echo '<td id="'.$equip_id.'ajaxMain"><button onclick="return itemModal('.$equip_id.');"  class="btn btn-primary btn-outline-primary btn-round">Sell</button></td>';
                                                            echo $status ='<td><button type="button" class="btn btn-outline-warning btn-round"> In Stock</button></td>';

                                                        }elseif($row['qty'] > 10){
                                                            echo '<td id="'.$equip_id.'ajaxMain"><button onclick="return itemModal('.$equip_id.');"  class="btn btn-primary btn-outline-primary btn-round">Sell</button></td>';
                                                            echo $status ='<td><button type="button" class="btn btn-outline-success btn-round"> In Stock</button></td>';

                                                        }

                                                        echo '<td>'.$name.'</td>';
                                                        echo '<td>'.$manu.'</td>';
                                                        echo '<td>'.$model.'</td>';
                                                        echo '<td>'.$code.'</td>';
                                                        echo '<td>'.$qty.'</td>';
                                                        echo '<td>'.number_format($u_price).' FCFA</td>';
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

