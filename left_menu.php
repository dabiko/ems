<?php
/**
 * Created by PhpStorm.
 * User: Dabiko Blaise
 * Date: 29-Jun-18
 * Time: 9:02 AM
 */

$selectMain = "SELECT * FROM main_category";
$mainCount = $RunQuery->numRows($selectMain);

$selectSub = "SELECT * FROM sub_category";
$subCount = $RunQuery->numRows($selectSub);

$selectEquip = "SELECT * FROM equipments";
$equipCount = $RunQuery->numRows($selectEquip);

$selectIn = "SELECT * FROM invoice";
$inCount = $RunQuery->numRows($selectIn);

$selectInvalid = "SELECT * FROM invoice WHERE balance != 0";
$invalidCount = $RunQuery->numRows($selectInvalid);

$selectLogs = "SELECT * FROM users_logs";
$logCount = $RunQuery->numRows($selectLogs);

?>
<nav class="pcoded-navbar">
    <div class="sidebar_toggle"><a style="cursor: pointer;" onclick="return void(0);"><i class="icon-close icons"></i></a></div>
    <div class="pcoded-inner-navbar main-menu">

        <div class="pcoded-navigatio-lavel" data-i18n="nav.category.navigation">EMS-Dashboard</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="pcoded-hasmenu active pcoded-trigger">
                <a href="index">
                    <span class="pcoded-micon"><i class="ti-home"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.dash.main">Dashboard-Home</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
        </ul>



        <div class="pcoded-navigatio-lavel" data-i18n="nav.category.ui-element">EMS-Category</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="pcoded-hasmenu ">
                <a style="cursor: pointer;" onclick="return void(0);">
                    <span class="pcoded-micon"><i class="ti-view-list"></i></span>
                    <span class="pcoded-mtext">Category Manager</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <li class=" ">
                        <a href="cat_tree" data-i18n="nav.basic-components.alert">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext">Category Tree</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="main_table"  data-i18n="nav.basic-components.breadcrumbs">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext">Main Category Table <label class="badge badge-primary"><?php echo $mainCount; ?> </label></span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="sub_table"  data-i18n="nav.basic-components.breadcrumbs">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext"> Sub Category Table <label class="badge badge-primary"><?php echo $subCount; ?> </label></span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>


        <div class="pcoded-navigatio-lavel" data-i18n="nav.category.ui-element">EMS-Equipment</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="pcoded-hasmenu">
                <a style="cursor: pointer;" onclick="return void(0);">
                    <span class="pcoded-micon"><i class="ti-archive"></i></span>
                    <span class="pcoded-mtext">Equipment Manager</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <li class=" ">
                        <a href="equipment_table" data-i18n="nav.basic-components.breadcrumbs">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext">Manage Equipment <label class="badge badge-primary"><?php echo $equipCount; ?> </label></span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>

                    <li class=" ">
                        <a href="sell_item"  data-i18n="nav.basic-components.breadcrumbs">
                            <span class="pcoded-micon"><i class="zmdi zmdi-shopping-basket"></i></span>
                            <span class="pcoded-mtext">Add to Card </span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>


        <div class="pcoded-navigatio-lavel" data-i18n="nav.category.extension">EMS-Invoice</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="pcoded-hasmenu ">
                <a style="cursor: pointer;" onclick="return void(0);" data-i18n="nav.invoice.main">
                    <span class="pcoded-micon"><i class="ti-layout-media-right"></i></span>
                    <span class="pcoded-mtext">Invoice Manager</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="">
                        <a href="invoice"  data-i18n="nav.invoice.invoice">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext">Order</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="">
                        <a href="invoice-summary.html" data-i18n="nav.invoice.invoice-summery">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext">Invoice Summary </span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="">
                        <a href="invoice_list"  data-i18n="nav.invoice.invoice-list">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext">Invoice List   <label class="badge badge-primary"><?php echo $inCount; ?> </label>
                                <label class="badge badge-warning"><?php echo $invalidCount; ?> </label>
                            </span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>

                </ul>
            </li>
        </ul>



        <div class="pcoded-navigatio-lavel" data-i18n="nav.category.extension">EMS-Users</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="pcoded-hasmenu ">
                <a style="cursor: pointer;" onclick="return void(0);" data-i18n="nav.invoice.main">
                    <span class="pcoded-micon"><i class="ti-user"></i></span>
                    <span class="pcoded-mtext">User Manager </span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="">
                        <a  href="users"  data-i18n="nav.invoice.invoice">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext">Manage Users <label class="badge badge-primary"><?php echo $logCount; ?> </label></span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                </ul>

                <ul class="pcoded-submenu">
                    <li class="">
                        <a href="logs"  data-i18n="nav.invoice.invoice">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext">Manage Logs <label class="badge badge-primary"><?php echo $logCount; ?> </label></span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>

