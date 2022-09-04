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


$MainCat = $_POST['selected'];

/** @var  $SelectQuery,check if main ID and sub ID exist in the database */
$SelectMain = "SELECT * FROM main_category ORDER BY main_cat ASC";
$statement = $adb->prepare($SelectMain);
$statement->execute();

$dropDown = '';
if ($statement->rowCount() > 0) {
    while ($row = $statement->fetch()) {
        $main_category = $row['main_cat'];
        $main_catID = $row['main_id'];
        ?>
        <option value="<?php echo $main_catID;?>"
            <?php if (strtolower($main_category) == strtolower($MainCat)) {
                echo '<option  selected="selected"'; } ?> >
            <?php echo $main_category; ?></option>
        <?php

    }
} else {
    echo '<option value="">No Data Available</option>';
}

?>


