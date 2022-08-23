<?php session_start();
include "database.php";

//include "login.php";
//
//
//if(empty($_SESSION['login']) && empty($_SESSION['uid'])){
//    header("Location:../../logout.php");
//}
?>
<script src="sweetalert2.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function success() {
        Swal.fire(
            'Done!',
            'User has been Added.',
            'success'
        )
    }

    function Requested() {
        Swal.fire(
            'Done!',
            'Requested Successfully.',
            'success'
        )
    }

    function oops() {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Invalid OTP'
        })
    }
</script>
<style>
    .logo {
        font-weight: bold;
        color: #da8cff;
    }

    body {
        font-family: Arial, Helvetica, sans-serif;
    }

    /* The Modal (background) */
    .modal,
    .modal1 {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
        z-index: 1;
        /* Sit on top */
        padding-top: 100px;
        /* Location of the box */
        left: 0;
        top: 0;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Enable scroll if needed */
        background-color: rgb(0, 0, 0);
        /* Fallback color */
        background-color: rgba(0, 0, 0, 0.4);
        /* Black w/ opacity */
    }

    /* Modal Content */
    .modal-content-popup {
        background-color: #fefefe;
        margin: auto;
        border-radius: 17px;
        padding: 20px;
        border: 1px solid #888;
        width: 40%;
    }

    /* The Close Button */
    .close,
    .close1 {
        color: #aaaaaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close1:hover,
    .close:focus,
    .close1:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }
