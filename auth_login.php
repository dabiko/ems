<?php

/**
 * Created by PhpStorm.
 * User: dabik
 * Date: 03-Nov-17
 * Time: 9:18 PM
 */
require_once 'resources/session.php';
require_once 'resources/utilities.php';


$RunQuery = new QueryControllers();

$error =  array(1,2,3,4);
if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST'){

        $user_email = $_POST['email'];
        $user_password = $_POST['password'];

        isset($_POST['remember']) ? $remember = $_POST['remember'] : $remember = "";
        if (!empty($user_email) && !empty($user_password)) {


            /** @var  $SelectQuery,check if user exist in the database */
            $SelectQuery = $RunQuery->SelectData('*','users WHERE email = "'.$user_email.'"');
            if($SelectQuery->rowCount() == 1){
                foreach ($SelectQuery->fetchAll(PDO::FETCH_ASSOC) as $row){

                    $dbPassword = $row['password'];

                    $users_id = $row['users_id'];
                    $username = $row['names'];



                            if (password_verify($user_password,$dbPassword)) {
                            $RunQuery->prepLogin($users_id, $username, $remember);

                            /** Inserting  data into User_logs Table*/
                            $columns[] = 'users_id';
                            $columns[] = 'log_status';
                            $columns[] = 'login_time';
                            $columns[] = 'logout_time';

                            $values[] = $users_id;
                            $values[] = date('Y-m-d H:i:s',STRTOTIME(date('h:i:sa')));
                            $values[] = date('Y-m-d H:i:s',STRTOTIME(date('h:i:sa')));
                            $values[] = date('Y-m-d H:i:s',STRTOTIME(date('h:i:sa')));

                            $InsertQuery = $RunQuery->InsertData('users_logs',$columns,$values);

                                $col = 'users_status';
                                $val = 1;
                                $activeQuery = $RunQuery->UpdateData('users',$col,$val,' users_id = "'.$users_id.'"');






                        header("Content-Type: application/json");

                        /** @var  $arr, sending users names back to ajax as json data */
                        $arr = array();
                        $jsonData = '{"results":[';
                        $jsonObject = new stdClass();
                        $jsonObject->emsname = $username;
                        $arr[] = json_encode($jsonObject);
                        $jsonData .= implode(",", $arr);
                        $jsonData .= ']}';

                        echo $jsonData;

                        }else {
                            echo$error[3];
                        }

                }

            }else {

                echo$error[2];
            }





        } else {
            echo$error[1];
        }



}else{
    echo$error[0];
}
