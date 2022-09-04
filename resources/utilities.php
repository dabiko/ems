<?php
/**
 * Created by PhpStorm.
 * User: dabik
 * Date: 15-Oct-17
 * Time: 3:54 PM
 */
require_once 'Database.php';


class convertToAgo{
    public function convert_datetime($str){
        date_default_timezone_set('Africa/Douala');
        list($date,$time) = explode(' ',$str);
        list($year,$month,$day) = explode('-',$date);
        list($hours,$minute,$seconds) = explode(':',$time);
        $timestamp = mktime($hours,$minute,$seconds,$month,$day,$year);
        return $timestamp;

    }

    public function makeAgo($timestamp){
        date_default_timezone_set('Africa/Douala');
        $difference = time()-$timestamp;
        $periods = ["Second","Minute","Hour","Day","Week","Month","Year","Decade"];
        $lengths = ["60","60","24","7","4","35","12","10"];
        for($i = 0;
            $difference >= $lengths[$i]; $i++)
            $difference /= $lengths[$i];
        $difference = round($difference);
        if ($difference != 1) $periods[$i] .= "s";
        $output = "$difference $periods[$i]";
        return $output." ago";

    }
} // Ago Class Ends Here


class QueryControllers{
    /**
     * @param $table, to Insert data .
     * @param $column_name, will contain the various columns/fields (as an array) in the database.
     * @param $values, will contain the various values/rows (as an array) to be inserted in the database.
     * @return true if successful and false (with errors) in case of any failure
     */

    /** @var. to be able to get the last inserted ID in the database */
    private $lastInsertId;

   public function InsertData($table, $column_name, $values){
      // global $user_id;
            $adb = new PDO(DB_DSN, DB_USER, DB_PASSWORD);

        //build the columns and loop through the column(s) given
        $buildColumns = '';
        if (is_array($column_name)) {
            //loop through all the columns
            foreach($column_name as $key => $columns) {
                if ($key == 0) {
                    //first column(s) item
                    $buildColumns .= $columns;
                } else {
                    //every other column name follows with a ","
                    $buildColumns .= ', '.$columns;
                }
            }
        } else {
            //this will insert just one field (row) onto the database
            $buildColumns .= $column_name;
        }


        //build the values and loop through the value(s) given
        $buildValues = '';
        if (is_array($values)) {
            //loop through all the fields
            foreach($values as $key => $value) {
                if ($key == 0) {
                    //first value(s) item
                    $buildValues .= '?';
                } else {
                    //every other value(s) or field(s) follows with a ","
                    $buildValues .= ', ?';
                }
            }
        } else {
            //this will insert just one field (row into the database)
            $buildValues .= ':value';
        }

               //Insert query
               $InsertQuery ="INSERT INTO ".$table." (".$buildColumns.") VALUES(".$buildValues.")";
               $statement = $adb->prepare($InsertQuery);
               //execute the Insert for one or many values
               if (is_array($values)) {
                   $statement->execute($values);

               } else {
                   $statement->execute(array(':value' => $values ));

               }
                  // Declaring a lastInsert variable using PDO::lastInsertId() method
                 $lastInsertId = $adb->lastInsertId();

               //setting the Private $lastInsert private  variable  to the last Id from the database
                 $this->lastInsertId = $lastInsertId;


        /**record and print any database error that might occur */
        $errorMessage = $statement->errorInfo();
        if ($errorMessage[1]) {
            print_r($errorMessage);
        } else {
            return true;
        }
       return false;

    }

    /**
     * @return mixed
     */
    public function getLastInsertId(){
        return $this->lastInsertId;
    }

    /**
     * @param $table, to Select (Retrieve) data from.
     * @param $column_name, will contain the various columns/fields (as an array) in the database.
     * @return true if successful and false (with errors) in case of any failure
     */

    public function SelectData($column_name,$table){
        $adb = new PDO(DB_DSN, DB_USER, DB_PASSWORD);

        //build the columns and loop through the column(s) given
        $buildSelect = '';
        if (is_array($column_name)) {
            //loop through all the columns
            foreach($column_name as $key => $columns) {
                if ($key == 0){
                    //first column(s) item
                    $buildSelect .= $columns;
                } else {
                    //every other item follows with a ","
                    $buildSelect .= ','.$columns;
                }
            }
        } else {
            //this will select just one field
            $buildSelect .= $column_name;
        }


     //Select Query
        $SelectQuery ="SELECT ".$buildSelect." FROM ".$table."  ";
        $statement = $adb->prepare($SelectQuery);

        //execute the Select for one or many values
        $statement->execute();

        /**record and print any database error that might occur */
        $errorMessage = $statement->errorInfo();
        if ($errorMessage[1]) {
            print_r($errorMessage);
        } else {
            return $statement;
        }

    }

