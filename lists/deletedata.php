<?php
include_once('../define/define.php');
include_once(login .'connect.php');
$id=$_GET['Id'];
$sql = "DELETE  FROM doctor_data WHERE Id='$id' ";
$rs = mysqli_query($conn,$sql);
$userid=$_GET['UserId'];
$sq = "DELETE  FROM user_data WHERE Id='$userid' ";
$r = mysqli_query($conn,$sq);

header('location:doctorlist.php');
exit();

?>