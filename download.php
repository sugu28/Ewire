<?php session_start();
include "../../database.php";
//include("../../auth_session.php");
//session_destroy();

     $id = $_GET['val'];
     global $db;
                                                $sqlselectimageFromDb = "SELECT CameraCapture FROM `tblCyberPlatCashTransfer` where Id=".$id;
                                                $dataFromDb = mysqli_query($db, $sqlselectimageFromDb);
                                                while ($row = mysqli_fetch_assoc($dataFromDb)) {
                                                   
             $fileData = $row["CameraCapture"];
                    header("Content-type: image/png");
                    header('Content-disposition: attachment; filename=file2.jpg');
                    header("Content-length: ".strlen($fileData)); 
                    //echo $fileData;
                    //echo '<img height="250px" width="250px" src="data:CameraCapture/png;base64, '.$fileData.'" />';
                 echo '<img height="250px" width="250px" src="data:CameraCapture/png;base64, '.$fileData.'" alt="Red dot" />';
                    exit();
                                                }
       
?>
