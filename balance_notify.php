<?php
/**
 * Created by PhpStorm.
 * User: Dabiko Blaise
 * Date: 02-Aug-18
 * Time: 4:23 PM
 */

require_once 'resources/utilities.php';

if (isset($_POST['balance'])){

    $Query = "SELECT * FROM invoice WHERE balance != 0";
    $statement = $adb->prepare($Query);
    $statement->execute();
    $number = $statement->rowCount();
    echo $number;

}
