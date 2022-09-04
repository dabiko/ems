<?php

require_once 'resources/session.php';
require_once 'resources/utilities.php';
/**
 * Created by PhpStorm.
 * User: Dabiko Blaise
 * Date: 29-Jun-18
 * Time: 9:02 AM
 */
if (isset($_POST['subDrop'])){
    $SelectData = "SELECT * FROM sub_category ORDER BY sub_cat ASC";
    $statement = $adb->prepare($SelectData);
    $statement->execute();

    if ($statement->rowCount() > 0) {
        while ($row = $statement->fetch()) {
            $sub_category = $row['sub_cat'];
            $sub_catID = $row['sub_id'];

            echo '<option value="'.$sub_catID.'">'.$sub_category.'</option>';

        }

    }else{
        echo '<option value="">No Data Available</option>';
    }
}elseif (isset($_POST['subEdit'])) {

    $sub = $_POST['subEdit'];

    $SelectData = "SELECT * FROM sub_category ORDER BY sub_cat ASC";
    $statement = $adb->prepare($SelectData);
    $statement->execute();

    if ($statement->rowCount() > 0) {
        while ($row = $statement->fetch()) {
            $sub_category = $row['sub_cat'];
            $sub_catID = $row['sub_id'];
            ?>
            <option value="<?php echo $sub_catID;?>"
                <?php if (strtolower($sub_category) == strtolower($sub)) {
                    echo '<option  selected="selected"'; } ?> >
                <?php echo $sub_category; ?></option>
            <?php
        }

    }else{
        echo '<option value="">No Data Available</option>';
    }

}
