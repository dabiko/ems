<?php
/**
 * Created by PhpStorm.
 * User: Dabiko Blaise
 * Date: 02-Aug-18
 * Time: 4:23 PM
 */

require_once 'resources/utilities.php';
$RunQuery = new QueryControllers();

if(isset($_POST['print'])){

    $Query = "SELECT * FROM invoice WHERE balance=:balance && print=:print";
    $statement = $adb->prepare($Query);
    $statement->execute(array(':balance' => 0, ':print' => 0));
    $number = $statement->rowCount();
    echo $number;
}