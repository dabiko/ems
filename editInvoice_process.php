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

$message = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15);
$error = '';
if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $client_name = $_POST['c_name'];
    $client_address = $_POST['c_address'];
    $client_number = $_POST['c_num'];
    $client_email = $_POST['c_email'];

    $unpaid_balance = $_POST['edit_due'];
    $invoice_id = $_POST['invoice_id'];
    $hide_paid = $_POST['hidden'];
    $p_method = $_POST['edit_method'];


    /** @var  $clientEmail , email validation */
    $Email = htmlspecialchars_decode($client_email, ENT_QUOTES);


    if (empty($client_name || $client_address || $client_number || $client_email)) {
        echo $message[1];
    } elseif (strlen($client_name) < 2) {
        echo $message[2];
    } elseif (strlen($client_name) > 20) {
        echo $message[3];
    } elseif (!filter_var($client_number, FILTER_SANITIZE_NUMBER_INT)) {
        echo $message[4];
    } else if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
        echo $message[5];
    }else if (empty($invoice_id)) {
        echo $message[6];
    }  elseif ($unpaid_balance === "") {
        echo $message[7];
    }
    elseif ($hide_paid === "") {
        echo $message[10];

    }else if ($unpaid_balance > 0 && $p_method == 2) {
        echo $message[11];

    }else if ($unpaid_balance > 0 && $p_method == 1) {
        echo $message[11];

    }else if ($unpaid_balance == 0 && $p_method == 3) {
        echo $message[12];

    }
    else{


        if ($unpaid_balance == 0){

            $print = 0;
            $columns[] = 'client_name';
            $columns[] = 'client_info';
            $columns[] = 'p_method';
            $columns[] = 'balance';
            $columns[] = 'print';
            $columns[] = 'updates';


            /** @var  $jsonClient , sending client data as array */
            $jsonClient = array("c_name" => $client_name, "c_address" => $client_address, "c_number" => $client_number, "c_email" => $client_email);
            $cJson = json_encode($jsonClient);
            date_default_timezone_set('Africa/Douala');

            $values[] = $client_name;
            $values[] = $cJson;
            $values[] = $p_method;
            $values[] = $unpaid_balance;
            $values[] = $print;
            $values[] = date('Y-m-d H:i:s');

            $InsertQuery = $RunQuery->UpdateData('invoice',$columns,$values,'in_id = "'.$invoice_id.'"');
            echo $message[8];

        }else{

            $print = 0;
            $columns[] = 'client_name';
            $columns[] = 'client_info';
            $columns[] = 'p_method';
            $columns[] = 'balance';
            $columns[] = 'print';
            $columns[] = 'updates';


            /** @var  $jsonClient , sending client data as array */
            $jsonClient = array("c_name" => $client_name, "c_address" => $client_address, "c_number" => $client_number, "c_email" => $client_email);
            $cJson = json_encode($jsonClient);
            date_default_timezone_set('Africa/Douala');

            $values[] = $client_name;
            $values[] = $cJson;
            $values[] = $p_method;
            $values[] = $unpaid_balance;
            $values[] = $print;
            $values[] = date('Y-m-d H:i:s');

            $InsertQuery = $RunQuery->UpdateData('invoice',$columns,$values,'in_id = "'.$invoice_id.'"');
            echo $message[9];
        }

    }

}else {
    echo $message[0];
}








