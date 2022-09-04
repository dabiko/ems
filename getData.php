<?php
/**
 * Created by PhpStorm.
 * User: Dabiko Blaise
 * Date: 10-Aug-18
 * Time: 12:30 AM
 */
require_once 'resources/session.php';
require_once 'resources/utilities.php';
require_once 'paginationClass.php';

if(isset($_POST['page'])) {

    $adb = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
    $start = !empty($_POST['page']) ? $_POST['page'] : 0;
    $limit = 6;

    //set conditions for search
    $whereSQL = $orderSQL = '';
    $keywords = $_POST['keywords'];
    $sortBy = $_POST['sortBy'];
    if (!empty($keywords)) {
        $whereSQL = "WHERE client_name LIKE '%" . $keywords . "%'";
    }
    if (!empty($sortBy)) {
        $orderSQL = " ORDER BY in_id " . $sortBy;
    } else {
        $orderSQL = " ORDER BY in_id DESC ";
    }


    $queryNum = $adb->query("SELECT COUNT(*) as InvoiceNum FROM invoice ".$whereSQL.$orderSQL);
    $resultNum = $queryNum->fetch();
    $rowCount = $resultNum['InvoiceNum'];

    //initialize pagination class
    $pagConfig = array(
        'currentPage' => $start,
        'totalRows' => $rowCount,
        'perPage' => $limit,
        'link_func' => 'searchFilter'
    );
    $pagination = new Pagination($pagConfig);

    //get rows
    $stmt = $adb->prepare("SELECT * FROM invoice $whereSQL $orderSQL LIMIT $start,$limit");
    $stmt->execute();
    $Count = $stmt->rowCount();

    $output = " " ;
    if ($Count  > 0){
        while($row = $stmt->fetch()) {


            $in_id = $row['in_id'];
            $client_info = $row['client_info'];
            $order_info = $row['order_info'];

            if ($row['balance'] == 0) {
                $balance = '<li><strong>Balance: </strong><span class="btn btn-info btn-mini b-none">' . @number_format($row['balance']) . ' FCFA</span></li>';
            } elseif ($row['balance'] !== 0 || $row['balance'] > 0) {
                $balance = '<li><strong>Balance: </strong><span class="btn btn-danger btn-mini b-none">' . @number_format($row['balance']) . ' FCFA</span></li>';
            }


            if ($row['balance'] == 0) {
                $status = '<button class="btn btn-success btn-mini waves-effect waves-light" type="button">Validated</button>';
            } elseif ($row['balance'] !== 0 || $row['balance'] > 0) {
                $status = '<button class="btn btn-warning btn-mini waves-effect waves-light" type="button">Pending</button>';
            }

            if ($row['print'] == 1) {
                $print = '<a onclick="restrictPrint(' . $in_id . '); return false;"  style="color: #f9fafd" class="btn btn-info btn-mini b-none"><i class="icofont icofont-print m-0"></i></a>';
            } elseif ($row['print'] == 0) {
                $print = '<a onclick="restrictPrint(' . $in_id . '); return false;" style="color: #f9fafd"  class="btn btn-info btn-mini b-none"><i class="icofont icofont-print m-0"></i></a>';
            }

            if ($row['print'] == 1) {
                $edit = '<a onclick="restrictEdit(' . $in_id . '); return false;"  style="color: #f9fafd" class="btn btn-info btn-mini b-none"><i class="icofont icofont-edit-alt"></i></a>';
            } elseif ($row['print'] == 0) {
                $edit = '<a onclick="restrictEdit(' . $in_id . '); return false;"  style="color: #f9fafd" class="btn btn-info btn-mini b-none"><i class="icofont icofont-edit-alt"></i></a>';
            }

            $view = ' <a onclick="viewInvoice(' . $in_id . '); return false;" style="color: #f9fafd" class="btn btn-info btn-mini b-none"><i class="icofont icofont-eye-alt m-0"></i></a>';

            if ($row['p_method'] == 1){
                $method = 'Cash';
            }elseif ($row['p_method'] == 2){
                $method = 'Check';
            }elseif ($row['p_method'] == 3){
                $method = 'Credit';
            }


            $details = $row['in_details'];
            $total = @number_format($row['total']) . ' FCFA';

            $print_date = $row['date_printed'];

            /**Decoding  the JSON data for PHP access as Objects and removing unwanted strings */
            $clientData = stripcslashes($client_info);
            $json_clientObject = json_decode($clientData);

            /**Decoding  the JSON data for PHP access as Objects and removing unwanted strings */
            $orderData = stripcslashes($order_info);
            $json_orderObject = json_decode($orderData);

            /**Formatting the order date, day and time */
            //$date = $json_orderObject->order_date;
            $date = strftime("%b %d, %Y", strtotime($json_orderObject->order_date));
            $time = date('D, h:m A', strtotime($json_orderObject->order_date));;

            /** implementing the Ago time*/
            date_default_timezone_set('Africa/Douala');
            $AgoDate = $json_orderObject->order_date;
            $printed_at = $AgoDate;
            $Ago = new convertToAgo();
            $unit_timestamp = $Ago->convert_datetime($printed_at);
            $ago = $Ago->makeAgo($unit_timestamp);

            /**Decoding  the JSON data for PHP access as Objects and removing unwanted strings */
            $detailsData = stripcslashes($details);
            $json_detailsObject = json_decode($detailsData);

            foreach ($json_detailsObject as $name => $items) {}


            $output .= '<div class="col-sm-6">
                <div class="card card-border-primary">
              <div class="card-header">
                  <h5>' . $json_clientObject->c_name . '</h5>

                  <div class="dropdown-secondary dropdown f-right">
                      ' . $status . '
                      <span class="f-left m-r-5 text-inverse">Status :  </span>
                  </div>
                  
              </div>
              <div class="card-block">
                  <div class="row">
                      <div class="col-sm-6">
                          <ul class="list list-unstyled">
                              <li><strong>Order Id: </strong>&nbsp;' . $json_orderObject->order_id . '</li>
                              <li><strong>Issued on : </strong><span class="text-semibold">' . $date . '</span></li>
                              <li><strong>Time:  </strong> <span class="text-semibold">' . $time . '</span></li>
                          </ul>
                      </div>
                      <div class="col-sm-6">
                          <ul class="list list-unstyled text-right">
                              <li>' . $total . '</li>
                               ' . $balance . '
                              <li><strong>Method: </strong><span class="text-semibold">' . $method . '</span></li>
                          </ul>
                      </div>
                  </div>
              </div>
              <div class="card-footer">
                  <div class="task-list-table">
                      <p class="task-due"><strong> Due :  </strong><strong class="label label-info">' . $ago . '</strong></p>
                  </div>
                  <div class="task-board m-0">
                       ' . $print . '
                       ' . $edit . '
                       ' . $view . '
                  </div>

              </div>

          </div>

      </div>';
             }
        $output .= '<div id="pagination">' .$pagination->createLinks(). '</div>';




        }else{
        $output .='
           <div  style="text-align: center" class="alert alert-info icons-alert col-md-12">
             <p  style="text-align: center"><strong>Oops!!! </strong> No Results found :)</p>
            </div>';
    }

    print $output;
}