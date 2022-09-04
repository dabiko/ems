<?php
/**
 * Created by PhpStorm.
 * User: Dabiko Blaise
 * Date: 11-Jul-18
 * Time: 11:47 PM
 */
require_once 'resources/session.php';
require_once 'resources/Database.php';


$adb = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
$sqlQuery = "SELECT * FROM equipments ORDER BY e_num DESC";
$statement = $adb->prepare($sqlQuery);
$statement->execute();
if($row = $statement->fetch()){
    $lastID = $row['e_num'];
    echo ++$lastID;
}else{
    $lastID = 1;
    echo $lastID;
}