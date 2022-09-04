<?php
$page_title = 'EMS-Invoice';
/**
 * Created by PhpStorm.
 * User: Dabiko Blaise
 * Date: 29-Jun-18
 * Time: 9:02 AM
 */
require_once 'resources/session.php';
require_once 'header.php';
require_once 'resources/utilities.php';
$RunQuery = new QueryControllers();

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
                                        <h4>EMS - Invoice</h4>
                                    </div>

                                    <div class="page-header-breadcrumb">
                                        <ul class="breadcrumb-title">
                                            <li class="breadcrumb-item">
                                                <a href="index.php">
                                                    <i class="icofont icofont-home"></i>
                                                </a>
                                            </li>
                                            <li class="breadcrumb-item"><a style="cursor: pointer;" onclick="return void(0);">Invoice receipt</a>
                                            </li>
                                            <li class="breadcrumb-item"><a style="cursor: pointer;" onclick="return RedirectToPage('sell_item');">Sell Items</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card" id="invoice_pdf">
                                 <form id="invoiceForm" onsubmit="submitInvoice(); return false;" method="POST" action="#">
                                    <div class="row invoice-contact">
                                        <div class="col-md-8">
                                            <div class="invoice-box row">
                                                <div class="col-sm-12">
                                                    <table class="table table-responsive invoice-table table-borderless">
                                                        <tbody>
                                                        <tr>
                                                            <td><img src="assets/images/logo-blue.png" class="m-b-10" alt="" /></td>
                                                        </tr>
                                                        <tr>
                                                            <td>EMS Inc. </td>
                                                        </tr>
                                                        <tr>
                                                            <td>2886 Douala, Bonabery, +237-00-00-00-00</td>
                                                        </tr>
                                                        <tr>
                                                            <td><a>emsadmin@gmail.com</a>
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

                                    <div class="card-block">
                                        <div class="row invoive-info">
                                            <div class="col-md-4 col-xs-12 invoice-client-info">
                                                <h6>Client Information : </h6>
                                                <div class="input-group input-group-default">
                                                    <span class="input-group-addon">Name :</span>
                                                    <input id="c_name" name="c_name" style="color: black;" type="text" class="form-control" placeholder="client name" />
                                                </div>
                                                <div class="input-group input-group-default">
                                                    <span class="input-group-addon">Address :</span>
                                                    <input id="c_address" name="c_address" style="color: black;" type="text" class="form-control" placeholder="cleint address" />
                                                </div>
                                                <div class="input-group input-group-default">
                                                    <span class="input-group-addon">Tel :</span>
                                                    <input id="c_num" name="c_num" style="color: black;" type="text" class="form-control" placeholder="phone number" />
                                                </div>
                                                <div class="input-group input-group-default">
                                                    <span class="input-group-addon">Email :</span>
                                                    <input id="c_email" name="c_email" style="color: black;" type="text" class="form-control" placeholder="email address" />
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-6">
                                                <h6>Order Information : </h6>
                                                <table class="table table-responsive invoice-table invoice-order table-borderless">
                                                    <tbody>
                                                    <tr>
                                                        <th>Date : </th>
                                                        <td><?php echo date("l jS, F Y"); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Time : </th>
                                                        <td><?php echo date("h:i:s A"); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Status : </th>
                                                        <td>
                                                            <span class="label label-warning">Pending </span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Id : </th>
                                                        <td id="orderID">

                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-md-4 col-sm-6">
                                                <h6 class="m-b-20">Invoice Number: <span id="inNum"> </span></h6>

                                                <div class="col-sm-8">
                                                    <select style="color: #0b0b0b;" name="p_method"  id="p_method" class="form-control form-control-inverse">
                                                        <option value="">Payment Method</option>
                                                        <option value="1">Cash</option>
                                                        <option value="2" >Check</option>
                                                        <option value="3" >Credit</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="dt-responsive table-responsive">
                                                    <table class="table invoice-detail-table " id="addRows-1">
                                                        <div   id="valueError"></div>
                                                        <thead>
                                                        <tr style="color: white;" class="table-primary">
                                                            <th>#</th>
                                                            <th><i class="icofont icofont-numbered"></i>#No</th>
                                                            <th>Item Name</th>
                                                            <th>Stocks</th>
                                                            <th>Quantity </th>
                                                            <th>Cost Price</th>
                                                            <th>Unit Price(FCFA)</th>
                                                            <th>Total(FCFA)</th>
                                                            <th>Action</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody id="invoice_item">


                                                        </tbody>

                                                    </table>
                                                    <div class="col-sm-12 invoice-btn-group">
                                                    <button onclick="return add_row();" type="button" id="addRow" name="addRow" class="btn btn-primary waves-effect waves-light add btn-round"><i class="icofont icofont-plus-circle"></i>Add Row</button>
                                                     <button type="submit" class="btn btn-primary btn-print-invoice waves-effect waves-light btn-round"><i class="icofont icofont-save"></i> Process</button>
                                                     <button type="reset" id="resetInvoice" name="resetInvoice" class="btn btn-danger waves-effect waves-light btn-round "><i class="icofont icofont-close-circled"></i> Reset </button>
                                                      <button    onclick="return load()" type="button" class="btn btn-primary waves-effect waves-light btn-round ">Total</button>
                                                        <button  onclick="return printPDF()" type="button" class="btn btn-primary waves-effect waves-light btn-round ">Download</button>
                                                    </div>
                                                    <div  id="otal" ></div><hr>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="">
                                                    <table id="sum_table" class="table invoice-table invoice-total table-responsive">
                                                        <tbody>

                                                        <tr>
                                                            <th>Sub Total : </th>
                                                            <td><input readonly=readonly style="color: black;" id="sub_total" name="sub_total" type="text" class="form-control" placeholder="sub total"/> </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Paid: </th>
                                                            <td>
                                                                <input onKeyPress="noSpaces(this); keypressPaid(); " onKeyUp=" noSpaces(this); keypressPaid(); " style="color: black;" id="paid" name="paid" type="text" class="form-control" placeholder="paid"/>
                                                                <input  style="color: black;" id="hidden_paid" name="hidden_paid" type="hidden" class="form-control"/>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Due: </th>
                                                            <td><input readonly=readonly style="color: black;" id="t_due" name="t_due" type="text" class="form-control" placeholder="due"/></td>
                                                        </tr>

                                                        <tr class="text-info">
                                                            <td>
                                                                <hr />
                                                                <h5 class="text-primary">Total:</h5>
                                                            </td>
                                                            <td class="">
                                                                <hr />
                                                                <h5 class="text-primary">
                                                                    <input readonly=readonly style="color: black;" id="t_cal" name="t_cal" type="text" class="form-control" placeholder="total"/>
                                                                    <input readonly=readonly style="color: black;" id="t_hide" name="t_hide" type="hidden" class="form-control"/>
                                                                </h5>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <p style="text-align: center;"> <strong>Authorized By: </strong> <?php echo $_SESSION['ems_username'];?> </p>
                                        <hr />
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <h6>Terms And Condition : </h6>
                                                <p>**************************************************************************************</p>
                                            </div>
                                        </div>
                                    </div>
                                    </form>
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

