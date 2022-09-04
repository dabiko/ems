<?php

/**
 * Created by PhpStorm.
 * User: dabik
 * Date: 03-Nov-17
 * Time: 9:18 PM
 */
require_once 'resources/session.php';
require_once 'resources/utilities.php';


$RunQuery = new QueryControllers();

if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {

    $main_id = $_POST['main_id'];

    if (!empty($main_id)) {
        /** @var  $SelectQuery,check if main ID and sub ID exist in the database */
        $SelectData = "SELECT * FROM main_category WHERE main_id = $main_id";
        $statement = $adb->prepare($SelectData);
        $statement->execute();
        if ($statement->rowCount() > 0) {
            header("Content-Type: application/json");
            $myArray = array();
            while ($row = $statement->fetch()) {
                /** @var  $arr, sending Main Category details back to ajax as json data */
                $myArray[] = $row;
            }
            echo json_encode($myArray);

        }else {

            echo 'Sorry!!!, No such data Exit';
        }
    }


}else{
    echo 'Error!!!, Please make sure you are sending a POST Request';
}
