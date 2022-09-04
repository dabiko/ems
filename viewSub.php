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
$view_id = $_POST['view_id'];

/** @var  $SelectQuery,check if main ID and sub ID exist in the database */
$SelectData = "SELECT * FROM sub_category".
    " INNER JOIN main_category AS re USING(main_id) WHERE sub_id = $view_id";
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