</style>
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
        .form-group .mandatory:after {
            content: "*";
            color: red;
        }

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
                                    <h3 class="logo" style="color:black;">Forgot password/Change password</h3>
                                </div>
                                <form class="input-group mb-2" method="POST" action="Changepassword.php">
                                    <h4 class="mandatory">Enter Username</h4>
                                    <div class="input-group mb-2">
                                        <input name="Username" id="Username" maxlength="10" type="text" class="form-control" placeholder="Enter Mobile No" style="font-weight:bold" required autocomplete="off">
                                        <!-- <input type="submit" name="mobno" class="btn btn-info" id="otp" value="GET OTP" style="visibility: visible;height: 50px;"> -->
                                    </div>
                                    <h4 class="mandatory">Enter KIOSK ID</h4>
                                    <div class="input-group mb-2">
                                        <input name="kioskid" id="KIOSKID" type="text" class="form-control" placeholder="Enter KIOSK ID" style="font-weight:bold" required autocomplete="off">
                                        <!-- <input type="submit" name="mobno" class="btn btn-info" id="otp" value="GET OTP" style="visibility: visible;height: 50px;"> -->
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <button type="submit" name="SubmitOTP" class="btn btn-rounded btn-info btn-md font-weight-medium auth-form-btn" value="SUBMIT" style="visibility: visible;height: 50px;">SUBMIT</button>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <a href="index.php" type="submit" name="back" class="btn btn-rounded btn-info btn-md font-weight-medium auth-form-btn" value="BACK">BACK</a>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Popup modal -->
                                    <div id="myModal" class="modal">
                                        <div class="modal-content-popup">
                                            <span class="close">&times;</span>
                                            <div class="input-group mb-2" id="otpShow1">
                                                <label for="limit" class="form-control" style="font-weight:bold;font-size:17px">Enter OTP </label>
                                                <input id="OTP" name="OTP" type="text" class="form-control" placeholder="OTP" maxlength="4" onkeypress="return event.charCode >= 48 && event.charCode <= 57" style="font-weight:bold">
                                                <input type="submit" name="Register" class="btn btn-info" style="width:20%;height: 60px;" id="btnOtp" value="Submit" />
                                            </div>
                                            <p><strong>Time Left:<mark id="timer"></mark></strong></p>
                                        </div>
                                    </div>
                                    <!-- Popup Modal End -->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- OTP timer -->

        <script>
            document.getElementById('timer').innerHTML =
                01 + ":" + 11;
            startTimer();


            function startTimer() {
                var presentTime = document.getElementById('timer').innerHTML;
                var timeArray = presentTime.split(/[:]+/);
                var m = timeArray[0];
                var s = checkSecond((timeArray[1] - 1));
                if (s == 59) {
                    m = m - 1
                }
                if (m < 0) {
                    return
                }

                document.getElementById('timer').innerHTML =
                    m + ":" + s;
                console.log(m)
                setTimeout(startTimer, 1000);

            }

            function checkSecond(sec) {
                if (sec < 10 && sec >= 0) {
                    sec = "0" + sec
                }; // add zero in front of numbers < 10
                if (sec < 0) {
                    sec = "59"
                };
                return sec;
            }
            var span = document.getElementsByClassName("close")[0];
            span.onclick = function() {
                myModal.style.display = "none";
            }


            function GetOTP() {
                document.getElementById("myModal").style.display = "block";
                window.onclick = function(event) {
                    if (event.target == myModal) {
                        myModal.style.display = "none";
                    }
                }
            }
        </script>
        <script>
            var span = document.getElementsByClassName("close")[0];
            span.onclick = function() {
                myModal.style.display = "none";
            }

            function GetOTP(Parameter) {
                var ParameterArray = Parameter.split(",");
                document.getElementById("Username").value = ParameterArray[0];
                document.getElementById("KIOSKID").value = ParameterArray[1];
                document.getElementById("myModal").style.display = "block";
            }
        </script>

        <?php
        if (isset($_POST['SubmitOTP'])) {

            if ($_POST["Username"] != "" &&  $_POST["kioskid"] != "") {
                $Username = $_POST["Username"];
                $kioskid = $_POST["kioskid"];
                $reg = mysqli_query($db, "SELECT Phone from tblRetailer where UserName='$Username' AND kioskId = '$kioskid'");
                $rows = mysqli_num_rows($reg);
                while ($row = mysqli_fetch_array($reg)) {
                    $retmobile = $row['Phone'];
                }
                if ($rows == 1) {
                    $_SESSION['number'] = $retmobile;
                    // $User_ID = $_SESSION['User_ID'];
                    $User_Mobile = $_SESSION['number'];
                    $mobile = $User_Mobile;
                    $numbers = array($mobile);
                    $ottp = (string)mt_rand(1000, 9999);
                    $REF_ID = (string)mt_rand(36523462, 99999999);
                    $fourRandomDigit = "OTP : " . $ottp;
                    $_SESSION['OTP'] = $ottp;
                    $uid = 'interactivfin';
                    $pwd = urlencode('13005');
                    $Peid = '1601100000000016430';
                    $tempid = '1607100000000217622';
                    $sender = urlencode('IFINKI');
                    $kkk = 'Dear user, Ref.ID ' . $REF_ID . ', Thank you for register with  iFIN PAYMENTS. Your credentials are ' . $fourRandomDigit . '. - Interactiv FinServe Kiosk';
                    $msg = $kkk;
                    //$msg = '' . $fourRandomDigit . ' is your One Time Password (OTP) to transfer Rs.' . $REF_ID . ' to A/c No.' . $REF_ID . ' - Interactiv FinServe Kiosk';
                    $message = rawurlencode($msg);
                    $numbers = implode(',', $numbers);
                    $dtTime = date('m-d-Y h:i:s A');
                    $data = '&uid=' . $uid . '&pwd=' . $pwd . '&mobile=' . $numbers . '&msg=' . $message . '&sid=' . $sender . '&type=0' . '&dtTimeNow=' . $dtTime . '&entityid=' . $Peid . '&tempid=' . $tempid;
                    $ch = curl_init('http://smsintegra.com/api/smsapi.aspx?');
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $response = curl_exec($ch);
                    curl_close($ch);
                    //echo "<script>alert('Message Sent to '" . $User_Mobile . "');</script>";
                    $Parameter = "'" . $Username . "," . $kioskid . "'";
                    echo "<script type='text/javascript'>GetOTP($Parameter);</script>";
                    //echo '<script type="text/javascript">jsFunction(' . $SubmitOTP . ');</script>';                
                } else {
                    echo "<script>alert('Invalid Username or Kioskid');</script>";
                }
            }
        }


        if (isset($_POST['Register'])) {
            $otpText = $_POST["OTP"];
            if ($otpText == $_SESSION['OTP']) {
                $Username = mysqli_real_escape_string($db, $_POST["Username"]);
                $kiosk = mysqli_real_escape_string($db, $_POST["kioskid"]);
                echo "<script> location.href='Createpassword.php?username=" . $Username . "&kioskid=" . $kiosk . "'; </script>";
            } else {
                echo "<script>oops();</script>";
            }
        }
        ?>
        <!-- OTP timer End-->
        <!-- OTP timer -->
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
<<<<<<< HEAD
..........................
=======

>>>>>>> 48a64901e5fbddfa26244871f31a99082e126603
</html>