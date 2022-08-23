<?php session_start();
include "database.php";

//include "login.php";
//
//
//if(empty($_SESSION['login']) && empty($_SESSION['uid'])){
//    header("Location:../../logout.php");
//}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <script language="JavaScript">
        javascript: window.history.forward(0);
    </script>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>iFIN PAYMENTS LOGIN</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets/images/KFW.jpeg" />

    <style>
        .logo {
            font-weight: bolder;
            color: white;
            cursor: pointer;
        }
    </style>
</head>
<?php

if (isset($_POST['login'])) {
    $userName = mysqli_real_escape_string($db, $_POST["userid"]);
    $password = mysqli_real_escape_string($db, $_POST["password"]);

    // echo $username ." ". md5($password);

    // Check user is exist in the database
    $query = "SELECT users.BCID, users.kioskid, users.Phone, users.UserName, users.FkRoleID, userRole.RoleName, users.Id FROM users INNER JOIN userRole ON users.FkRoleID = userRole.PKRoleId WHERE users.UserName = '$userName' AND users.Password = '$password'"; //' . md5($password) . "'";


    //        $query    = "SELECT * FROM `students_reg` WHERE username='$username'
    //                     AND password='" . md5($password) . "'";

    $result = mysqli_query($db, $query) or die(mysqli_error($db));
    $rows = mysqli_num_rows($result);
    while ($row = mysqli_fetch_array($result)) {
        //$student_id = $row['UserId'];
        $_SESSION['User_RoleID']  = $row['FkRoleID'];
        $_SESSION['User_RoleName']  = $row['RoleName'];
        $_SESSION['User_ID'] = $row['Id'];
        $_SESSION['User_BCID'] = $row['BCID'];
        $_SESSION['User_KioID'] = $row['kioskid'];
        $_SESSION['User_Mobile'] = $row['Phone'];
        $_SESSION['User_Name'] = $userName;
    }

    if ($rows == 1) {
        $kioID =  $_SESSION['User_KioID'];
        $User_ID =   $_SESSION['User_ID'];

        if ($_SESSION['User_RoleName'] == 'Retailer') {
            $query = "SELECT MaximumLimit,Available_Balance FROM tblRetailer WHERE tblRetailer.kioskId = '$kioID' ";
            $result = mysqli_query($db, $query) or die(mysqli_error($db));
            while ($row = mysqli_fetch_array($result)) {
                //$student_id = $row['UserId'];
                $_SESSION['AvailableLimit'] = $row['Available_Balance'];
                $_SESSION['MaximumLimit'] = $row['MaximumLimit'];
            }
            $query = "SELECT SUM(Requested_limit) AS RequestedTotal FROM tblLimitTable WHERE tblLimitTable.`Status` ='success' AND KioskID = '$kioID'";

            //$query  = "SELECT SUM(Requested_limit) RequestedTotal FROM tblLimitTable WHERE KioskID = '$kioID' ";
            // $query1 ="SELECT AvailableLimit FROM tblRetailer WHERE UserID='$User_ID'";
            $result = mysqli_query($db, $query) or die(mysqli_error($db));
            while ($row = mysqli_fetch_array($result)) {
                //$student_id = $row['UserId'];
                $_SESSION['RequestedTotal'] = $row['RequestedTotal'];
            }
        }
        // Redirect to user dashboard page
        // echo "<script>alert('.$userid. or .$RoleID. or .$RoleName.');</script>";
        // console.log ($_SESSION['UserId'],$_SESSION['RoleID'],$_SESSION['RoleName']);
        // header("Location: https://kfwlogin.com/dashboard.php");

        ob_start(); // ensures anything dumped out will be caught

        // do stuff here
        //  $url = 'https://kfwlogin.com/dashboard.php'; // this can be set based on whatever
        //$url = 'dashboard.php'; // this can be set based on whatever

        // clear out the output buffer
        while (ob_get_status()) {
            ob_end_clean();
        }

        // no redirect
        //header( "Location: $url" );

        // echo "<script>rediredtToDash()</script>";

        echo "<script> location.href='dashboard.php'; </script>";


        // echo "<script> window.location = 'https://kfwlogin.com/dashboard.php' </script>";

        // HTML: <meta http-equiv="refresh" content="0;url=http://www.site.com/cart.php">

        // JavaScript #1: <script>window.location = "http://www.site.com/cart.php";</script>

        // JavaScript #2: <script>window.navigate("http://www.site.com/cart.php");</script>
    } else {
        echo "<script>alert('Invalid UserId or Password');</script>";
    }
}
?>

<body>

    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <!--  -->
            <div class="content-wrapper d-flex align-items-center auth" style="background:url(assets/images/Copy.jpeg);background-size:cover">
                <div class="content-wrapper1 d-flex align-items-center auth">
                    <div class="row flex-grow">
                        <div class="col-lg-4 mx-auto">
                            <div class="auth-form-dark text-left p-5 " style="border-radius:20px;margin-top: -70%;background:light">
                                <div class="brand-logo" style="text-align: center;">
                                    <h1 class="logo" style="color:black;">LOGIN</h1>
                                </div>
                                <!--
                            <h4 style="color: white;">Hello! let's get started</h4>
                            <h6 class="font-weight-light" style="color: white;">Sign in to continue.</h6>
-->
                                <form class="pt-3" name="login" method="post">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-lg" name="userid" id="userid" placeholder="UserID" style="border-radius: 7px; color:black;" required autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-lg" name="password" id="password" placeholder="Password" style="border-radius: 7px; color:black;" required autocomplete="off">
                                    </div>
                                    <div class="mt-3" style="text-align: center;">
                                        <input type="submit" name="login" class="btn btn-rounded btn-info btn-md font-weight-medium auth-form-btn" value="SIGN IN" />
                                    </div>
                                   

                                </form>
                                 <div class="my-2 d-flex justify-content-between align-items-center">
                                        <div class="form-check" style="text-align: center;">
                                            <label  class="form-check-label text-muted">
                                                <input type="" class="form-check-input"> <i class="input-helper"></i></label>
                                        </div>
                                        <a href="Changepassword.php"  class="auth-link text-bule">Forgot/Change Password</a>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
            </div>
            <!-- page-body-wrapper ends -->
        </div>
        <!-- container-scroller -->
        <!-- plugins:js -->


        <script>
            function rediredtToDash() {
                debugger;
                //            window.location = "https://kfwlogin.com/dashboard.php";  
                window.location = "dashboard.php";
            }
        </script>


        <script src="assets/vendors/js/vendor.bundle.base.js"></script>
        <!-- endinject -->
        <!-- Plugin js for this page -->
        <!-- End plugin js for this page -->
        <!-- inject:js -->
        <script src="assets/js/off-canvas.js"></script>
        <script src="assets/js/hoverable-collapse.js"></script>
        <script src="assets/js/misc.js"></script>
        <!-- endinject -->
</body>

</html>