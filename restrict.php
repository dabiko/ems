<?php
/**
 * Created by PhpStorm.
 * User: Dabiko Blaise
 * Date: 31-Jul-18
 * Time: 12:50 AM
 */
require_once 'resources/session.php';
require_once 'resources/Database.php';

if (isset($_POST['restrict_print'])){

    $encodedID = $_POST['restrict_print'];
    $ID = base64_decode(urldecode($encodedID));

    $selectQuery = "SELECT * FROM invoice WHERE in_id = $ID";
    $statement =$adb->prepare($selectQuery);
    $statement->execute();
    $row = $statement->fetch();
    if ($row['print'] == 1 || $row['balance'] > 0 ){
        echo 1;
    }

}elseif (isset($_POST['restrict_edit'])){

    $encodedID = $_POST['restrict_edit'];
    $ID = base64_decode(urldecode($encodedID));

    $selectQuery = "SELECT * FROM invoice WHERE in_id = $ID";
    $statement =$adb->prepare($selectQuery);
    $statement->execute();
    $row = $statement->fetch();
    echo $row['print'];
}else{

    echo 'There was an Error';
}