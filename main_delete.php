<?php
/**
 * Created by PhpStorm.
 * User: dabik
 * Date: 04-Jan-18
 * Time: 2:19 AM
 */
require_once 'resources/session.php';
require_once 'resources/utilities.php';
$RunQuery = new QueryControllers();

$delete_id = $_POST['deleted_id'];

$columns[] = 'main_id';
$values[] = $delete_id;
$DeleteLog = $RunQuery->DeleteData('main_category',$columns,$values);
echo 1;