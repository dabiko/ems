<?php
/**
 * Created by PhpStorm.
 * User: Dabiko Blaise
 * Date: 12-Jul-18
 * Time: 10:52 PM
 */

require_once 'resources/session.php';
require_once 'resources/utilities.php';


$RunQuery = new QueryControllers();
$error = array(1,2,3,4);
if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {

    $e_id = $_POST['e_id'];
    $qty = $_POST['quantity'];

    if (!filter_var($qty,FILTER_VALIDATE_INT) || empty($qty) || $qty == 0) {
        echo $error[0];

    }elseif ($qty < 0) {
        echo  $error[1];

    }else {
                /** @var  $SelectQuery,check if main ID and sub ID exist in the database */
        $SelectData = "SELECT * FROM invoice WHERE e_id = $e_id";
        $statement = $adb->prepare($SelectData);
        $statement->execute();
        if ($statement->rowCount() > 0) {
                echo 3;

        }else {
            echo[3];
//            $columns[] = 'e_id';
//            $columns[] = 'quantity';
//
//
//            $values[] = $e_id;
//            $values[] = $qty;

            //$InsertQuery = $RunQuery->InsertData('invoice', $columns, $values);
            //echo[3];
        }


//        $columns[] = 'sub_cat';
//        $columns[] = 'main_id';
//        $columns[] = 'created_date';
//        $columns[] = 'updated_date';
//
//        $values[] = $sub_cat;
//        $values[] = $main_id;
//        $values[] = date('Y-m-d H:i:s');;
//        $values[] = date('Y-m-d H:i:s');;

//        $InsertQuery = $RunQuery->InsertData('sub_category', $columns, $values);
//
//        /** @var  $SelectQuery,check if main ID and sub ID exist in the database */
//        $SelectData = "SELECT * FROM sub_category".
//            " INNER JOIN main_category AS re USING(main_id) WHERE sub_id = $lastID";
//        $statement = $adb->prepare($SelectData);
//        $statement->execute();
//        if ($statement->rowCount() > 0) {
//            $myArray = array();
//            while ($row = $statement->fetch()) {
//
//
//            }
//
//        }else {
//
//            echo $error = 'Sorry!!!, No such data Exit';
//        }

    }

}
