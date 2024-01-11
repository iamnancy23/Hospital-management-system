<?php
include_once('connect.php');
$email = $_POST['email'];
$otp = $_POST['otp'];
$err = array();


if (empty($otp)) {
    $err['otperror'] = "Otp is Required";
}




$log = mysqli_query($conn, "select * from user_data where  Email='$email' AND otp= '" . $otp . "' ");
if (mysqli_num_rows($log) == 1) {
    $row = mysqli_fetch_assoc($log);
} else {
    $err['otperror'] = "Otp does not match";
}



$logs = mysqli_query($conn, "select * from user_data where  Email='$email' ");

$rows = mysqli_fetch_assoc($logs);
if (mysqli_num_rows($logs) == 1) {
    if ($rows['Status'] == 0) {
        $err['userstatus'] = "User Inactive";
    }}




if (empty($err)) {
 




   




        
                session_destroy();
                session_start();
                $_SESSION['user'] = $row["Name"];
                $_SESSION['Id']=$row['Id'];

                $_SESSION['inc_num'] = 1;

                $_SESSION['login'] = "open";
                $_SESSION['data']=rand(1,100);


             
                echo json_encode(['status' => 'success']);
            }
        
  else {

    echo json_encode(['status' => 'error', 'errors' => $err]);
}
