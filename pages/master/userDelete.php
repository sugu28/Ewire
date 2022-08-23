<?php session_start();  
include "../../database.php";
if($_GET['UID']){
    $UserID = $_GET['UID'];
    $query="UPDATE users SET isActive = 0 WHERE Id = '$UserID'";
      $res= mysqli_query($db, $query);
      if ($res) {
               echo "<script>alert('Deleted Successfully');</script>";
            }
            else {
                echo "<script>alert('Deleting User Failed');</script>";
            }

    // mysql_query("delete from products where product_id='".$_GET['did']."'");
    // echo "delete from products where product_id='".$_GET['did']."'";
    // echo mysql_errno() . ": " . mysql_error() ;    
    // die();

    
    ob_start(); // ensures anything dumped out will be caught

    // do stuff here
    $url = 'manageusers.php'; // this can be set based on whatever
    //$url = 'https://kfwlogin.com/pages/master/manageusers.php';
    // clear out the output buffer
    while (ob_get_status()) 
    {
        ob_end_clean();
    }
    
    // no redirect
    header( "Location: $url" );


    // header("Location: https://kfwlogin.com/pages/master/manageusers.php");
}


?>