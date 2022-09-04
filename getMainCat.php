<?php

require_once 'resources/session.php';
require_once 'resources/utilities.php';
/**
 * Created by PhpStorm.
 * User: Dabiko Blaise
 * Date: 29-Jun-18
 * Time: 9:02 AM
 */

if (isset($_POST['mainDrop'])){
    $SelectData = "SELECT * FROM main_category ORDER BY main_cat ASC";
    $statement = $adb->prepare($SelectData);
    $statement->execute();

    if ($statement->rowCount() > 0) {
        while ($row = $statement->fetch()) {
            $main_category = $row['main_cat'];
            $main_catID = $row['main_id'];

            echo '<option value="'.$main_catID.'">'.$main_category.'</option>';

        }

    }else{
        echo '<option value="">No Data Available</option>';
    }
}elseif (isset($_POST['mainEdit'])){

    $main = $_POST['mainEdit'];

    $SelectData = "SELECT * FROM main_category ORDER BY main_cat ASC";
    $statement = $adb->prepare($SelectData);
    $statement->execute();
    if ($statement->rowCount() > 0) {
        while ($row = $statement->fetch()) {
            $main_category = $row['main_cat'];
            $main_catID = $row['main_id'];
            ?>
            <option value="<?php echo $main_catID;?>"
                <?php if (strtolower($main_category) == strtolower($main)) {
                    echo '<option  selected="selected"'; } ?> >
                <?php echo $main_category; ?></option>
            <?php

        }
    } else {
        echo '<option value="">No Data Available</option>';
    }

}
