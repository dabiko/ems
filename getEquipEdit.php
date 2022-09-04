<?php
/**
 * Created by PhpStorm.
 * User: Dabiko Blaise
 * Date: 29-Jun-18
 * Time: 9:02 AM
 */
require_once 'resources/session.php';
require_once 'resources/utilities.php';


if(isset($_POST['edit_id'])){
    $encodedID = $_POST['edit_id'];
    $ID = base64_decode(urldecode($encodedID));

    $SelectData = "SELECT * FROM equipments".
        " LEFT JOIN main_category AS ma USING(main_id)".
        " LEFT JOIN sub_category AS su USING(sub_id) WHERE e_id = $ID";
    $statement = $adb->prepare($SelectData);
    $statement->execute();
    if ($statement->rowCount() > 0) {
        if ($rows = $statement->fetch()) {

            $equip_id = $rows['e_id'];
            $name = $rows['e_name'];
            $des = $rows['des'];
            $number = $rows['e_num'];
            $model = $rows['e_model'];
            $manu = $rows['e_manu'];
            $code = $rows['e_code'];
            $qty = $rows['qty'];
            $u_price = $rows['u_price'];
            $cogs = $rows['cogs'];

            $sub_cat = $rows['sub_cat'];
            $main_cat = $rows['main_cat'];
            $main_id = $rows['main_id'];

            $added_on = $rows['add_date'];
            $updated_on = $rows['updated'];





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

            $arr = array();
            $jsonData = '{"results":[';
            $jsonObject = new stdClass();
            $jsonObject->equip_id = $equip_id;
            $jsonObject->ename = $name;
            $jsonObject->des = $des;
            $jsonObject->e_number = $number;
            $jsonObject->emodel = $model;
            $jsonObject->manu = $manu;
            $jsonObject->ecode = $code;
            $jsonObject->qty = $qty;
            $jsonObject->eup = $u_price;
            $jsonObject->perCost = $cogs;
            $jsonObject->sub_cat = $sub_cat;
            $jsonObject->main_cat = $main_cat;
            $jsonObject->main_id = $main_id;
            $jsonObject->agoAdded = $ago;
            $jsonObject->updateago = $update_Ago;
            $jsonObject->dateAdded = $add_date;
            $jsonObject->updatedate = $update_date;
            $arr[] = json_encode($jsonObject);
            $jsonData .= implode(",", $arr);
            $jsonData .= ']}';
            echo $jsonData;


        }
    }


  }else{

       echo 1;

    }

