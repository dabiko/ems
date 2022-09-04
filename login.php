<?php
$page_title = 'EMS-Login';
/**
 * Created by PhpStorm.
 * User: Dabiko Blaise
 * Date: 29-Jun-18
 * Time: 9:51 AM
 */
ob_start();  ob_end_clean();
require_once 'resources/session.php';
require_once 'resources/utilities.php';


$RunQuery = new QueryControllers();
if (isset($_SESSION['ems_username']) || isset($_SESSION['ems_id']) || $RunQuery->isCookieValid($adb)) {
    $RunQuery->redirectToPage('index');
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
    <meta name="keywords" content="flat ui, Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app" />
    <meta name="author" content="#" />

    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon" />

    <link href="fonts.googleapis.com/css_5e7b61cf.css" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="bower_components/bootstrap/css/bootstrap.min.css" />

    <link rel="stylesheet" type="text/css" href="bower_components/sweetalert/css/sweetalert.css" />

    <link rel="stylesheet" type="text/css" href="assets/icon/themify-icons/themify-icons.css" />

    <link rel="stylesheet" type="text/css" href="assets/icon/icofont/css/icofont.css" />

    <link rel="stylesheet" type="text/css" href="assets/pages/flag-icon/flag-icon.min.css" />


    <link rel="stylesheet" type="text/css" href="assets/pages/menu-search/css/component.css" />

    <link rel="stylesheet" type="text/css" href="assets/pages/dashboard/horizontal-timeline/css/style.css" />

    <link rel="stylesheet" type="text/css" href="assets/pages/dashboard/amchart/css/amchart.css" />

    <link rel="stylesheet" type="text/css" href="assets/pages/widget/calender/pignose.calendar.min.css" />

    <link rel="stylesheet" type="text/css" href="assets/pages/flag-icon/flag-icon.min.css" />

    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />

    <link rel="stylesheet" type="text/css" href="assets/css/linearicons.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/simple-line-icons.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/ionicons.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/jquery.mCustomScrollbar.css" />

    <script src="scripts/js/auth_login.js"></script>
</head>
<body class="fix-menu">
<section  style="background-image: url('scripts/img/');" class="login p-fixed d-flex text-center bg-primary common-img-bg">

    <div class="container">
        <div class="row">
            <div class="col-sm-12">

                <div class="login-card card-block auth-body m-auto">
                    <form id="loginForm" onsubmit="loginForm(); return false;" method="POST" class="md-float-material">
                        <div class="text-center">
                            <img src="assets/images/logo.png" alt="logo.png" />
                        </div>
                        <div class="auth-box">
                            <div class="row m-b-20">
                                <div class="col-md-12">
                                    <h3 class="text-center txt-primary">Sign In </h3>
                                </div>
                            </div>
                            <div id="loginError"></div>
                            <hr />
                            <div class="input-group">
                                    <span class="input-group-addon">
                                       <i class="icofont icofont-email"></i>
                                    </span>
                                <input type="text" name="email" id="email" class="form-control" placeholder="Your Email Address" />
                                <span class="md-line"></span>
                            </div>
                            <div class="input-group">
                                     <span class="input-group-addon">
                                       <i class="icofont icofont-lock"></i>
                                    </span>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Password" />
                                <span class="md-line"></span>
                            </div>
                            <div class="row m-t-25 text-left">
                                <div class="col-sm-7 col-xs-12">
                                    <div class="checkbox-fade fade-in-primary">
                                        <label>
                                            <input type="checkbox"  id="remember" name="remember" value="" />
                                            <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                            <span class="text-inverse">Remember me </span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-5 col-xs-12 forgot-phone text-right">
                                    <a href="#" class="text-right f-w-600 text-inverse"> Forgot Password? </a>
                                </div>
                            </div>

                            <div class="row m-t-30">
                                <div class="col-md-12">
                                    <button type="submit" id="loginBtn" name="loginBtn" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">
                                        Sign in <i id="msgSubmit"></i>
                                    </button>
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-9">
                                    <p class="text-inverse text-left m-b-0">&copy; EMS All Right Reserved <?php echo date('Y')?></p>
                                    <p class="text-inverse text-left"><a style="color: black;" href="http://katambatech.com/" target="_blank"><b>Powered-By : Katamba-Tech </b></a></p>
                                </div>
                                <div class="col-3">
                                    <img src="assets/images/auth/Logo-small-bottom.png" alt="small-logo.png" />
                                </div>
                            </div>
                        </div>
                    </form>

                </div>

            </div>

        </div>

    </div>

</section>
<script type="text/javascript" src="bower_components/jquery/js/jquery.min.js"></script>
<script src="bower_components/jquery-ui/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="bower_components/popper.js/js/popper.min.js"></script>
<script type="text/javascript" src="bower_components/bootstrap/js/bootstrap.min.js"></script>

<script type="text/javascript" src="bower_components/jquery-slimscroll/js/jquery.slimscroll.js"></script>

<script type="text/javascript" src="bower_components/modernizr/js/modernizr.js"></script>
<script type="text/javascript" src="bower_components/modernizr/js/css-scrollbars.js"></script>

<script type="text/javascript" src="bower_components/moment/js/moment.min.js"></script>
<script type="text/javascript" src="assets/pages/widget/calender/pignose.calendar.min.js"></script>

<script type="text/javascript" src="bower_components/classie/js/classie.js"></script>

<script src="bower_components/c3/js/c3.js"></script>

<script src="assets/pages/chart/knob/jquery.knob.js"></script>
<script type="text/javascript" src="assets/pages/widget/jquery.sparkline.js"></script>

<script src="bower_components/d3/js/d3.js"></script>
<script src="bower_components/rickshaw/js/rickshaw.js"></script>

<script src="bower_components/raphael/js/raphael.min.js"></script>
<script src="bower_components/morris.js/js/morris.js"></script>

<script type="text/javascript" src="assets/pages/todo/todo.js"></script>

<script src="assets/pages/chart/float/jquery.flot.js"></script>
<script src="assets/pages/chart/float/jquery.flot.categories.js"></script>
<script src="assets/pages/chart/float/jquery.flot.pie.js"></script>

<script src="assets/pages/chart/echarts/js/echarts-all.js" type="text/javascript"></script>

<script type="text/javascript" src="assets/pages/dashboard/horizontal-timeline/js/main.js"></script>

<script type="text/javascript" src="assets/pages/dashboard/amchart/js/amcharts.js"></script>
<script type="text/javascript" src="assets/pages/dashboard/amchart/js/serial.js"></script>
<script type="text/javascript" src="assets/pages/dashboard/amchart/js/light.js"></script>
<script type="text/javascript" src="assets/pages/dashboard/amchart/js/custom-amchart.js"></script>

<script type="text/javascript" src="bower_components/i18next/js/i18next.min.js"></script>
<script type="text/javascript" src="bower_components/i18next-xhr-backend/js/i18nextXHRBackend.min.js"></script>
<script type="text/javascript" src="bower_components/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js"></script>
<script type="text/javascript" src="bower_components/jquery-i18next/js/jquery-i18next.min.js"></script>

<script type="text/javascript" src="assets/pages/dashboard/custom-dashboard.js"></script>
<script type="text/javascript" src="assets/js/script.js"></script>

<script src="assets/js/pcoded.min.js"></script>
<script src="assets/js/demo-12.js"></script>
<script src="assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="assets/js/jquery.mousewheel.min.js"></script>

<script type="text/javascript" src="bower_components/sweetalert/js/sweetalert.min.js"></script>
<script type="text/javascript" src="assets/js/modal.js"></script>
<script type="text/html" src="scripts/js/functions.js"></script>
</body>
</html>