<?php
include_once('../define/define.php');
include_once(login .'connect.php');
if (!isset($_SESSION['login'])) {
  header("location:".login."login.php");
  exit();
}

if (isset($_REQUEST['id'])) {

   
    $id=$_REQUEST['id'];
    // Retrieve and sanitize the data sent via AJAX
    $patval = $_REQUEST['patval'];
   
  
  


    $sql = "INSERT INTO patvalue (category,pat_val,data_id) VALUES ('$_REQUEST[id]','$_REQUEST[patval]','$_SESSION[data]')";
    if ($conn->query($sql)) {
        echo "inserted";
    
    }


}

?>