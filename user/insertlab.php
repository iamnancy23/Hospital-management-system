




<?php
include_once('../define/define.php');
include_once(login .'connect.php');
if (!isset($_SESSION['login'])) {
  header("location:".login."login.php");
  exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 
    $dataToSubmit = $_REQUEST['data'];
    $name=$_REQUEST['name'];
    $sql = "select * from labinvoice Where p_name='$name'";
    $rs = mysqli_query($conn, $sql);
    $ro = mysqli_fetch_assoc($rs);

    // Insert the data into the database
    foreach ($dataToSubmit as $row) {
        $kitId = $row['kitId'];
        $kitUsed = $row['kitUsed'];
        $kitname = $row['kitname'];
        $sql = "INSERT INTO labkitrecord (childcat,kitused,kitname,user_id) VALUES ('$kitId','$kitUsed','$kitname','$ro[Id]')";
   
        if ($conn->query($sql)) {
        
           

        }}


    echo 'Data submitted successfully!';
    
}
?>
