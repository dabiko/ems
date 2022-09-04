<?php
/**
 * Created by PhpStorm.
 * User: Dabiko Blaise
 * Date: 02-Jul-18
 * Time: 3:04 AM
 */

require_once 'resources/session.php';
require_once 'resources/utilities.php';


$RunQuery = new QueryControllers();

if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST'){

    $sub_id = $_POST['sub_id'];
    $main_id = $_POST['main_id'];

    if (!empty($main_id) || !empty($sub_id)) {





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


                $update = date('Y-m-d H:i:s');
                $update_at = $update;
                $upAgo = new convertToAgo();
                $unitTimestamp = $upAgo->convert_datetime($update_at);
                $updateAgo = $upAgo->makeAgo($unitTimestamp);


                /** Formatting the join date and today's date */
                $updateDate = strftime("%b %d, %Y", strtotime($update));

                header("Content-Type: application/json");

                /** @var  $arr, sending Main Category details back to ajax as json data */

                $arr = array();
                $jsonData = '{"results":[';
                $jsonObject = new stdClass();
                $jsonObject->main_cat = $mainCat;
                $jsonObject->sub_id = $subID;
                $jsonObject->sub_cat = $subCat;
                $jsonObject->update = $updateDate;
                $jsonObject->agoTime = $updateAgo;
                $arr[] = json_encode($jsonObject);
                $jsonData .= implode(",", $arr);
                $jsonData .= ']}';

                echo $jsonData;



            }

        }else {

            echo 'Sorry!!!, No such data Exit';
        }


    } else {
        echo 'Sorry!!!, Request was Incomplete';
    }

}else{
    echo 'Error!!!, Please make sure you are sending a POST Request';
}
