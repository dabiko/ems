<?php
  define('DB_DSN', 'mysql:host=localhost; port=3306; dbname=ems');
  define('DB_USER', 'root');
  define('DB_PASSWORD', 'Sadler10');

  // Define database connection constants
//   define('DB_HOST', 'katambatechcom1.ipagemysql.com');
//   define('DB_USER', 'ems');
//   define('DB_PASSWORD', 'ems');
//   define('DB_NAME', 'ems');


try{

/** @var  $adb, create an instance of the PDO class with the required paramters */
    $adb = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
    $adb->exec("set names utf8");

/** set PDO error mode to exception */
    $adb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $adb->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $adb->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

//display success message
    //echo "Connected Successfully".'<br>';

}catch(PDOException $ex) {

    echo "Connection to database Failed" . $ex->getMessage();

}



