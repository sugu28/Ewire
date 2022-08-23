<?php

$mobile = $_GET['mobile'];
$type = $_GET['type'];

if($type == "OTP")
{
$numbers = array($mobile);
// echo "<script>alert ('".$kkk."')</script>";

$ottp = (string)mt_rand(1000,9999);
$REF_ID = (string)mt_rand(36523462,99999999);
$fourRandomDigit ="OTP : ".$ottp;
// $kkk1 = 'Dear User, Ref.ID {#var#}, Thank you for register with {#var#}{#var#}. Your credentials are {#var#}{#var#}. -UNIPAY SBSR KANNAM';
$kkk1 = 'Dear user, Ref.ID '.$REF_ID.', Thank you for register with UNIPAY KFW. Your credentials are '.$fourRandomDigit.'. - UNIPAY KFW';
sendSMS($numbers,$kkk1);
// $msg = '	Dear {#var#}, Ref.ID {#var#}, Thank you for register with {#var#}{#var#}. Your credentials are {#var#}{#var#}. -UNIPAY SBSR KANNAM';
//function to send API request to smsintegra

}

function sendSMS($numbers, $msg) {

// echo "<script>alert ('".$msg."')</script>";
    $uid = 'sbsrkannam';
    
    $pwd =urlencode('9180');
    
    $Peid = '1601100000000016430';
    
    $tempid = '1607100000000145049';
    
    $sender = urlencode('UNIATM');
    
    $ottp = (string)mt_rand(1000,9999);
    $REF_ID = (string)mt_rand(194839,999999);
    $fourRandomDigit ="OTP : ".$ottp;
    $kkk = 'Dear user, Ref.ID '.$REF_ID.', Thank you for register with UNIPAY KFW. Your credentials are '.$fourRandomDigit.'. - UNIPAY SBSR KANNAM';
    // $kkk = "Dear User, Ref.ID".$ottp.", Thank you for register with Unipay. Your credentials are ".$fourRandomDigit.". - UNIPAY KFW";
    
    $msg = $kkk; //'Dear User, Ref.ID '.$ottp.', Thank you for register with Unipay. Your credentials are '.$fourRandomDigit.'. - UNIPAY KFW'; //$kkk; //'Dear User, Ref.ID 123123, Thank you for register with Unipay. Your credentials are '.$fourRandomDigit.'. -UNIPAY SBSR KANNAM';
    
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
    
    echo "<script> alert ('".$response."'); </script>";
    echo "<script> location.href='../../dashboard.php=" . $response ."'; </script>";
    }
?>