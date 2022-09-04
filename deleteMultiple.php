<?php
/**
 * Created by PhpStorm.
 * User: Dabiko Blaise
 * Date: 08-Jul-18
 * Time: 4:52 PM
 */
require_once 'resources/session.php';
require_once 'resources/utilities.php';

$RunQuery = new QueryControllers();

$deleteID = $_POST['deleted_id'];
$databaseName = $_POST['databaseTable'];
$tableID = $_POST['tableID'];

$clean_id = str_replace(',', ' ', $deleteID);
$diff_id = explode(' ', $clean_id);
$final_number = array();
if (count($diff_id) > 0) {
    foreach ($diff_id as $delete_id) {
        if (!empty($delete_id)) {
            $final_number[] = $delete_id;
        }}}
$length = count($final_number);

for($i=0;$i<$length;$i++){
    $delete = $final_number[$i];
    $DeleteCategories = "DELETE FROM $databaseName WHERE $tableID = $delete";
    $statement = $adb->prepare($DeleteCategories);
    $statement->execute();
}
echo 1;
