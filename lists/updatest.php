

<?php
include_once('../define/define.php');
include_once(login .'connect.php');

if (isset($_POST['userId']) && isset($_POST['status'])) {
    $userId = $_POST['userId'];
    $newStatus = $_POST['status'];
  

   
    $updateQuery = "UPDATE book_slot SET Status='$newStatus' WHERE Id='$userId'";
    if ($conn->query($updateQuery) === TRUE) {
        echo "Status updated successfully";
    } else {
        echo "Error updating status: " . $conn->error;
    }
} else {
    echo "Invalid request";
}
?>