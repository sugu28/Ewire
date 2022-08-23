<?php session_start();  
include "database.php";

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
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>iFIN PAYMENTS DASHBOARD</title>
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="assets/images/KFW.jpeg" />
    
</head>
        <!-- <span class="close">&times;</span> -->
        <body>
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
                            <img src="assets\images\faces-clipart\pic-1.png">
                            <span class="login-status online"></span>
                            <!--change to offline or busy as needed-->
                        </div>
                        <div class="nav-profile-text d-flex flex-column">

                            <span class="font-weight-bold mb-2"><?php echo $_SESSION['User_Name']; ?></span>
                            <span class="text-secondary text-small"><?php echo $_SESSION['User_RoleName']; ?></span>
                            <span class="text-secondary text-small"><?php echo$_SESSION['User_KioID']; ?></span>

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
                if($_SESSION['User_RoleName'] == 'Super Admin') {  ?>
                        <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                                    <span class="menu-title">Master</span>
                                    <i class="menu-arrow"></i>
                                        <i class="mdi mdi-account menu-icon"></i>

                                </a>
                                <div class="collapse" id="ui-basic">
                                    <ul class="nav flex-column sub-menu">
                                        <li class="nav-item"> <a class="nav-link" href="pages/master/manageusers.php">Manage Users</a></li>
                                        <li class="nav-item"> <a class="nav-link" href="pages/master/kioskdetails.php">Kiosk Details</a></li>
                                        <li class="nav-item"> <a class="nav-link" href="pages/master/addMasterDistributor.php">Add Master Distributor</a></li>
                                        <li class="nav-item"> <a class="nav-link" href="pages/master/addDistributors.php">Add Distributors </a></li>
                                        <li class="nav-item"> <a class="nav-link" href="pages/master/subDistributors.php">Sub Distributor</a>
                            </li>
                                        <li class="nav-item"> <a class="nav-link" href="pages/master/addUsers.php">Add Users </a></li>
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
                           
                               
                <li class="nav-item">
                    <a class="nav-link" href="pages/Direct/Allbankcashdeposit.php">
                        <span class="menu-title">All Bank Cash Deposit</span>
                        <i class="mdi mdi-cash-multiple menu-icon"></i>
                    </a>
                </li>
                
<!--
                 <li class="nav-item">
                    <a class="nav-link" href="../DMT_Dashboard/SBSR_Dashboard/pages/Direct/Debitcardtransaction.php">
                        <span class="menu-title">Debit Card Withdrawal</span>
                        <i class="mdi mdi-account-card-details menu-icon"></i>
                    </a>
                </li>
                
                 <li class="nav-item">
                    <a class="nav-link" href="../DMT_Dashboard/SBSR_Dashboard/pages/Direct/Aadharpay.php">
                        <span class="menu-title">Aadhaar Pay</span>
                        <i class="mdi mdi-animation menu-icon"></i>
                    </a>
                </li>
                
                 <li class="nav-item">
                    <a class="nav-link" href="../DMT_Dashboard/SBSR_Dashboard/pages/Direct/QRcard.php">
                        <span class="menu-title">QR Card Withdrawal</span>
                        <i class="mdi mdi-qrcode menu-icon"></i>
                    </a>
                </li>
-->

                
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
                            <li class="nav-item"> <a class="nav-link" href="pages/BBPSBILLERS/Airtel.php">Airtel</a></li>
                            <li class="nav-item"> <a class="nav-link" href="pages/BBPSBILLERS/Bsnl.php">Bsnl</a></li>
                            <li class="nav-item"> <a class="nav-link" href="pages/BBPSBILLERS/Idea.php">Idea</a></li>
                            <li class="nav-item"> <a class="nav-link" href="pages/BBPSBILLERS/Jio.php">Jio</a></li>
                            <li class="nav-item"> <a class="nav-link" href="pages/BBPSBILLERS/MTNLMumbai.php">MTNL Mumbai</a></li>
                            <li class="nav-item"> <a class="nav-link" href="pages/BBPSBILLERS/MTNLDelhi.php">MTNL Delhi</a></li>
                            <li class="nav-item"> <a class="nav-link" href="pages/BBPSBILLERS/Vodafone.php">Vodafone</a></li>
                            <li class="nav-item"> <a class="nav-link" href="pages/BBPSBILLERS/AirtelDTH.php">Airtel DTH</a></li>
                            <li class="nav-item"> <a class="nav-link" href="pages/BBPSBILLERS/DishTV.php">Dish TV</a></li>
                            <li class="nav-item"> <a class="nav-link" href="pages/BBPSBILLERS/Sundirect.php">Sundirect</a></li>
                            <li class="nav-item"> <a class="nav-link" href="pages/BBPSBILLERS/TataskyRetails.php">Tatasky Retails</a></li>
                            <li class="nav-item"> <a class="nav-link" href="pages/BBPSBILLERS/TataskyOnline.php">Tatasky Online</a></li>
                            <li class="nav-item"> <a class="nav-link" href="pages/BBPSBILLERS/VideoconD2H.php">Videocon D2H</a></li>
                            <li class="nav-item"> <a class="nav-link" href="pages/BBPSBILLERS/VodafoneDatacard.php">Vodafone Datacard</a></li>
                            <li class="nav-item"> <a class="nav-link" href="pages/BBPSBILLERS/AirtelDatacard.php">Airtel Datacard</a></li>
                            <li class="nav-item"> <a class="nav-link" href="pages/BBPSBILLERS/Ideadatacard.php">Idea data card</a></li>
                            <li class="nav-item"> <a class="nav-link" href="pages/BBPSBILLERS/Electricity.php">Electricity</a></li>
                            <li class="nav-item"> <a class="nav-link" href="pages/BBPSBILLERS/Gas.php">Gas</a></li>
                            <li class="nav-item"> <a class="nav-link" href="pages/BBPSBILLERS/Water.php">Water</a></li>
                            <li class="nav-item"> <a class="nav-link" href="pages/BBPSBILLERS/TelecomMobileAndLandline.php">Telecom Mobile And Landline Post Paid Online</a></li>
                            <li class="nav-item"> <a class="nav-link" href="pages/BBPSBILLERS/TelecomMobilepostpaid.php">Telecom Mobile And Landline Post Retails</a></li>
                            

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
                            <li class="nav-item"> <a class="nav-link" href="pages/NONBBPS/cellonepostpaid.php">Cellone Post Paid</a></li>
                            <li class="nav-item"> <a class="nav-link" href="pages/NONBBPS/ideapostpaid.php">Idea Post Paid</a></li>
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
                            <li class="nav-item"> <a class="nav-link" href="pages/Internetserviceproviders/Tikonabill.php">Tikona Bill Payment</a></li>
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
                            <li class="nav-item"> <a class="nav-link" href="pages/InsuranceBillPay/Tataaiglife.php">Tata AIG Life</a></li>
                            <li class="nav-item"> <a class="nav-link" href="pages/InsuranceBillPay/ICICIPruLife.php">ICICI Pru Life</a></li>
                           
                            <li class="nav-item"> <a class="nav-link" href="pages/InsuranceBillPay/BhartiAxaLifeInsurance.php">Bharti  Axa Life Insurance</a></li>
                           
                            <li class="nav-item"> <a class="nav-link" href="pages/InsuranceBillPay/IndiaFirstInsurance.php">India First Insurance</a></li>
                           
                           </ul>
                    </div>
                </li>
                
                 <li class="nav-item">
                    <a class="nav-link" href="../DMT_Dashboard/SBSR_Dashboard/pages/fastag/">
                        <span class="menu-title">QR Card Withdrawal</span>
                        <i class="mdi mdi-qrcode menu-icon"></i>
                    </a>
                </li>
                
               <li class="nav-item">
                    <a class="nav-link" href="../pages/fastag/fastag.php">
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
                            <li class="nav-item"> <a class="nav-link" href="pages/QRRecharge/amazonpay.php">Amazon Pay</a></li>
                           
                            <li class="nav-item"> <a class="nav-link" href="pages/QRRecharge/GooglePay.php">Google Pay</a></li>
                           
                            <li class="nav-item"> <a class="nav-link" href="pages/QRRecharge/Paytm.php">Paytm</a></li>
                            <li class="nav-item"> <a class="nav-link" href="pages/QRRecharge/PhonePe.php">PhonePe</a></li>
                            <li class="nav-item"> <a class="nav-link" href="pages/QRRecharge/AirtelPay.php">Airtel Pay</a></li>
                           
                           </ul>
                    </div>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#reports" aria-expanded="false" aria-controls="ui-basic">
                        <span class="menu-title">Reports</span>
                        <i class="menu-arrow"></i>
                        <i class="mdi mdi-flag-outline menu-icon"></i>
                    </a>
                    <div class="collapse" id="reports">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="pages/reports/transactionlist.php">Transaction List</a></li>
                            <li class="nav-item"> <a class="nav-link" href="pages/reports/kiosklist.php">KIOSK List</a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#tools" aria-expanded="false" aria-controls="ui-basic">
                        <span class="menu-title">Tools</span>
                        <i class="menu-arrow"></i>
                        <i class="mdi mdi-settings menu-icon"></i>
                    </a>
                    <div class="collapse" id="tools">
                        <ul class="nav flex-column sub-menu">
                            <!-- <li class="nav-item"> <a class="nav-link" href="../tools/manageusers.php">MANAGE USERS</a></li> -->
                            <li class="nav-item"> <a class="nav-link" href="../DMT_Dashboard/SBSR_Dashboard/pages/tools/backup.php">Backup</a></li>
                        </ul>
                    </div>
                </li>


            </ul>
        </nav>
        <form class="form" method="post">
        <div class="input-group">  
            <label class="form-control" style="font-size:20px">Limit Available : ₹<?php echo " 20,000" ?></label><br>
        </div>

        <div class="input-group mb-2">     
            <label for="limit" class="form-control" style="font-weight:bold;font-size:17px">Increase Limit : </label>   
            <input id="limit" name="limit" type="number" class="form-control" placeholder="Increase limit" value = "<?php echo (isset($amount))?$amount:'';?>" style="font-weight:bold">
            <input type="submit" name="amount" class="btn btn-info" style="width:20%" id="btnOtp" value="Get OTP" />
        </div>        
        <div class="otpShow" id="otpShow">
            <div class="input-group mb-2">     
                <label for="submit" class="form-control" style="font-weight:bold;font-size:17px">Enter OTP : </label>   
                <input id="submit" name="otp" type="text" class="form-control" placeholder="OTP" maxlength="4" style="font-weight:bold">
                <input type="submit" name="submit" class="btn btn-info" style="width:20%" id="btnOtpSubmit" value="Submit" />
            </div>
        </div>
        </form>
        
        </body>

<!-- otp model -->
<script>
    
var otpmod = document.getElementById("otpShow");

var btnotp = document.getElementById("btnOtp");

var limit = document.getElementById("limit");

var btnOtpSub = document.getElementById("btnOtpSubmit");

var txtsubmit = document.getElementById("submit");


btnotp.onclick = function() {    
    if(limit.value.length != ""){
    otpmod.style.display = "block";
    btnotp.style.visibility = 'hidden';
    }
    else{
        btnotp.style.visibility = 'visible';
    }
}
btnOtpSub.onclick = function() {        
    if(txtsubmit.value.length === 4){
        modal.style.display = "none";
        otpmod.style.display = "none";
        txtsubmit.value = null;
        limit.value = null;
        btnotp.style.visibility = 'visible';
    }
}


</script>
<!-- otp model end-->

<script>

// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
    debugger;
//   modal.style.display = "block";
location.href='IncreaseLimit.php';
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
  otpmod.style.display = "none";
  txtsubmit.value = null;
  limit.value = null;
  btnotp.style.visibility = 'visible';
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";  
    txtsubmit.value = null;
    limit.value = null;
  }
  
