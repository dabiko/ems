<?php
/**
 * Created by PhpStorm.
 * User: Dabiko Blaise
 * Date: 15-Jul-18
 * Time: 5:08 AM
 */
require_once 'resources/session.php';
require_once 'resources/utilities.php';

if (isset($_POST['item_id']) && !empty($_POST['item_id'])){
    $id = $_POST['item_id'];

    $select = "SELECT * FROM equipments WHERE e_id = $id";
    $statement = $adb->prepare($select);
    $statement->execute();
    if($statement->rowCount() > 0){
        while ($row = $statement->fetch()){

            $unit_price =$row['u_price'];
            $cost_price =$row['cogs'];
            $qty =$row['qty'];
            $name =$row['e_name'];
            $des =$row['des'];

            $arr = array();
            $jsonData = '{"results":[';
            $jsonObject = new stdClass();
            $jsonObject->available_qty = $qty;
            $jsonObject->unit_price = $unit_price;
            $jsonObject->cost_price = $cost_price;
            $jsonObject->item_name = $name;
            $jsonObject->item_des = $des;
            $arr[] = json_encode($jsonObject);
            $jsonData .= implode(",", $arr);
            $jsonData .= ']}';

            echo $jsonData;

        }
    }else{
        echo 'There was an error';
    }

}else{
    echo 'empty data';
}