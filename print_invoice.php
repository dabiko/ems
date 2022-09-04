<?php
/**
 * Created by PhpStorm.
 * User: Dabiko Blaise
 * Date: 31-Jul-18
 * Time: 2:19 AM
 */

require_once 'resources/session.php';
require_once 'resources/Database.php';

$encodedID = $_POST['print_id'];
$ID = base64_decode(urldecode($encodedID));

$selectQuery = "SELECT * FROM invoice".
    " INNER JOIN users AS u USING(users_id) WHERE in_id = $ID";
$statement =$adb->prepare($selectQuery);
$statement->execute();
$row = $statement->fetch();

$in_id = $row['in_id'];
$details = $row['in_details'];
$auth_name = $row['names'];

$total = $row['total'];
$print_date = $row['date_printed'];

$client_info = $row['client_info'];
$order_info = $row['order_info'];

/**Decoding  the JSON data for PHP access as Objects and removing unwanted strings */
$clientData = stripcslashes($client_info);
$json_clientObject = json_decode($clientData);

/**Decoding  the JSON data for PHP access as Objects and removing unwanted strings */
$orderData = stripcslashes($order_info);
$json_orderObject = json_decode($orderData);

/**Formatting the order date, day and time */
$date = strftime("%b %d, %Y", strtotime($json_orderObject->order_date));
$time = date('D, h:m A', strtotime($json_orderObject->order_date));


if ($row['balance'] == 0){
    $status = '<span class="label label-success">Validated </span>';
}else{
    $status = '<span class="label label-warning">Pending </span>';

}

$paid = $total - $row['balance'];
$balance = $row['balance'];

if ($row['p_method'] == 1){

    $method = ' <h6 class="m-b-20">Payment Method:  <span>Cash</span></h6>';

}elseif ($row['p_method'] == 2){

    $method = '<h6 class="m-b-20">Payment Method:  <span>Check</span></h6>';

}elseif ($row['p_method'] == 3){

    $method = ' <h6 class="m-b-20">Payment Method:  <span>Credit</span></h6>';

}


//if($row['balance'] == 0){
//    $print = '<button  onclick="return printInvoice('.$in_id.');" type="submit" class="btn btn-primary btn-print-invoice waves-effect waves-light m-r-20 m-b-10">Print Invoice</button>';
//}elseif($row['balance'] !== 0 || $row['balance'] > 0){
//    $print = '<button type="button"  style="cursor:not-allowed;" disabled=disabled class="btn btn-danger btn-print-invoice waves-effect waves-light m-r-20 m-b-10">Print Invoice</button>';
//}

if ($row['print'] == 0){
    $datePrinted = 'Pending';
}else{
    $datePrinted = strftime("%b %d, %Y", strtotime($row['date_printed']))."</br>".
        date('D, h:m A', strtotime($row['date_printed']));
}

/**Decoding  the JSON data for PHP access as Objects and removing unwanted strings */
$detailsData = stripcslashes($details);
$json_detailsObject = json_decode($detailsData);

$output = '';

$output .= ' <div class="card">
 <div class="row invoice-contact">
 <div class="col-md-8">
 <div class="invoice-box row">
 <div class="col-sm-12">
 <table class="table table-responsive invoice-table table-borderless">
 <tbody style="text-align: left;">
 <tr>
 <td><img src="assets/images/logo-blue.png" class="m-b-10" alt="" /></td>
 </tr>
  <tr>
     <td>EMS Pvt ltd. </td>
 </tr>
 <tr>
     <td>2886 Douala, Bonabery, +237-00-00-00-00</td>
 </tr>
 <tr>
     <td><a>admin@gmail.com</a>
     </td>
 </tr>
 <tr>
     <td>+237-00-00-00-00 </td>
 </tr>
 </tbody>
 </table>
 </div>
 </div>
 </div>
 <div class="col-md-4">
 <div class="row text-center">
 <div class="col-sm-12 invoice-btn-group">
 <h6>Date printed: '.$datePrinted.'</h6>
 </div>
 </div>
 </div>
 </div>
 <div class="card-block">
 <div class="row invoive-info">
 <div style="text-align: left;" class="col-md-4 col-xs-12 invoice-client-info">
 <h6>Client Information : </h6>
 <p class="m-0">Name: '.$json_clientObject->c_name.'</p>
 <p class="m-0 m-t-10">Address: '.$json_clientObject->c_address.'</p>
 <p class="m-0">Cantact: '.$json_clientObject->c_number.'</p>
 <p><a>Email: '.$json_clientObject->c_email.'</a></p>
 </div>
 <div class="col-md-4 col-sm-6">
 <h6>Order Information : </h6>
 <table class="table table-responsive invoice-table invoice-order table-borderless">
 <tbody>
 <tr>
 <th>Date : </th>
 <td>'.$date.' </td>
 </tr>
 <tr>
 <th>Time : </th>
 <td>'.$time.' </td>
 </tr>
 <tr>
 <th>Status : </th>
 <td>
 '.$status.'
 </td>
 </tr>
 <tr>
 <th>Id : </th>
 <td>
   '.$json_orderObject->order_id.'
 </td>
 </tr>
 </tbody>
 </table>
 </div>
 <div class="col-md-4 col-sm-6">
 <h6 class="m-b-20">Invoice Number  <span>'.$json_orderObject->invoice_number.'</span></h6>
 '.$method.'
 </div>
 </div>
 <div class="row">
 <div class="col-sm-12">
 <div class="table-responsive">
 <table class="table table-sm">
 <thead class="center">
 <tr style="color: white;" class="table-primary">
 <th class="center"><i class="icofont icofont-numbered"></i>#No </th>
 <th class="center">Item Name </th>
 <th class="center">Quantity </th>
 <th class="center">Cost Price </th>
 <th class="center">Unit Price </th>
 <th class="center">Total </th>
 </tr>
 </thead>
 <tbody class="center">';
$i=1;
foreach ($json_detailsObject as $name => $items) {
    $output .= '<tr>
 <td class="center"><h6>'.$i++.'</h6></td>
 <td style="text-align: left;">
 <h6>'.$items->Item_name.'</h6>
 <p>'.$items->Description.' </p>
 </td>
 <td class="center">'.$items->Quantity.'</td>
 <td class="center">'.number_format($items->Cogs).'</td>
 <td class="center">'.number_format($items->Unit_Price).'</td>
 <td class="center">'.number_format($items->Total).' </td>
 </tr>';
}
 $output .='</tbody>
 </table>
 </div>
 </div>
 </div>
 <div class="row">
 <div class="col-sm-12">
 <div class="">
 <table class="table invoice-table invoice-total table-responsive">
 <tbody>
 
 
        <th>Sub Total : </th>
        <td>'.number_format($total).' FCFA</td>
    </tr>
    <tr>
        <th>Paid: </th>
        <td>'.number_format($paid).' FCFA</td>
    </tr>
    <tr>
        <th>Balance: </th>
        <td>'.number_format($balance).' FCFA</td>
    </tr>
 <tr class="text-info">
 <td>
 <hr />
 <h5 class="text-primary">Total : </h5>
 </td>
 <td>
 <hr />
 <h5 class="text-primary">'.number_format($total).' FCFA</h5>
 </td>
 </tr>
 </tbody>
 </table>
 </div>
 </div>
 </div>
 <p style="text-align: center;"> <strong>Authorized By: </strong>'.$auth_name.' </p>
 <hr />
 <div class="row">
 <div style="text-align: left;" class="col-sm-12">
 <h6>Terms And Condition : </h6>
 <p>********************************************************************</p>
 </div>
 </div>
 </div>
 </div>';

print $output;