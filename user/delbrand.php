<?php
include_once('../define/define.php');
include_once(login .'connect.php');
$id=$_GET['Id'];
$sql = "DELETE  FROM brand_details WHERE Id='$id' ";
$rs = mysqli_query($conn,$sql);
header('location:productlist.php');
exit();

?>