<?php
include_once('../define/define.php');
include_once(login .'connect.php');
$id=$_GET['Id'];
$sql = "DELETE  FROM book_slot WHERE Id='$id' ";
$rs = mysqli_query($conn,$sql);
header('location:patientlist.php');
exit();

?>