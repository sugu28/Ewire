<?php

include "../../database.php";
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
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>tneb</title>
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
                                    while ($row = mysqli_fetch_array($result))   {  ?> 
                                    
                                        
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
                                        <h6 class="preview-subject ellipsis mb-1 font-weight-normal"><?php echo $row['KioskID']." "."Requested"?>
                                        </h6>
                                        <a href="pages/Direct/ViewRequest.php"><h6 class="preview-subject ellipsis mb-1 font-weight-normal"><?php echo $row['Requested_limit']." "."Limit" ?>
                                            </h6></a>
                                       <a href="pages/Direct/ViewRequest.php"><p class="text-gray mb-0"> <?php echo $row['Requested_On'] ?> </p></a>
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
                                                       <p class="mb-1 text-black"><?php echo $_SESSION['UserId']; ?></p>
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

                                <span class="font-weight-bold mb-2"> USER ID</span>
                                <span class="text-secondary text-small">SUPER ADMIN</span>
                            </div>
                            <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../dashboard.php">
                            <span class="menu-title">DASHBOARD</span>
                            <i class="mdi mdi-home menu-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                            <span class="menu-title">MASTER</span>
                            <i class="menu-arrow"></i>
                            <i class="mdi mdi-account menu-icon"></i>

                        </a>
                        <div class="collapse" id="ui-basic">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="../master/manageusers.php">Manage Users</a></li>
                                <li class="nav-item"> <a class="nav-link" href="../master/kioskdetails.php">Kiosk Details</a></li>
                                <li class="nav-item"> <a class="nav-link" href="../master/addMasterDistributor.php">Add Master Distributor</a></li>
                                <li class="nav-item"> <a class="nav-link" href="../master/addDistributors.php">Add Distributors </a></li>
                                  <li class="nav-item"> <a class="nav-link" href="../master/subDistributors.php">Sub Distributor</a>
                            </li>
                                <li class="nav-item"> <a class="nav-link" href="../master/addUsers.php">Add Users </a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#transactions" aria-expanded="false" aria-controls="transactions">
                            <span class="menu-title">TRANSACTIONS</span>
                            <i class="menu-arrow"></i>
                            <i class="mdi mdi-chart-areaspline menu-icon"></i>
                        </a>
                        <div class="collapse" id="transactions">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="./cashtransactions.php">Cash Transactions</a></li>
                                <li class="nav-item"> <a class="nav-link" href="./bbpstransactions.php">BBPS Transactions</a></li>
                                <li class="nav-item"> <a class="nav-link" href="./debitcardwithdrawals.php">Debit card withdrawals</a></li>
                                <li class="nav-item"> <a class="nav-link" href="./aepswithdrawals.php">AEPS withdrawals</a></li>
                                <li class="nav-item"> <a class="nav-link" href="./fastag.php">FASTAG</a></li>
                                <li class="nav-item"> <a class="nav-link" href="./tneb.php">TNEB</a></li>
                                <li class="nav-item"> <a class="nav-link" href="./gst.php">GST</a></li>
                                <li class="nav-item"> <a class="nav-link" href="./totalcashoutflow.php">Total Cash Outflow</a></li>
                                <li class="nav-item"> <a class="nav-link" href="./commissionreceived.php">Commission Received</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#reports" aria-expanded="false" aria-controls="ui-basic">
                            <span class="menu-title">REPORTS</span>
                            <i class="menu-arrow"></i>
                            <i class="mdi mdi-flag-outline menu-icon"></i>
                        </a>
                        <div class="collapse" id="reports">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="../reports/transactionlist.php">Transaction List</a></li>
                                <li class="nav-item"> <a class="nav-link" href="../reports/kiosklist.php">KIOSK List</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#tools" aria-expanded="false" aria-controls="ui-basic">
                            <span class="menu-title">TOOLS</span>
                            <i class="menu-arrow"></i>
                            <i class="mdi mdi-settings menu-icon"></i>
                        </a>
                        <div class="collapse" id="tools">
                            <ul class="nav flex-column sub-menu">
                               <!-- <li class="nav-item"> <a class="nav-link" href="../tools/manageusers.php">MANAGE USERS</a></li> -->
                                <li class="nav-item"> <a class="nav-link" href="../tools/backup.php">Backup</a></li>
                                <li class="nav-item"> <a class="nav-link" href="../tools/Errorlog.php">Error Log</a></li>

                            </ul>
                        </div>
                    </li>


                </ul>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title">
                        <span class="page-title-icon bg-gradient-primary text-white me-2">
                            <i class="mdi mdi-chart-areaspline menu-icon"></i>
                        </span>     
                        TNEB </h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                               <!-- <li class="breadcrumb-item"><a href="#">TRANSACTIONS</a></li>-->
                                <li class="breadcrumb-item active" aria-current="page">TNEB</li>
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
                                                <th style="text-align: center;">Kiosk ID</th>
                                                <th style="text-align: center;">BCID</th>
                                                <th style="text-align: center;">Mobile No</th>
                                                <th style="text-align: center;">Transaction Date</th>
                                                <th style="text-align: center;">Bill Service No</th>
                                                <th style="text-align: center;">Amount</th>
                                                <th style="text-align: center;">Due Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                             <?php 
                    
                    $res = mysqli_query($db,"select * from tblCardWithdraw");
                    while ($row=mysqli_fetch_array($res)){
                        ?> 
                                            <tr>
                                                 <td style="text-align: center;"><?php echo $row["kioskid"];?></td>
                                                <td style="text-align: center;"><?php echo $row["bcid"];?></td>
                                                 <td style="text-align: center;"><?php echo $row["MobileNo"];?></td>
                                                <td style="text-align: center;"><?php echo $row["TransactionDate"];?></td>
                                                 <td style="text-align: center;"><?php echo $row["voucherno"];?></td>
                                                <td style="text-align: center;"><?php echo $row["Amount"];?></td>
                                                <td style="text-align: center;"><?php echo $row["expiryDate"];?></td>
                                               
                                               



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
                                                'pdfHtml5'
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