    /**
     * @param $table, to Update data .
     * @param $column_name, will contain the various columns/fields (as an array) in the database.
     * @param $values, will contain the various values (as an array)  provided when calling the UpdateData function.
     * @param $where, specifying which row/columns are to be updated.
     * @return true if successful and false (with errors) in case of any failure
     */
   public function UpdateData($table, $column_name, $values,$where){
        $adb = new PDO(DB_DSN, DB_USER, DB_PASSWORD);

        //build the field to value correlation (Establishing connection between two or more Variables.)
        $buildUpdate = '';
        if (is_array($column_name)) {

            //loop through all the fields and assign them to the correlating $values
            foreach($column_name as $key => $field) :
                if ($key == 0) {
                    //first item
                    $buildUpdate .= $field.' = ?';
                } else {
                    //every other item follows with a ","
                    $buildUpdate .= ', '.$field.' = ?';
                }
            endforeach;

        } else {
            //updating just one field
            $buildUpdate .= $column_name.' = :value';
        }

        $UpdateQuery =" UPDATE ".$table." SET ".$buildUpdate." WHERE ".$where." ";
        $statement = $adb->prepare($UpdateQuery);

        //execute the update for one or many values
        if (is_array($values)) {
            $statement->execute($values);
        } else {
            $statement->execute(array(':value' => $values));
        }



        /**record and print any database error that might occur */
        $errorMessage = $statement->errorInfo();
        if ($errorMessage[1]) {
            print_r($errorMessage);
        } else {
            return $statement;
        }
        //return false;

    }

    /**
     * @param $table, to Delete data from.
     * @param $column_name, will contain the various columns/fields (as an array) in the database.
     * @param $values, will contain the various values (as an array) provided when calling the DeleteData function.
     * @return true if successful and false (with errors) in case of any failure
     */

    public function DeleteData($table, $column_name, $values){


        //build the columns and loop through the column(s) given
        $buildColumns = '';
        if (is_array($column_name)) {
            //loop through all the columns
            foreach($column_name as $key => $columns) {
                if ($key == 0) {
                    //first column(s) item
                    $buildColumns .= $columns;
                } else {
                    //every other item follows with a ","
                    $buildColumns .= ', '.$columns;
                }
            }
        } else {
            //we are only inserting one field
            $buildColumns .= $column_name;
        }


        //build the values and loop through the value(s) given
        $buildValues = '';
        if (is_array($values)) {
            //loop through all the fields
            foreach($values as $key => $value) {
                if ($key == 0) {
                    //first value(s) item
                    $buildValues .= '?';
                } else {
                    //every other item follows with a ","
                    $buildValues .= ', ?';
                }
            }
        } else {
            //this will insert just one field
            $buildValues .= ':value';
        }

     $adb = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
     $DeleteQuery =" DELETE FROM ".$table." WHERE ".$buildColumns." = $buildValues ";
     $statement = $adb->prepare($DeleteQuery);

    ;
        //execute the Delete for one or many values
        if (is_array($values)) {
            $statement->execute($values);
        } else {
            $statement->execute(array(':value' => $values));
        }

        /**record and print any database error that might occur */
        $errorMessage = $statement->errorInfo();
        if ($errorMessage[1]) {
            print_r($errorMessage);
        } else {
            return true;
        }
        return false;

    }


