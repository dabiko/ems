<?php
/**
 * Created by PhpStorm.
 * User: dabik
 * Date: 21-Dec-17
 * Time: 6:50 PM
 */
require_once 'resources/session.php';
require_once 'resources/utilities.php';


$RunQuery = new QueryControllers();
$error = array(1,2,3,4,5);
if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {

        $main_id = $_POST['main_id'];
        $sub_cat = $_POST['sub_cat'];


        if (empty($sub_cat)) {
            echo  $error[0];

        } elseif (strlen($sub_cat) < 2) {
            echo  $error[1];

        } elseif (!ctype_alnum($sub_cat)){
            echo $error[2];

        }elseif (empty($main_id)){
            echo  $error[3];

           } elseif ($RunQuery->checkDuplicateSubCat($sub_cat, $adb)) {
            echo $error[4];
        }

        else {


            $columns[] = 'sub_cat';
            $columns[] = 'main_id';
            $columns[] = 'created_date';
            $columns[] = 'updated_date';

            $values[] = $sub_cat;
            $values[] = $main_id;
            $values[] = date('Y-m-d H:i:s');;
            $values[] = date('Y-m-d H:i:s');;

            $InsertQuery = $RunQuery->InsertData('sub_category', $columns, $values);

            $lastID = $RunQuery->getLastInsertId();

            /** @var  $SelectQuery,check if main ID and sub ID exist in the database */
            $SelectData = "SELECT * FROM sub_category".
                " INNER JOIN main_category AS re USING(main_id) WHERE sub_id = $lastID";
            $statement = $adb->prepare($SelectData);
            $statement->execute();
            if ($statement->rowCount() > 0) {
                header("Content-Type: application/json");
                $myArray = array();
                while ($row = $statement->fetch()) {

                    /** @var  $arr, sending Main Category details back to ajax as json data */
                    $mainID = $row['main_id'];
                    $mainCat = $row['main_cat'];
                    $subID = $row['sub_id'];
                    $subCat = $row['sub_cat'];
                    $createDate = $row['created_date'];
                    $updateDate = $row['updated_date'];


                    /** implementing the Ago time*/
                    $date = $createDate;
                    $posted_at = $date;
                    $Ago = new convertToAgo();
                    $unit_timestamp = $Ago->convert_datetime($posted_at);
                    $ago = $Ago->makeAgo($unit_timestamp);

                    $update = $updateDate;
                    $update_at = $update;
                    $upAgo = new convertToAgo();
                    $unitTimestamp = $upAgo->convert_datetime($update_at);
                    $update_Ago = $upAgo->makeAgo($unitTimestamp);


                    /** Formatting the join date and today's date */
                    $create_date = strftime("%b %d, %Y", strtotime($createDate));
                    $update_date = strftime("%b %d, %Y", strtotime($updateDate));

                    $arr = array();
                    $jsonData = '{"results":[';
                    $jsonObject = new stdClass();
                    $jsonObject->main_id = $mainID;
                    $jsonObject->main_cat = $mainCat;
                    $jsonObject->sub_id = $subID;
                    $jsonObject->sub_cat = $subCat;
                    $jsonObject->createdate = $create_date;
                    $jsonObject->updatedate = $update_date;
                    $jsonObject->createago = $ago;
                    $jsonObject->updateago = $update_Ago;
                    $arr[] = json_encode($jsonObject);
                    $jsonData .= implode(",", $arr);
                    $jsonData .= ']}';
                    echo $jsonData;

                }

            }else {

                echo $error = 'Sorry!!!, No such data Exit';
            }

        }

    }

