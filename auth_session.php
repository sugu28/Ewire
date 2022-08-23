
<?php
 if (!isset($_SESSION)) {
      $_SESSION = array();
    }
    //session_start();
    if(!isset($_SESSION["UserId"])) {
       // header("Location: index.php");
        exit();
    }

//    if(!isset($_SESSION["UserId"])) {
//        exit();
//    }

?>
