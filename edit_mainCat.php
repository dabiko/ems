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
$error = array(1,2,3,4);
if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {

        $main_id = $_POST['main_id'];
        $main_cat = $_POST['main_cat'];



        if (empty($main_cat)) {
            echo $error[0];

        } elseif (strlen($main_cat) < 2) {
            echo $error[1];

        }elseif (!ctype_alnum($main_cat)){
            echo $error[2];

        }elseif ($RunQuery->checkDuplicateMainCat($main_cat,$adb)) {
            echo $error[3];
        }

        else{



            $columns[] = 'main_id';
            $columns[] = 'main_cat';
            $columns[] = 'updated_on';

            $values[] = $main_id;
            $values[] = $main_cat;
            $values[] = date('Y-m-d H:i:s');;

            $UpdateQuery = $RunQuery->UpdateData('main_category', $columns, $values, 'main_id = "' . $main_id . '"');

            /** @var  $SelectQuery,check if main ID and sub ID exist in the database */
            $SelectData = "SELECT * FROM main_category WHERE main_id = $main_id ORDER BY main_id DESC";
            $statement = $adb->prepare($SelectData);
            $statement->execute();

            if ($statement->rowCount() > 0) {
                while ($row = $statement->fetch()) {

                    $mainCat = $row['main_cat'];
                    $updateDate = $row['updated_on'];


                    /** implementing the Ago time*/
                    $update = $updateDate;
                    $update_at = $update;
                    $upAgo = new convertToAgo();
                    $unitTimestamp = $upAgo->convert_datetime($update_at);
                    $update_Ago = $upAgo->makeAgo($unitTimestamp);

                    header("Content-Type: application/json");

                    /** Formatting the join date and today's date */
                    $update_date = strftime("%b %d, %Y", strtotime($updateDate));

                    $arr = array();
                    $jsonData = '{"results":[';
                    $jsonObject = new stdClass();
                    $jsonObject->main_cat = $mainCat;
                    $jsonObject->updatedate = $update_date;
                    $jsonObject->updateago = $update_Ago;
                    $arr[] = json_encode($jsonObject);
                    $jsonData .= implode(",", $arr);
                    $jsonData .= ']}';
                    echo $jsonData;
                }

            }else {

                echo 'Sorry!!!, No such data Exit';
            }

        }

}else{
    echo 'Oops!!!, Please make sure your REQUEST is POST';
}

