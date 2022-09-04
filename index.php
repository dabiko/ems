<?php
$page_title = 'EMS-Home';
/**
 * Created by PhpStorm.
 * User: Dabiko Blaise
 * Date: 29-Jun-18
 * Time: 9:02 AM
 */
require_once 'header.php';
?>

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
 <h4>Dashboard </h4>
 </div>
 <div class="page-header-breadcrumb">
 <ul class="breadcrumb-title">
 <li class="breadcrumb-item">
 <a onclick="return RedirectToPage('index');">
 <i class="icofont icofont-home"></i>
 </a>
 </li>
 <li class="breadcrumb-item"><a style="cursor: pointer;" onclick="return void(0);">Home </a>
 </li>
 <li class="breadcrumb-item"><a style="cursor: pointer;" onclick="return void(0);">Dashboard </a>
 </li>
 </ul>
 </div>
 </div>
 <div class="page-body">
 <div class="row">

 <div class="col-md-12 col-xl-4">
 <div class="card widget-statstic-card borderless-card">
 <div class="card-header">
 <div class="card-header-left">
 <h5>Statistics </h5>
 <p class="p-t-10 m-b-0 text-muted">Compared to last week </p>
 </div>
 </div>
 <div class="card-block">
 <i class="icofont icofont-presentation-alt st-icon bg-primary"></i>
 <div class="text-left">
 <h3 class="d-inline-block">5,456 </h3>
 <i class="icofont icofont-long-arrow-up f-30 text-success"></i>
 <span class="f-right bg-success">23% </span>
 </div>
 </div>
 </div>
 </div>


 <div class="col-md-6 col-xl-4">
 <div class="card widget-statstic-card borderless-card">
 <div class="card-header">
 <div class="card-header-left">
 <h5>Daily order </h5>
 <p class="p-t-10 m-b-0 text-muted">Compare to yesterday </p>
 </div>
 </div>
 <div class="card-block">
 <i class="icofont icofont-users-social st-icon bg-warning txt-lite-color"></i>
 <div class="text-left">
 <h3 class="d-inline-block">600 </h3>
 <i class="icofont icofont-long-arrow-down text-danger f-30 "></i>
 <span class="f-right bg-danger">-5% </span>
 </div>
 </div>
 </div>
 </div>


 <div class="col-md-6 col-xl-4">
 <div class="card widget-statstic-card borderless-card">
 <div class="card-header">
 <div class="card-header-left">
 <h5>Revenue 2017 </h5>
 <p class="p-t-10 m-b-0 text-muted">This year revenue </p>
 </div>
 </div>
 <div class="card-block">
 <i class="icofont icofont-chart-line st-icon bg-success"></i>
 <div class="text-left">
 <h3 class="d-inline-block">$2,65,500 </h3>
 </div>
 </div>
 </div>
 </div>



 <div class="col-xl-8 col-md-6">
 <div class="card">
 <div class="card-block">
 <h5>Analytics </h5>
 </div>
 <div class="card-block">
 <div id="analythics-graph" style="height:365px"></div>
 </div>
 </div>
 </div>




 <div class="col-xl-4 col-md-6">
 <div class="user-card-block card">
 <div class="card-block">
 <div class="top-card text-center">
 <img src="assets/images/widget/user1.png" class="img-responsive" alt="" />
 </div>
 <div class="card-contain text-center p-t-40">
 <h5 class="text-capitalize p-b-10">Gregory Johnes </h5>
 <p class="text-muted">Califonia, USA </p>
 </div>
 <div class="card-data m-t-40">
 <div class="row">
 <div class="col-3 b-r-default text-center">
 <p class="text-muted">Followers </p>
 <span>345 </span>
 </div>
 <div class="col-3 b-r-default text-center">
 <p class="text-muted">Following </p>
 <span>40 </span>
 </div>
 <div class="col-3 b-r-default text-center">
 <p class="text-muted">Questions </p>
 <span>12 </span>
 </div>
 <div class="col-3 text-center">
 <p class="text-muted">Answers </p>
 <span>40 </span>
 </div>
 </div>
 </div>
 <div class="card-button p-t-50">
 <div class="row">
 <div class="col-6 text-right">
 <button class="btn btn-primary btn-round">Follow </button>
 </div>
 <div class="col-6 text-left">
 <button class="btn btn-success btn-round">Message </button>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>



 <div class="col-md-12 col-xl-4">

 <div class="row">
 <div class="col-xl-12 col-md-6">
 <div class="card">
 <div class="card-block-big card-status">
 <h5>Income Status </h5>
 <div class="card-block text-center">
 <h2 class="text-primary">$4,612 </h2>
 </div>
 <div class="row">
 <div class="col-6">
 <p class="f-16 text-muted m-0">Totale Income : $4,679 </p>
 </div>
 <div class="col-6">
 <div class="text-muted f-16 text-right">
 <span>20.56% </span>
 <i class="icofont icofont-caret-up text-success"></i>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 <div class="col-xl-12 col-md-6">
 <div class="card">
 <div class="card-block-big card-status">
 <h5>Sale Status </h5>
 <div class="card-block text-center">
 <h2 class="text-warning">425 </h2>
 </div>
 <div class="row">
 <div class="col-6">
 <p class="f-16 text-muted m-0">Totale Income : 3,712 </p>
 </div>
 <div class="col-6">
 <div class="text-muted f-16 text-right">
 <span>20.56% </span>
 <i class="icofont icofont-caret-down text-primary"></i>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>



     <div class="col-md-12 col-xl-8">

         <div class="card">
             <div class="card-header">
                 <h5>Summary </h5>
                 <div class="card-header-right">
                     <i class="icofont icofont-rounded-down"></i>
                     <i class="icofont icofont-refresh"></i>
                     <i class="icofont icofont-close-circled"></i>
                 </div>
             </div>
             <div class="card-block">
                 <div id="chart2"></div>
             </div>
         </div>

     </div>


 <div class="col-md-12 col-xl-12">
     <div class="card">
         <div class="card-header">
             <h5>Sales and Expenses </h5>
             <div class="card-header-right">
                 <i class="icofont icofont-rounded-down"></i>
                 <i class="icofont icofont-refresh"></i>
                 <i class="icofont icofont-close-circled"></i>
             </div>
         </div>
         <div class="card-block text-center">
             <canvas id="barChart" width="400" height="270"></canvas>
         </div>
     </div>
 </div>


     <div class="col-md-12 col-xl-12">

         <div class="card">
             <div class="card-header">
                 <h5>Top Expense </h5>
                 <div class="card-header-right">
                     <i class="icofont icofont-rounded-down"></i>
                     <i class="icofont icofont-refresh"></i>
                     <i class="icofont icofont-close-circled"></i>
                 </div>
             </div>
             <div class="card-block text-center">
                 <div id="chart3"></div>
             </div>
         </div>

     </div>

 </div>
 </div>
 </div>
 <div id="styleSelector">
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>

<script type="text/javascript" src="scripts/js/notification.js"></script>
<?php
require_once 'footer.php';
?>


 