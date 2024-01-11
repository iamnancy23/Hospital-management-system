<?php
include_once('../define/define.php');
include_once(login .'connect.php');

if (isset($_REQUEST['id'])) {
    $userid = $_REQUEST['id'];
    // Retrieve and sanitize the data sent via AJAX
    $name = $_REQUEST['name'];

    $mobile = $_REQUEST['mob'];
    $add = $_REQUEST['add'];
    $email = $_REQUEST['email'];

    $gen = $_REQUEST['gen'];




    $sql = "select * from user_data where Id = '" . $userid . "' ";
    $rs = mysqli_query($conn, $sql);
    $numRows = mysqli_num_rows($rs);
    if ($numRows == 1) {
        while ($rows = mysqli_fetch_assoc($rs)) {
?>
            <td><?php echo  $rows['Name']; ?> </td>

            <td><?php echo  $rows['Email'];  ?></td>
            <td><?php echo  $rows['Mobile'];  ?> </td>
            <td><?php echo  $rows['Whatsapp'];  ?> </td>
            <td><?php echo $rows['Address'];  ?> </td>
            <td><?php echo $rows['Gender'];  ?> </td>

            <td><button class="<?php echo $rows['Status'] == '1' ? 'btn btn-success' : 'btn btn-danger'; ?> status-button" id="status_<?php echo $rows['Id']; ?>" data-user-id="<?php echo $rows['Id']; ?>" data-status="<?php echo $rows['Status']; ?>" value="<?php echo $rows['Status'] == '1' ? 'Activate' : 'Deactivate'; ?>" onclick="colorchange(<?php echo $rows['Id'] ?>);">
                              <?php echo $rows['Status'] == '1' ? 'Activate' : 'Deactivate';  ?>
                            </button></td>
                <td id="editdel_<?php echo $rows['Id']; ?>"><button style="background-color:dodgerblue;color:white" id="edit_<?php echo $rows['Id']; ?>" value="<?php echo $rows['Id']; ?>" onclick="changedata(<?php echo $rows['Id']; ?>);"><i class="fas fa-pencil-alt"></i>Edit</button> <button style="background-color:red;color:white;" onclick=" return condelete()"><a style="color:aliceblue" href="deletedata.php?Id=<?php echo $rows['Id']; ?>"><i class="fas fa-trash">
                                                                </i>Delete</a></button></td>
<?php

        }
    }
}

?>