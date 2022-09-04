<?php
$page_title ='EMS-Admin Users';
/**
 * Created by PhpStorm.
 * User: Dabiko Blaise
 * Date: 04-Jul-18
 * Time: 12:21 PM
 */

require_once 'header.php';

echo '<script>
    
</script>';
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
                                        <h4>EMS - Admin Logs </h4>
                                    </div>

                                    <div class="page-header-breadcrumb">
                                        <ul class="breadcrumb-title">
                                            <li class="breadcrumb-item">
                                                <a href="index.php">
                                                    <i class="icofont icofont-home"></i>
                                                </a>
                                            </li>
                                            <li class="breadcrumb-item"><a style="cursor: pointer;" onclick="return RedirectToPage('index');">Home</a>
                                            </li>
                                            <li class="breadcrumb-item"><a style="cursor: pointer;" onclick="return void(0);">Admin Logs</a>
                                            </li>

                                        </ul>
                                    </div>
                                </div>


                                <div class="card">
                                    <div class="card-header table-card-header">
                                        <h5>Admin User Table</h5>
                                        <div class="card-header-right">
                                            <i class="icofont icofont-rounded-down"></i>
                                            <i class="icofont icofont-refresh"></i>
                                        </div>
                                    </div>
                                    <div class="card-block ">
                                        <div class="dt-responsive table-responsive">
                                            <div id="deleteMulError"></div>
                                            <button  onclick="return printUsers();" type="button"  title="Request all System Logs in PDF"   class="btn btn-primary m-b-20"><i class="icofont icofont-download-alt"></i> Request PDF</button>
                                            <table id="basic-btn" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                <tr  style="color: white;" class="table-primary">
                                                    <th><i class="icofont icofont-numbered"></i> #No </th>
                                                    <th><i class="icofont icofont-user-alt-3"></i> EMS User</th>
                                                    <th><i class="icofont icofont-email"></i> Email</th>
                                                    <th> Status</th>

                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php


                                                /** Creating the Edit form for Main categories */

                                                $SelectData = "SELECT * FROM users ORDER BY names ASC";
                                                $statement = $adb->prepare($SelectData);
                                                $statement->execute();

                                                if ($statement->rowCount() > 0) {
                                                    $num = 0;
                                                    while ($row = $statement->fetch()) {

                                                        $user_id = $row['users_id'];
                                                        $user_name = $row['names'];

                                                        $email = $row['email'];
                                                        if ($row['users_status'] == 1 && isset($_SESSION['ems_id'])){
                                                            $status = '<button type="button" class="btn btn-outline-primary btn-round">Online</button>';
                                                        }else{
                                                            $status = '<button type="button" class="btn btn-outline-warning btn-round">Offline</button>';
                                                        }




                                                        echo '<tr>';

                                                        echo '<td><button style="width: 30px; height: 30px;"  class="btn btn-primary btn-outline-primary btn-icon">'.++$num.'</button></td>';
                                                        echo '<td>'.$user_name.'</td>';
                                                        echo '<td>'.$email.'</td> ';
                                                        echo '<td>'.$status.'</td> ';

                                                        echo '</tr>';









                                                    }
                                                }else{
                                                    echo '<tr>
                                                           <td colspan="6" style="text-align: center;">
                                                          <div class="alert alert-info icons-alert">
                                                               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                               <i class="icofont icofont-close-line-circled"></i>
                                                               </button>
                                                               <p><strong>Oops!!! </strong> No Data Available</p>
                                                               </div>
                                                         </td>
                                                         </tr>';
                                                }
                                                ?>
                                                </tbody>
                                            </table>
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


<?php require_once 'footer.php'; ?>

