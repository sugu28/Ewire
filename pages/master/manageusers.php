<?php session_start();
include "../../database.php";

$Edit = 1;

?>
<script src="sweetalert2.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function DeleteUser(id) {
        // Swal.fire({
        //     title: 'Are you sure?',
        //     text: "You won't be able to revert this!",
        //     icon: 'warning',
        //     showCancelButton: true,
        //     confirmButtonColor: '#3085d6',
        //     cancelButtonColor: '#d33',
        //     confirmButtonText: 'Yes, delete it!'
        // }).then((result) => {
        //     location.href = '../../UserDelete.php?id=' + id;
        // })

        // // .then((result) => {
        // //     if (result.isConfirmed) {            
        // //         Swal.fire(
        // //             'Deleted!',
        // //             'Your file has been deleted.',
        // //             'success'
        // //         )
        // //     }
        // // })    


        swal({
                title: "Are you sure?",
                text: "You won't be able to revert this!!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    location.href = '../../UserDelete.php?id=' + id;
                }
            });
    }

    function oops() {
        swal({
            text: "Incorrect OTP",
            icon: "warning",
        });
    }
</script>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>manage users</title>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

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
                        <a class="nav-link" href="../Direct/Allbankcashdeposit.php">
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
                            <span class="menu-title">Insurance Bill Pay - IFSPL</span>
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
                            Manage Users
                        </h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <!--
                                <li class="breadcrumb-item"><a href="#">MASTER</a></li>
                                <li class="breadcrumb-item active" aria-current="page">MANAGE USERS</li>
