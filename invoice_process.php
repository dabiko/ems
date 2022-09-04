<?php
/**
 * Created by PhpStorm.
 * User: Dabiko Blaise
 * Date: 23-Jul-18
 * Time: 1:40 PM
 */
require_once 'resources/session.php';
require_once 'resources/utilities.php';

$RunQuery = new QueryControllers();

$error = '';
if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {

    $client_name = $_POST['c_name'];
    $client_address = $_POST['c_address'];
    $client_number = $_POST['c_num'];
    $client_email = $_POST['c_email'];

    $order_id = $_POST['order_id'];
    $invoice_num = $_POST['in_num'];
    $p_method = $_POST['p_method'];
    $paid = $_POST['paid'];
    $hidden_paid = $_POST['hidden_paid'];
    $sub_total= $_POST['sub_total'];

    $rowData = $_POST['rowData'];
    $unpaid_balance = $_POST['t_due'];
    $total = $_POST['t_cal'];




    /** @var  $clientEmail , email validation */
    $Email = htmlspecialchars_decode($client_email, ENT_QUOTES);

    /**Json formatting data **/
    /** escaping the string values in the JSON array*/
    $tableData = stripcslashes($rowData);

    /** Decoding the JSON array to be accessed as Objects */
    $Data = json_decode($tableData);


    if (empty($client_name || $client_address || $client_number || $client_email)) {
        echo $error = 2;

    } elseif (strlen($client_name) < 2) {
        echo $error = 3;

    } elseif (strlen($client_name) > 20) {
        echo $error = 4;

    } elseif (!filter_var($client_number, FILTER_SANITIZE_NUMBER_INT)) {
        echo $error = 5;

    } else if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
        echo $error = 6;

    } else if (empty($order_id || $invoice_num)) {
        echo $error = 7;

    }else if (empty($p_method)) {
        echo $error = 8;

    }else if ($unpaid_balance > 0 && $p_method == 2) {
        echo $error = 14;

    }else if ($unpaid_balance > 0 && $p_method == 1) {
        echo $error = 14;

    }else if ($unpaid_balance == 0 && $p_method == 3) {
        echo $error = 15;

    }elseif (empty($total) || empty($sub_total)) {
        echo $error = 9;

    }elseif ($total === "NaN" || $total === "NaNFCFA" ||
              $total === "0" || $total === "0 FCFA") {

        echo $error = 10;

    }elseif ($paid  > $sub_total ) {
        echo $error = 11;

    }elseif (empty($hidden_paid)) {
        echo $error = 12;

    }

    elseif (isset($Data)){
        /**
         * @var  $name
         * @var  $scores ,looping through the multidimensional array
         */
        foreach ($Data as $name => $items) {
            if (empty($items->Item_Id) ||
                empty($items->Item_name) ||
                empty($items->Stocks) ||
                empty($items->Quantity) ||
                empty($items->Cogs) ||
                empty($items->Unit_Price) ||
                empty($items->Total)
            ) {

                echo $error = 'This Invoice has an empty field or row. Please rectify to continue';
                break;

            } elseif ($items->Quantity > $items->Stocks) {

                 echo $error = $items->Item_name. 'has more quantity to be sold than in stock. Please verify the error(s) to continue';
                break;
            } elseif ($items->Unit_Price < $items->Cogs) {

                echo $error = 'Your trying to sell'.$items->Item_name.' below the cost price. Rectify the error(s) to continue';
                break;
            }
        }
    }


    if (empty($error)){
        $columns[] = 'users_id';
        $columns[] = 'client_name';
        $columns[] = 'client_info';
        $columns[] = 'order_info';
        $columns[] = 'p_method';
        $columns[] = 'balance';
        $columns[] = 'in_details';
        $columns[] = 'print';
        $columns[] = 'total';
        $columns[] = 'date_printed';
        $columns[] = 'updates';


        /** @var  $jsonClient , sending client data as array */
        $jsonClient = array("c_name" => $client_name, "c_address" => $client_address, "c_number" => $client_number, "c_email" => $client_email);
        $cJson = json_encode($jsonClient);

        /** sending order data as array */
        $order_date = date('Y-m-d H:i:s');
        $jsonOrder = array("order_date" => $order_date, "order_id" => $order_id, "invoice_number" => $invoice_num);
        $oJson = json_encode($jsonOrder);


       $print = 0;

        $values[] = $_SESSION['ems_id'];
        $values[] = $client_name;
        $values[] = $cJson;
        $values[] = $oJson;
        $values[] = $p_method;
        $values[] = $unpaid_balance;
        $values[] = $rowData;
        $values[] = $print;
        $values[] = $total;
        date_default_timezone_set('Africa/Douala');
        $values[] = date('Y-m-d H:i:s');
        $values[] = date('Y-m-d H:i:s');

        $InsertQuery = $RunQuery->InsertData('invoice', $columns, $values);
        $lastID = $RunQuery->getLastInsertId();

        /** @var  $SelectQuery ,check if Invoice ID exist in the database */
        $SelectData = "SELECT in_details FROM invoice WHERE in_id = $lastID";
        $statement = $adb->prepare($SelectData);
        $statement->execute();
        if ($row = $statement->fetch()) {
            $inRow = $row['in_details'];

        }
        /**Json formatting data **/
        /** escaping any string values in the JSON array*/
        $table = stripcslashes($inRow);

        /** Decoding the JSON array to be accessed as Objects */
        $rowDetails = json_decode($table);
        foreach ($rowDetails as $key => $value) {
            $itemId = $value->Item_Id;
            $Qty = $value->Quantity;

            /**Checking if Item ID exit in the equipment table */
            $sqlQuery = "SELECT * FROM equipments WHERE e_id IN ($itemId)";
            $statement = $adb->prepare($sqlQuery);
            $statement->execute();
            if ($rows = $statement->fetch()) {
                $eQty = $rows['qty'];

                $newStock = ($eQty - $Qty);
                $dateNow = date('Y-m-d H:i:s');

                $sqlUpdate = "UPDATE equipments SET qty =:qty, updated =:updated WHERE e_id=:e_id";
                $statement = $adb->prepare($sqlUpdate);
                $statement->execute(array(':qty' => $newStock, ':updated' => $dateNow, ':e_id' => $itemId));

            }


        }
         echo 13;
    }


}else {
    echo $error = 1;
}