    /**
     * @param $table, to get the total number of rows.
     * @param $column_name, will contain the various columns/fields (as an array) in the database.
     * @param $values, will contain the various values (as an array) provided when calling the getRowCount function.
     * @return true if successful and false (with errors) in case of any failure
     */
    public function getRowCount($table,$column_name,$values){

        //build the columns and loop through the column(s) given
        $buildColumns = '';
        if (is_array($column_name)) {
            //loop through all the columns
            foreach($column_name as $key => $columns) {
                if ($key == 0) {
                    //first column(s) item
                    $buildColumns .= $columns;
                } else {
                    //every other item follows with a ","
                    $buildColumns .= ', '.$columns;
                }
            }
        } else {
            //we are only inserting one field
            $buildColumns .= $column_name;
        }


        //build the values and loop through the value(s) given
        $buildValues = '';
        if (is_array($values)) {
            //loop through all the fields
            foreach($values as $key => $value) {
                if ($key == 0) {
                    //first value(s) item
                    $buildValues .= '?';
                } else {
                    //every other item follows with a ","
                    $buildValues .= ', ?';
                }
            }
        } else {
            //this will insert just one field
            $buildValues .= ':value';
        }

        $adb = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
        $columnQuery =" SELECT * FROM ".$table." WHERE ".$buildColumns." = $buildValues ";
        $statement = $adb->prepare($columnQuery);
        //execute the Query
        if (is_array($values)) {
            $statement->execute($values);
        } else {
            $statement->execute(array(':value' => $values));
        }
        $data =  $statement->rowCount();
        echo $data;

        /**record and print any database error that might occur */
        $errorMessage = $statement->errorInfo();
        if ($errorMessage[1]) {
            print_r($errorMessage);
        } else {
            return true;
        }
        return false;

    }



    /**
     * @param $page, will direct the user the required page.
     * @param $id, will direct the user the $page with the ID.
     */
    public function redirectToPageID($page,$id){
       header("location: {$page}.php?id={$id}");
    }

    /**
     * @param $page, will direct the user the home page.
     */
    public function redirectToPage($page){
      header("location: {$page}.php");
    }

    /** @param $variable, to clean all output data from the database
     * @return*/
    public function filter($variable) {
        return filter_var($variable,FILTER_SANITIZE_STRIPPED);
        //return htmlspecialchars($variable, ENT_QUOTES,'UTF-8');
    }




    /** @param $user_id, will be encoded*/

    function rememberMe($user_id){

        $encryptCookieData = base64_encode("MFbi35GIzsExm9cL4c3bilTXA{$user_id}");
        // cookie set to expire in  30 days
        setcookie("emsUserCookie", $encryptCookieData, time()+60*60*24*30, "/");
    }

    function isCookieValid($adb){



        //setting the cookie to false by default
        $isValid = false;

        if (isset($_COOKIE['emsUserCookie'])) {
            /**
             * Decode cookie and extract user ID
             */
            $decryptCookieData = base64_decode($_COOKIE['emsUserCookie']);
            $user_id = explode("MFbi35GIzsExm9cL4c3bilTXA", $decryptCookieData);
            $userID = $user_id[1];

            /**
             * check if id retrieved from the cookie exits in the database
             */
            $adb = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
            $sqlQuery = "SELECT * FROM users WHERE users_id = :users_id";
            $statement = $adb->prepare($sqlQuery);
            $statement->execute([':users_id' => $userID]);

            if ($row = $statement->fetch()){
                $user_id = $row['users_id'];
                $username = $row['names'];

                /**
                 * create the user session variable
                 */
                $_SESSION['ems_id'] = $user_id;
                $_SESSION['ems_username'] = $username;
                $isValid = true;
            } else {
                /**
                 * cookie ID is invalid destroy session and logout user
                 */
                $isValid = false;
                $RunQuery = new QueryControllers();
                $RunQuery->signOut();
            }
        }
        return $isValid;
    }



    /**This function  will signOut the user and destroy the previous user cookie */
    function signOut(){
        unset($_SESSION['ems_username']);
        unset($_SESSION['ems_id']);

        if(isset($_COOKIE['emsUserCookie'])){
            unset($_COOKIE['emsUserCookie']);
            setcookie('emsUserCookie', null, -1, '/');
        }
        session_destroy();
        session_regenerate_id(true);
        $RunQuery = new QueryControllers();
        $RunQuery->redirectToPage('login');
    }

