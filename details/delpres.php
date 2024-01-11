<?php
include_once('../define/define.php');
include_once('../login/connect.php');
$id=$_GET['Id'];
$sql = "DELETE  FROM prescription WHERE Id='$id' ";
$rs = mysqli_query($conn,$sql);
header("location:".details."patientprescription.php");
exit();

?>