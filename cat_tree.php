<?php
$page_title = 'EMS-Category Tree';
/**
 * Created by PhpStorm.
 * User: Dabiko Blaise
 * Date: 29-Jun-18
 * Time: 9:02 AM
 */
require_once 'header.php';
?>



<div class="theme-loader">
    <div class="ball-scale">
        <div></div>
    </div>
</div>


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
                                        <h4>EMS - Category Tree </h4>
                                    </div>

                                    <div class="page-header-breadcrumb">
                                        <ul class="breadcrumb-title">
                                            <li class="breadcrumb-item">
                                                <a href="index.php">
                                                    <i class="icofont icofont-home"></i>
                                                </a>
                                            </li>
                                            <li class="breadcrumb-item"><a href="#!">Main Categories</a>
                                            </li>
                                            <li class="breadcrumb-item"><a href="#!">Sub Categories</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="page-body button-page">
                                    <div class="row">

                                        <div class="col-sm-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Create Categories</h5>
                                                <span>Main Categories - Sub Categories</span>
                                                <div class="card-header-right">
                                                    <i class="icofont icofont-rounded-down"></i>
                                                    <i class="icofont icofont-refresh"></i>
                                                </div>
                                            </div>

                                            <div class="card-block">
                                                <div class="row modal-mob-btn">
                                                    <div class="col-sm-6">
                                                        <button onclick="return CreateMainModal();"  class="btn btn-primary btn-outline-primary btn-block"><i class="icofont icofont-plus-circle"></i>Main Category</button>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <button onclick="return CreateSubModal();" class="btn btn-primary btn-outline-primary btn-block"><i class="icofont icofont-plus-circle"></i>Sub Category </button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        </div>

                                    </div>
                                </div>



                                    <div class="col-sm-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Basic Tree </h5>
                                                <div class="card-header-right">
                                                    <i class="icofont icofont-rounded-down"></i>
                                                    <i class="icofont icofont-refresh"></i>
                                                    <i class="icofont icofont-close-circled"></i>
                                                </div>
                                            </div>
                                            <div class="card-block">
                                                <div class="card-block tree-view">
                                                    <div id="basicTree">
                                                        <ul>
                                                            <li>Admin
                                                                <ul>
                                                                    <li data-jstree='{"opened":true}'>Assets
                                                                        <ul>
                                                                            <li data-jstree='{"type":"file"}'>Css </li>
                                                                            <li data-jstree='{"opened":true}'>Plugins
                                                                                <ul>
                                                                                    <li data-jstree='{"selected":true,"type":"file"}'>Plugin one </li>
                                                                                    <li data-jstree='{"type":"file"}'>Plugin two </li>
                                                                                </ul>
                                                                            </li>
                                                                        </ul>
                                                                    </li>
                                                                    <li data-jstree='{"opened":true}'>Email Template
                                                                        <ul>
                                                                            <li data-jstree='{"type":"file"}'>Email one </li>
                                                                            <li data-jstree='{"type":"file"}'>Email two </li>
                                                                        </ul>
                                                                    </li>
                                                                    <li data-jstree='{"icon":"zmdi zmdi-view-dashboard"}'>Dashboard </li>
                                                                    <li data-jstree='{"icon":"zmdi zmdi-format-underlined"}'>Typography </li>
                                                                    <li data-jstree='{"opened":true}'>User Interface
                                                                        <ul>
                                                                            <li data-jstree='{"type":"file"}'>Buttons </li>
                                                                            <li data-jstree='{"type":"file"}'>Cards </li>
                                                                        </ul>
                                                                    </li>
                                                                    <li data-jstree='{"icon":"zmdi zmdi-collection-text"}'>Forms </li>
                                                                    <li data-jstree='{"icon":"zmdi zmdi-view-list"}'>Tables </li>
                                                                </ul>
                                                            </li>
                                                            <li data-jstree='{"type":"file"}'>Frontend </li>
                                                        </ul>
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
</div>


<?php require_once 'footer.php'; ?>

