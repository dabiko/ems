<?php
/**
 * Created by PhpStorm.
 * User: dabik
 * Date: 19-Mar-18
 * Time: 9:51 PM
 */
require_once 'resources/session.php';
require_once 'resources/utilities.php';
$error = '';
$RunQuery = new QueryControllers();
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {


    $e_num = $_POST['e_num'];
    $name = $_POST['e_name'];
    $des = $_POST['des'];
    $mainCat = $_POST['mainCat_id'];
    $subCat = $_POST['subCat_id'];
    $e_manu = $_POST['e_manu'];
    $e_model = $_POST['e_model'];
    $e_code= $_POST['e_code'];
    $qty = $_POST['qty'];
    $cogs = $_POST['cogs'];
    $u_price = $_POST['u_price'];




    if (empty($e_num)) {
        echo $error = 2;
    }if (empty($name)) {
        echo $error =3;

    }elseif (empty($des)) {
        echo $error =4;

    }elseif (str_word_count($des) > 100) {

        echo $error =5;

    } elseif (empty($mainCat)) {
        echo $error =6;

    }elseif (empty($subCat)) {
        echo $error =7;
    }  elseif (empty($e_manu)) {
        echo $error =8;

    }elseif (empty($e_model)) {
        echo $error =9;

    } elseif (empty($e_code)) {
        echo $error =10;

    } elseif (empty($qty)) {
        echo $error =11;

    } elseif (!filter_var($qty, FILTER_VALIDATE_INT)) {
        echo $error =12;

    }elseif ($qty < 0) {
        echo $error =13;

    } elseif (empty($cogs)) {
        echo $error =14;

    } elseif (!filter_var($cogs, FILTER_VALIDATE_INT)) {
        echo $error =15;

    }elseif ($cogs < 0){
        echo $error =16;

    } elseif (empty($u_price)) {
        echo $error =17;

    } elseif (!filter_var($u_price, FILTER_VALIDATE_INT)) {
        echo $error =18;

    }elseif ($u_price < 0){
        echo $error =19;

    } elseif ($u_price < $cogs){
        echo $error =20;

    }


    elseif (strlen($name) < 2) {
        echo $error =21;

    }elseif (strlen($name) > 30) {
        echo $error =22;

    } elseif ($RunQuery->checkDuplicateEquip($name, $adb)) {
        echo $error =23;

    }elseif(isset($e_model)){

        $adb = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
        $sqlQuery = "SELECT * FROM equipments WHERE e_model = :e_model";
        $statement = $adb->prepare($sqlQuery);
        $statement->execute(array(':e_model' => $e_model));
        if ($row = $statement->fetch()) {

            echo $error =24;

        }

    }

    if(empty($error)) {

        $columns[] = 'e_num';
        $columns[] = 'e_name';
        $columns[] = 'des';
        $columns[] = 'main_id';
        $columns[] = 'sub_id';
        $columns[] = 'e_manu';
        $columns[] = 'e_model';
        $columns[] = 'e_code';
        $columns[] = 'qty';
        $columns[] = 'cogs';
        $columns[] = 'u_price';
        $columns[] = 'add_date';
        $columns[] = 'updated';


        $values[] = $e_num;
        $values[] = $name;
        $values[] = $des;
        $values[] = $mainCat;
        $values[] = $subCat;
        $values[] = $e_manu;
        $values[] = $e_model;
        $values[] = $e_code;
        $values[] = $qty;
        $values[] = $cogs;
        $values[] = $u_price;
        $values[] = date('Y-m-d H:i:s');
        $values[] = date('Y-m-d H:i:s');
        $InsertQuery = $RunQuery->InsertData('equipments', $columns, $values);

        header("Content-Type: application/json");
        $lastID = $RunQuery->getLastInsertId();

        $Query = "SELECT * FROM equipments".
            " LEFT JOIN main_category AS ma USING(main_id)".
            " LEFT JOIN sub_category AS su USING(sub_id) WHERE e_id = $lastID";
        $statements = $adb->prepare($Query);
        $statements->execute();
        if ($rows = $statements->fetch()){

            $equip_id = $rows['e_id'];
            $name = $rows['e_name'];
            $des = $rows['des'];
            $number = $rows['e_num'];
            $model = $rows['e_model'];
            $manu = $rows['e_manu'];
            $code = $rows['e_code'];
            $qty = $rows['qty'];
            $u_price = $rows['u_price'];
            $cp_goods =$rows['cogs'];
            $TC = ($cp_goods * $qty);

            $sub_cat = $rows['sub_cat'];
            $main_cat = $rows['main_cat'];
            $main_id = $rows['main_id'];

            $added_on = $rows['add_date'];
            $updated_on = $rows['updated'];





            /** implementing the Ago time*/
            $date = $added_on;
            $posted_at = $date;
            $Ago = new convertToAgo();
            $unit_timestamp = $Ago->convert_datetime($posted_at);
            $ago = $Ago->makeAgo($unit_timestamp);

            $update = $updated_on;
            $update_at = $update;
            $upAgo = new convertToAgo();
            $unitTimestamp = $upAgo->convert_datetime($update_at);
            $update_Ago = $upAgo->makeAgo($unitTimestamp);


            /** Formatting the join date and today's date */
            $add_date = strftime("%b %d, %Y", strtotime($added_on));
            $update_date = strftime("%b %d, %Y", strtotime($updated_on));

            $arr = array();
            $jsonData = '{"results":[';
            $jsonObject = new stdClass();
            $jsonObject->equip_id = $equip_id;
            $jsonObject->ename = $name;
            $jsonObject->des = $des;
            $jsonObject->emodel = $model;
            $jsonObject->manu = $manu;
            $jsonObject->ecode = $code;
            $jsonObject->qty = $qty;
            $jsonObject->eup = $u_price;
            $jsonObject->ecogs = $cp_goods;
            $jsonObject->etc = $TC;
            $jsonObject->sub_cat = $sub_cat;
            $jsonObject->main_cat = $main_cat;
            $jsonObject->main_id = $main_id;
            $jsonObject->agoAdded = $ago;
            $jsonObject->updateago = $update_Ago;
            $jsonObject->dateAdded = $add_date;
            $jsonObject->updatedate = $update_date;
            $arr[] = json_encode($jsonObject);
            $jsonData .= implode(",", $arr);
            $jsonData .= ']}';
            echo $jsonData;


        }

    }

}else{
        echo $error =1;
    }
