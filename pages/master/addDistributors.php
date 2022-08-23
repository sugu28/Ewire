<?php session_start();
include "../../database.php";
//include("../../auth_session.php");
//session_destroy();
//Code for Registration 

$id = "";
$username = "";
$fullname = "";
$shopname = "";
$bcid = "";
$location = "";
$debitcard = "";
$gst = "";
$adhar = "";
$pan = "";
$cpuid = "";
$dispenser = "";
$acceptor = "";
$fkrole = "";
$dob = "";
$password = "";
$phone = "";
$kiosk = "";
$address1 = "";
$state = "";
$address2 = "";
$postcode = "";
$city = "";
$country = "";
// $_SESSION['Edit'] = null;
if ($_GET['Edit'] != null) {
    $edit = $_GET['Edit'];
    $_SESSION['Edit'] = $edit;

    if ($_SESSION['Edit'] == 1) {
        $id = $_GET['id'];
        $username = $_GET['username'];
        $fullname = $_GET['fullname'];
        $shopname = $_GET['shopname'];
        $bcid = $_GET['bcid'];
        $location = $_GET['location'];
        $debitcard = $_GET['debitcard'];
        $gst = $_GET['gst'];
        $adhar = $_GET['adhar'];
        $pan = $_GET['pan'];
        $cpuid = $_GET['cpuid'];
        $dispenser = $_GET['dispenser'];
        $acceptor = $_GET['acceptor'];
        $fkrole = $_GET['fkrole'];
        $dob = $_GET['dob'];
        $password = $_GET['password'];
        $phone = $_GET['phone'];
        $kiosk = $_GET['kiosk'];
        $address1 = $_GET['address1'];
        $state = $_GET['state'];
        $address2 = $_GET['address2'];
        $postcode = $_GET['postcode'];
        $city = $_GET['city'];
        $country = $_GET['country'];
    }
}
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

    function Updated() {
        Swal.fire(
            'Done!',
            'Updated Successfully.',
            'success'
        )
    }

    function oops() {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'User already Exists'
        })
    }
