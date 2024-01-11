<?php
include_once('../define/define.php');
include_once(login .'connect.php');
$id=$_GET['Id'];
$sql = "DELETE  FROM user_data WHERE Id='$id' ";
$rs = mysqli_query($conn,$sql);
header('location:data.php');
exit();

?>