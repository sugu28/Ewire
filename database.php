<?php 
//$username = "162.144.59.148";
//$user = "sbsrkann_KFW";
//$password = "KFW123kfw!@#";
//$database = 'sbsrkann_Universal_Test_DB';
//
//$db = new mysqli($username, $user, $password, $database);
//if (!$db) {
//
//    echo "Database Connection failed!";
//
//}



// Database configuration  
define('DB_HOST', 'localhost'); 
define('DB_USERNAME', 'root'); 
define('DB_PASSWORD', ''); 
define('DB_NAME', 'ifinpaym_updbewire');


// Connect with the database  
$db = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);  
  
// Display error if failed to connect   
if ($db->connect_errno) {  
    printf("Connect failed: %s\n", $db->connect_error);  
    exit();  
}
?>