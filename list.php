<?php
/**
 * Created by PhpStorm.
 * User: Dabiko Blaise
 * Date: 05-Jul-18
 * Time: 4:02 AM
 */

require_once 'resources/session.php';
require_once 'resources/utilities.php';


$RunQuery = new QueryControllers();
/** @var  $SelectQuery,check if main ID and sub ID exist in the database */
$SelectData = "SELECT * FROM main_category";
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