//   function jsFunction(amount)
//     { debugger; var limit = document.getElementById("limit"); limit.value = amount; }
}
</script>
<script type="text/javascript">
function jsFunction(amount){
    { debugger; var limit = document.getElementById("limit"); limit.value = amount; }
}
</script>

<?php

if (isset($_POST['amount'])) {
    $amount = $_POST["limit"];
    // echo "<script>alert('".$amount."')</script>";
    echo '<script type="text/javascript">jsFunction('.$amount.');</script>';

//     echo '<script type="text/javascript">',
//      'jsfunction('".$amount."');',
//      '</script>'
// ;
    // $User_ID = $_SESSION['User_ID'];
    // $User_Mobile = $_SESSION['User_Mobile'];  
    // $mobile = $User_Mobile;
    // $numbers = array($mobile);
    // $ottp = (string)mt_rand(1000,9999);
    // $REF_ID = (string)mt_rand(36523462,99999999);
    // $fourRandomDigit ="OTP : ".$ottp;
    // $uid = 'sbsrkannam';    
    // $pwd =urlencode('9180');    
    // $Peid = '1601100000000016430';    
    // $tempid = '1607100000000145049';    
    // $sender = urlencode('UNIATM');
    // $kkk = 'Dear user, Ref.ID '.$REF_ID.', Thank you for register with UNIPAY KFW. Your credentials are '.$fourRandomDigit.'. - UNIPAY SBSR KANNAM';    
    // $msg = $kkk;    
    // $message = rawurlencode($msg);    
    // $numbers = implode(',', $numbers);    
    // $dtTime = date('m-d-Y h:i:s A');    
    // $data = '&uid=' . $uid . '&pwd='. $pwd . '&mobile=' . $numbers . '&msg=' . $message . '&sid=' .$sender. '&type=0' . '&dtTimeNow=' . $dtTime. '&entityid=' .$Peid. '&tempid=' . $tempid ;    
    // $ch = curl_init('http://smsintegra.com/api/smsapi.aspx?');    
    // curl_setopt($ch, CURLOPT_POST, true);    
    // curl_setopt($ch, CURLOPT_POSTFIELDS, $data);    
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);    
    // $response = curl_exec($ch);    
    // curl_close($ch);
}
?>
