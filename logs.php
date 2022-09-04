<?php
$page_title ='EMS-Admin Logs';
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
                                        <h5>Admin Logs Table</h5>
                                        <div class="card-header-right">
                                            <i class="icofont icofont-rounded-down"></i>
                                            <i class="icofont icofont-refresh"></i>
                                        </div>
                                    </div>
                                    <div class="card-block ">
                                        <div class="dt-responsive table-responsive">
                                            <div id="deleteMulError"></div>
                                            <button  disabled=disabled onclick="return deleteMultipleMain();" type="button" name="btn_delete" id="btn_delete"  class="btn btn-danger m-b-20">Delete Selected</button>
                                            <button  onclick="return printLogs();" type="button"  title="Request all System Logs in PDF"   class="btn btn-primary m-b-20"><i class="icofont icofont-download-alt"></i> Request PDF</button>
                                            <table id="basic-btn" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                <tr  style="color: white;" class="table-primary">
                                                    <th>Actions </th>
                                                    <th><i class="icofont icofont-numbered"></i> #No </th>
                                                    <th><i class="icofont icofont-user-alt-3"></i> EMS User</th>
                                                    <th><i class="icofont icofont-ui-timer"></i> Login Time</th>
                                                    <th><i class="icofont icofont-ui-timer"></i> Logout Time</th>
                                                    <th><i class="icofont icofont-ui-timer"></i> Active Hours</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php

                                                function differenceInHours($startdate,$enddate){
                                                    $starttimestamp = strtotime($startdate);
                                                    $endtimestamp = strtotime($enddate);
                                                    $difference = abs($endtimestamp - $starttimestamp)/3600;
                                                    return $difference;
                                                }
                                                /** Creating the Edit form for Main categories */

                                                $SelectData = "SELECT * FROM users_logs".
                                                    " INNER JOIN users AS ur USING(users_id) ORDER BY log_id DESC";
                                                $statement = $adb->prepare($SelectData);
                                                $statement->execute();

                                                if ($statement->rowCount() > 0) {
                                                    $num = 0;
                                                    while ($row = $statement->fetch()) {

                                                        $log_id = $row['log_id'];
                                                        $user_name = $row['names'];

                                                        $log_status = $row['log_status'];
                                                        $login_time = $row['login_time'];
                                                        $logout_time = $row['logout_time'];


                                                        /** implementing the Ago time*/
                                                        $LogStates = $log_status;
                                                        $posted_at = $LogStates;
                                                        $Ago = new convertToAgo();
                                                        $unit_timestamp = $Ago->convert_datetime($posted_at);
                                                        $status = $Ago->makeAgo($unit_timestamp);

                                                        $LogTime = $login_time;
                                                        $log_at = $LogTime;
                                                        $timeAgo = new convertToAgo();
                                                        $unitTimestamp = $timeAgo->convert_datetime($log_at);
                                                        $logIn = $timeAgo->makeAgo($unitTimestamp);

                                                        $LogOut =  $logout_time;
                                                        $log_lout = $LogOut;
                                                        $logAgo = new convertToAgo();
                                                        $unitTimestamp = $logAgo->convert_datetime($log_lout);
                                                        $logOut = $logAgo->makeAgo($unitTimestamp);


                                                        /** Formatting the join date and today's date */
                                                        $status_date = strftime("%b %d, %Y", strtotime($log_status));
                                                        $logIn_date = strftime("%b %d, %Y", strtotime($login_time));
                                                        $logOut_date = strftime("%b %d, %Y", strtotime($logout_time));

                                                        $hours_difference = differenceInHours($logIn_date,$logOut_date);


                                                        echo '<tr>';

                                                        echo '<td>
                                                                <label title="Check to Delete ' . $user_name . '" style="width: 30px; height: 30px;" class="btn btn-info btn-info btn-icon">
                                                                  <input type="checkbox" class="checked"  id="checkedLogs" name="checkedLogs[]" value="'.$log_id.'" aria-label="Checkbox for following text input" />
                                                                  </label>
                                                                  <button  disabled=disabled onclick="return logsDelete('.$log_id.');" title="Delete ' . $user_name . '" style="width: 30px; height: 30px;"  class="btn btn-danger btn-outline-danger btn-icon"><i class="icofont icofont-delete-alt"></i></button>
                                                              </td>';

                                                        echo '<td>'.++$num.'</td>';
                                                        echo '<td>'.$user_name.'</td>';
                                                        echo '<td>'.$logIn.' ('.date('D, h:m A', strtotime($login_time)).')</td> ';
                                                        echo '<td>'.$logOut.' ('.date('D, h:m A', strtotime($logout_time)).')</td> ';
                                                        echo '<td>'.$status.' ('.date('D, h:m A', strtotime($log_status)).')</td> ';
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

