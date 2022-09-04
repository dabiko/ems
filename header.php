<?php
/**
 * Created by PhpStorm.
 * User: Dabiko Blaise
 * Date: 29-Jun-18
 * Time: 8:59 AM
 */
require_once 'resources/session.php';
require_once 'resources/Database.php';
require_once 'resources/utilities.php';

/** Referencing for the various Modals Used */

//require_once 'createMain_modal.php';
//require_once 'createSub_modal.php';

$RunQuery = new QueryControllers();
if (isset($_SESSION['ems_username']) || isset($_SESSION['ems_id']) || $RunQuery->isCookieValid($adb)) {

}else{
    $RunQuery->redirectToPage('login');
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php if(isset($page_title)) echo $page_title; ?> </title>


    <!--[if lt IE 9]>
    <script src="libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no" />
    <meta name="description" content="#" />
    <meta name="keywords" content="EMS, Equipment Management Syaytem" />
    <meta name="author" content="#" />

    <script src="scripts/js/auth_login.js"></script>
    <script src="scripts/js/category_actions.js"></script>

    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon" />

    <link href="fonts.googleapis.com/css_5e7b61cf.css" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="bower_components/bootstrap/css/bootstrap.min.css" />

    <link rel="stylesheet" type="text/css" href="scripts/css/sweetalert2.min.css" />

    <link rel="stylesheet" type="text/css" href="assets/icon/themify-icons/themify-icons.css" />

    <link rel="stylesheet" type="text/css" href="assets/icon/material-design/css/material-design-iconic-font.min.css" />

    <link rel="stylesheet" type="text/css" href="assets/icon/icofont/css/icofont.css" />

    <link rel="stylesheet" type="text/css" href="assets/pages/flag-icon/flag-icon.min.css" />


    <link rel="stylesheet" type="text/css" href="assets/pages/menu-search/css/component.css" />
    <link rel="stylesheet" type="text/css" href="assets/pages/notification/notification.css" />

    <link rel="stylesheet" type="text/css" href="bower_components/animate.css/css/animate.css" />

    <link rel="stylesheet" href="bower_components/select2/css/select2.min.css" />
    <link rel="stylesheet" type="text/css" href="bower_components/bootstrap-multiselect/css/bootstrap-multiselect.css" />
    <link rel="stylesheet" type="text/css" href="bower_components/multiselect/css/multi-select.css" />

    <link rel="stylesheet" type="text/css" href="bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" type="text/css" href="assets/pages/data-table/css/buttons.dataTables.min.css" />
    <link rel="stylesheet" type="text/css" href="bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" />
    <link rel="stylesheet" type="text/css" href="assets/pages/data-table/extensions/buttons/css/buttons.dataTables.min.css" />


    <link rel="stylesheet" type="text/css" href="assets/pages/dashboard/horizontal-timeline/css/style.css" />

    <link rel="stylesheet" type="text/css" href="assets/pages/dashboard/amchart/css/amchart.css" />

    <link rel="stylesheet" type="text/css" href="assets/pages/widget/calender/pignose.calendar.min.css" />

    <link rel="stylesheet" type="text/css" href="assets/pages/flag-icon/flag-icon.min.css" />




    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />

    <link rel="stylesheet" type="text/css" href="bower_components/jquery.steps/css/jquery.steps.css" />

    <link rel="stylesheet" type="text/css" href="bower_components/chartist/css/chartist.css" />

    <link rel="stylesheet" href="bower_components/c3/css/c3.css" type="text/css" media="all" />



    <link rel="stylesheet" type="text/css" href="assets/css/linearicons.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/simple-line-icons.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/ionicons.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/jquery.mCustomScrollbar.css" />






</head>
<body>

<div class="theme-loader">
    <div class="ball-scale">
        <div> </div>
    </div>

</div>

