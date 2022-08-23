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
    <title>All Bank Cash Deposit</title>
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


    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function DeleteUser() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            })
            // .then((result) => {
            //     if (result.isConfirmed) {            
            //         Swal.fire(
            //             'Deleted!',
            //             'Your file has been deleted.',
            //             'success'
            //         )
            //     }
            // })     

        }

        function success() {
            Swal.fire(
                'Rejected!',
                'Request has been Rejected.',
                'success'
            )
        }

        function approveSuccess() {
            Swal.fire(
                'Approved!',
                'Request has been Approved.',
                'success'
            )
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
                    if ($_SESSION['User_RoleName'] == 'Super Admin') {  ?>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                                <span class="menu-title">Master</span>
                                <i class="menu-arrow"></i>
                                <i class="mdi mdi-account menu-icon"></i>

                            </a>
                            <div class="collapse" id="ui-basic">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"> <a class="nav-link" href="../../pages/master/manageusers.php">Manage Users</a></li>
                                    <li class="nav-item"> <a class="nav-link" href="../../pages/master/kioskdetails.php">Kiosk Details</a></li>
                                    <li class="nav-item"> <a class="nav-link" href="../../pages/master/addMasterDistributor.php">Add Master Distributor</a></li>
                                    <li class="nav-item"> <a class="nav-link" href="../../pages/master/addDistributors.php">Add Distributors </a></li>
                                            <li class="nav-item"> <a class="nav-link" href="../../pages/master/subDistributors.php">Sub Distributor</a>
                            </li>
                                    <li class="nav-item"> <a class="nav-link" href="../../pages/master/addUsers.php">Add Users </a></li>
                                    
                                </ul>
                            </div>
                        </li>

                    <?php
                    }
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="awaiting.php">
                            <span class="menu-title">Manual Entry Transactions</span>
                            <i class="mdi mdi-transcribe menu-icon"></i>
                        </a>
                    </li>


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
                                <i class="mdi mdi-cash-multiple menu-icon"></i>
                            </span>
                            View Request
                        </h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <a href="../../dashboard.php"><input type="submit" name="SubmitOTP" value="Back" class="btn btn-gradient-primary me-2" style="background-color: #9118d3;color: #fff;border: none;" /></a>
                                <!--<li class="breadcrumb-item active" aria-current="page">CASH TRANSACTIONS</li>-->
                            </ol>
                        </nav>
                    </div>


                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <table class="table" style="width:100%">
                                        <thead>
                                            <tr>
                                                <!--<th>S.No</th>-->
                                                <th style="text-align: center;">S.No</th>
                                                <th style="text-align: center;">Available Limit</th>
                                                <th style="text-align: center;">Requested Limit</th>
                                                <th style="text-align: center;">BCID</th>
                                                <th style="text-align: center;">KioskID</th>
                                                <th style="text-align: center;">Requested On</th>
                                                <th style="text-align: center;">Status</th>
                                                <th style="text-align: center;">Approve</th>
                                                <th style="text-align: center;">Reject</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                            $kioID =  $_SESSION['User_KioID'];
                                            $res = mysqli_query($db, "SELECT *,@a:=@a+1 Sno FROM tblLimitTable, (SELECT @a:= 0) AS a WHERE Status = 'Pending' OR Status = 'success' OR Status = 'Reject' ORDER BY tblLimitTable.Requested_On DESC");
                                            while ($row = mysqli_fetch_array($res)) {
                                                $id = $row['ID'];
                                                $status = $row["Status"];
                                            ?>
                                                <tr>
                                                    <!--<td></td>-->
                                                    <td style="text-align: center;"><?php echo $row["Sno"]; ?></td>
                                                    <td style="text-align: center;"><?php echo $row["Available_limit"]; ?></td>
                                                    <td style="text-align: center;"><?php echo $row["Requested_limit"]; ?></td>
                                                    <td style="text-align: center;"><?php echo $row["BCID"]; ?></td>
                                                    <td style="text-align: center;"><?php echo $row["KioskID"]; ?></td>
                                                    <td style="text-align: center;"><?php echo $row["Requested_On"]; ?></td>
                                                    <td style="text-align: center;"><?php echo $row["Status"]; ?></td>
                                                    <?php if ($status == "Pending") { ?>
                                                        <td>
                                                            <form action="ViewRequest.php" method="POST"> <button name="Approve" class='btn-edit btn btn-square btn-sm btn-outline-info btn-icon-text' value="<?php echo $id; ?>"> Approve </button> </form>
                                                        </td>
                                                        <td>
                                                            <form action="ViewRequest.php" method="POST"> <button class='btn-delete btn btn-square btn-sm btn-outline-danger btn-icon-text' name="Reject" value="<?php echo $id; ?>"> Reject</button></form>
                                                        </td>
                                                    <?php } else { ?>
                                                        <td>
                                                            <button name="Approve" class='btn-edit btn btn-square btn-sm btn-outline-info btn-icon-text' disabled> Approve </button>
                                                        </td>
                                                        <td>
                                                            <button class='btn-delete btn btn-square btn-sm btn-outline-danger btn-icon-text' disabled> Reject</button>
                                                        </td>
                                                    <?php } ?>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    <script>
                                        $(' table').DataTable({
                                            dom: 'Bfrtip',
                                            "scrollX": true,
                                            buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5']
                                        });
                                    </script>
                                </div>
                            </div>
                            <div id="myModal" class="modal">
                                <div class="modal-content">
                                    <span class="close">&times;</span>
                                    <form class="form" action="ViewRequest.php" method="post">
                                        <div class="input-group mb-2">
                                            <label for="submit" class="form-control" style="font-weight:bold;font-size:17px">Enter OTP : </label>
                                            <input name="textOTP" type="text" class="form-control" placeholder="OTP" maxlength="4" style="font-weight:bold">
                                            <input type="submit" name="submit" class="btn btn-info" style="width:20%;height: 48px;" id="btnOtpSubmit" value="Submit" />
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div id="myModal1" class="modal">
                                <div class="modal-content">
                                    <span class="close">&times;</span>
                                    <form class="form" action="ViewRequest.php" method="post">
                                        <div class="input-group mb-2">
                                            <label for="submit" class="form-control" style="font-weight:bold;font-size:17px">Enter OTP : </label>
                                            <input name="textOTP1" type="text" class="form-control" placeholder="OTP" maxlength="4" style="font-weight:bold">
                                            <input type="submit" name="submit1" class="btn btn-info" style="width:20%;height: 48px;" id="btnOtpSubmit" value="Submit" />
                                        </div>
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
    <!-- otp model -->

</body>

</html>
<script>
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
    function Delete() {
        document.getElementById("myModal1").style.display = "block";
        window.onclick = function(event) {
            if (event.target == myModal) {
                myModal.style.display = "none";
            }
        }
    }
</script>

<?php

if (isset($_POST['Approve'])) {
    $_SESSION['sno'] = $_POST['Approve'];
    $ottp = (string)mt_rand(1000, 9999);
    $fourRandomDigit = "OTP : " . $ottp;
    $_SESSION['otp'] = $ottp;
    $mobile = $_SESSION['User_Mobile'];
    $numbers = array($mobile);
    $REF_ID = (string)mt_rand(36523462, 99999999);
    $uid = 'interactivfin';
    $pwd = urlencode('13005');
    $Peid = '1601100000000016430';
    $tempid = '1607100000000217622';
    $sender = urlencode('IFINKI');
    $kkk = 'Dear user, Ref.ID ' . $REF_ID . ', Thank you for register with INTERACTIVE KIOSK. Your credentials are ' . $fourRandomDigit . '. - Interactiv FinServe Kiosk';
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
    echo '<script type="text/javascript">GetOTP();</script>';
}

if (isset($_POST["submit"])) {
    $textOTP = $_POST['textOTP'];
    if ($textOTP == $_SESSION['otp']) {
        date_default_timezone_set('Asia/Kolkata');
        $date = date("Y/m/d h:i:sa");
        $SNO = $_SESSION['sno'];
        $query    = " UPDATE `tblLimitTable`  SET Status = 'success' WHERE ID = '$SNO' ";
        $result   = mysqli_query($db, $query);

        if ($result) {

            $q    = " SELECT KioskID,Requested_limit FROM tblLimitTable WHERE ID = '$SNO' ";
            $res   = mysqli_query($db, $q);
            while ($row = mysqli_fetch_array($res)) {
                $reqlimit = $row['Requested_limit'];
                $kid = $row['KioskID'];
            }

            //            echo "<script>alert('$kid');</script>";

            $query1  = "UPDATE tblRetailer SET Available_Balance = Available_Balance + '$reqlimit' WHERE kioskId =  '$kid' ";
            $result1   = mysqli_query($db, $query1);
            if ($result1) {
                //               echo "<script>alert('$reqlimit');</script>";
                $q1    = "SELECT * FROM tblRetailer INNER JOIN tblLimitTable ON tblLimitTable.KioskID = tblRetailer.kioskId WHERE tblLimitTable.ID = '$SNO' AND tblRetailer.kioskId = '$kid' ";
                $res   = mysqli_query($db, $q1);
                while ($row = mysqli_fetch_array($res)) {
                    $Requested_limit1 = $row['Requested_limit'];
                    $kid1 = $row['KioskID'];
                    $BC = $row['BCID'];
                    $bal = $row['Available_Balance'];
                    $mob = $row['Phone'];
                }

                $transid = rand(100000000000, 999999999999);
                date_default_timezone_set('Asia/Kolkata');
                $date = date("Y/m/d h:i:sa");
                $SNO = $_SESSION['sno'];
                $query    = "INSERT INTO `tbl_Journal_Ledger`(bcid,kioskid,RemitterPhone,transaction_Id,trans_amount,Credit_OR_Debit,transaction_type,balance)
                            VALUES ('$BC','$kid1','$mob','$transid','$Requested_limit1','CREDIT','RETAILER DEPOSIT','$bal') ";
                $result   = mysqli_query($db, $query);
                echo "<script>approveSuccess();</script>";
                echo "<script>location.href='ViewRequest.php';</script>";
            }
        }
    } else {
        // echo "<script> alert ('".$OTP."'); </script>";
        echo "<script>alert('Invalid OTP');</script>";
    }
}
?>
<?php

if (isset($_POST['Reject'])) {
    $_SESSION['id'] = $_POST['Reject'];
    $ottp = (string)mt_rand(1000, 9999);
    $fourRandomDigit = "OTP : " . $ottp;
    $_SESSION['otp1'] = $ottp;
    $mobile = $_SESSION['User_Mobile'];
    $numbers = array($mobile);
    $REF_ID = (string)mt_rand(36523462, 99999999);
    $uid = 'interactivfin';
    $pwd = urlencode('13005');
    $Peid = '1601100000000016430';
    $tempid = '1607100000000217622';
    $sender = urlencode('IFINKI');
    $kkk = 'Dear user, Ref.ID ' . $REF_ID . ', Thank you for register with INTERACTIVE KIOSK. Your credentials are ' . $fourRandomDigit . '. - Interactiv FinServe Kiosk';
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
    echo '<script type="text/javascript">Delete();</script>';
}

if (isset($_POST["submit1"])) {
    $textOTP = $_POST['textOTP1'];
    if ($textOTP == $_SESSION['otp1']) {
        date_default_timezone_set('Asia/Kolkata');
        $date = date("Y/m/d h:i:sa");
        $id = $_SESSION['id'];
        $query    = " UPDATE `tblLimitTable`  SET Status = 'Reject' WHERE ID = '$id' ";
        $result   = mysqli_query($db, $query);
        if ($result) {

            echo "<script>success();</script>";
            echo "<script>location.href='ViewRequest.php';</script>";
        }
    } else {
        // echo "<script> alert ('".$OTP."'); </script>";
        echo "<script>alert('Invalid OTP');</script>";
    }
}

?>