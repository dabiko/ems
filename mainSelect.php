<?php
/**
 * Created by PhpStorm.
 * User: Dabiko Blaise
 * Date: 05-Jul-18
 * Time: 1:33 AM
 */
require_once 'resources/session.php';
require_once 'resources/utilities.php';


$RunQuery = new QueryControllers();

          /** @var  $SelectQuery,check if main ID and sub ID exist in the database */
          $SelectData = "SELECT main_id,main_cat FROM main_category ORDER BY main_cat ASC";
          $statement = $adb->prepare($SelectData);
          $statement->execute();

    //header("Content-Type: application/json");
          if ($statement->rowCount() > 0) {
              $dropDown = '';
              //asort($row);
          while ($row = $statement->fetch()) {
              $main_category = $row['main_cat'];
              $main_catID = $row['main_id'];

              $dropDown .='<option value="'.$main_catID.'">'.$main_category.'</option>';

             }

         }else{
              $dropDown .='<option value="">No Data Available</option>';
          }

          echo $dropDown;