    /** Guard function that will sign out the user if the user is inactive for the specified duration in the function */
    function guard(){

        $isValid = true;
        $inactive = 60*30; //2 mins
        $fingerprint = md5($_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']);

        if(isset($_SESSION['fingerprint']) && $_SERVER['HTTP_USER_AGENT'] != $fingerprint){
            $isValid = false;
            $RunQuery = new QueryControllers();
            $RunQuery->signOut();

        }else if((isset($_SESSION['last_active']) && (time() - $_SESSION['last_active']) > $inactive) && $_SESSION['ems_username']){
            $isValid = false;
            $RunQuery = new QueryControllers();
            $RunQuery->signOut();
        }else{
            $_SESSION['last_active'] = time();
        }

        return $isValid;
    }

    /**
     * @param $user_id
     *  @param $username
     *  @param $remember
     *  */
    function prepLogin($user_id, $username, $remember){
        $_SESSION['ems_id'] = $user_id;
        $_SESSION['ems_username'] = $username;

        $fingerprint = md5($_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']);
        $_SESSION['last_active'] = time();
        $_SESSION['fingerprint'] = $fingerprint;

        if ($remember === "yes"){
            $RunQuery = new QueryControllers();
            $RunQuery->rememberMe($user_id);
        }
    }





    /**
     * @param $value, provided by user
     * in this case 'email' and value is the input entered by the user
     *  @param $adb,database connection
     * @return true,  on success and false on failure
     */
    public function checkDuplicateEmails($value, $adb){

        try {
            $adb = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
            $sqlQuery = "SELECT email FROM admin_users WHERE  email=:email";
            $statement = $adb->prepare($sqlQuery);
            $statement->execute(array(':email' => $value));

            if ($row = $statement->fetch()) {
               return true;
            }

        } catch (PDOException $ex) {

        }
        return false;
    }


/**
 * @param  $value,the name of the table
 * @param  $adb, for the database connection
 * @return true,if data is found
 * This function is to check duplicate categories in the main  categories table */
    public function checkDuplicateMainCat($value, $adb){
        try {
            $adb = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
            $sqlQuery = "SELECT main_cat FROM main_category WHERE  main_cat = :main_cat";
            $statement = $adb->prepare($sqlQuery);
            $statement->execute(array(':main_cat' => $value));

            if ($row = $statement->fetch()) {
                return true;
            }
            return false;

        } catch (PDOException $ex) {
            // echo "Registration Failed" . $ex->getMessage();
        }

    }

    /**
     * @param  $value,the name of the table
     * @param  $adb, for the database connection
     * @return true,if data is found
     * This function is to check duplicate categories in the sub  categories table */
    public function checkDuplicateSubCat($value, $adb){
        try {
            $adb = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
            $sqlQuery = "SELECT sub_cat FROM sub_category WHERE  sub_cat = :sub_cat";
            $statement = $adb->prepare($sqlQuery);
            $statement->execute(array(':sub_cat' => $value));

            if ($row = $statement->fetch()) {
                return true;
            }
            return false;

        } catch (PDOException $ex) {
            // echo "Registration Failed" . $ex->getMessage();
        }

    }



    /**
     * @param  $value ,the name of the table
     * @param  $adb , for the database connection
     * @return true,if data is found
     * This function is to check duplicate equipment names in the equipment table */
    public function checkDuplicateEquip($value, $adb)
    {
        try {
            $adb = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
            $sqlQuery = "SELECT e_name FROM equipments WHERE  e_name = :e_name";
            $statement = $adb->prepare($sqlQuery);
            $statement->execute(array(':e_name' => $value));

            if ($row = $statement->fetch()) {
                return true;
            }
            return false;

        } catch (PDOException $ex) {
            // echo "Registration Failed" . $ex->getMessage();
        }


    }




   public function runQuery($query) {
        $adb = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
       $statement = $adb->prepare($query);
       $statement->execute();
       while($row = $statement->fetch()) {
            $resultset[] = $row;
        }

        if(!empty($resultset))

            return $resultset;
    }


    public function numRows($query) {
        $adb = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
        $statement = $adb->prepare($query);
        $statement->execute();
        $rowcount = $statement->rowCount();
        return $rowcount;
    }





    public function Notification($position,$type,$title){
        echo $message = '<script>
               swal({
               position: \''.$position.'\',
               type: \''.$type.'\',
               title:\''.$title.'\',
               showConfirmButton: false,
               timer: 1500
             })
</script>';
        return $message;
    }



}





class notifyMessages{
    /**
     * @param $message, provided  to alert the Error for Invalid Token
     ** @param $title, for error tittle
     */
    public function InvalidToken($title,$message){
        echo '<script>
        swal({
  title: \''.$title.'\',
  text: \''.$message.'\',
  type: \'error\',
  timer: 9000,
  showCancelButton: false,
  confirmButtonColor: \'#d33\',
  confirmButtonText: \'OK !!!\'
})
</script>';
    }




}


?>
