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
          $SelectData = "SELECT e_id,e_name FROM equipments WHERE qty != 0 ORDER BY e_id ASC";
          $statement = $adb->prepare($SelectData);
          $statement->execute();

          if ($statement->rowCount() > 0) {
              $dropDown = '';
          while ($row = $statement->fetch()) {
              $name = $row['e_name'];
              $ID = $row['e_id'];

              $dropDown .='<option style="color: black;" value="'.$ID.'">'.$name.'</option>';

             }

         }else{
              $dropDown .='<option style="color: black;" value="">No Item Available for Sale</option>';
          }

          echo $dropDown;