-->
                            </ol>
                        </nav>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <form method="POST" action="manageusers.php">
                                        <table class="table" style="width:100%">
                                            <thead>
                                                <tr style="text-align: center;">
                                                    <th style="text-align: center;">SI No. </th>
                                                    <!--                                                    <th>ID</th>-->
                                                    <th style="text-align: center;">Userrole</th>
                                                    <th style="text-align: center;">UserID</th>
                                                    <th style="text-align: center;">Full Name </th>
                                                    <th style="text-align: center;">Shop name </th>
                                                    <th style="text-align: center;">BCID</th>
                                                    <th style="text-align: center;">Location</th>
                                                    <th style="text-align: center;">DebitCardReaderNo</th>
                                                    <th style="text-align: center;">GSTNo</th>
                                                    <th style="text-align: center;">AAdhar</th>
                                                    <th style="text-align: center;">Panno</th>
                                                    <th style="text-align: center;">CPUID</th>
                                                    <th style="text-align: center;">Dispenser Type</th>
                                                    <th style="text-align: center;">Acceptor Type</th>
                                                    <th style="text-align: center;">POA</th>
                                                    <th style="text-align: center;">POAReferenceNo</th>

                                                    <th style="text-align: center;">DOB</th>
                                                    <th style="text-align: center;">Password</th>
                                                    <th style="text-align: center;">Mobile No</th>
                                                    <th style="text-align: center;">KioskId</th>
                                                    <th style="text-align: center;">Address1</th>
                                                    <th style="text-align: center;">State</th>
                                                    <th style="text-align: center;">Address2</th>
                                                    <th style="text-align: center;">Postcode</th>
                                                    <th style="text-align: center;">City</th>
                                                    <th style="text-align: center;">Country</th>
                                                    <th style="text-align: center;">Edit</th>
                                                    <th style="text-align: center;">Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php

                                                // $res = mysqli_query($db,"select * from users WHERE isActive = 1");
                                                if ($_SESSION['User_RoleName'] == 'Super Admin') {
                                                    $res = mysqli_query($db, "SELECT * FROM users INNER JOIN userRole ON users.FkRoleID = userRole.PKRoleId WHERE users.isActive = 1 ");
                                                } else if ($_SESSION['User_RoleName'] == 'Master Distributor') {
                                                    $uid = $_SESSION['User_ID'];
                                                    $res = mysqli_query($db, "SELECT users.*,userRole.RoleName FROM users INNER JOIN userRole ON users.FkRoleID = userRole.PKRoleId INNER JOIN tblRetailer ON tblRetailer.UserID = users.Id 
                                                    INNER JOIN tblMasterDistributor ON tblRetailer.MasterDistributorID = tblMasterDistributor.Id WHERE tblMasterDistributor.UserID = $uid AND tblRetailer.IsActive = 1 ");

                                                    // $res = mysqli_query($db, "SELECT users.*,userRole.RoleName FROM users INNER JOIN userRole ON users.FkRoleID = userRole.PKRoleId INNER JOIN tblDistributor ON tblDistributor.UserID = users.Id 
                                                    // INNER JOIN tblMasterDistributor ON tblDistributor.MasterDistributorID = tblMasterDistributor.Id WHERE tblMasterDistributor.UserID = $uid AND tblDistributor.IsActive = 1");
                                                }
                                                $cnt = 1;
                                                while ($row = mysqli_fetch_array($res)) { {
                                                ?>

                                                        <tr>
                                                            <td><?php echo $cnt; ?></td>
                                                            <!-- <td style="text-align: center;"><?php echo $row["Id"]; ?></td> -->
                                                            <td style="text-align: center;"><?php echo $row["RoleName"]; ?></td>
                                                            <td style="text-align: center;"><?php echo $row["UserName"]; ?></td>
                                                            <td style="text-align: center;"><?php echo $row["FullName"]; ?></td>
                                                            <td style="text-align: center;"><?php echo $row["ShopName"]; ?></td>
                                                            <td style="text-align: center;"><?php echo $row["BCID"]; ?></td>
                                                            <td style="text-align: center;"><?php echo $row["Location"]; ?></td>
                                                            <td style="text-align: center;"><?php echo $row["DebitCardReaderNo"]; ?></td>
                                                            <td style="text-align: center;"><?php echo $row["GSTNo"]; ?></td>
                                                            <td style="text-align: center;"><?php echo $row["AAdhar"]; ?></td>
                                                            <td style="text-align: center;"><?php echo $row["Panno"]; ?></td>
                                                            <td style="text-align: center;"><?php echo $row["CPUID"]; ?></td>
                                                            <td style="text-align: center;"><?php echo $row["Dispensertype"]; ?></td>
                                                            <td style="text-align: center;"><?php echo $row["AcceptorType"]; ?></td>
                                                            <td style="text-align: center;"><?php echo $row["POA"]; ?></td>
                                                            <td style="text-align: center;"><?php echo $row["POAReferenceNo"]; ?></td>

                                                            <td style="text-align: center;"><?php echo $row["DOB"]; ?></td>
                                                            <td style="text-align: center;"><?php echo $row["Password"]; ?></td>
                                                            <td style="text-align: center;"><?php echo $row["Phone"]; ?></td>
                                                            <td style="text-align: center;"><?php echo $row["kioskId"]; ?></td>
                                                            <td style="text-align: center;"><?php echo $row["Address1"]; ?></td>
                                                            <td style="text-align: center;"><?php echo $row["State"]; ?></td>
                                                            <td style="text-align: center;"><?php echo $row["Address2"]; ?></td>
                                                            <td style="text-align: center;"><?php echo $row["Postcode"]; ?></td>
                                                            <td style="text-align: center;"><?php echo $row["City"]; ?></td>
                                                            <td style="text-align: center;"><?php echo $row["Country"]; ?></td>
                                                            <td style="text-align: center;"><?php
                                                                                            if ($row["FkRoleID"] == 1) {
                                                                                                echo " <button  class='btn-delete btn btn-square btn-sm btn-outline-info btn-icon-text' disabled>Edit</button>";
                                                                                            } elseif ($row["FkRoleID"] == 2) {
                                                                                                echo '<button  class="btn-delete btn btn-square btn-sm btn-outline-info btn-icon-text">  <a style=text-decoration:none; href="addMasterDistributor.php?id=' . $row["Id"] . '&username=' . $row['UserName'] . '&fullname=' . $row['FullName'] . '&shopname=' . $row['ShopName'] . '&bcid=' . $row['BCID'] . '&location=' . $row['Location'] . '&debitcard=' . $row['DebitCardReaderNo'] . '&gst=' . $row['GSTNo'] . '&
                                                                                                                    adhar=' . $row['AAdhar'] . '&pan=' . $row['Panno'] . '&cpuid=' . $row['CPUID'] . '&dispenser=' . $row['Dispensertype'] . '&acceptor=' . $row['AcceptorType'] . '&fkrole=' . $row['FkRoleID'] . '&dob=' . $row["DOB"] . '&password=' . $row["Password"] . '&phone=' . $row["Phone"] . '&
                                                                                                                    kiosk=' . $row["kioskId"] . '&address1=' . $row["Address1"] . '&state=' . $row["State"] . '&address2=' . $row["Address2"] . '&postcode=' . $row["Postcode"] . '&city=' . $row["City"] . '&country=' . $row["Country"] . ' &Edit=' . $Edit . ' ">Edit </a> </button>';
                                                                                            } elseif ($row["FkRoleID"] == 3) {
                                                                                                echo '<button  class="btn-delete btn btn-square btn-sm btn-outline-info btn-icon-text">  <a style=text-decoration:none; href="addDistributors.php?id=' . $row["Id"] . '&username=' . $row['UserName'] . '&fullname=' . $row['FullName'] . '&shopname=' . $row['ShopName'] . '&bcid=' . $row['BCID'] . '&location=' . $row['Location'] . '&debitcard=' . $row['DebitCardReaderNo'] . '&gst=' . $row['GSTNo'] . '&
                                                                                                                        adhar=' . $row['AAdhar'] . '&pan=' . $row['Panno'] . '&cpuid=' . $row['CPUID'] . '&dispenser=' . $row['Dispensertype'] . '&acceptor=' . $row['AcceptorType'] . '&fkrole=' . $row['FkRoleID'] . '&dob=' . $row["DOB"] . '&password=' . $row["Password"] . '&phone=' . $row["Phone"] . '&
                                                                                                                        kiosk=' . $row["kioskId"] . '&address1=' . $row["Address1"] . '&state=' . $row["State"] . '&address2=' . $row["Address2"] . '&postcode=' . $row["Postcode"] . '&city=' . $row["City"] . '&country=' . $row["Country"] . ' &Edit=' . $Edit . ' ">Edit </a> </button>';
                                                                                            } elseif ($row["FkRoleID"] == 4) {
                                                                                                echo '<button  class="btn-delete btn btn-square btn-sm btn-outline-info btn-icon-text">  <a style=text-decoration:none; href="addUsers.php?id=' . $row["Id"] . '&username=' . $row['UserName'] . '&fullname=' . $row['FullName'] . '&shopname=' . $row['ShopName'] . '&bcid=' . $row['BCID'] . '&location=' . $row['Location'] . '&debitcard=' . $row['DebitCardReaderNo'] . '&gst=' . $row['GSTNo'] . '&
                                                                                                                            adhar=' . $row['AAdhar'] . '&pan=' . $row['Panno'] . '&cpuid=' . $row['CPUID'] . '&dispenser=' . $row['Dispensertype'] . '&acceptor=' . $row['AcceptorType'] . '&fkrole=' . $row['FkRoleID'] . '&dob=' . $row["DOB"] . '&NatureofBusiness=' . $row['NatureofBusiness'] . '&AEPS=' . $row['AEPS'] . '&POAReferenceNo=' . $row['POAReferenceNo'] . '&FMCG=' . $row['FMCG'] . '&password=' . $row["Password"] . '&phone=' . $row["Phone"] . '&
                                                                                                                            kiosk=' . $row["kioskId"] . '&address1=' . $row["Address1"] . '&state=' . $row["State"] . '&address2=' . $row["Address2"] . '&postcode=' . $row["Postcode"] . '&city=' . $row["City"] . '&country=' . $row["Country"] . ' &Edit=' . $Edit . ' ">Edit </a> </button>';
                                                                                            }
                                                                                            ?> </td>
                                                            <!-- onclick="DeleteUser(<?php echo $row['Id']; ?>)" -->
                                                            <td style="text-align: center;">
                                                                <?php if ($row['FkRoleID'] == 1) {
                                                                    echo "<button class='btn-delete btn btn-square btn-sm btn-outline-danger btn-icon-text' disabled>Delete</button>";
                                                                } else { ?> <button class='btn-delete btn btn-square btn-sm btn-outline-danger btn-icon-text' name="DeleteUser" value="<?php echo $row['Id'] ?>">Delete</button> <?php } ?>
                                                            </td>
                                                        </tr>

                                                    <?php $cnt = $cnt + 1;
                                                    } ?>
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
                                                        pageSize: 'A2',
                                                        text: ' PDF ',
                                                        titleAttr: 'PDF'
                                                    }
                                                ]
                                            });
                                        </script>
                                        <!-- OTP Model -->
                                        <div id="myModal" class="modal">
                                            <div class="modal-content">
                                                <span class="close">&times;</span>
                                                <div class="input-group mb-2" id="otpShow1">
                                                    <label for="limit" class="form-control" style="font-weight:bold;font-size:17px">Enter OTP </label>
                                                    <input id="OTP" name="OTP" type="text" class="form-control" placeholder="OTP" maxlength="4" onkeypress="return event.charCode >= 48 && event.charCode <= 57" style="font-weight:bold">
                                                    <input type="submit" name="cfrmDelete" class="btn btn-info" style="width:20%;height: 52px;" id="btnOtp" value="Submit" />
                                                </div>
                                                <p><strong>Time Left:<mark id="timer"></mark></strong></p>
                                            </div>
                                        </div>
                                        <!-- OTP Model End-->
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- OTP timer -->
                <script>
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
                <?php

                if (isset($_POST['DeleteUser'])) {
                    $_SESSION['deleteid'] = $_POST['DeleteUser'];
                    $ottp = (string)mt_rand(1000, 9999);
                    $fourRandomDigit = "OTP : " . $ottp;
                    $_SESSION['otp'] = $ottp;
                    $User_Mobile = $_SESSION['User_Mobile'];
                    $mobile = $User_Mobile;
                    $numbers = array($mobile);
                    $REF_ID = (string)mt_rand(36523462, 99999999);
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

                    echo "<script type='text/javascript'>GetOTP();</script>";
                    //  $Parameter = "'" . $FullName . "," . $ShopName . "," . $BCID . "," . $mobile . "," . $DebitCardReaderNo . "," . $GSTNo . "," . $AAdhar . "," . $Panno . "," . $Username . "," . $CPUID . "," . $DOB . "," . $Password . "," . $Address1 . "," . $State . "," . $Address2 . "," . $Postcode . "," . $City . "," . $Country . "'";
                    //                     echo '<script type="text/javascript">alert(' . $Parameter . ');</script>';

                    echo '<script type="text/javascript">GetOTP();</script>';
                }

                if (isset($_POST['cfrmDelete'])) {
                    $otptext = $_POST['OTP'];
                    if ($otptext == $_SESSION['otp']) {
                        $id = $_SESSION['deleteid'];
                        echo '<script>DeleteUser(' . $id . ')</script>';
                    } else {
                        echo '<script>oops()</script>';
                    }
                }
                ?>
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