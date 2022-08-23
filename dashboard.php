<?php session_start();
include "database.php";
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
<!DOCTYPE html>
<html lang="en">

<head>
    <script language="JavaScript">
    javascript: window.history.forward(1);
    </script>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>iFIN PAYMENTS DASHBOARD</title>

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

</head>


<body>

    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
            <a class="navbar-brand brand-logo" href="dashboard.php">
                <img src="assets/images/KFW.jpeg">
            </a>
            <a class="navbar-brand brand-logo-mini" href="dashboard.php"><img src="assets/images/logo-mini.svg" /></a>
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
                    <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="mdi mdi-email-outline" style="color: #af67ff;"></i>
                        <!-- <span class="count-symbol bg-warning">5</span> -->

                        <?php
                            $uid = $_SESSION['User_ID'];
                            $sql = "SELECT COUNT(tblLimitTable.`Status`) AS count FROM tblLimitTable INNER JOIN tblRetailer ON 
tblLimitTable.kioskid = tblRetailer.kioskId INNER JOIN tblMasterDistributor ON 
tblRetailer.MasterDistributorID = tblMasterDistributor.Id 
WHERE tblMasterDistributor.UserID = '$uid' AND tblLimitTable.`Status` = 'Pending'";
                            $result = mysqli_query($db, $sql);
                            while ($row = mysqli_fetch_array($result)) {  ?>


                        <p class="text-gray mb-0" style="font-weight: bold;color: red;"> <?php echo $row['count'] ?>
                        </p>
                        <?php }

                            ?>

                    </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                        aria-labelledby="messageDropdown">
                        <h6 class="p-3 mb-0">Requests</h6>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item preview-item">
                            <div class="preview-thumbnail">
                                <!-- <img src="../../assets\images\faces-clipart\pic-1.png" alt="image" class="profile-pic"> -->
                            </div>
                            <div
                                class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                <?php
                                    $uid = $_SESSION['User_ID'];
                                    $sql = "SELECT tblLimitTable.* FROM tblLimitTable INNER JOIN tblRetailer ON tblLimitTable.kioskid = tblRetailer.kioskId INNER JOIN tblMasterDistributor ON 
                                            tblRetailer.MasterDistributorID = tblMasterDistributor.Id 
                                            WHERE tblMasterDistributor.UserID = '$uid' AND tblLimitTable.`Status` = 'Pending'";
                                    $result = mysqli_query($db, $sql);
                                    while ($row = mysqli_fetch_array($result)) {  ?>
                                <h6 class="preview-subject ellipsis mb-1 font-weight-normal">
                                    <?php echo $row['KioskID'] . " " . "Requested" ?>
                                </h6>
                                <a href="pages/Direct/ViewRequest.php">
                                    <h6 class="preview-subject ellipsis mb-1 font-weight-normal">
                                        <?php echo $row['Requested_limit'] . " " . "Limit" ?>
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
                    <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <div class="nav-profile-img">
                            <img src="assets\images\faces-clipart\pic-1.png">
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
                        <a class="dropdown-item" href="logout.php" style="color:black">
                            <i class="mdi mdi-logout me-2 text-primary"></i>Signout </a>
                    </div>
                </li>
                <li class="nav-item d-none d-lg-block full-screen-link">
                    <a class="nav-link">
                        <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
                    </a>
                </li>


                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </ul>
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
                            <img src="assets\images\faces-clipart\pic-1.png">
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
                    <a class="nav-link" href="dashboard.php">
                        <span class="menu-title">Dashboard</span>
                        <i class="mdi mdi-home menu-icon"></i>
                    </a>
                </li>
                <?php
                if ($_SESSION['User_RoleName'] == 'Super Admin' || $_SESSION['User_RoleName'] == 'Master Distributor') {  ?>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false"
                        aria-controls="ui-basic">
                        <span class="menu-title">Master</span>
                        <i class="menu-arrow"></i>
                        <i class="mdi mdi-account menu-icon"></i>
                    </a>
                    <div class="collapse" id="ui-basic">
                        <ul class="nav flex-column sub-menu">

                            <li class="nav-item"> <a class="nav-link" href="pages/master/manageusers.php">Manage
                                    Users</a></li>
                            <li class="nav-item"> <a class="nav-link" href="pages/master/kioskdetails.php">Kiosk
                                    Details</a></li>
                            <?php if ($_SESSION['User_RoleName'] == 'Super Admin') { ?>
                            <li class="nav-item"> <a class="nav-link" href="pages/master/addMasterDistributor.php">Add
                                    Master Distributor</a></li>
                            <li class="nav-item"> <a class="nav-link" href="pages/master/addDistributors.php">Add
                                    Distributors </a></li>
                            <li class="nav-item"> <a class="nav-link" href="pages/master/subDistributors.php">Sub Distributor</a>
                            </li>
                            
                            <?php } ?>
                            <li class="nav-item"> <a class="nav-link" href="pages/master/addUsers.php">Add Users </a>
                            </li>
                            <li class="nav-item"> <a class="nav-link" href="pages/master/addDistributors.php">Add
                                    Distributors </a></li>
                                 <li class="nav-item"> <a class="nav-link" href="pages/master/subDistributors.php">Sub Distributor</a>
                            </li>
                            
                        </ul>
                    </div>
                </li>
                <?php
                }
                ?>
                <?php
                if ($_SESSION['User_RoleName'] == 'Super Admin' || $_SESSION['User_RoleName'] == 'Master Distributor') {  ?>
                <li class="nav-item">
                    <a class="nav-link" href="pages/Direct/awaiting.php">
                        <span class="menu-title">Manual Entry Transactions</span>
                        <i class="mdi mdi-transcribe menu-icon"></i>
                    </a>
                </li>
                <?php
                }
                ?>


                <li class="nav-item">
                    <a class="nav-link" href="pages/Direct/Allbankcashdeposit.php">
                        <span class="menu-title">All Bank Cash Deposit</span>
                        <i class="mdi mdi-cash-multiple menu-icon"></i>
                    </a>
                </li>



                <!-- 
                <li class="nav-item">
                    <a class="nav-link" href="../SBSR_Dashboard/pages/Direct/Debitcardtransaction.php">
                        <span class="menu-title">Debit Card Withdrawal</span>
                        <i class="mdi mdi-account-card-details menu-icon"></i>
                    </a>
                </li>

                
                <li class="nav-item">
                    <a class="nav-link" href="../SBSR_Dashboard/pages/Direct/Aadharpay.php">
                        <span class="menu-title">Aadhaar Pay</span>
                        <i class="mdi mdi-animation menu-icon"></i>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="../SBSR_Dashboard/pages/Direct/QRcard.php">
                        <span class="menu-title">QR Card Withdrawal</span>
                        <i class="mdi mdi-qrcode menu-icon"></i>
                    </a>
                </li> -->

                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#BBPSBILLERS" aria-expanded="false"
                        aria-controls="transactions">
                        <span class="menu-title">BBPS Billers IFSPL</span>
                        <i class="menu-arrow"></i>
                        <i class="mdi mdi-chart-areaspline menu-icon"></i>
                    </a>
                    <div class="collapse" id="BBPSBILLERS">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="pages/BBPSBILLERS/Airtel.php">Airtel</a>
                            </li>
                            <li class="nav-item"> <a class="nav-link" href="pages/BBPSBILLERS/Bsnl.php">Bsnl</a></li>
                            <li class="nav-item"> <a class="nav-link" href="pages/BBPSBILLERS/Idea.php">Idea</a></li>
                            <li class="nav-item"> <a class="nav-link" href="pages/BBPSBILLERS/Jio.php">Jio</a></li>
                            <li class="nav-item"> <a class="nav-link" href="pages/BBPSBILLERS/MTNLMumbai.php">MTNL
                                    Mumbai</a></li>
                            <li class="nav-item"> <a class="nav-link" href="pages/BBPSBILLERS/MTNLDelhi.php">MTNL
                                    Delhi</a></li>
                            <li class="nav-item"> <a class="nav-link" href="pages/BBPSBILLERS/Vodafone.php">Vodafone</a>
                            </li>
                            <li class="nav-item"> <a class="nav-link" href="pages/BBPSBILLERS/AirtelDTH.php">Airtel
                                    DTH</a></li>
                            <li class="nav-item"> <a class="nav-link" href="pages/BBPSBILLERS/DishTV.php">Dish TV</a>
                            </li>
                            <li class="nav-item"> <a class="nav-link"
                                    href="pages/BBPSBILLERS/Sundirect.php">Sundirect</a></li>
                            <li class="nav-item"> <a class="nav-link"
                                    href="pages/BBPSBILLERS/TataskyRetails.php">Tatasky Retails</a></li>
                            <li class="nav-item"> <a class="nav-link" href="pages/BBPSBILLERS/TataskyOnline.php">Tatasky
                                    Online</a></li>
                            <li class="nav-item"> <a class="nav-link" href="pages/BBPSBILLERS/VideoconD2H.php">Videocon
                                    D2H</a></li>
                            <li class="nav-item"> <a class="nav-link"
                                    href="pages/BBPSBILLERS/VodafoneDatacard.php">Vodafone Datacard</a></li>
                            <li class="nav-item"> <a class="nav-link" href="pages/BBPSBILLERS/AirtelDatacard.php">Airtel
                                    Datacard</a></li>
                            <li class="nav-item"> <a class="nav-link" href="pages/BBPSBILLERS/Ideadatacard.php">Idea
                                    data card</a></li>
                            <li class="nav-item"> <a class="nav-link"
                                    href="pages/BBPSBILLERS/Electricity.php">Electricity</a></li>
                            <li class="nav-item"> <a class="nav-link" href="pages/BBPSBILLERS/Gas.php">Gas</a></li>
                            <li class="nav-item"> <a class="nav-link" href="pages/BBPSBILLERS/Water.php">Water</a></li>
                            <li class="nav-item"> <a class="nav-link"
                                    href="pages/BBPSBILLERS/TelecomMobileAndLandline.php">Telecom Mobile And Landline
                                    Post Paid Online</a></li>
                            <li class="nav-item"> <a class="nav-link"
                                    href="pages/BBPSBILLERS/TelecomMobilepostpaid.php">Telecom Mobile And Landline Post
                                    Retails</a></li>


                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#NONBBPS" aria-expanded="false"
                        aria-controls="ui-basic">
                        <span class="menu-title">Non BBPS Billers - IFSPL</span>
                        <i class="menu-arrow"></i>
                        <i class="mdi mdi-apps-box menu-icon"></i>

                    </a>
                    <div class="collapse" id="NONBBPS">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="pages/NONBBPS/cellonepostpaid.php">Cellone
                                    Post Paid</a></li>
                            <li class="nav-item"> <a class="nav-link" href="pages/NONBBPS/ideapostpaid.php">Idea Post
                                    Paid</a></li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#Internetserviceproviders" aria-expanded="false"
                        aria-controls="ui-basic">
                        <span class="menu-title">Internet Service Providers</span>
                        <i class="menu-arrow"></i>
                        <i class="mdi mdi-internet-explorer menu-icon"></i>

                    </a>
                    <div class="collapse" id="Internetserviceproviders">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link"
                                    href="pages/master/Internetserviceproviders/Tikonabill.php">Tikona Bill Payment</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#InsuranceBillPay" aria-expanded="false"
                        aria-controls="ui-basic">
                        <span class="menu-title">Insurance Bill Pay - IFSPL</span>
                        <i class="menu-arrow"></i>
                        <i class="mdi mdi-satellite menu-icon"></i>

                    </a>
                    <div class="collapse" id="InsuranceBillPay">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="pages/InsuranceBillPay/Tataaiglife.php">Tata
                                    AIG Life</a></li>
                            <li class="nav-item"> <a class="nav-link"
                                    href="pages/InsuranceBillPay/ICICIPruLife.php">ICICI Pru Life</a></li>

                            <li class="nav-item"> <a class="nav-link"
                                    href="pages/InsuranceBillPay/BhartiAxaLifeInsurance.php">Bharti Axa Life
                                    Insurance</a></li>

                            <li class="nav-item"> <a class="nav-link"
                                    href="pages/InsuranceBillPay/IndiaFirstInsurance.php">India First Insurance</a></li>

                        </ul>
                    </div>
                </li>

                <!-- <li class="nav-item">
                    <a class="nav-link" href="../SBSR_Dashboard/pages/fastag/">
                        <span class="menu-title">QR Card Withdrawal</span>
                        <i class="mdi mdi-qrcode menu-icon"></i>
                    </a>
                </li> -->

                <li class="nav-item">
                    <a class="nav-link" href="pages/fastag/fastag.php">
                        <span class="menu-title">Fasttag Recharge - IFSPL</span>
                        <i class="mdi mdi-transcribe menu-icon"></i>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#QRRecharge" aria-expanded="false"
                        aria-controls="ui-basic">
                        <span class="menu-title">QR Recharge - IFSPL</span>
                        <i class="menu-arrow"></i>
                        <i class="mdi mdi-cellphone menu-icon"></i>

                    </a>
                    <div class="collapse" id="QRRecharge">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="pages/QRRecharge/amazonpay.php">Amazon
                                    Pay</a></li>

                            <li class="nav-item"> <a class="nav-link" href="pages/QRRecharge/GooglePay.php">Google
                                    Pay</a></li>

                            <li class="nav-item"> <a class="nav-link" href="pages/QRRecharge/Paytm.php">Paytm</a></li>
                            <li class="nav-item"> <a class="nav-link" href="pages/QRRecharge/PhonePe.php">PhonePe</a>
                            </li>
                            <li class="nav-item"> <a class="nav-link" href="pages/QRRecharge/AirtelPay.php">Airtel
                                    Pay</a></li>

                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#tools" aria-expanded="false"
                        aria-controls="ui-basic">
                        <span class="menu-title">Tools</span>
                        <i class="menu-arrow"></i>
                        <i class="mdi mdi-settings menu-icon"></i>
                    </a>
                    <div class="collapse" id="tools">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="pages/tools/backup.php">Camera</a></li>
                            <li class="nav-item"> <a class="nav-link" href="pages/tools/Errorlog.php">Error Log</a></li>
                        </ul>
                    </div>

                </li>

                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#Reports" aria-expanded="false"
                        aria-controls="ui-basic">
                        <span class="menu-title">Report</span>
                        <i class="menu-arrow"></i>
                        <i class="mdi mdi-settings menu-icon"></i>
                    </a>
                    <div class="collapse" id="Reports">
                        <ul class="nav flex-column sub-menu">
                            <!--                             <li class="nav-item"> <a class="nav-link" href="../Reports/Debit.php">Debit Card Transaction</a></li>-->
                            <li class="nav-item"> <a class="nav-link" href="pages/Reports/Direct.php">All Bank Cash
                                    Deposit</a></li>
                            <!--
                             <li class="nav-item"> <a class="nav-link" href="../Reports/QRCard.php">QR Card Withdrawal</a></li>
                             <li class="nav-item"> <a class="nav-link" href="../Reports/Aadhar.php">Aadhaar Pay</a></li>
                            <li class="nav-item"> <a class="nav-link" href="../Reports/Commission.php">Commission Charges</a>-->
                            <?php if ($_SESSION['User_RoleName'] == 'Super Admin' || $_SESSION['User_RoleName'] == 'Master Distributor') {  ?>
                            <li class="nav-item"> <a class="nav-link" href="pages/Reports/Commission.php">Commission
                                    History</a></li>
                            <?php                 }                 ?>
                            <li class="nav-item"> <a class="nav-link"
                                    href="pages/Reports/BeneficiaryList.php">Beneficiary List </a></li>
                            <li class="nav-item"> <a class="nav-link"
                                    href="pages/Reports/CommissionDetails.php">Commission Details </a></li>
                            <li class="nav-item"> <a class="nav-link" href="pages/Reports/JournalLedger.php">Journal
                                    Ledger </a></li>
                            <li class="nav-item"> <a class="nav-link" href="pages/Reports/CashInMachine.php">Cash In
                                    Machine </a></li>
                            <li class="nav-item"> <a class="nav-link" href="pages/Reports/DaywiseSplit.php">Daywise
                                    Split </a></li>
                            <li class="nav-item"> <a class="nav-link"
                                    href="pages/Reports/MissingTransaction.php">Missing Transaction </a></li>
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
                            <i class="mdi mdi-home"></i>
                        </span>
                        Dashboard
                    </h3>

                </div>

                <?php
                if ($_SESSION['User_RoleName'] == 'Super Admin') {  ?>
                <div class="row">
                    <div class="col-md-4 stretch-card grid-margin">
                        <div class="card bg-gradient-primary card-img-holder text-white">
                            <div class="card-body">
                                <img src="assets/images/dashboard/circle.svg" class="card-img-absolute"
                                    alt="circle-image" />
                                <h4 class="font-weight-normal mb-3">Working ATM's <i
                                        class="mdi mdi-web mdi-24px float-right"></i>
                                </h4>
                                <?php
                                    $sql = "SELECT COUNT(*) AS count FROM tblRetailer WHERE IsActive='1'";
                                    $result = mysqli_query($db, $sql);
                                    while ($row = mysqli_fetch_array($result)) {  ?>
                                <h2 class="mb-5"><?php echo $row['count'] ?></h2>

                                <!--                                       <p class="text-gray mb-0" style="font-weight: bold;color: red;"> <?php echo $row['count'] ?> </p>-->
                                <?php }

                                    ?>
                                <!--<h6 class="card-text">Increased by 68%</h6>-->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 stretch-card grid-margin">
                        <div class="card bg-gradient-info card-img-holder text-white">
                            <div class="card-body">
                                <img src="assets/images/dashboard/circle.svg" class="card-img-absolute"
                                    alt="circle-image" />
                                <h4 class="font-weight-normal mb-3">ATM's Under Service <i
                                        class="mdi mdi-wrench mdi-24px float-right"></i>
                                </h4>
                                <?php
                                    $sql = "SELECT COUNT(*) AS count FROM tblRetailer WHERE OOS_Status='1'";
                                    $result = mysqli_query($db, $sql);
                                    while ($row = mysqli_fetch_array($result)) {  ?>
                                <h2 class="mb-5"><?php echo $row['count'] ?></h2>

                                <!--                                       <p class="text-gray mb-0" style="font-weight: bold;color: red;"> <?php echo $row['count'] ?> </p>-->
                                <?php }

                                    ?>
                                <!--<h6 class="card-text">Decreased by 28%</h6>-->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 stretch-card grid-margin">
                        <div class="card bg-gradient-dark card-img-holder text-white">
                            <div class="card-body">
                                <img src="assets/images/dashboard/circle.svg" class="card-img-absolute"
                                    alt="circle-image" />
                                <h4 class="font-weight-normal mb-3" style="color:black;">Transactions <i
                                        class="mdi mdi-chart-line mdi-24px float-right"></i>
                                </h4>
                                <?php
                                    $sql = "SELECT COUNT(*) AS count FROM tblCyberPlatCashTransfer";
                                    $result = mysqli_query($db, $sql);
                                    while ($row = mysqli_fetch_array($result)) {  ?>
                                <h2 class="mb-5"><?php echo $row['count'] ?></h2>

                                <!--                                       <p class="text-gray mb-0" style="font-weight: bold;color: red;"> <?php echo $row['count'] ?> </p>-->
                                <?php }

                                    ?>
                                <!--<h6 class="card-text">Increased by 26%</h6>-->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- <br/><br/><br/> -->
                    <div class="col-md-4 stretch-card grid-margin">
                        <div class="card bg-gradient-success card-img-holder text-white">
                            <div class="card-body">
                                <img src="assets/images/dashboard/circle.svg" class="card-img-absolute"
                                    alt="circle-image" />
                                <h4 class="font-weight-normal mb-3" style="color:black">Successfull Transactions <i
                                        class="mdi mdi-check-circle-outline mdi-24px float-right"></i>
                                </h4>
                                <?php
                                    $sql = "SELECT COUNT(*) AS count FROM tblCyberPlatCashTransfer WHERE TransferStatus='Transaction Successful' OR TransferStatus='Success'";
                                    $result = mysqli_query($db, $sql);
                                    while ($row = mysqli_fetch_array($result)) {  ?>
                                <h2 class="mb-5" style="color:black"><?php echo $row['count'] ?></h2>

                                <!--                                       <p class="text-gray mb-0" style="font-weight: bold;color: red;"> <?php echo $row['count'] ?> </p>-->
                                <?php }

                                    ?>
                                <!--<h6 class="card-text">Increased by 73%</h6>-->
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 stretch-card grid-margin">
                        <div class="card bg-gradient-danger card-img-holder text-white">
                            <div class="card-body">
                                <img src="assets/images/dashboard/circle.svg" class="card-img-absolute"
                                    alt="circle-image" />
                                <h4 class="font-weight-normal mb-3" style="color:black;">Unsuccessfull Transactions <i
                                        class="mdi mdi-close-circle-outline mdi-24px float-right"></i>
                                </h4>
                                <?php
                                    $sql = "SELECT COUNT(*) AS count FROM tblCyberPlatCashTransfer WHERE TransferStatus='Transaction Failure' OR TransferStatus='Failure'";
                                    $result = mysqli_query($db, $sql);
                                    while ($row = mysqli_fetch_array($result)) {  ?>
                                <h2 class="mb-5" style="color:black"><?php echo $row['count'] ?></h2>

                                <!--                                       <p class="text-gray mb-0" style="font-weight: bold;color: red;"> <?php echo $row['count'] ?> </p>-->
                                <?php
                                    }
                                    ?>
                                <!--<h6 class="card-text">Decreased by 35%</h6>-->
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 stretch-card grid-margin">
                        <div class="card bg-gradient-warning card-img-holder text-black">
                            <div class="card-body">
                                <img src="assets/images/dashboard/circle.svg" class="card-img-absolute"
                                    alt="circle-image" />
                                <h4 class="card-text">Distributors <i class="mdi mdi-account-star"></i>
                                    <?php
                                        $sql = "SELECT COUNT(*) AS UserName FROM tblDistributor WHERE UserID";
                                        $result = mysqli_query($db, $sql);
                                        while ($row = mysqli_fetch_array($result)) {  ?>
                                    <h4 class="card-text"><?php echo $row['UserName'] ?></h4>
                                    <!-- <p class="text-gray mb-0" style="font-weight: bold;color: red;"> <?php echo $row['count'] ?> </p>-->
                                    <?php }
                                        ?>
                                </h4><br>
                                <h4 class="card-text">Retailers <i class="mdi mdi-account-multiple"></i>
                                    <?php
                                        $sql = "SELECT COUNT(*) AS UserName FROM tblRetailer WHERE UserID";
                                        $result = mysqli_query($db, $sql);
                                        while ($row = mysqli_fetch_array($result)) {  ?>
                                    <h4 class="card-text"><?php echo $row['UserName'] ?></h4>
                                    <!--<p class="text-gray mb-0" style="font-weight: bold;color: red;"> <?php echo $row['count'] ?> </p>-->
                                    <?php }
                                        ?>
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                } else if ($_SESSION['User_RoleName'] == 'Retailer') { ?>
                <div class="row">
                    <div class="col-md-4 stretch-card grid-margin">
                        <div class="card bg-gradient-primary card-img-holder text-white">
                            <div class="card-body">
                                <img src="assets/images/dashboard/circle.svg" class="card-img-absolute"
                                    alt="circle-image" />
                                <h4 class="font-weight-normal mb-3" style="color:black;">Limit available<i
                                        class="mdi mdi-web mdi-24px float-right"></i>
                                </h4>
                                <?php
                                    $kioID =  $_SESSION['User_KioID'];
                                    $query = "SELECT MaximumLimit,Available_Balance FROM tblRetailer WHERE tblRetailer.kioskId = '$kioID' ";
                                    $result = mysqli_query($db, $query) or die(mysqli_error($db));
                                    while ($row = mysqli_fetch_array($result)) {

                                        $_SESSION['bal'] = $row['Available_Balance'];
                                    ?>
                                <h2 class="mb-5" style="color:black;"><?php echo $row['Available_Balance']; ?></h2>
                                <?php } ?>
                                <button class="btn btn-primary" id="myBtn" style="color:black;">Request Limit</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 stretch-card grid-margin">
                        <div class="card bg-gradient-info card-img-holder text-white">
                            <div class="card-body">
                                <img src="assets/images/dashboard/circle.svg" class="card-img-absolute"
                                    alt="circle-image" />
                                <h4 class="font-weight-normal mb-3" style="color:black;">Approved limit <i
                                        class="mdi mdi-wrench mdi-24px float-right"></i>
                                </h4>
                                <?php
                                    $query = "SELECT SUM(Requested_limit) AS RequestedTotal FROM tblLimitTable WHERE tblLimitTable.`Status` ='success' AND KioskID = '$kioID'";

                                    //$query  = "SELECT SUM(Requested_limit) RequestedTotal FROM tblLimitTable WHERE KioskID = '$kioID' ";
                                    // $query1 ="SELECT AvailableLimit FROM tblRetailer WHERE UserID='$User_ID'";
                                    $result = mysqli_query($db, $query) or die(mysqli_error($db));
                                    while ($row = mysqli_fetch_array($result)) {
                                    ?>
                                <h2 class="mb-5" style="color:black;"><?php echo $row['RequestedTotal'];
                                                                            } ?></h2>
                                <button class="btn btn-info" id="myBtn1" style="color:black;">View Request</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 stretch-card grid-margin">
                        <div class="card bg-gradient-warning card-img-holder text-black">
                            <div class="card-body">
                                <img src="assets/images/dashboard/circle.svg" class="card-img-absolute"
                                    alt="circle-image" />
                                <h4 class="font-weight-normal mb-3" style="color:black;">Earned Commission <i
                                        class="mdi mdi-wrench mdi-24px float-right"></i><br><br>
                                   <p><span class="card-text" style="font-weight:bold ; font-size:large">Today :
                                        <?php
                                            $kioID =  $_SESSION['User_KioID'];
                                            $sql = "SELECT (SELECT SUM(trans_amount) AS total FROM tbl_Journal_Ledger INNER JOIN
                                            tblRetailer ON tblRetailer.kioskId = tbl_Journal_Ledger.kioskId WHERE tblRetailer.kioskId = '$kioID' 
                                            AND DATE(tbl_Journal_Ledger.trans_datetime) = CURDATE() AND tbl_Journal_Ledger.transaction_type = ' COMMISSION TO THE KIOSK')
                                            -
                                            IFNULL ((SELECT SUM(trans_amount) AS total FROM tbl_Journal_Ledger WHERE tbl_Journal_Ledger.kioskId = '$kioID' AND DATE(tbl_Journal_Ledger.trans_datetime) = CURDATE()
                                            AND tbl_Journal_Ledger.transaction_type = ' TRANSACTION FAILED ' AND Credit_OR_Debit = 'DEBIT'),0) AS Total";
                                            $result = mysqli_query($db, $sql);
                                            while ($row = mysqli_fetch_array($result)) {  ?>
                                        <span class="card-text"><?php if ($row['Total'] == "") {
                                                                            echo "0.00";
                                                                        } else {
                                                                            echo round($row['Total'], 2);
                                                                        } ?></span>

                                        <!-- <p class="text-gray mb-0" style="font-weight: bold;color: red;"> <?php echo $row['count'] ?> </p>-->
                                        <?php }
                                            ?>
                                    </span></p> 
                                   <p> <span class="card-text" style="font-weight:bold ; font-size:large">This Week :
                                        <?php
                                            $kioID =  $_SESSION['User_KioID'];
                                            $sql = "SELECT (SELECT SUM(trans_amount) AS total FROM tbl_Journal_Ledger INNER JOIN
                                            tblRetailer ON tblRetailer.kioskId = tbl_Journal_Ledger.kioskId WHERE tblRetailer.kioskId = '$kioID' 
                                            AND YEARWEEK(tbl_Journal_Ledger.trans_datetime) = YEARWEEK(CURDATE()) AND tbl_Journal_Ledger.transaction_type = ' COMMISSION TO THE KIOSK')
                                            -
                                            IFNULL ((SELECT SUM(trans_amount) AS total FROM tbl_Journal_Ledger WHERE tbl_Journal_Ledger.kioskId = '$kioID' AND YEARWEEK(tbl_Journal_Ledger.trans_datetime) = YEARWEEK(CURDATE())
                                            AND tbl_Journal_Ledger.transaction_type = ' TRANSACTION FAILED ' AND Credit_OR_Debit = 'DEBIT'),0) AS Total";
                                            $result = mysqli_query($db, $sql);
                                            while ($row = mysqli_fetch_array($result)) {  ?>
                                        <span class="card-text"><?php if ($row['Total'] == "") {
                                                                            echo "0.00";
                                                                        } else {
                                                                            echo round($row['Total'], 2);
                                                                        } ?></span>
                                        <!--<p class="text-gray mb-0" style="font-weight: bold;color: red;"> <?php echo $row['count'] ?> </p>-->
                                        <?php }
                                            ?>
                                    </span></p>
                                   <p> <span class="card-text" style="font-weight:bold ; font-size:large">This Month :
                                        <?php
                                            $kioID =  $_SESSION['User_KioID'];
                                            $month = date("m");
                                            $sql = "SELECT (SELECT SUM(trans_amount) AS total FROM tbl_Journal_Ledger INNER JOIN
                                            tblRetailer ON tblRetailer.kioskId = tbl_Journal_Ledger.kioskId WHERE tblRetailer.kioskId = '$kioID' 
                                            AND MONTH(tbl_Journal_Ledger.trans_datetime) = '$month' AND tbl_Journal_Ledger.transaction_type = ' COMMISSION TO THE KIOSK')
                                            -
                                            IFNULL ((SELECT SUM(trans_amount) AS total FROM tbl_Journal_Ledger WHERE tbl_Journal_Ledger.kioskId = '$kioID' AND MONTH(tbl_Journal_Ledger.trans_datetime) = '$month'
                                            AND tbl_Journal_Ledger.transaction_type = ' TRANSACTION FAILED ' AND Credit_OR_Debit = 'DEBIT'),0) AS Total";
                                            $result = mysqli_query($db, $sql);
                                            while ($row = mysqli_fetch_array($result)) {  ?>
                                        <span class="card-text"><?php if ($row['Total'] == "") {
                                                                            echo "0.00";
                                                                        } else {
                                                                            echo round($row['Total'], 2);
                                                                        } ?></span>

                                        <!--<p class="text-gray mb-0" style="font-weight: bold;color: red;"> <?php echo $row['count'] ?> </p>-->
                                        <?php }
                                            ?>
                                    </span></p>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 stretch-card grid-margin">
                        <div class="card bg-gradient-success card-img-holder text-white">
                            <div class="card-body">
                                <img src="assets/images/dashboard/circle.svg" class="card-img-absolute"
                                    alt="circle-image" />
                                <h4 class="font-weight-normal mb-3" style="color:black;">Successfull Transactions <i
                                        class="mdi mdi-check-circle-outline mdi-24px float-right"></i>
                                </h4>
                                <?php
                                    $uid = $_SESSION['User_ID'];
                                    $sql = "SELECT COUNT(*) AS count FROM tblCyberPlatCashTransfer WHERE kioskid = (SELECT Kioskid FROM tblRetailer WHERE UserID = '$uid') AND (TransferStatus='Transaction Successful' OR TransferStatus='Success')";
                                    $result = mysqli_query($db, $sql);
                                    while ($row = mysqli_fetch_array($result)) {  ?>
                                <h2 class="mb-5" style="color:black"><?php echo $row['count'] ?></h2>

                                <!--                                       <p class="text-gray mb-0" style="font-weight: bold;color: red;"> <?php echo $row['count'] ?> </p>-->
                                <?php }

                                    ?>
                                <!--<h6 class="card-text">Increased by 73%</h6>-->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 stretch-card grid-margin">
                        <div class="card bg-gradient-danger card-img-holder text-white">
                            <div class="card-body">
                                <img src="assets/images/dashboard/circle.svg" class="card-img-absolute"
                                    alt="circle-image" />
                                <h4 class="font-weight-normal mb-3" style="color:black;">Unsuccessfull Transactions <i
                                        class="mdi mdi-close-circle-outline mdi-24px float-right"></i>
                                </h4>
                                <?php
                                    $sql = "SELECT COUNT(*) AS count FROM tblCyberPlatCashTransfer WHERE kioskid = (SELECT Kioskid FROM tblRetailer WHERE UserID = '$uid') AND (TransferStatus='Transaction UnSuccessful' OR TransferStatus='Failure')";
                                    $result = mysqli_query($db, $sql);
                                    while ($row = mysqli_fetch_array($result)) {  ?>
                                <h2 class="mb-5" style="color:black"><?php echo $row['count'] ?></h2>

                                <!--                                       <p class="text-gray mb-0" style="font-weight: bold;color: red;"> <?php echo $row['count'] ?> </p>-->
                                <?php }

                                    ?>
                                <!--<h6 class="card-text">Decreased by 35%</h6>-->
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 stretch-card grid-margin">
                        <div class="card bg-gradient-dark card-img-holder text-white">
                            <div class="card-body">
                                <img src="assets/images/dashboard/circle.svg" class="card-img-absolute"
                                    alt="circle-image" />
                                <h4 class="font-weight-normal mb-3" style="color:black;">Transactions <i
                                        class="mdi mdi-chart-line mdi-24px float-right"></i>
                                </h4>
                                <?php
                                    $sql = "SELECT COUNT(*) AS count FROM tblCyberPlatCashTransfer WHERE kioskid = (SELECT Kioskid FROM tblRetailer WHERE UserID = '$uid')";
                                    $result = mysqli_query($db, $sql);
                                    while ($row = mysqli_fetch_array($result)) {  ?>
                                <h2 class="mb-5" style="color:black"><?php echo $row['count'] ?></h2>

                                <!--<p class="text-gray mb-0" style="font-weight: bold;color: red;"> <?php echo $row['count'] ?> </p>-->
                                <?php }

                                    ?>
                                <!--<h6 class="card-text">Increased by 26%</h6>-->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 stretch-card grid-margin">
                        <div class="card bg-gradient-warning card-img-holder text-black">
                            <div class="card-body">
                                <img src="assets/images/dashboard/circle.svg" class="card-img-absolute"
                                    alt="circle-image" />
                                <h4 class="font-weight-normal mb-3" style="color:black;">Total Transactions <i
                                        class="mdi mdi-wrench mdi-24px float-right"></i><br><br>
                                   <p> <span class="card-text"  style="font-weight:bold ; font-size:larger">Today :
                                        <?php
                                            $kioID =  $_SESSION['User_KioID'];
                                            $sql = "SELECT sum(amount) AS total FROM tblCyberPlatCashTransfer WHERE kioskId = '$kioID' 
                                                    AND DATE(tblCyberPlatCashTransfer.trans_datetime) = CURDATE()";
                                            $result = mysqli_query($db, $sql);
                                            while ($row = mysqli_fetch_array($result)) {  ?>
                                        <span class="card-text"><?php if ($row['total'] == "") {
                                                                            echo "0.00";
                                                                        } else {
                                                                            echo $row['total'];
                                                                        } ?></span>

                                        <!-- <p class="text-gray mb-0" style="font-weight: bold;color: red;"> <?php echo $row['count'] ?> </p>-->
                                        <?php }
                                            ?>
                                    </span>
                                    </p>
                                    <p><span class="card-text"  style="font-weight:bold ; font-size:larger">This Week :
                                        <?php
                                            $kioID =  $_SESSION['User_KioID'];
                                            $sql = " SELECT sum(amount) AS total FROM tblCyberPlatCashTransfer WHERE kioskId = '$kioID'
                                                    AND YEARWEEK(tblCyberPlatCashTransfer.trans_datetime) = YEARWEEK(CURDATE())";
                                            $result = mysqli_query($db, $sql);
                                            while ($row = mysqli_fetch_array($result)) {  ?>
                                        <span class="card-text"><?php if ($row['total'] == "") {
                                                                            echo "0.00";
                                                                        } else {
                                                                            echo $row['total'];
                                                                        } ?></span>
                                        <!--<p class="text-gray mb-0" style="font-weight: bold;color: red;"> <?php echo $row['count'] ?> </p>-->
                                        <?php }
                                            ?>
                                    </span></p>
                                    <p><span class="card-text"  style="font-weight:bold ;font-size:larger">This Month :
                                        <?php
                                            $kioID =  $_SESSION['User_KioID'];
                                            $month = date("m");
                                            $sql = " SELECT sum(amount) AS total FROM tblCyberPlatCashTransfer  WHERE kioskId = '$kioID' 
                                                    AND month(tblCyberPlatCashTransfer.trans_datetime) = '$month'";
                                            $result = mysqli_query($db, $sql);
                                            while ($row = mysqli_fetch_array($result)) {  ?>
                                        <span class="card-text"><?php if ($row['total'] == "") {
                                                                            echo "0.00";
                                                                        } else {
                                                                            echo $row['total'];
                                                                        } ?></span>

                                        <!--<p class="text-gray mb-0" style="font-weight: bold;color: red;"> <?php echo $row['count'] ?> </p>-->
                                        <?php }
                                            ?>
                                    </span></p>
                                   <p><span class="card-text" style="font-weight:bold ;font-size:larger">Last Month :
                                        <?php
                                            $kioID =  $_SESSION['User_KioID'];
                                            $month = date("m");
                                            $sql = " SELECT sum(amount) AS total FROM tblCyberPlatCashTransfer WHERE kioskId = '$kioID' AND YEAR(trans_datetime) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH)
                                            AND MONTH(trans_datetime) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)";
                                            $result = mysqli_query($db, $sql);
                                            while ($row = mysqli_fetch_array($result)) {  ?>
                                        <span class="card-text"><?php if ($row['total'] == "") {
                                                                            echo "0.00";
                                                                        } else {
                                                                            echo $row['total'];
                                                                        } ?></span>

                                        <!--<p class="text-gray mb-0" style="font-weight: bold;color: red;"> <?php echo $row['count'] ?> </p>-->
                                        <?php }
                                            ?>
                                    </span></p>

                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-12 grid-margin">

                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Recent Transactions</h4>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center;">KIOSK_ID</th>
                                                <th style="text-align: center;">Beneficiary Name</th>
                                                <th style="text-align: center;">Transfer Status</th>
                                                <th style="text-align: center;">Beneficiary Phone</th>
                                                <th style="text-align: center;">Remitter Phone</th>
                                                <th style="text-align: center;">Amount</th>
                                                <th style="text-align: center;">Date</th>
                                            </tr>
                                        </thead>
                                        

                                        <tbody>
                                            <?php
                                                $kioID =  $_SESSION['User_KioID'];
                                                $uid = $_SESSION['User_ID'];
                                                if ($_SESSION['User_RoleID'] == 1) {
                                                    $res = mysqli_query($db, "SELECT * FROM tbl_Transaction_Status WHERE kioskid='$kioID' AND Is_note_accepted = '1' AND Is_yapay_done = '1' 
                                                AND (Is_trans_done = '0' OR Is_journal_done = '0') AND Is_trans_failed='0' ORDER BY tbl_Transaction_Status.trans_datetime DESC");
                                                } elseif ($_SESSION['User_RoleID'] == 2) {
                                                    $res = mysqli_query($db, "SELECT * FROM tbl_Transaction_Status WHERE Is_yapay_done = '1' ORDER BY tbl_Transaction_Status.trans_datetime DESC");
                                                } elseif ($_SESSION['User_RoleID'] == 3) {
                                                    $res = mysqli_query($db, "SELECT * FROM tbl_Transaction_Status WHERE Is_yapay_done = '1' AND kioskid='$kioID' ORDER BY tbl_Transaction_Status.trans_datetime DESC");
                                                } elseif ($_SESSION['User_RoleID'] == 4) {
                                                    $res = mysqli_query($db, "SELECT * FROM tbl_Transaction_Status WHERE Is_yapay_done = '1' AND kioskid='$kioID'  ORDER BY tbl_Transaction_Status.trans_datetime DESC limit 10");
                                                }
                                                $cnt = 1;
                                                while ($row = mysqli_fetch_array($res)) { ?>
                                            <tr>

                                                <td style="text-align: center;"><?php echo $row["kioskid"]; ?></td>
                                                <td style="text-align: center;"><?php echo $row["name"]; ?></td>
                                                <?php if (
                                                            $row["Is_yapay_done"] == '1' && $row["Is_trans_failed"] ==  '1' && ($row["Is_trans_done"] ==  '0' || $row["Is_journal_done"] == '0')
                                                        ) { ?>
                                                <td style="text-align: center;">
                                                    <label class="badge badge-gradient-danger">FAILURE</label>
                                                </td>
                                                <?php } else { ?>
                                                <td style="text-align: center;">
                                                    <label class="badge badge-gradient-success">SUCCESS</label>
                                                </td>
                                                <?php } ?>
                                                <td style="text-align: center;"><?php echo $row["BeneficiaryPhone"]; ?>
                                                </td>
                                                <td style="text-align: center;"><?php echo $row["RemitterPhone"]; ?>
                                                </td>
                                                <td style="text-align: center;"><?php echo $row["amount"]; ?></td>
                                                <td style="text-align: center;"><?php echo $row["trans_datetime"]; ?>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php

                    $sql = "SELECT * FROM tblLimitTable";
                    $result = $db->query($sql);

                    if ($result->num_rows > 0) {
                        // output data of each row
                        while ($row = $result->fetch_assoc()) {
                            echo "";
                        }
                    }
                    ?>
                <?php
                } else { ?>
                <div class="row">
                    <div class="col-md-4 stretch-card grid-margin">
                        <div class="card bg-gradient-info card-img-holder text-white">
                            <div class="card-body">
                                <img src="assets/images/dashboard/circle.svg" class="card-img-absolute"
                                    alt="circle-image" />
                                <h4 class="font-weight-normal mb-3" style="color:black;" style="color:black;">Master
                                    Distributor Balance <i class="mdi mdi-web mdi-24px float-right"></i>
                                </h4>
                                <?php
                                    $_password = "2069|29a7ea7b83b4cc5f2d98";
                                    $password = hash('sha512', $_password);

                                    // API URL to send data
                                    $url = 'https://ft.yapay.in/?action=getbalance&ver=3&mid=2069&hash=' . $password;

                                    $ch = curl_init();
                                    // Disable SSL verification
                                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                                    // Will return the response, if false it print the response
                                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                    // Set the url
                                    curl_setopt($ch, CURLOPT_URL, $url);
                                    // Execute
                                    $result = curl_exec($ch);
                                    // Will dump a beauty json <3
                                    $fr = json_decode($result, true);
                                    ?>
                                <h2 class="mb-5" style="color:black"><?php echo $fr["Response"]["balanceAmount"];
                                                                            ?></h2>
                            </div>
                        </div>
                    </div>
                    <!--
                        <div class="col-md-4 stretch-card grid-margin">
                            <div class="card bg-gradient-info card-img-holder text-white">
                                <div class="card-body">
                                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                                    <h4 class="font-weight-normal mb-3">Retailer Balance<br> <i class="mdi mdi-wrench mdi-24px float-right"></i>
                                    </h4>
                                    <?php
                                    $kid =   $_SESSION['User_KioID'];
                                    $sql = "SELECT Available_Balance FROM tblRetailer WHERE kioskId = '$kid' ";
                                    $result = mysqli_query($db, $sql);
                                    while ($row = mysqli_fetch_array($result)) {  ?>
                                        <h2 class="mb-5"><?php echo $row['Available_Balance'];
                                                        } ?></h2>
                                                                            <h6 class="card-text">Decreased by 28%</h6>
                                </div>
                            </div>
                        </div>
                        -->

                    <!--
                                                <div class="col-md-4 stretch-card grid-margin">
                            <div class="card bg-gradient-info card-img-holder text-white">
                                <div class="card-body">
                                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                                    <h4 class="font-weight-normal mb-3">Retailer Balance<br> <i class="mdi mdi-wrench mdi-24px float-right"></i>
                                    </h4>
                                    <?php
                                    $kid =   $_SESSION['User_KioID'];
                                    $sql = "SELECT Available_Balance FROM tblRetailer WHERE kioskId = '$kid' ";
                                    $result = mysqli_query($db, $sql);
                                    while ($row = mysqli_fetch_array($result)) {  ?>
                                        <h2 class="mb-5"><?php echo $row['Available_Balance'];
                                                        } ?></h2>
                                                                            <h6 class="card-text">Decreased by 28%</h6>
                                </div>
                            </div>
                        </div>
                        -->

                    <div class="col-md-4 stretch-card grid-margin">
                        <div class="card bg-gradient-dark card-img-holder text-white"
                            style="background: linear-gradient(to right, #da8cff, #9a55ff) !important">
                            <div class="card-body">
                                <img src="assets/images/dashboard/circle.svg" class="card-img-absolute"
                                    alt="circle-image" />
                                <h4 class="font-weight-normal mb-3" style="color:black;">Retailer Requested limit <i
                                        class="mdi mdi-wrench mdi-24px float-right"></i>
                                </h4>
                                <?php
                                    $kid =   $_SESSION['User_KioID'];
                                    $sql = "SELECT SUM(Requested_limit) RequestedTotal FROM tblLimitTable WHERE KioskID = '$kid' ";
                                    $result = mysqli_query($db, $sql);
                                    while ($row = mysqli_fetch_array($result)) {  ?>
                                <h2 class="mb-5"><?php echo  $row['RequestedTotal'];
                                                        } ?></h2>
                                <a href="pages/Direct/ViewRequest.php"><button class="btn btn-primary"
                                        style="color:black;">View
                                        Request</button></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 stretch-card grid-margin">
                        <div class="card bg-gradient-warning card-img-holder text-black">
                            <div class="card-body">
                                <img src="assets/images/dashboard/circle.svg" class="card-img-absolute"
                                    alt="circle-image" />
                                <h4 class="font-weight-normal mb-3" style="color:black;">Earned Commission <i
                                        class="mdi mdi-wrench mdi-24px float-right"></i><br><br>
                                   <p> <span class="card-text" style="font-weight:bold ; font-size:large">Today :
                                        <?php
                                            $kioID =  $_SESSION['User_KioID'];
                                            $sql = "SELECT SUM(Dist_Com) AS total FROM tbl_Commission_Details INNER JOIN
                                                tblRetailer ON tblRetailer.Id = tbl_Commission_Details.RetailerID WHERE DATE(tbl_Commission_Details.Created_Date) = CURDATE()";
                                            $result = mysqli_query($db, $sql);
                                            while ($row = mysqli_fetch_array($result)) {  ?>
                                        <span class="card-text"><?php if ($row['total'] == "") {
                                                                            echo "0.00";
                                                                        } else {
                                                                            echo $row['total'];
                                                                        } ?></span>

                                        <!-- <p class="text-gray mb-0" style="font-weight: bold;color: red;"> <?php echo $row['count'] ?> </p>-->
                                        <?php }
                                            ?>
                                    </span></p>
                                   <p> <span class="card-text" style="font-weight:bold ; font-size:larger">This Week :
                                        <?php
                                            $kioID =  $_SESSION['User_KioID'];
                                            $sql = "SELECT SUM(Dist_Com) AS total FROM tbl_Commission_Details INNER JOIN
                                        tblRetailer ON tblRetailer.Id = tbl_Commission_Details.RetailerID WHERE YEARWEEK(tbl_Commission_Details.Created_Date) = YEARWEEK(CURDATE())";
                                            $result = mysqli_query($db, $sql);
                                            while ($row = mysqli_fetch_array($result)) {  ?>
                                        <span class="card-text"><?php if ($row['total'] == "") {
                                                                            echo "0.00";
                                                                        } else {
                                                                            echo $row['total'];
                                                                        } ?></span>
                                        <!--<p class="text-gray mb-0" style="font-weight: bold;color: red;"> <?php echo $row['count'] ?> </p>-->
                                        <?php }
                                            ?>
                                    </span></p>
                                    <p><span class="card-text" style="font-weight:bold ; font-size:larger">This Month :
                                        <?php
                                            $kioID =  $_SESSION['User_KioID'];
                                            $month = date("m");
                                            $sql = "SELECT SUM(Dist_Com) AS total FROM tbl_Commission_Details INNER JOIN
                                            tblRetailer ON tblRetailer.Id = tbl_Commission_Details.RetailerID WHERE month(tbl_Commission_Details.Created_Date) = '$month'";
                                            $result = mysqli_query($db, $sql);
                                            while ($row = mysqli_fetch_array($result)) {  ?>
                                        <span class="card-text"><?php if ($row['total'] == "") {
                                                                            echo "0.00";
                                                                        } else {
                                                                            echo $row['total'];
                                                                        } ?></span>

                                        <!--<p class="text-gray mb-0" style="font-weight: bold;color: red;"> <?php echo $row['count'] ?> </p>-->
                                        <?php }
                                            ?>
                                    </span></p>

                            </div>
                        </div>
                    </div>



                    <!--
                         <div class="col-md-4 stretch-card grid-margin">
                            <div class="card bg-gradient-success card-img-holder text-white">
                                <div class="card-body">
                                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                                    <h4 class="font-weight-normal mb-3">Master Distributor Balance<i class="mdi mdi-check-circle-outline mdi-24px float-right"></i>
                                    </h4>
                                    <h2 class="mb-5">400002</h2>

                                </div>
                            </div>
                        </div>
                         <div class="col-md-4 stretch-card grid-margin">
                            <div class="card bg-gradient-dark card-img-holder text-white">
                                <div class="card-body">
                                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                                    <h4 class="font-weight-normal mb-3">Retailer Balance <i class="mdi mdi-chart-line mdi-24px float-right"></i>
                                    </h4>
                                    <h2 class="mb-5"><?php echo $_SESSION['AvailableLimit']; ?></h2>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 stretch-card grid-margin">
                            <div class="card bg-gradient-primary card-img-holder text-white">
                                <div class="card-body">
                                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                                    <h4 class="font-weight-normal mb-3">Retailer Requested limit<br> <i class="mdi mdi-wrench mdi-24px float-right"></i>
                                    </h4>
                                     <h2 class="mb-5"><?php echo  $_SESSION['RequestedTotal']; ?></h2>
                                    <a href="pages/Direct/ViewRequest.php"><button class="btn btn-primary">View Request</button></a>
                                </div>
                            </div>
                        </div>
                        -->
                </div>
                <div class="row">
                    <!-- <br/><br/><br/> -->
                    <div class="col-md-4 stretch-card grid-margin">
                        <div class="card bg-gradient-success card-img-holder text-white">
                            <div class="card-body">
                                <img src="assets/images/dashboard/circle.svg" class="card-img-absolute"
                                    alt="circle-image" />
                                <h4 class="font-weight-normal mb-3" style="color:black;">Successfull Transactions <i
                                        class="mdi mdi-check-circle-outline mdi-24px float-right"></i>
                                </h4>
                                <?php
                                    $sql = "SELECT COUNT(*) AS count FROM tblCyberPlatCashTransfer WHERE TransferStatus='Transaction Successful' OR TransferStatus='Success'";
                                    $result = mysqli_query($db, $sql);
                                    while ($row = mysqli_fetch_array($result)) {  ?>
                                <h2 class="mb-5" style="color:black"><?php echo $row['count'] ?></h2>

                                <!--                                       <p class="text-gray mb-0" style="font-weight: bold;color: red;"> <?php echo $row['count'] ?> </p>-->
                                <?php }

                                    ?>
                                <!--<h6 class="card-text">Increased by 73%</h6>-->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 stretch-card grid-margin">
                        <div class="card bg-gradient-danger card-img-holder text-white">
                            <div class="card-body">
                                <img src="assets/images/dashboard/circle.svg" class="card-img-absolute"
                                    alt="circle-image" />
                                <h4 class="font-weight-normal mb-3" style="color:black;">Unsuccessfull Transactions <i
                                        class="mdi mdi-close-circle-outline mdi-24px float-right"></i>
                                </h4>
                                <?php
                                    $sql = "SELECT COUNT(*) AS count FROM tblCyberPlatCashTransfer WHERE TransferStatus='Transaction Failure' OR TransferStatus='Failure'";
                                    $result = mysqli_query($db, $sql);
                                    while ($row = mysqli_fetch_array($result)) {  ?>
                                <h2 class="mb-5" style="color:black"><?php echo $row['count'] ?></h2>

                                <!--                                       <p class="text-gray mb-0" style="font-weight: bold;color: red;"> <?php echo $row['count'] ?> </p>-->
                                <?php }

                                    ?>
                                <!--<h6 class="card-text">Decreased by 35%</h6>-->
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 stretch-card grid-margin">
                        <div class="card bg-gradient-dark card-img-holder text-white">
                            <div class="card-body">
                                <img src="assets/images/dashboard/circle.svg" class="card-img-absolute"
                                    alt="circle-image" />
                                <h4 class="font-weight-normal mb-3" style="color:black;">Transactions <i
                                        class="mdi mdi-chart-line mdi-24px float-right"></i>
                                </h4>
                                <?php
                                    $sql = "SELECT COUNT(*) AS count FROM tblCyberPlatCashTransfer";
                                    $result = mysqli_query($db, $sql);
                                    while ($row = mysqli_fetch_array($result)) {  ?>
                                <h2 class="mb-5" style="color:black"><?php echo $row['count'] ?></h2>

                                <!--                                       <p class="text-gray mb-0" style="font-weight: bold;color: red;"> <?php echo $row['count'] ?> </p>-->
                                <?php }

                                    ?>
                                <!--<h6 class="card-text" style="color: black;">Increased by 26%</h6>-->
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                } ?>

                <footer class="footer">
                    <div class="container-fluid d-flex justify-content-center">
                        <span class="text-muted d-block text-center text-sm-start d-sm-inline-block">©
                            <?php echo date("Y") ?> KFW. All Rights Reserved.</span>
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
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="assets/vendors/chart.js/Chart.min.js"></script>
    <script src="assets/js/jquery.cookie.js" type="text/javascript"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/todolist.js"></script>
    <!-- End custom js for this page -->
</body>
<style>
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
    width: 55%;
    height: 77%;
    margin-right: 8%;
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
<style>
.error {
    color: #FF0000;
}
</style>
</head>

<body>

    <div id="myModal" class="modal">

        <div class="modal-content">
            <span class="close">&times;</span>
            <form class="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="input-group">
                    <label class="form-control" style="font-size:20px">Limit Available : ₹
                        <?php echo $_SESSION['AvailableLimit']; ?></label><br>
                </div>

                <div class="input-group mb-2" id="otpShow1">
                    <label for="limit" class="form-control" style="font-weight:bold;font-size:17px">Request Limit :
                    </label>
                    <!-- <input id="limit" name="limit" type="number" class="form-control" placeholder="Increase limit" value = "<?php echo (isset($amount)) ? $amount : ''; ?>" style="font-weight:bold"> -->
                    <input id="limit" name="limit" type="number" class="form-control" placeholder="Request Limit"
                        style="font-weight:bold">
                    <input type="submit" name="amount" class="btn btn-info" id="btnOtp" value="Get OTP"
                        style="visibility: visible;height: 50px;" />
                </div>
                <div class="otpShow" id="otpShow" style="display : none">
                    <div class="input-group mb-2">
                        <label for="submit" class="form-control" style="font-weight:bold;font-size:17px">Enter OTP :
                        </label>
                        <input id="otp" name="otp" type="text" class="form-control" placeholder="OTP" maxlength="4"
                            style="font-weight:bold">
                        <input type="submit" name="qwe" class="btn btn-info" style="visibility : hidden" />
                        <!--                        <input type="submit" name="submit" class="btn btn-info" style="width:20%" id="btnOtpSubmit" value="Submit" />-->
                    </div>
                    <div class="input-group mb-2">
                        <label for="submit" class="form-control" style="font-weight:bold;font-size:17px">Remarks :
                        </label>
                        <input id="Remarks" name="Remarks" type="text" class="form-control" placeholder="Remarks"
                            style="font-weight:bold">
                        <span class="text-danger" id="remarksError"></span>
                        <input type="submit" name="submit" class="btn btn-info" id="btnOtpSubmit" value="Submit"
                            style="visibility: visible;height: 50px;" />
                    </div>
                </div>
                <p><strong>Time Left:<mark id="timer"></mark></strong></p>
            </form>

        </div>
    </div>

    <div id="myModal1" class="modal1">

        <div class="modal-content">
            <span class="close">&times;</span>
            <form class="form" method="post">

                <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
                <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">
                <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
                <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
                <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
                <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
                <table class="table">
                    <thead>
                        <tr>
                            <th style="text-align: center">S.No</th>
                            <!-- <th>ID</th> -->
                            <th style="text-align: center">Available Limit</th>
                            <th style="text-align: center">Required Limit</th>
                            <th style="text-align: center">BCID</th>
                            <th style="text-align: center">KioskID</th>
                            <th style="text-align: center">Required On</th>
                            <th style="text-align: center">Status</th>
                            <!--
                            <th style="text-align: center;">Approve</th>
                            <th style="text-align: center;">Reject</th>
-->
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $kioID =  $_SESSION['User_KioID'];
                        $res = mysqli_query($db, "SELECT *,@a:=@a+1 Sno FROM tblLimitTable, (SELECT @a:= 0) AS a WHERE KioskID = '$kioID' ORDER BY tblLimitTable.Requested_On DESC");
                        $cnt = 1;
                        while ($row = mysqli_fetch_array($res)) { {
                        ?>
                        <tr>


                            <td style="text-align: center"><?php echo $cnt; ?></td>
                            <td style="text-align: center"> <?php echo $row["Available_limit"]; ?></td>
                            <td style="text-align: center"><?php echo $row["Requested_limit"]; ?></td>
                            <td style="text-align: center"><?php echo $row["BCID"]; ?></td>
                            <td style="text-align: center"><?php echo $row["KioskID"]; ?></td>
                            <td style="text-align: center"><?php echo $row["Requested_On"]; ?></td>
                            <td style="text-align: center"><?php echo $row["Status"]; ?></td>
                            <!--
                                <td><button id="myBtn" class='btn-edit btn btn-square btn-sm btn-outline-info btn-icon-text'>Approve</button></td>
                                <td><button class='btn-delete btn btn-square btn-sm btn-outline-danger btn-icon-text' data-toggle='#Delete' data-target='#delete'>Reject</button></td>
-->

                        </tr>
                        <?php $cnt = $cnt + 1;
                            } ?>
                        <?php
                        }

                        ?>
                        <div id="myModal" class="modal">
                            <div class="modal-content">
                                <span class="close">&times;</span>
                                <div class="input-group mb-2" id="otpShow1">
                                    <label for="limit" class="form-control"
                                        style="font-weight:bold;font-size:17px">Enter OTP </label>
                                    <input id="OTP" name="OTP" type="text" class="form-control" placeholder="OTP"
                                        maxlength="4" onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                        style="font-weight:bold">
                                    <input type="submit" name="Register" class="btn btn-info" style="width:20%"
                                        id="btnOtp" value="Register" />
                                </div>
                                <p><strong>Time Left:<mark id="timer"></mark></strong></p>
                            </div>
                        </div>
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


                    </tbody>
                </table>
                <script>
                $('table').DataTable({
                    dom: 'Bfrtip',
                    "scrollX": false,
                    buttons: [
                        'copyHtml5',
                        'excelHtml5',
                        'csvHtml5',
                        {
                            extend: 'pdfHtml5',
                            title: this.title,
                            orientation: 'landscape',
                            pageSize: 'A2',
                            text: ' PDF ',
                            titleAttr: 'PDF'
                        }
                    ]
                });
                </script>
        </div>
    </div>

    </form>

    </div>
    </div>

    <script type="text/javascript">
    function saveOTP() {
        debugger;
        sessionStorage.setItem('Remarks', document.getElementById("Remarks").value);
        sessionStorage.setItem('otp', document.getElementById("otp").value);
        alert(document.getElementById("otp").value);
        alert(document.getElementById("Remarks").value);
        //$_SESSION['textOTP'] = document.getElementById("otp").value;
        //$_SESSION['textRemarks'] = document.getElementById("Remarks").value;
    }

    function jsFunction(amount) {

        debugger;
        if (amount == 0) {

            var otpmod = document.getElementById("otpShow");
            var btnotp = document.getElementById("btnOtp");
            var modal = document.getElementById("myModal");
            modal.style.display = "block";
            document.getElementById("limit").value = amount;
            otpmod.style.display = "none";
            btnotp.style.visibility = 'visible';
        } else {
            var otpmod = document.getElementById("otpShow");
            var btnotp = document.getElementById("btnOtp");
            var modal = document.getElementById("myModal");
            modal.style.display = "block";
            document.getElementById("limit").value = amount;
            otpmod.style.display = "block";
            btnotp.style.visibility = 'hidden';
            document.getElementById("limit").readOnly = true;
            document.getElementById("myModal").style.display = "block";
        }
    }
    $(document).ready(function() {
        $("#btnOtpSubmit").click(function() {
            debugger;
            if ($("#Remarks").val() == '') {
                alert("Please enter remarks");
                return false;
            }

        });
    });
    Retailer
    </script>
    <?php

    if (isset($_POST['amount'])) {
        $amount = $_POST["limit"];
        if ($amount != "") {
            $_SESSION['Limit'] = $amount;
            $User_ID = $_SESSION['User_ID'];
            $User_Mobile = $_SESSION['User_Mobile'];
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
            echo '<script type="text/javascript">jsFunction(' . $amount . ');</script>';
        } else {
            echo "<script>alert('Please Select Valid Limit');</script>";
            echo '<script type="text/javascript">jsFunction(0);</script>';
        }
    }




    if (isset($_POST['submit'])) {

        //echo '<script type="text/javascript">',
        //'saveOTP();',
        //'</script>';

        //$textOTP = '<script>document.write(sessionStorage.getItem("textOTP"))</script>';
        //$textOTP = "<script>document.write(sessionStorage.getItem('textOTP'))</script>";
        //$Remarks = "<script>document.write(sessionStorage.getItem('Remarks'))</script>";

        //$textOTP = $_SESSION['textOTP'];
        //$Remarks = $_SESSION['Remarks'];

        $textOTP = $_POST["otp"];
        $Remarks = $_POST["Remarks"];
        $OTP = $_SESSION['OTP'];
        //echo '<script type="text/javascript">alert(' . $textOTP . ')</script>';
        //echo '<script type="text/javascript">alert(' . $Remarks . ')</script>';
        //echo '<script type="text/javascript">alert(' . $OTP . ')</script>';
        //echo "<script>alert('Requested Successfully');</script>";
        if ($Remarks != '') {
            if ($OTP == $textOTP && $textOTP != '') {
                date_default_timezone_set('Asia/Kolkata');
                //$date = date("Y/m/d h:i:sa");
                // $amount =  mysqli_real_escape_string($db, $_POST["limit"]);    
                // $amount = $_POST["limit"];
                // echo '<script type="text/javascript">GetLimit();</script>';
                // echo "<script>alert('Message Sent to '.$amount123.');</script>";
                $Limit = $_SESSION['Limit'];
                $BCID = $_SESSION['User_BCID'];
                $kioID =  $_SESSION['User_KioID'];
                $AvailableLimit =  $_SESSION['bal'];
                $query    = "INSERT into `tblLimitTable` (Available_limit,Requested_limit,BCID,KioskID,Status,Remarks) VALUES ('$AvailableLimit','$Limit','$BCID','$kioID','Pending','$Remarks')";
                $result   = mysqli_query($db, $query);
                if ($result) {
                    //echo "<script>alert('Requested Successfully');</script>";
                    echo "<script>Requested();</script>";
                }
            } else {

                //echo "<script>alert('Invalid OTP');</script>";
                echo "<script>oops();</script>";
            }
        }
        //        else{
        //            
        //            echo "<script>alert('Please give Remarks');</script>";
        //        }
    }

    ?>

    <!-- otp model -->
    <script>
    var btnotp = document.getElementById("btnOtp");
    var otpmod = document.getElementById("otpShow");
    var modal = document.getElementById("myModal");
    var btn = document.getElementById("myBtn");
    var span = document.getElementsByClassName("close")[0];
    btn.onclick = function() {
        debugger;
        modal.style.display = "block";
        btnotp.style.visibility = 'visible';
        otpmod.style.display = "none";

    }
    span.onclick = function() {
        modal.style.display = "none";
        otpmod.style.display = "none";
        txtsubmit.value = null;
        limit.value = null;
        btnotp.style.visibility = 'visible';
    }
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
            txtsubmit.value = null;
            limit.value = null;
        }
    }
    var limit = document.getElementById("limit");
    var btnOtpSub = document.getElementById("btnOtpSubmit");
    var txtsubmit = document.getElementById("submit");



    btnOtpSub.onclick = function() {

        if (txtsubmit.value.length === 4) {
            modal.style.display = "none";
            otpmod.style.display = "none";
            txtsubmit.value = null;
            limit.value = null;
            btnotp.style.visibility = 'visible';
        }
    }
    </script>


    <!-- suguna -->



    <script>
    var btnotp1 = document.getElementById("btnOtp1");
    var otpmod1 = document.getElementById("otpShow1");
    var modal1 = document.getElementById("myModal1");
    var btn = document.getElementById("myBtn1");
    var span = document.getElementsByClassName("close")[1];
    btn.onclick = function() {
        debugger;
        modal1.style.display = "block";
        btnotp.style.visibility = 'visible';
        otpmod.style.display = "none";

    }
    span.onclick = function() {
        modal1.style.display = "none";
        otpmod.style.display = "none";
        txtsubmit.value = null;
        limit.value = null;
        btnotp.style.visibility = 'visible';
    }
    window.onclick = function(event) {
        if (event.target == modal1) {
            modal1.style.display = "none";
            txtsubmit.value = null;
            limit.value = null;
        }
    }
    var limit = document.getElementById("limit");
    var btnOtpSub1 = document.getElementById("btnOtpSubmit");
    var txtsubmit = document.getElementById("submit");


    btnOtpSub1.onclick = function() {
        if (txtsubmit.value.length === 4) {
            modal1.style.display = "none";
            otpmod.style.display = "none";
            txtsubmit.value = null;
            limit.value = null;
            btnotp.style.visibility = 'visible';
        }
    }
    </script>



</body>

</html>