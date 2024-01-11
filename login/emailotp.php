<?php
include_once('connect.php');
$email=$_POST['email'];
$pass=$_POST['pass'];
$err = array();


if (empty($email)) {
  $err['emerror'] = "Email is Required";
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $err['emerror'] = "Invalid email format";
}
if (empty($pass)) {
  $err['passerror'] = "Password is Required";
}

    $password = md5($pass);
    $log = mysqli_query($conn, "select * from user_data where  Email='$email' AND Password = '" . $password . "' ");
    if (mysqli_num_rows($log) == 1) {
      $row = mysqli_fetch_assoc($log);
     }
      else{
        $err['passerror'] = "Password does not match";
      }


require "../PHPMailer-master/PHPMailer-master/src/PHPMailer.php";
require "../PHPMailer-master/PHPMailer-master/src/SMTP.php";
require "../PHPMailer-master/PHPMailer-master/src/Exception.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

if (empty($err)) {
  
if (isset($_POST['email'])) {

    $email=$_POST['email'];
    $otp=rand(100000,999999); 
   
} 
function sendmail($send_to,$otp,$name)
{$mail=new PHPMailer(TRUE);
    $mail->isSMTP();
    $mail->SMTPAuth=true;
    $mail->SMTPSecure="tls";
    $mail->Host="smtp.gmail.com";
    $mail->SMTPSecure=PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port=25;
    $mail->Username="malviyanancy23@gmail.com";
    $mail->Password="uidb ymrg gmvu ebea";
    $mail->setFrom("malviyanancy23@gmail.com","Nancy Malviya");
    $mail->addAddress($send_to);
    $mail->Subject="Account activation";
    $mail->isHTML(true);
    $mail->Body = '<div style="width:60%; margin:auto; text-align:center;">
    <div style="background-color:#000;color:white; padding:10px; margin:20px 0;">Your Verification Email Otp</div>

    <div style="margin:20px 0;"><span style="background-color:blue; color:#FFF; padding: 15px 45px; border-radius:10px; display:inline-block;">' . $otp . '</span></div>
   
    <div style="background-color:#000;color:white; padding:10px; margin:20px 0;">Please use the above OTP to login.</div>
</div>';
    $mail->send();


}
sendmail($email,$otp,"nancy");

$log = mysqli_query($conn, "select * from user_data where  Email='$email' AND Password = '" . $password . "' ");

  $row = mysqli_fetch_assoc($log);

$q = "UPDATE user_data
SET otp='$otp'

 WHERE Id='$row[Id]'";
      

      $exe = mysqli_query($conn, $q);




      if ( $exe) {
     

      }
      echo json_encode(['status' => 'success']);
}

  
else {
 
    echo json_encode(['status' => 'error', 'errors' => $err]);
}
  
?>






