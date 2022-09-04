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
$error = array(1,2,3,4,5,6);
if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {


    $selectedID = $_POST['selectedID'];
    $main_id = $_POST['main_id'];
    $sub_id = $_POST['sub_id'];
    $sub_cat = $_POST['sub_cat'];



    if (empty($sub_cat)) {
        echo $error[0];

    } elseif (strlen($sub_cat) < 2) {
        echo $error[1];

    }elseif (strlen($sub_cat) > 30) {
        echo $error[2];

    }elseif (!ctype_alnum($sub_cat)){
        echo $error[3];

    }
//    elseif ($selectedID != $main_id){
//        echo $error[4];
//    }
    elseif ($selectedID == $main_id && $RunQuery->checkDuplicateSubCat($sub_cat,$adb)) {
            echo $error[5];
       }
       else{
            $columns[] = 'sub_id';
            $columns[] = 'sub_cat';
            $columns[] = 'main_id';
            $columns[] = 'updated_date';

            $values[] = $sub_id;
            $values[] = $sub_cat;
            $values[] = $selectedID;
            $values[] = date('Y-m-d H:i:s');

            $UpdateQuery = $RunQuery->UpdateData('sub_category', $columns, $values, 'sub_id = "' . $sub_id . '"');


            /** @var  $SelectQuery,check if main ID and sub ID exist in the database */
            $SelectData = "SELECT * FROM sub_category".
                " INNER JOIN main_category AS re USING (main_id) WHERE sub_id = $sub_id ORDER BY sub_id DESC";
            $statement = $adb->prepare($SelectData);
            $statement->execute();

            if ($statement->rowCount() > 0) {
                while ($row = $statement->fetch()) {

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


                    header("Content-Type: application/json");

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

                echo 'Sorry!!!, No such data Exit';
            }
        }


}else{
    echo 'Oops!!!, Please make sure your REQUEST is POST';
}

