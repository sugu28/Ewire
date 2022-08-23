<?php session_start();
include "database.php";
$kioskid = $_GET['kioskid'];
$username = $_GET['username'];

if (isset($_POST['login'])) {
    $CreatePassword = mysqli_real_escape_string($db, $_POST["CreatePassword"]);
    $ConfrimPassword = mysqli_real_escape_string($db, $_POST["ConfrimPassword"]);
    if ($CreatePassword ==  $ConfrimPassword) {
        $query1   = "UPDATE `tblRetailer` SET Password = '$CreatePassword' WHERE UserName ='$username' AND kioskId = '$kioskid' ";
        $result1   = mysqli_query($db, $query1);
        if ($result1) {
            echo "<script>alert('Password Changed');</script>";
            echo "<script>location.href='index.php';</script>";
        }
    } else {
        echo "<script>alert('Password Doesn`t Match');</script>";
    }
}
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
    <title>IFSK Change Password</title>
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

<body>

    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <!--  -->
            <div class="content-wrapper d-flex align-items-center auth" style="background:url(assets/images/Copy.jpeg);background-size:cover">
                <div class="content-wrapper1 d-flex align-items-center auth">
                    <div class="row flex-grow">
                        <div class="col-lg-4 mx-auto">
                            <div class="auth-form-dark text-left p-5" style="border-radius:20px;margin-top: -70%;">
                                <div class="brand-logo" style="text-align: center;">
                                    <h3 class="logo" style="color:black;">Create password</h3>
                                </div>
                                <form class="pt-3" name="login" method="post">
                                    <div class="form-group">
                                        <input type="password" name="CreatePassword" class="form-control form-control-lg" placeholder="Create Password" style="border-radius: 7px; color:black;" required autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="ConfrimPassword" class="form-control form-control-lg" placeholder="Confrim Password" style="border-radius: 7px; color:black;" required autocomplete="off">
                                    </div>
                                    <div class="mt-3" style="text-align: center;">
                                        <button type="submit" name="login" class="btn btn-rounded btn-info btn-md font-weight-medium auth-form-btn" value="SUBMIT">SUBMIT</button>
                                    </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
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