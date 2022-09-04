<?php
require_once 'resources/utilities.php';
require_once 'searchPaginationClass.php';

$RunQuery = new QueryControllers();
$perPage = new searchPaginationClass();

$paginationlink = "searchResults?page=";
$pagination_setting = $_GET["pagination-setting"];

$page = 1;
if(!empty($_GET["page"])) {
    $page = $_GET["page"];
}

$start = ($page-1)*$perPage->SetDisplaySearchLimit;
if($start < 0) $start = 0;
$start = ($page-1) * $perPage->SetDisplaySearchLimit;
if($start < 0) $start = 0;

try {


    $searchData= $_GET['searchData'];

    $adb = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
    $Query = "SELECT * FROM invoice WHERE JSON_SEARCH(client_info,'all','%$searchData%') IS NOT NULL LIMIT $start,$perPage->SetDisplaySearchLimit ";
    $stmt = $adb->prepare($Query);
    $stmt->execute();

    $Count = $stmt->rowCount();

    if(empty($_GET["searchCount"]) || $_GET["searchCount"] == 0 ) {
        $_GET["searchCount"] = $Count;
    }

    if($pagination_setting == "prev-next") {
        $perpageresult = $perPage->getPrevNext($_GET["searchCount"], $paginationlink,$pagination_setting);
    } else {
        $perpageresult = $perPage->getAllPageLinks($_GET["searchCount"], $paginationlink,$pagination_setting);
    }

    $output = " " ;
    if ($Count  > 0){
        while($row = $stmt->fetch()) {
            $output .= '<div class="question"><input type="hidden" id="searchCount" name="searchCount" value="' . $_GET["searchCount"] . '" /></div>';

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
                              <li><strong>Invoice No: </strong>&nbsp;' . $json_orderObject->order_id . '</li>
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



    }else{
        $output .='
           <div  style="text-align: center" class="alert alert-info icons-alert col-md-12">
             <p  style="text-align: center"><strong>Oops!!! </strong> No Results found :)</p>
            </div>';
    }

    if(!empty($perpageresult)) {
        $output .= '<div id="pagination">' . $perpageresult . '</div>';
    }


    print $output;

}
catch (PDOException $e) {
    echo 'There was an Error: ' . $e->getMessage();

}








?>