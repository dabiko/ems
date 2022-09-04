<?php
/**
 * Created by PhpStorm.
 * User: Dabiko Blaise
 * Date: 29-Jun-18
 * Time: 9:02 AM
 */
require_once 'resources/session.php';
require_once 'resources/utilities.php';

?>



         <div class="card" id="invoice_pdf">
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

                 </div>
             </div>
             <?php
             $encodedID = $_POST['edit_id'];
             $ID = base64_decode(urldecode($encodedID));

             $selectQuery = "SELECT * FROM invoice".
                 " INNER JOIN users AS u USING(users_id) WHERE in_id = $ID";
             $statement =$adb->prepare($selectQuery);
             $statement->execute();
             $row = $statement->fetch();

             $in_id = $row['in_id'];
             $details = $row['in_details'];

             $total = $row['total'];
             $print_date = $row['date_printed'];

             $auth_name = $row['names'];

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



             if($row['balance'] == 0){
                 $print = '<button type="button" class="btn btn-primary btn-print-invoice waves-effect waves-light m-r-20 m-b-10">Print Invoice</button>';
             }elseif($row['balance'] !== 0){
                 $print = '<button type="button"  style="cursor:not-allowed;" disabled=disabled class="btn btn-danger btn-print-invoice waves-effect waves-light m-r-20 m-b-10">Print Invoice</button>';
             }

             $paid = $total - $row['balance'];
             $balance = $row['balance'];

             if ($balance > 0){
                 $status = '<span class="label label-warning">Pending... </span>';
             }else{
                 $status = '<span class="label label-success">Validated</span>';
             }

             if ($row['p_method'] == 1){

                 $method = ' <option  selected=selected value="1">Cash</option>
                             <option   value="2">Check</option>
                             <option   value="3">Credit</option>';

             }elseif ($row['p_method'] == 2){

                 $method = ' <option  selected=selected value="2">Check</option>
                              <option   value="1">Cash</option>
                              <option   value="3">Credit</option>';

             }elseif ($row['p_method'] == 3){

                 $method = ' <option  selected=selected value="3">Credit</option>
                             <option   value="2">Check</option>
                             <option   value="1">Cash</option>';

             }

             if ($row['print'] == 0){
                 $datePrinted = 'Pending';
             }else{
                 $datePrinted = strftime("%b %d, %Y", strtotime($row['date_printed']))."</br>".
                     date('D, h:m A', strtotime($row['date_printed']));
             }

             /**Decoding  the JSON data for PHP access as Objects and removing unwanted strings */
             $detailsData = stripcslashes($details);
             $json_detailsObject = json_decode($detailsData);

             echo '<form id="invoiceForm" onsubmit="EditedInvoice(); return false;" method="POST" action="#">
                 <div class="card-block">
                     <div class="row invoive-info">
                         <div class="col-md-4 col-xs-12 invoice-client-info">
                             <h6>Client Information : </h6>
                             <div class="input-group input-group-default">
                                 <span class="input-group-addon">Name :</span>
                                 <input id="editC_name" name="c_name" style="color: black;" type="text" class="form-control" value="'.$json_clientObject->c_name.'" />
                             </div>
                             <div class="input-group input-group-default">
                                 <span class="input-group-addon">Address :</span>
                                 <input id="editC_address" name="c_address" style="color: black;" type="text" class="form-control" value="'.$json_clientObject->c_address.'" />
                             </div>
                             <div class="input-group input-group-default">
                                 <span class="input-group-addon">Tel :</span>
                                 <input id="editC_num" name="c_num" style="color: black;" type="text" class="form-control" value="'.$json_clientObject->c_number.'" />
                             </div>
                             <div class="input-group input-group-default">
                                 <span class="input-group-addon">Email :</span>
                                 <input id="editC_email" name="c_email" style="color: black;" type="text" class="form-control" value="'.$json_clientObject->c_email.'" />
                                  <input id="invoice_id" name="invoice_id" style="color: black;" type="hidden" class="form-control" value="'.$in_id.'" />
                             </div>
                         </div>
                         
                         <div class="col-md-4 col-sm-6">
                             <h6>Order Information : </h6>
                             <table class="table table-responsive invoice-table invoice-order table-borderless">
                                 <tbody>
                                 <tr>
                                     <th>Date : </th>
                                     <td>'.$date.'</td>
                                 </tr>
                                 <tr>
                                     <th>Time : </th>
                                     <td>'.$time.'</td>
                                 </tr>
                                 <tr>
                                     <th>Status : </th>
                                     <td>
                                         '.$status.'
                                     </td>
                                 </tr>
                                 <tr>
                                     <th>Id : </th>
                                     <td>'.$json_orderObject->order_id.'</td>
                                 </tr>
                                 </tbody>
                             </table>
                         </div>
                         <div class="col-md-4 col-sm-6">
                             <div class="row">
                             <h6 class="m-b-20">Invoice Number: <span>'.$json_orderObject->invoice_number.' </span></h6>
                             <span class="m-r-15">Payment Method</span>
                             <select name="edit_method" id="edit_method" class="form-control">
                                 '.$method.'
                             </select>
                         </div>
                          </div>
                     </div>
                    
                     <div class="row">
                         <div class="col-sm-12">
                             <div class="dt-responsive table-responsive">
                                 <table class="table   " id="editRows">
                                    <div id="editInError"></div>
                                     <thead>
                                     <tr style="color: white;" class="table-primary">
                                  
                                     <th><i class="icofont icofont-numbered"></i>#No</th>
                                     <th>Item Name</th>
                                     <th>Quantity </th>
                                     <th>Cost Price</th>
                                     <th>Unit Price(FCFA)</th>
                                     <th>Total(FCFA)</th>
                                     </tr>
                                     </thead><tbody>';
                                         $i=1;
                                         foreach ($json_detailsObject as $name => $items) {

                                             echo '
                                 <tr>
                              <td><button disabled=disabled style="width: 30px; height: 30px;" name="editBtn" id="editBtn" class="btn btn-primary btn-outline-primary btn-icon">'.$i++.'</button></td>                                                
                              <td><input style="color: black;" readonly="readonly" class="form-control input-sm" type="text" name="editStocks" id="editStocks" value="'.$items->Item_name.'"></td>
                              <td><input style="color: black;" readonly="readonly" class="form-control input-sm" type="text" name="editQty" id="editQty" value="'.$items->Quantity.'"></td>
                              <td><input style="color: black;" readonly="readonly" class="form-control input-sm"  type="text" name="editCog" id="editCog" value="'.number_format($items->Cogs).'"></td>
                              <td><input style="color: black;" readonly="readonly" class="form-control input-sm" type="text" name="editUp" id="editUp" value="'.number_format($items->Unit_Price).'"></td>
                              <td><input style="color: black;" readonly="readonly" class="form-control input-sm" type="text" name="editTp" id="editTprice'.$i.'" value="'.number_format($items->Total).' " </td>
                              </tr>
                              ';
                                         }


                                    echo '</tbody>
                                 </table>
                                 <div class="col-sm-12 invoice-btn-group">
                                     <button type="submit" class="btn btn-primary btn-print-invoice waves-effect waves-light btn-round"><i class="icofont icofont-upload-alt"></i>Update Invoice</button>
                                 </div>
                                   <hr>
                                   <div id="editInError"></div>
                             </div>
                         </div>
                     </div>
                     
                     <div class="row">
                         <div class="col-sm-12">
                             <div class="">
                                 <table  class="table invoice-table invoice-total table-responsive">
                                     <tbody>
                                    <tr>
                                     <th>Sub Total : </th>
                                     <td><input readonly=readonly style="color: black;" id="editSub_total" name="editSub_total" type="text" class="form-control" value="'.$total.'"/> </td>
                                 </tr>
                                 <tr>
                                     <th>Paid: </th>
                                     <td>
                                         <input onKeyPress="noSpacesEdit(this); keypressPaidEdit(); " onKeyUp=" noSpacesEdit(this); keypressPaidEdit(); " value="'.$paid.'" style="color: black;" id="editPaid" name="editPaid" type="text" class="form-control"/>
                                         <input  style="color: black;" id="hidden" name="hidden" type="hidden" value="'.$paid.'"  class="form-control"/>
                                         <input  style="color: black;" id="hide_paid" name="hide_paid" type="hidden" value="'.$paid.'" class="form-control"/>
                                     </td>
                                 </tr>
                                 <tr>
                                     <th>Due: </th>
                                     <td>
                                     <input readonly=readonly style="color: black;" id="edit_due" name="edit_due" type="text" class="form-control" value="'.$balance.'"/>
                                     <input  style="color: black;" id="hide_due" name="hide_due" type="hidden" class="form-control" value="'.$balance.'"/>
                                     </td>
                                 </tr>
                                     <tr class="text-info">
                                         <td>
                                             <hr />
                                             <h5 class="text-primary">Total:</h5>
                                         </td>
                                         <td class="">
                                             <hr />
                                             <h5 class="text-primary">
                                                 <input readonly=readonly style="color: black;" id="" name="" type="text" class="form-control" value="'.number_format($total).' FCFA"/> </h5>
                                         </td>
                                     </tr>
                                     </tbody>
                                 </table>
                             </div>
                         </div>
                     </div>
                     <p style="text-align: center;"> <strong>Authorized By: '.$auth_name.'</p>
                     <hr />
                     <div class="row">
                         <div style="text-align: left;" class="col-sm-12">
                             <h6>Terms And Condition : </h6>
                             <p>*******************88*********************************</p>
                         </div>
                     </div>
                 </div>
             </form>';

             ?>

    </div>
