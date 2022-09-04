<?php
$page_title = 'EMS-LogOut';
/**
 * Created by PhpStorm.
 * User: dabik
 * Date: 04-Nov-17
 * Time: 2:31 AM
 */
require_once 'resources/session.php';
require_once 'resources/utilities.php';

$RunQuery = new QueryControllers();
$col[] = 'users_status';
$val[] = 0;
$UpdateQuery = $RunQuery->UpdateData('users',$col,$val,'users_id ="'.$_SESSION['users_id'].'"');

//$column[] = 'active_hours';
//$value[] = date('Y-m-d H:i:s',STRTOTIME(date('h:i:sa')));
//$UpdateQuery = $RunQuery->UpdateData('admin_logs',$column,$value,'admin_id ="'.$_SESSION['admin_id'].'"');
$RunQuery->signOut();

//            $message = $userNames. 'had some errors trying to calculate the Total number of
//            Hours spent on the BLAST platform. Please try to rectify the situation ASAP. Thanks';
//            $column[] = 'admin_id';
//            $column[] = 'message';
//            $column[] = 'sender';
//            $column[] = 'error_date';
//
//            $value[] = $_SESSION['admin_id'];
//            $value[] = $message;
//            $value[] = 'BLAST - Automated Support';
//            date_default_timezone_set('Africa/Douala');
//            $value[] = date('Y-m-d H:i:s');
//            $InsertQuery = $RunQuery->InsertData('error_messages',$column,$value);
//            $RunQuery->signOut();






