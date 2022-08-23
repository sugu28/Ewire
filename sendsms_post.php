
<?php
// include 'addDistributors';
include 'dashboard.php';
// include 'addMasterDistributor.php';

$mobile = $_GET['mobile'];
$type = $_GET['type'];

// echo "<script>alert ('sendsms_post.php?mobile=" . $mobile ."&type=OTP')</script>";
// echo "<script>alert ('sendsms_post.php?mobile=" . $type ."&type=OTP')</script>";

// if(isset($_GET['type']))
// {
//     $type = $_GET['type'];
    
// }
// else
// {
//     $type = "";
// }

// if(isset($_GET['mobile']))
// {
//     echo "<script>alert ('sendsms_post.php?mobile=INNNN&type=OTP')</script>";
//     $mobile = $_GET['mobile'];
// }
// else
// {
//     $mobile = "";
// }

if($type == "OTP")
{
    // echo "<script>alert ('sendsms_post.php?mobile=in otp " . $mobile ."" . $type ."&type=OTP')</script>";
    $numbers = array('8637472682');

    $fourRandomDigit ="OTP : "+ rand(1000,9999);

    sendSMS($numbers,'Dear User, Ref.ID 123, Thank you for register with Unipay. Your credentials are 987654321. -UNIPAY SBSR KANNAM');
    // $msg = 'Dear User, Ref.ID 123, Thank you for register with Unipay. Your credentials are 987654321. -UNIPAY SBSR KANNAM';
    // $msg = '	Dear {#var#}, Ref.ID {#var#}, Thank you for register with {#var#}{#var#}. Your credentials are {#var#}{#var#}. -UNIPAY SBSR KANNAM';
    
    //function to send API request to smsintegra

    function sendSMS($numbers, $msg) {

    $uid = 'sbsrkannam';

    $pwd = urlencode('9180');

    $Peid = '1601100000000016430';

    $tempid = '1607100000000145054';

    $sender = urlencode('UNIATM');

    $msg = 'Dear User, Ref.ID 123, Thank you for register with Unipay. Your credentials are 987654321. -UNIPAY SBSR KANNAM';
    // $msg = 'Dear Ramesh, You are a registered remitter of UNIPAY OTP : 2845, with BCID 94873939485, Kiosk ID Kiosk0002. -UNIPAY. SBSR KANNAM';
    // $msg = 'Dear User, Ref.ID 2845, Thank you for register with Unipay. Your credentials are OTP: 2845. -UNIPAY SBSR KANNAM';
    // $msg = '	Dear {#var#}, Ref.ID {#var#}, Thank you for register with {#var#}{#var#}. Your credentials are {#var#}{#var#}. -UNIPAY SBSR KANNAM';

    $message = rawurlencode($msg);

    $numbers = implode(',', $numbers);

    $dtTime = date('m-d-Y h:i:s A');

    $data = '&uid=' . $uid . '&pwd='. $pwd . '&mobile=' . $numbers . '&msg=' . $message . '&sid=' .$sender. '&type=0' . '&dtTimeNow=' . $dtTime. '&entityid=' .$Peid. '&tempid=' . $tempid ;

    $ch = curl_init('http://smsintegra.com/api/smsapi.aspx?');

    curl_setopt($ch, CURLOPT_POST, true);

    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    echo $response;

    curl_close($ch);

    return $response;
    }
}

if($type == "Register")
{

}

?>