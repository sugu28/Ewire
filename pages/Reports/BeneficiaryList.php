<?php session_start();
include "../../database.php";
//include("../../auth_session.php");
//session_destroy();
?>
<script src="sweetalert2.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    function load() {
        let timerInterval
        Swal.fire({
            title: 'Loading',
            html: '',
            timer: 1000,
            timerProgressBar: false,
            didOpen: () => {
                Swal.showLoading()
                const b = Swal.getHtmlContainer().querySelector('b')
                timerInterval = setInterval(() => {
                    b.textContent = Swal.getTimerLeft()
                }, 100)
            },
            willClose: () => {
                clearInterval(timerInterval)
            }
        }).then((result) => {
            /* Read more about handling dismissals below */
            if (result.dismiss === Swal.DismissReason.timer) {
                console.log('I was closed by the timer')
            }
        })
    }

    window.onload = load;
</script>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Beneficiary List</title>
    <!-- Tables -->

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
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
        .logo {
            font-weight: bold;
            color: #da8cff;
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

                                    <li class="nav-item"> <a class="nav-link" href="../master/manageusers.php">Manage Users</a></li>
                                    <li class="nav-item"> <a class="nav-link" href="../master/kioskdetails.php">Kiosk Details</a></li>
                                    <?php if ($_SESSION['User_RoleName'] == 'Super Admin') { ?>
                                        <li class="nav-item"> <a class="nav-link" href="../master/addMasterDistributor.php">Add Master Distributor</a></li>
                                        <li class="nav-item"> <a class="nav-link" href="../master/addDistributors.php">Add Distributors </a></li>
                                            <li class="nav-item"> <a class="nav-link" href="../master/subDistributors.php">Sub Distributor</a>
                            </li>
                                    <?php } ?>
                                    <li class="nav-item"> <a class="nav-link" href="../master/addUsers.php">Add Users </a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../Direct/awaiting.php">
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


                    <!--
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#transactions" aria-expanded="false" aria-controls="transactions">
                        <span class="menu-title">Transactions</span>
                        <i class="menu-arrow"></i>
                        <i class="mdi mdi-chart-areaspline menu-icon"></i>
                    </a>
                    <div class="collapse" id="transactions">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="pages/transactions/cashtransactions.php">Cash Transactions</a></li>
                            <li class="nav-item"> <a class="nav-link" href="pages/transactions/bbpstransactions.php">BBPS Transactions</a></li>
                            <li class="nav-item"> <a class="nav-link" href="pages/transactions/debitcardwithdrawals.php">Debit card withdrawals</a></li>
                            <li class="nav-item"> <a class="nav-link" href="pages/transactions/aepswithdrawals.php">AEPS withdrawals</a></li>
                            <li class="nav-item"> <a class="nav-link" href="pages/transactions/fastag.php">FASTAG</a></li>
                            <li class="nav-item"> <a class="nav-link" href="pages/transactions/tneb.php">TNEB</a></li>
                            <li class="nav-item"> <a class="nav-link" href="pages/transactions/gst.php">GST</a></li>
                            <li class="nav-item"> <a class="nav-link" href="pages/transactions/totalcashoutflow.php">Total Cash Outflow</a></li>
                            <li class="nav-item"> <a class="nav-link" href="pages/transactions/commissionreceived.php">Commission Received</a></li>
                        </ul>
                    </div>
                </li>
-->


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
                    <!--                 
                <li class="nav-item">
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
                                <i class="mdi mdi-animation menu-icon"></i>
                            </span>
                            Beneficiary List
                        </h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <!-- <li class="breadcrumb-item"><a href="#">TRANSACTIONS</a></li>-->
                                <!--<li class="breadcrumb-item active" aria-current="page">CASH TRANSACTIONS</li>-->
                            </ol>
                        </nav>
                    </div>
                    <form action="" method="GET">

                        <label class="btn btn-gradient-primary me-2" style="text-align: center;"> From Date</label>
                        <input type="date" style="text-align: center;" class="class='btn-delete btn btn-square btn-sm btn-outline-info btn-icon-text'" name="from_date" class="form-group">
                        <label class="btn btn-gradient-primary me-2" style="text-align: center;"> To Date</label>
                        <input type="date" style="text-align: center;" class="class='btn-delete btn btn-square btn-sm btn-outline-info btn-icon-text'" name="to_date" class="form-group">
                        <button type="submit" class="btn btn-gradient-primary me-2" style="background-color: #9118d3;color: #fff;border: none;">Search</button>
                    </form>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <table class="table" style="width:100%">
                                        <thead>
                                            <tr>

                                                <th style="text-align: center;">kioskId</th>
                                                <!--   <th style="text-align: center;">RemitterID</th>-->
                                                <th style="text-align: center;">RemitterPhone</th>
                                                <th style="text-align: center;">BeneficiaryName</th>
                                                <th style="text-align: center;">BeneficiaryPhone</th>
                                                <th style="text-align: center;">BeneficiaryA/C No</th>
                                                <th style="text-align: center;">BankName</th>
                                                <!--<th style="text-align: center;">Branch</th>-->
                                                <th style="text-align: center;">IFSC</th>
                                                <th style="text-align: center;">Created_Date</th>


                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            $filterQry = '';


                                            if (isset($_GET['from_date']) && isset($_GET['to_date'])) {
                                                $from_date = $_GET['from_date'];
                                                $to_date = $_GET['to_date'];
                                                $tt = date('Y-m-d', strtotime($to_date . ' + 1 days'));
                                                $filterQry = "AND createddatetime BETWEEN '$from_date' AND '$tt'";
                                            }
                                            $kioID =  $_SESSION['User_KioID'];
                                            $uid = $_SESSION['User_ID'];
                                            if ($_SESSION['User_RoleID'] == 1) {
                                                $res = mysqli_query($db, "SELECT * FROM tblBeneficiaryList " . $filterQry . "ORDER BY tblBeneficiaryList.createddatetime DESC");
                                            } elseif ($_SESSION['User_RoleID'] == 2) {
                                                $res = mysqli_query($db, "SELECT tblBeneficiaryList.kioskid,remitterid,remitterphone,beneficiaryName,benephone,beneaccountno,
                                                benebankname,benebankbranch,beneifsc,benename,tblBeneficiaryList.createddatetime FROM tblBeneficiaryList INNER JOIN tblRetailer ON tblRetailer.kioskId = tblBeneficiaryList.kioskid INNER JOIN tblMasterDistributor ON tblRetailer.MasterDistributorID = tblMasterDistributor.Id
                                                WHERE  tblMasterDistributor.UserID = '$uid' " . $filterQry . "ORDER BY tblBeneficiaryList.createddatetime DESC ");
                                            } elseif ($_SESSION['User_RoleID'] == 3) {
                                                $res = mysqli_query($db, "SELECT * FROM tblBeneficiaryList INNER JOIN tblRetailer ON tblRetailer.kioskId = tblBeneficiaryList.kioskid INNER JOIN tblDistributor ON tblRetailer.DistributorID = tblDistributor.Id
                                                WHERE  tblDistributor.UserID = '$uid' " . $filterQry . "ORDER BY tblBeneficiaryList.createddatetime DESC");
                                            } elseif ($_SESSION['User_RoleID'] == 4) {
                                                $res = mysqli_query($db, "SELECT kioskid,remitterid,remitterphone,beneficiaryName,benephone,beneaccountno,
                                                benebankname,benebankbranch,beneifsc,benename,createddatetime FROM tblBeneficiaryList where kioskid='$kioID' " . $filterQry . "ORDER BY tblBeneficiaryList.createddatetime DESC ");
                                            }
                                            $cnt = 1;
                                            while ($row = mysqli_fetch_array($res)) { ?>

                                                <tr>

                                                    <td style="text-align: center;"><?php echo $row["kioskid"]; ?></td>
                                                    <!--  <td style="text-align: center;"><?php echo $row["remitterid"]; ?></td>-->
                                                    <td style="text-align: center;"><?php echo $row["remitterphone"]; ?></td>
                                                    <td style="text-align: center;"><?php echo $row["benename"]; ?></td>
                                                    <td style="text-align: center;"><?php echo $row["benephone"]; ?></td>
                                                    <td style="text-align: center;"><?php echo $row["beneaccountno"]; ?></td>
                                                    <td style="text-align: center;"><?php echo $row["benebankname"]; ?></td>
                                                    <!--   <td style="text-align: center;"><?php echo $row["benebankbranch"]; ?></td>-->
                                                    <td style="text-align: center;"><?php echo $row["beneifsc"]; ?></td>
                                                    <td style="text-align: center;"><?php echo $row["createddatetime"]; ?></td>



                                                </tr>
                                            <?php
                                            }

                                            ?>
                                        </tbody>
                                    </table>
                                    <script>
                                        $('table').DataTable({
                                            dom: 'Bfrtip',
                                            "scrollX": true,
                                            buttons: [
                                                'copyHtml5',
                                                'excelHtml5',
                                                'csvHtml5',
                                                {
                                                    extend: 'pdfHtml5',
                                                    title: this.title,
                                                    orientation: 'landscape',
                                                    pageSize: 'LEGAL',
                                                    text: ' PDF ',
                                                    titleAttr: 'PDF'
                                                }
                                            ]
                                        });
                                    </script>

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