</script>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>add Distributors</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../../assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../../assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End Plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="../../assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="../../assets/images/KFW.jpeg" />
    <style>
        .form-group .mandatory:after {
            content: "*";
            color: red;
        }

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
        .modal-content {
            background-color: #fefefe;
            margin: auto;
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
</head>

<body>
    <div class="container-scroller">
        <!-- partial:../../partials/_navbar.html -->
        <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo" href="../../dashboard.php"><img src="../../assets/images/KFW.jpeg"></a>
                <a class="navbar-brand brand-logo-mini" href="../../dashboard.php"><img src="../../assets/images/logo-mini.svg" alt="logo" /></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-stretch">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="mdi mdi-menu"></span>
                </button>

                <ul class="navbar-nav navbar-nav-right">
                    <?php
                    if ($_SESSION['User_RoleID'] == 2) {
                    ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-email-outline" style="color: #af67ff;"></i>
                                <!-- <span class="count-symbol bg-warning">5</span> -->

                                <?php
                                $sql = "SELECT COUNT(tblLimitTable.`Status`) AS count FROM tblLimitTable INNER JOIN tblRetailer ON 
tblLimitTable.kioskid = tblRetailer.kioskId INNER JOIN tblMasterDistributor ON 
tblRetailer.MasterDistributorID = tblMasterDistributor.Id 
WHERE tblMasterDistributor.UserID = '101' AND tblLimitTable.`Status` = 'Pending'";
                                $result = mysqli_query($db, $sql);
                                while ($row = mysqli_fetch_array($result)) {  ?>


                                    <p class="text-gray mb-0" style="font-weight: bold;color: red;"> <?php echo $row['count'] ?> </p>
                                <?php }

                                ?>

                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                                <h6 class="p-3 mb-0">Requests</h6>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item preview-item">
                                    <div class="preview-thumbnail">
                                        <!-- <img src="../../assets\images\faces-clipart\pic-1.png" alt="image" class="profile-pic"> -->
                                    </div>
                                    <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                        <?php
                                        $uid = $_SESSION['User_ID'];
                                        $sql = "SELECT tblLimitTable.* FROM tblLimitTable INNER JOIN tblRetailer ON tblLimitTable.kioskid = tblRetailer.kioskId INNER JOIN tblMasterDistributor ON 
                                            tblRetailer.MasterDistributorID = tblMasterDistributor.Id 
                                            WHERE tblMasterDistributor.UserID = '$uid' AND tblLimitTable.`Status` = 'Pending'";
                                        $result = mysqli_query($db, $sql);
                                        while ($row = mysqli_fetch_array($result)) {  ?>
                                            <h6 class="preview-subject ellipsis mb-1 font-weight-normal"><?php echo $row['KioskID'] . " " . "Requested" ?>
                                            </h6>
                                            <a href="pages/Direct/ViewRequest.php">
                                                <h6 class="preview-subject ellipsis mb-1 font-weight-normal"><?php echo $row['Requested_limit'] . " " . "Limit" ?>
                                                </h6>
                                            </a>
                                            <a href="pages/Direct/ViewRequest.php">
                                                <p class="text-gray mb-0"> <?php echo $row['Requested_On'] ?> </p>
                                            </a>
                                        <?php } ?>
                                    </div>
                                </a>
                                <!-- <h6 class="p-3 mb-0 text-center">4 new messages</h6> -->
                            </div>
                        </li>
                    <?php
                    }
                    ?>
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="nav-profile-img">
                                <img src="../../assets\images\faces-clipart\pic-1.png">
                                <span class="availability-status online"></span>
                            </div>
                            <div class="nav-profile-text">
                                <p class="mb-1 text-black"><?php echo $_SESSION['User_Name']; ?></p>
                            </div>
                        </a>
                        <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                            <!--    <a class="dropdown-item" href="#">
                            <i class="mdi mdi-cached me-2 text-success"></i> Activity Log </a> -->
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="../../logout.php" style="color:black">
                                <i class="mdi mdi-logout me-2 text-primary"></i>Signout </a>
                        </div>
                    </li>
                    <li class="nav-item d-none d-lg-block full-screen-link">
                        <a class="nav-link">
                            <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
                        </a>
                    </li>

                    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                        <span class="mdi mdi-menu"></span>
                    </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item nav-profile">
                        <a href="#" class="nav-link">
                            <div class="nav-profile-image">
                                <img src="../../assets\images\faces-clipart\pic-1.png">
                                <span class="login-status online"></span>
                                <!--change to offline or busy as needed-->
                            </div>
                            <div class="nav-profile-text d-flex flex-column">

                                <span class="font-weight-bold mb-2"><?php echo $_SESSION['User_Name']; ?></span>
                                <span class="text-secondary text-small"><?php echo $_SESSION['User_RoleName']; ?></span>
                                <span class="text-secondary text-small"><?php echo $_SESSION['User_KioID']; ?></span>
                            </div>
                            <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../dashboard.php">
                            <span class="menu-title">Dashboard</span>
                            <i class="mdi mdi-home menu-icon"></i>
                        </a>
                    </li>
                    <?php
                    if ($_SESSION['User_RoleName'] == 'Super Admin' || $_SESSION['User_RoleName'] == 'Master Distributor') {  ?>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                                <span class="menu-title">Master</span>
                                <i class="menu-arrow"></i>
                                <i class="mdi mdi-account menu-icon"></i>

                            </a>
                            <div class="collapse" id="ui-basic">
                                <ul class="nav flex-column sub-menu">

                                    <li class="nav-item"> <a class="nav-link" href="manageusers.php">Manage Users</a></li>
                                    <li class="nav-item"> <a class="nav-link" href="kioskdetails.php">Kiosk Details</a></li>
                                    <?php if ($_SESSION['User_RoleName'] == 'Super Admin') { ?>
                                        <li class="nav-item"> <a class="nav-link" href="addMasterDistributor.php">Add Master Distributor</a></li>
                                        <li class="nav-item"> <a class="nav-link" href="addDistributors.php">Add Distributors </a></li>
                                    <li class="nav-item"> <a class="nav-link" href="subDistributors.php">Sub Distributor</a>
                            </li>
                                    <?php } ?>
                                    <li class="nav-item"> <a class="nav-link" href="addUsers.php">Add Users </a></li>
                                    <li class="nav-item"> <a class="nav-link" href="pages/master/addDistributors.php">Add
                                    Distributors </a></li>
                                 <li class="nav-item"> <a class="nav-link" href="pages/master/subDistributors.php">Sub Distributor</a>
                            </li>
                            
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="awaiting.php">
                                <span class="menu-title">Manual Entry Transactions</span>
                                <i class="mdi mdi-transcribe menu-icon"></i>
                            </a>
                        </li>
                    <?php
                    }
                    ?>


                    <li class="nav-item">
                        <a class="nav-link" href="../../pages/Direct/Allbankcashdeposit.php">
                            <span class="menu-title">All Bank Cash Deposit</span>
                            <i class="mdi mdi-cash-multiple menu-icon"></i>
                        </a>
                    </li>


                    <!-- <li class="nav-item">
                        <a class="nav-link" href="../pages/Direct/Debitcardtransaction.php">
                            <span class="menu-title">Debit Card Withdrawal</span>
                            <i class="mdi mdi-account-card-details menu-icon"></i>
                        </a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link" href="../pages/Direct/Aadharpay.php">
                            <span class="menu-title">Aadhaar Pay</span>
                            <i class="mdi mdi-animation menu-icon"></i>
                        </a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link" href="../pages/Direct/QRcard.php">
                            <span class="menu-title">QR Card Withdrawal</span>
                            <i class="mdi mdi-home menu-icon"></i>
                        </a>
                    </li> -->

                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#BBPSBILLERS" aria-expanded="false" aria-controls="transactions">
                            <span class="menu-title">BBPS Billers IFSPL</span>
                            <i class="menu-arrow"></i>
                            <i class="mdi mdi-chart-areaspline menu-icon"></i>
                        </a>
                        <div class="collapse" id="BBPSBILLERS">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="../../pages/BBPSBILLERS/Airtel.php">Airtel</a></li>
                                <li class="nav-item"> <a class="nav-link" href="../../pages/BBPSBILLERS/Bsnl.php">Bsnl</a></li>
                                <li class="nav-item"> <a class="nav-link" href="../../pages/BBPSBILLERS/Idea.php">Idea</a></li>
                                <li class="nav-item"> <a class="nav-link" href="../../pages/BBPSBILLERS/Jio.php">Jio</a></li>
                                <li class="nav-item"> <a class="nav-link" href="../../pages/BBPSBILLERS/MTNLMumbai.php">MTNL Mumbai</a></li>
                                <li class="nav-item"> <a class="nav-link" href="../../pages/BBPSBILLERS/MTNLDelhi.php">MTNL Delhi</a></li>
                                <li class="nav-item"> <a class="nav-link" href="../../pages/BBPSBILLERS/Vodafone.php">Vodafone</a></li>
                                <li class="nav-item"> <a class="nav-link" href="../../pages/BBPSBILLERS/AirtelDTH.php">Airtel DTH</a></li>
                                <li class="nav-item"> <a class="nav-link" href="../../pages/BBPSBILLERS/DishTV.php">Dish TV</a></li>
                                <li class="nav-item"> <a class="nav-link" href="../../pages/BBPSBILLERS/Sundirect.php">Sundirect</a></li>
                                <li class="nav-item"> <a class="nav-link" href="../../pages/BBPSBILLERS/TataskyRetails.php">Tatasky Retails</a></li>
                                <li class="nav-item"> <a class="nav-link" href="../../pages/BBPSBILLERS/TataskyOnline.php">Tatasky Online</a></li>
                                <li class="nav-item"> <a class="nav-link" href="../../pages/BBPSBILLERS/VideoconD2H.php">Videocon D2H</a></li>
                                <li class="nav-item"> <a class="nav-link" href="../../pages/BBPSBILLERS/VodafoneDatacard.php">Vodafone Datacard</a></li>
                                <li class="nav-item"> <a class="nav-link" href="../../pages/BBPSBILLERS/AirtelDatacard.php">Airtel Datacard</a></li>
                                <li class="nav-item"> <a class="nav-link" href="../../pages/BBPSBILLERS/Ideadatacard.php">Idea data card</a></li>
                                <li class="nav-item"> <a class="nav-link" href="../../pages/BBPSBILLERS/Electricity.php">Electricity</a></li>
                                <li class="nav-item"> <a class="nav-link" href="../../pages/BBPSBILLERS/Gas.php">Gas</a></li>
                                <li class="nav-item"> <a class="nav-link" href="../../pages/BBPSBILLERS/Water.php">Water</a></li>
                                <li class="nav-item"> <a class="nav-link" href="../../pages/BBPSBILLERS/TelecomMobileAndLandline.php">Telecom Mobile And Landline Post Paid Online</a></li>
                                <li class="nav-item"> <a class="nav-link" href="../../pages/BBPSBILLERS/TelecomMobilepostpaid.php">Telecom Mobile And Landline Post Retails</a></li>

                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#NONBBPS" aria-expanded="false" aria-controls="ui-basic">
                            <span class="menu-title">Non BBPS Billers - IFSPL</span>
                            <i class="menu-arrow"></i>
                            <i class="mdi mdi-apps-box menu-icon"></i>
                        </a>
                        <div class="collapse" id="NONBBPS">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="../../pages/NONBBPS/cellonepostpaid.php">Cellone Post Paid</a></li>
                                <li class="nav-item"> <a class="nav-link" href="../../pages/NONBBPS/ideapostpaid.php">Idea Post Paid</a></li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#Internetserviceproviders" aria-expanded="false" aria-controls="ui-basic">
                            <span class="menu-title">Internet Service Providers</span>
                            <i class="menu-arrow"></i>
                            <i class="mdi mdi-internet-explorer menu-icon"></i>
                        </a>
                        <div class="collapse" id="Internetserviceproviders">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="../../pages/master/Internetserviceproviders/Tikonabill.php">Tikona Bill Payment</a></li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#InsuranceBillPay" aria-expanded="false" aria-controls="ui-basic">
                            <span class="menu-title">Insurance Bill Pay- IFSPL</span>
                            <i class="menu-arrow"></i>
                            <i class="mdi mdi-satellite menu-icon"></i>
                        </a>
                        <div class="collapse" id="InsuranceBillPay">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="../../pages/InsuranceBillPay/Tataaiglife.php">Tata AIG Life</a></li>
                                <li class="nav-item"> <a class="nav-link" href="../../pages/InsuranceBillPay/ICICIPruLife.php">ICICI Pru Life</a></li>
                                <li class="nav-item"> <a class="nav-link" href="../../pages/InsuranceBillPay/BhartiAxaLifeInsurance.php">Bharti Axa Life Insurance</a></li>
                                <li class="nav-item"> <a class="nav-link" href="../../pages/InsuranceBillPay/IndiaFirstInsurance.php">India First Insurance</a></li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="../../pages/fastag/fastag.php">
                            <span class="menu-title">Fasttag Recharge - IFSPL</span>
                            <i class="mdi mdi-transcribe menu-icon"></i>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#QRRecharge" aria-expanded="false" aria-controls="ui-basic">
                            <span class="menu-title">QR Recharge - IFSPL</span>
                            <i class="menu-arrow"></i>
                            <i class="mdi mdi-cellphone menu-icon"></i>

                        </a>
                        <div class="collapse" id="QRRecharge">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="../../pages/QRRecharge/amazonpay.php">Amazon Pay</a></li>
                                <li class="nav-item"> <a class="nav-link" href="../../pages/QRRecharge/GooglePay.php">Google Pay</a></li>
                                <li class="nav-item"> <a class="nav-link" href="../../pages/QRRecharge/Paytm.php">Paytm</a></li>
                                <li class="nav-item"> <a class="nav-link" href="../../pages/QRRecharge/PhonePe.php">PhonePe</a></li>
                                <li class="nav-item"> <a class="nav-link" href="../../pages/QRRecharge/AirtelPay.php">Airtel Pay</a></li>

                            </ul>
                        </div>
                    </li>

                    <!-- <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#reports" aria-expanded="false" aria-controls="ui-basic">
                            <span class="menu-title">Reports</span>
                            <i class="menu-arrow"></i>
                            <i class="mdi mdi-flag-outline menu-icon"></i>
                        </a>
                        <div class="collapse" id="reports">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="../../pages/reports/transactionlist.php">Transaction List</a></li>
                                <li class="nav-item"> <a class="nav-link" href="../../pages/reports/kiosklist.php">KIOSK List</a></li>
                            </ul>
                        </div>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#tools" aria-expanded="false" aria-controls="ui-basic">
                            <span class="menu-title">Tools</span>
                            <i class="menu-arrow"></i>
                            <i class="mdi mdi-settings menu-icon"></i>
                        </a>
                        <div class="collapse" id="tools">
                            <ul class="nav flex-column sub-menu">
                                <!-- <li class="nav-item"> <a class="nav-link" href="../tools/manageusers.php">MANAGE USERS</a></li> -->
                                <li class="nav-item"> <a class="nav-link" href="../../pages/tools/backup.php">Camera</a></li>
                                <li class="nav-item"> <a class="nav-link" href="../../pages/tools/Errorlog.php">Error Log</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#Reports" aria-expanded="false" aria-controls="ui-basic">
                            <span class="menu-title">Report</span>
                            <i class="menu-arrow"></i>
                            <i class="mdi mdi-settings menu-icon"></i>
                        </a>
                        <div class="collapse" id="Reports">
                            <ul class="nav flex-column sub-menu">
                                <!--                             <li class="nav-item"> <a class="nav-link" href="../Reports/Debit.php">Debit Card Transaction</a></li>-->
                                <li class="nav-item"> <a class="nav-link" href="../Reports/Direct.php">All Bank Cash Deposit</a></li>
                                <!--
                             <li class="nav-item"> <a class="nav-link" href="../Reports/QRCard.php">QR Card Withdrawal</a></li>
                             <li class="nav-item"> <a class="nav-link" href="../Reports/Aadhar.php">Aadhaar Pay</a></li>
                            <li class="nav-item"> <a class="nav-link" href="../Reports/Commission.php">Commission Charges</a>
-->
                                <?php if ($_SESSION['User_RoleName'] == 'Super Admin' || $_SESSION['User_RoleName'] == 'Master Distributor') {  ?> <li class="nav-item"> <a class="nav-link" href="../Reports/Commission.php">Commission History</a></li>
                                    <?php                 }                 ?>
                                <li class="nav-item"> <a class="nav-link" href="../Reports/BeneficiaryList.php">Beneficiary List </a></li>
                                <li class="nav-item"> <a class="nav-link" href="../Reports/CommissionDetails.php">Commission Details </a></li>
                                <li class="nav-item"> <a class="nav-link" href="../Reports/JournalLedger.php">Journal Ledger </a></li>
                                <li class="nav-item"> <a class="nav-link" href="../Reports/CashInMachine.php">Cash In Machine </a></li>
                                <li class="nav-item"> <a class="nav-link" href="../Reports/DaywiseSplit.php">Daywise Split </a></li>
                                <li class="nav-item"> <a class="nav-link" href="../Reports/MissingTransaction.php">Missing Transaction </a></li>
                            </ul>
                        </div>
                    </li>

                </ul>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title" style="color:#9435f3">
                            <span class="page-title-icon bg-gradient-primary text-white me-2">
                                <i class="mdi mdi-account menu-icon"></i>
                            </span>
                            ADD DISTRIBUTORS
                        </h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <!--
                                <li class="breadcrumb-item"><a href="#">MASTER</a></li>
                                <li class="breadcrumb-item active" aria-current="page">ADD USERS</li>
-->
                            </ol>
                        </nav>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <!-- <h2 class="card-title" style="text-align: center;color:#b66dff">ADD DISTRIBUTORS</h2> -->
                                    <br>
                                    <br>
                                    <form class="form" action="addDistributors.php" method="post">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label mandatory">Full Name</label>
                                                    <div class="col-sm-9">
                                                        <input class="form-control" id="FullName" name="FullName" value="<?php echo $fullname; ?>" onkeydown="return /[a-z]/i.test(event.key)" required placeholder="Full Name" autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label mandatory">Shop Name</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="ShopName" name="ShopName" value="<?php echo $shopname; ?>" onkeydown="return /[a-z]/i.test(event.key)" required placeholder="Shop Name" autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label mandatory">BCID</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="BCID" name="BCID" value="<?php echo $bcid; ?>" onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="BCID" required autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label mandatory">Mobile </label>
                                                    <div class="col-sm-9">
                                                        <input type="text" maxlength="10" class="form-control" id="mobile" value="<?php echo $phone; ?>" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="mobile" placeholder="mobile" required autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label mandatory">Debit Card Reader No</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="DebitCardReaderNo" name="DebitCardReaderNo" value="<?php echo $debitcard; ?>" onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="Debit Card Reader" required autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">GST No</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="GSTNo" name="GSTNo" value="<?php echo $gst; ?>" onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="GST No" autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label mandatory">Aadhar No</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="AAdhar" name="AAdhar" value="<?php echo $adhar; ?>" onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="AadharNo" required autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label mandatory">PAN No</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="Panno" name="Panno" value="<?php echo $pan; ?>" placeholder="Pan No" required autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label mandatory">User ID </label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="Username" name="Username" value="<?php echo $username; ?>" placeholder="User ID" required autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label mandatory">CPU ID </label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="CPUID" name="CPUID" value="<?php echo $cpuid; ?>" placeholder="CPU ID" required autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label mandatory">Master Distributor</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-select" id="MasterDistributor" name="MasterDistributor" required>
                                                            <option selected>-- select distributor --</option>
                                                            <?php
                                                            $res = mysqli_query($db, "SELECT Id,FullName FROM tblMasterDistributor ");
                                                            while ($row = mysqli_fetch_array($res)) {
                                                            ?>
                                                                <option value="<?php echo $row['Id']; ?>"><?php echo $row['FullName']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label mandatory">Date Of Birth</label>
                                                    <div class="col-sm-9">
                                                        <input type="date" class="form-control" id="DOB" placeholder="dd/mm/yyyy" value="<?php echo $dob; ?>" name="DOB" autocomplete="off" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label mandatory">Password</label>
                                                    <div class="col-sm-9">
                                                        <input type="password" class="form-control" id="Password" name="Password" value="<?php echo $password; ?>" placeholder="Password" autocomplete="off" required />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="card-description"> Address </p>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label mandatory">Address 1</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="Address1" name="Address1" value="<?php echo $address1; ?>" placeholder="Address" autocomplete="off" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label mandatory">State</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="State" name="State" placeholder="State" value="<?php echo $state; ?>" autocomplete="off" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label mandatory">Address 2</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="Address2" name="Address2" placeholder="Address" value="<?php echo $address2; ?>" autocomplete="off" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label mandatory">Postcode</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="Postcode" name="Postcode" value="<?php echo $postcode; ?>" onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="Postcode" autocomplete="off" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label mandatory">City</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="City" name="City" placeholder="City" value="<?php echo $city; ?>" autocomplete="off" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label mandatory">Country</label>
                                                    <div class="col-sm-9">
                                                        <select name="Country" id="Country" class="form-select" required>
                                                            <option>America</option>
                                                            <option>Britain</option>
                                                            <option selected>India</option>
                                                            <option>Italy</option>
                                                            <option>Russia</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <input type="reset" value="Reset" name="reset" class="btn btn-info" style="width: 35%;margin-left: 35%;">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <input type="submit" name="SubmitOTP" id="myBtn" value="Submit" class="btn btn-info" style="width: 35%;margin-left: 35%;" />
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Popup modal -->
                                        <div id="myModal" class="modal">
                                            <div class="modal-content">
                                                <span class="close">&times;</span>
                                                <div class="input-group mb-2" id="otpShow1">
                                                    <label for="limit" class="form-control" style="font-weight:bold;font-size:17px">Enter OTP </label>
                                                    <input id="OTP" name="OTP" type="text" class="form-control" placeholder="OTP" maxlength="4" onkeypress="return event.charCode >= 48 && event.charCode <= 57" style="font-weight:bold">
                                                    <input type="submit" name="Register" class="btn btn-info" style="width:20%;height: 56px;" id="btnOtp" value="Submit" />
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
                <!-- partial:../../partials/_footer.html -->
                <footer class="footer">
                    <div class="container-fluid d-flex justify-content-center">
                        <span class="text-muted d-block text-center text-sm-start d-sm-inline-block">© <?php echo date("Y") ?> KFW. All Rights Reserved.</span>
                    </div>
                </footer>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../../assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../../assets/js/off-canvas.js"></script>
    <script src="../../assets/js/hoverable-collapse.js"></script>
    <script src="../../assets/js/misc.js"></script>
    <!-- endinject -->
</body>

</html>
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
</script>
<!-- OTP timer End-->
<script type="text/javascript">
    var span = document.getElementsByClassName("close")[0];
    span.onclick = function() {
        myModal.style.display = "none";
    }

    function GetOTP(Parameter) {
        var ParameterArray = Parameter.split(",");
        document.getElementById("FullName").value = ParameterArray[0];
        document.getElementById("ShopName").value = ParameterArray[1];
        document.getElementById("BCID").value = ParameterArray[2];
        document.getElementById("mobile").value = ParameterArray[3];
        document.getElementById("DebitCardReaderNo").value = ParameterArray[4];
        document.getElementById("GSTNo").value = ParameterArray[5];
        document.getElementById("AAdhar").value = ParameterArray[6];
        document.getElementById("Panno").value = ParameterArray[7];
        document.getElementById("Username").value = ParameterArray[8];
        document.getElementById("CPUID").value = ParameterArray[9];
        document.getElementById("MasterDistributor").value = ParameterArray[10];
        document.getElementById("DOB").value = ParameterArray[11];
        document.getElementById("Password").value = ParameterArray[12];
        document.getElementById("Address1").value = ParameterArray[13];
        document.getElementById("State").value = ParameterArray[14];
        document.getElementById("Address2").value = ParameterArray[15];
        document.getElementById("Postcode").value = ParameterArray[16];
        document.getElementById("City").value = ParameterArray[17];
        document.getElementById("Country").value = ParameterArray[18];

        document.getElementById("myModal").style.display = "block";
    }
</script>


<?php


if (isset($_POST['SubmitOTP'])) {

    $FullName = $_POST["FullName"];
    $ShopName = $_POST["ShopName"];
    $BCID = $_POST["BCID"];
    $mobile = $_POST["mobile"];
    $DebitCardReaderNo = $_POST["DebitCardReaderNo"];
    $GSTNo = $_POST["GSTNo"];
    $AAdhar = $_POST["AAdhar"];
    $Panno = $_POST["Panno"];
    $Username = $_POST["Username"];
    $CPUID = $_POST["CPUID"];
    $MasterDist = $_POST["MasterDistributor"];
    $DOB = $_POST["DOB"];
    $Password = $_POST["Password"];
    $Address1 = $_POST["Address1"];
    $State = $_POST["State"];
    $Address2 = $_POST["Address2"];
    $Postcode = $_POST["Postcode"];
    $City = $_POST["City"];
    $Country = $_POST["Country"];
    $User_Mobile = $_SESSION['User_Mobile'];
    $mobileotp = $User_Mobile;
    $numbers = array($mobileotp);
    $REF_ID = (string)mt_rand(36523462, 99999999);
    $ottp = (string)mt_rand(1000, 9999);
    $fourRandomDigit = "OTP : " . $ottp;
    $_SESSION['otp'] = $ottp;
    $uid = 'interactivfin';
    $pwd = urlencode('13005');
    $Peid = '1601100000000016430';
    $tempid = '1607100000000217622';
    $sender = urlencode('IFINKI');
    $kkk = 'Dear user, Ref.ID ' . $REF_ID . ', Thank you for register with  iFIN PAYMENTS. Your credentials are ' . $fourRandomDigit . '. - Interactiv FinServe Kiosk';
    $msg = $kkk;
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

    // echo "<script type='text/javascript'>GetOTP();</script>";
    $Parameter = "'" . $FullName . "," . $ShopName . "," . $BCID . "," . $mobile . "," . $DebitCardReaderNo . "," . $GSTNo . "," . $AAdhar . "," . $Panno . "," . $Username . "," . $CPUID . "," . $MasterDist . "," . $DOB . "," . $Password . "," . $Address1 . "," . $State . "," . $Address2 . "," . $Postcode . "," . $City . "," . $Country . "'";
    // echo '<script type="text/javascript">alert('.$Parameter.');</script>';

    echo '<script type="text/javascript">GetOTP(' . $Parameter . ');</script>';
}

if (isset($_POST['Register'])) {
    // removes backslashes
    //$datetime = date("Y-m-d H:i:s");
    $otpText = $_POST["OTP"];
    // // echo '<script type="text/javascript">alert(' . $otpText . ');</script>';

    // // echo '<script type="text/javascript">alert(' . $_SESSION['otp'] . ');</script>';

    if ($otpText == $_SESSION['otp']) {


        $FullName = mysqli_real_escape_string($db, $_POST["FullName"]);
        $ShopName = mysqli_real_escape_string($db, $_POST["ShopName"]);
        $BCID = mysqli_real_escape_string($db, $_POST["BCID"]);
        $Mobile = mysqli_real_escape_string($db, $_POST["mobile"]);
        $DebitCardReaderNo = mysqli_real_escape_string($db, $_POST["DebitCardReaderNo"]);
        $GSTNo = mysqli_real_escape_string($db, $_POST["GSTNo"]);
        $AAdhar = mysqli_real_escape_string($db, $_POST["AAdhar"]);
        $Panno = mysqli_real_escape_string($db, $_POST["Panno"]);
        $Username = mysqli_real_escape_string($db, $_POST["Username"]);
        $CPUID = mysqli_real_escape_string($db, $_POST["CPUID"]);
        $Userrole = 3;
        $MasterDist = mysqli_real_escape_string($db, $_POST["MasterDistributor"]);
        $DOB = mysqli_real_escape_string($db, $_POST["DOB"]);
        $Password = mysqli_real_escape_string($db, $_POST["Password"]);
        $Address1 = mysqli_real_escape_string($db, $_POST["Address1"]);
        $State = mysqli_real_escape_string($db, $_POST["State"]);
        $Address2 = mysqli_real_escape_string($db, $_POST["Address2"]);
        $Postcode = mysqli_real_escape_string($db, $_POST["Postcode"]);
        $City = mysqli_real_escape_string($db, $_POST["City"]);
        $Country = mysqli_real_escape_string($db, $_POST["Country"]);
        //$course_id   =1;    
        $User_ID = $_SESSION['User_ID'];


        if ($_SESSION['Edit'] == null) {
            $query2 = "SELECT UserName from `tblDistributor` WHERE UserName='$Username' ";
            $res = mysqli_query($db, $query2);

            if (mysqli_num_rows($res) > 0) {
                echo '<script>oops()</script>';
            } else {

                $query = "INSERT into `users` (UserName,FullName,ShopName,BCID,Location,DebitCardReaderNo,GSTNo,AAdhar,Panno,CPUID,DOB,Password,Phone,FkRoleID,IsActive,Address1,State,Address2,Postcode,City,Country,CreatedUserId)
             VALUES ('$Username','$FullName','$ShopName','$BCID','$Address1','$DebitCardReaderNo','$GSTNo','$AAdhar','$Panno','$CPUID','$DOB', '$Password','$Mobile','$Userrole','1','$Address1','$State','$Address2','$Postcode','$City','$Country','$User_ID')";
                // VALUES ('$FullName','$ShopName','$BCID','$Location','$DebitCardReaderNo','$GSTNo','$AAdhar','$Panno','$Username','$CPUID','$Dispensertype','$AcceptorType','$Userrole','$DOB', '" . md5($Password) . "', '$kioskId','$Address1','$State','$Address2','$Postcode','$City','$Country')";    
                $rest   = mysqli_query($db, $query);

                if ($rest) {
                    // to get UserID in users table
                    $sql = ("SELECT Id FROM `users` WHERE UserName = '$Username'");
                    $res   = mysqli_query($db, $sql);
                    while ($row = mysqli_fetch_array($res)) {
                        $NewUserID = $row['Id'];
                    }

                    $query1   = "INSERT into `tblDistributor` (UserID,UserName,FullName,ShopName,BCID,Location,DebitCardReaderNo,GSTNo,AAdhar,Panno,CPUID,DOB,Password,Phone,FkRoleID,IsActive,Address1,State,Address2,Postcode,City,Country,MasterDistributorID,CreatedUserId)
                VALUES ('$NewUserID','$Username','$FullName','$ShopName','$BCID','$Address1','$DebitCardReaderNo','$GSTNo','$AAdhar','$Panno','$CPUID','$DOB', '$Password','$Mobile','$Userrole','1','$Address1','$State','$Address2','$Postcode','$City','$Country','$MasterDist','$User_ID')";
                    $result   = mysqli_query($db, $query1);

                    if ($result) {

                        // register message
                        $reg = mysqli_query($db, "SELECT Phone FROM tblMasterDistributor WHERE Id='$MasterDist' ");
                        while ($row = mysqli_fetch_array($reg)) {
                            $mastMobile = $row['Phone'];
                        }

                        $numbers = array($Mobile, $mastMobile);
                        // $ottp = (string)mt_rand(1000,9999);
                        $REF_ID = (string)mt_rand(36523462, 99999999);
                        // $fourRandomDigit ="OTP : ".$ottp;
                        $uid = 'sbsrkannam';
                        $pwd = urlencode('9180');
                        $Peid = '1601100000000016430';
                        $tempid = '1607100000000145049';
                        $sender = urlencode('UNIATM');
                        $kkk = 'Dear ' . $FullName . ', Ref.ID ' . $REF_ID . ', Thank you for register with UNIPAY KFW. Your credentials are 123. - UNIPAY SBSR KANNAM';
                        $msg = $kkk;
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
                        // echo "<script>alert('Message Sent to '.$User_Mobile.');</script>";

                        echo "<script> success();</script>";
                        echo "<script>location.href='addDistributors.php';</script>";
                    }
                } else {
                    echo "<script>alert('Adding User Failed');</sc>";
                }
            }
        } elseif ($_SESSION['Edit'] == 1) {

            $sql = ("SELECT Id FROM users WHERE UserName = '$Username'");
            $res   = mysqli_query($db, $sql);
            while ($row = mysqli_fetch_array($res)) {
                $NewUserID = $row['Id'];
            }
            $query1   = "UPDATE `tblDistributor` SET UserName = '$Username',FullName = '$FullName',ShopName = '$ShopName' ,BCID = '$BCID',Location = '$Address1',DebitCardReaderNo = '$DebitCardReaderNo',GSTNo = '$GSTNo',AAdhar = '$AAdhar',Panno = '$Panno',CPUID = '$CPUID',DOB = '$DOB',
            Password = '$Password',Phone = '$Mobile',FkRoleID = '$Userrole',Address1 = '$Address1',State = '$State',Address2 = '$Address2',Postcode = '$Postcode',City = '$City',Country ='$Country',MasterDistributorID = '$MasterDist',ModifiedUserId='$User_ID' WHERE  UserID='$NewUserID' ";
            $result1   = mysqli_query($db, $query1);

            if ($result1) {

                $query2   = "UPDATE `users` SET UserName = '$Username',FullName = '$FullName',ShopName = '$ShopName' ,BCID = '$BCID',Location = '$Address1',DebitCardReaderNo = '$DebitCardReaderNo',GSTNo = '$GSTNo',AAdhar = '$AAdhar',Panno = '$Panno',CPUID = '$CPUID',DOB = '$DOB',
                                Password = '$Password',Phone = '$Mobile',FkRoleID = '$Userrole',Address1 = '$Address1',State = '$State',Address2 ='$Address2',Postcode = '$Postcode',City = '$City',Country = '$Country',ModifiedUserId='$User_ID' WHERE  Id='$NewUserID' ";

                $result2   = mysqli_query($db, $query2);

                if ($result2) {

                    //               register message
                    $numbers = array($Mobile);
                    // $ottp = (string)mt_rand(1000,9999);
                    $REF_ID = (string)mt_rand(36523462, 99999999);
                    // $fourRandomDigit ="OTP : ".$ottp;
                    $uid = 'sbsrkannam';
                    $pwd = urlencode('9180');
                    $Peid = '1601100000000016430';
                    $tempid = '1607100000000145049';
                    $sender = urlencode('UNIATM');
                    $kkk = 'Dear ' . $FullName . ', Ref.ID ' . $REF_ID . ', Thank you for register with UNIPAY KFW. Your credentials are 123. - UNIPAY SBSR KANNAM';
                    $msg = $kkk;
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

                    // echo "<script>alert('Message Sent to '.$Mobile.');</script>";

                    echo "<script>Updated();</script>";
                    unset($_SESSION['Edit']);
                    echo "<script>location.href='manageusers.php';</script>";
                } else {
                    echo "<script>alert('Update User Failed');</script>";
                }
            } else {
                echo "<script>alert('Update User Failed');</script>";
            }
        }
    } else {
        echo "<script>alert('OTP is not Correct');</script>";
    }
}

?>