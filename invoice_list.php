<?php
$page_title = 'EMS-Invoice List';
/**
 * Created by PhpStorm.
 * User: Dabiko Blaise
 * Date: 29-Jun-18
 * Time: 9:02 AM
 */
require_once 'resources/session.php';
require_once 'header.php';
require_once 'resources/utilities.php';
require_once 'paginationClass.php';
$RunQuery = new QueryControllers();


?>
<style>
    div.pagination {
        font-family: "Lucida Sans", Geneva, Verdana, sans-serif;
        padding:20px;
        margin:7px;
    }
    div.pagination a {
        margin: 2px;
        padding: 0.5em 0.64em 0.43em 0.64em;
        background-color: #3498DB;
        text-decoration: none;
        color: #fff;
        border-radius: 5px;
    }
    div.pagination a:hover, div.pagination a:active {
        padding: 0.5em 0.64em 0.43em 0.64em;
        margin: 2px;
        background-color: #0078D7;
        color: #fff;
    }
    div.pagination span.current {
        padding: 0.5em 0.64em 0.43em 0.64em;
        margin: 2px;
        background-color: #0078D7;
        color: #6d643c;
    }
    div.pagination span.disabled {
        display:none;
    }
</style>
<div id="pcoded" class="pcoded">
    <div class="pcoded-overlay-box"></div>
    <div class="pcoded-container navbar-wrapper">

        <?php require_once 'horizontal_menu.php';?>

        <div class="pcoded-main-container">
            <div class="pcoded-wrapper">

                <?php require_once 'left_menu.php';?>


                <div class="pcoded-content">
                    <div class="pcoded-inner-content">
                        <div class="main-body">
   <div class="page-wrapper">
       <div class="page-header">
           <div class="page-header-title">
               <h4>EMS - Invoice List</h4>
           </div>

           <div class="page-header-breadcrumb">
               <ul class="breadcrumb-title">
                   <li class="breadcrumb-item">
                       <a href="index.php">
                           <i class="icofont icofont-home"></i>
                       </a>
                   </li>
                   <li class="breadcrumb-item"><a style="cursor: pointer;" onclick="return void(0);">Invoice list</a>
                   </li>
                   <li class="breadcrumb-item"><a style="cursor: pointer;" onclick="return RedirectToPage('invoice');">Invoice</a>
                   </li>
               </ul>
           </div>
       </div>

       <div class="page-body invoice-list-page">
           <div class="row">
               <div class="col-xl-3 col-lg-12 push-xl-9">

                   <div class="card">
                       <div class="card-header">
                           <h5 class="card-header-text">Search Invoice </h5></div>
                       <div class="card-block p-t-10">
                           <div class="input-group">
                               <input onkeyup="searchFilter()" type="text" name="searchData"  id="searchData" class="form-control" placeholder="Search by names..." />
                               <span onclick="return searchResults();" class="input-group-addon" id="searchBtn" ><i class="icofont icofont-search"></i></span>
                           </div>
                           <div class="task-right">
                               <div class="task-right-header-status">
                                   <span data-toggle="collapse">Invoice Statitics</span>
                                   <i class="icofont icofont-rounded-down f-right"></i>
                               </div>

                               <div class="taskboard-right-progress">
                                   <h6>Balance Owed </h6>
                                   <div class="faq-progress">
                                       <div class="progress">

                                           <div class="faq-bar3" style="width: 80%;"></div>
                                       </div>
                                   </div>
                                   <h6>Pending Printing</h6>
                                   <div class="faq-progress">
                                       <div class="progress">

                                           <div class="faq-bar1" style="width: 70%;"></div>
                                       </div>
                                   </div>
                                   <h6>Validated Invoice</h6>
                                   <div class="faq-progress">
                                       <div class="progress">

                                           <div class="faq-bar2" style="width: 50%;"></div>
                                       </div>
                                   </div>
                                   <h6>No Balance</h6>
                                   <div class="faq-progress">
                                       <div class="progress">

                                           <div class="faq-bar4" style="width: 60%;"></div>
                                       </div>
                                   </div>
                               </div>


                               <div class="task-right-header-users">
                                   <span data-toggle="collapse">Assign Users </span>
                                   <i class="icofont icofont-rounded-down f-right"></i>
                               </div>
                               <div class="user-box assign-user taskboard-right-users">
                                   <div class="media">
                                       <div class="media-left media-middle photo-table">
                                           <a href="#">
                                               <img class="media-object img-circle" src="assets/images/avatar-1.png" alt="Generic placeholder image" />
                                               <div class="live-status bg-danger"></div>
                                           </a>
                                       </div>
                                       <div class="media-body">
                                           <h6>Josephin Doe </h6>
                                           <p>Santa Ana,CA </p>
                                       </div>
                                   </div>

                               </div>

                               <div class="task-right-header-revision">
                                   <span data-toggle="collapse">Revision </span>
                                   <i class="icofont icofont-rounded-down f-right"></i>
                               </div>
                               <div class="taskboard-right-revision user-box">
                                   <div class="media">
                                       <div class="media-left">
                                           <a class="btn btn-outline-primary btn-lg bg-white txt-muted btn-icon" href="#!" role="button"><i class="icofont icofont-gears"></i>
                                           </a>
                                       </div>
                                       <div class="media-body">
                                           <div class="chat-header">Drop the IE specific _____ for temporal inputs </div>
                                           <p class="chat-header  text-muted">4 minutes ago </p>
                                       </div>

                                   </div>

                                   <div class="media">
                                       <div class="media-left">
                                           <a class="btn btn-outline-danger btn-lg bg-white txt-muted btn-icon" href="#!" role="button"><i class="icofont icofont-share"></i>
                                           </a>
                                       </div>
                                       <div class="media-body">
                                           <div class="chat-header">Have Carousel ignore keyboard ______ </div>
                                           <p class="chat-header  text-muted">12 Dec,2015 </p>
                                       </div>

                                   </div>

                                   <div class="media">
                                       <div class="media-left">
                                           <a class="btn btn-outline-warning btn-lg bg-white txt-muted btn-icon" href="#!" role="button"><i class="icofont icofont-font"></i>
                                           </a>
                                       </div>
                                       <div class="media-body">
                                           <div class="chat-header">Add full font overrides ___ popovers and tooltips </div>
                                           <p class="chat-header text-muted">2 month ago </p>
                                       </div>

                                   </div>

                                   <div class="media">
                                       <div class="media-left">
                                           <a class="btn btn-outline-success btn-lg bg-white txt-muted btn-icon" href="#!" role="button"><i class="icofont icofont-responsive"></i>
                                           </a>
                                       </div>
                                       <div class="media-body">
                                           <div class="chat-header">Responsive Asssignment </div>
                                           <p class="chat-header  text-muted">6 month ago </p>
                                       </div>

                                   </div>

                               </div>

                           </div>

                       </div>

                   </div>

               </div>
               <script src="scripts/js/jquery2.1.1.min.js"></script>
               <script>
                   function searchFilter(page_num) {
                       page_num = page_num?page_num:0;
                       var keywords = $('#searchData').val();
                       var sortBy = $('#sortBy').val();
                       $.ajax({
                           type: 'POST',
                           url: 'getData',
                           data:'page='+page_num+'&keywords='+keywords+'&sortBy='+sortBy,
                           beforeSend: function () {
                               $("#overlay").show();
                               setInterval(function() {
                                   $("#overlay").hide();
                               },3000);
                           },
                           success: function (html) {
                               $("#pagination-result").html(html);
                               $("#overlay").fadeOut("slow");
                           }
                       });
                   }



                   /**Function to refresh Invoice list page with the getresult(); and changePagination(); Functions */
               function refreshPage(option) {
                       $("#searchData").val(" ");
                       $("#pagination-setting").trigger("reset");
                       $("#filter_method").trigger("reset");
                       $("#filter_search").trigger("reset");
                   $("#remove").remove();
                   _("refresh").innerHTML = '<i class="ti-reload rotate-refresh"></i>';
                   $("#refresh").show();
                   setTimeout(function () {
                       $("#refresh").hide();
                       _("replace").innerHTML ='<i  id="remove" class="icofont icofont-refresh"></i>';
                       $("#replace").show();
                       }, 3000);
                       searchFilter();

               }

               </script>


               <div class="col-xl-9 col-lg-12 pull-xl-3 filter-bar">

                   <nav class="navbar navbar-light bg-faded m-b-30 p-10">

                       <div class="nav-item nav-grid">
                           <span class="m-r-15"><i class="icofont icofont-money"></i> Payment Method</span>
                           <select name="filter_method" id="filter_method" onChange="paymentMethod(this.value);" class="form-control">
                               <option value="all">All</option>
                               <option value="1">Cash</option>
                               <option value="2">Check</option>
                               <option value="3">Credit</option>
                           </select>
                       </div>

                       <div class="nav-item nav-grid">
                           <span class="m-r-15"><i class="icofont icofont-sub-listing"></i> Search</span>
                           <select name="filter_search" id="filter_search" onChange="searchStatus(this.value);" class="form-control">
                               <option value="all">All Invoice</option>
                               <option value="balance">Balance</option>
                               <option value="printed">Printed</option>
                               <option value="pending">Pending</option>
                               <option value="needs_printing">Needs Printing</option>
                           </select>
                       </div>

                       <div class="nav-item nav-grid">
                           <span class="m-r-15"><i class="icofont icofont-page"></i> Pagination Setting  </span>
                           <select name="sortBy" id="sortBy" onChange="searchFilter(); refreshPage(this.value)" class="form-control">
                               <option value="asc">Ascending Order</option>
                               <option value="desc">Descending Order</option>
                           </select>
                       </div>

                       <div class="nav-item nav-grid">
                           <span class="m-r-15"><i class="icofont icofont-chart-histogram-alt"></i> Refresh List  </span>
                           <button name="refreshPage" id="refreshPage" onclick="return refreshPage(); " type="button" class="pagination-setting btn btn-sm btn-primary waves-effect waves-light m-r-10"  data-placement="top" title="Refresh Invoive List">
                               <i  id="remove" class="icofont icofont-refresh"></i>
                               <i  id="replace" ></i>
                               <i  id="refresh" ></i>
                           </button>
                       </div>

                   </nav>



                   <div class="loader-block" id="overlay"  style="background-color:transparent;z-index: 999;position: absolute;left: 0;top: 0;width: 100%;height: 100%;display: none;">
                       <div class="preloader6">
                           <hr />
                       </div>
                   </div>

                   <div class="row" id="pagination-result">

                       <?php

                       $limit = 6;

                       /** @var  $adb, get number of rows */
                       $adb = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
                       $queryNum = $adb->query("SELECT COUNT(*) as InvoiceNum FROM invoice");
                       $resultNum = $queryNum->fetch();
                       $rowCount = $resultNum['InvoiceNum'];

                       /** @var  $pagConfig,initialize pagination class */
                       $pagConfig = array(
                           'totalRows' => $rowCount,
                           'perPage' => $limit,
                           'link_func' => 'searchFilter'
                       );
                       $pagination =  new Pagination($pagConfig);


                       $stmt = $adb->prepare("SELECT * FROM invoice  ORDER BY in_id DESC LIMIT $limit");
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

      </div>
      <hr />';

     }


   $output .= '<div id="pagination">
    <nav aria-label="pagination example">
    <ul class="pagination pagination-circle pg-blue mb-0">
      ' .$pagination->createLinks(). '
      </ul>
</nav></div>';



   }else{
      $output .='
           <div  style="text-align: center" class="alert alert-info icons-alert col-md-12">
             <p  style="text-align: center"><strong>Oops!!! </strong> No Results found :)</p>
            </div>';
}

                       print $output;

                                                ?>

                                            </div>


                                            <script>
                                                //getresult("getresult");
                                            </script>


                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php require_once 'footer.php'; ?>

