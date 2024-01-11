<?php
include_once('../define/define.php');
include_once(login .'connect.php');

if (isset($_REQUEST['id'])) {
    $userid = $_REQUEST['id'];
    // Retrieve and sanitize the data sent via AJAX
    $name = $_REQUEST['name'];

    $val = $_REQUEST['val'];



    $id = 1;

    $sql = "select * from brand_details where Id = '" . $userid . "' ";
    $rs = mysqli_query($conn, $sql);
    $numRows = mysqli_num_rows($rs);
    if ($numRows == 1) {
        while ($rows = mysqli_fetch_assoc($rs)) {
?>
            <td><?php echo $id++;  ?></td>
            <td><?php echo  $rows['b_name']; ?> </td>
            <td><?php echo  $rows['k_name']; ?> </td>


            <td> <button class="<?php echo $rows['b_status'] == 'Available' ? 'btn btn-success' : 'btn btn-danger'; ?> status-button" id="status_<?php echo $rows['Id']; ?>" data-user-id="<?php echo $rows['Id']; ?>" data-status="<?php echo $rows['b_status']; ?>" value="<?php echo $rows['b_status'] == 'Available' ? 'Available' : 'Unavailable'; ?>" onclick="colorchange(<?php echo $rows['Id'] ?>);">
                    <?php echo $rows['b_status'] == 'Available' ? 'Available' : 'Unavailable';  ?>
                </button></td>
            <td><?php echo $rows['total_kit'];  ?> </td>
            <?php
            $sum = 0;
            $que = "SELECT * FROM patvalue where category=$rows[childcategory]  ";

            $resu = $conn->query($que);
            while ($r = $resu->fetch_assoc()) {

                $sum++;
            }

            ?>
                   
            <td><?php echo $sum; ?></td>
            <?php
            $que = "SELECT * FROM tests where Id=$rows[category]  ";
            $resu = $conn->query($que);
            $r = $resu->fetch_assoc();
            ?>
            <td><?php echo $r['c_name']; ?></td>
            <?php
            $que = "SELECT * FROM tests where Id=$rows[subcategory]  ";
            $resu = $conn->query($que);
            $r = $resu->fetch_assoc();
            ?>
            <td><?php echo $r['c_name']; ?></td>
            <?php
            $que = "SELECT * FROM tests where Id=$rows[childcategory]  ";
            $resu = $conn->query($que);
            $r = $resu->fetch_assoc();
            ?>
            <td><?php echo $r['c_name']; ?></td>
            <td id="editdel_<?php echo $rows['Id']; ?>"><button style="background-color:dodgerblue;color:white" id="edit_<?php echo $rows['Id']; ?>" value="<?php echo $rows['Id']; ?>" onclick="changedata(<?php echo $rows['Id']; ?>);"> <i class="fas fa-pencil-alt">
                    </i>Edit</button> <button style="background-color:red;color:white;" onclick=" return condelete()"><a style="color:aliceblue" href="delbrand.php?Id=<?php echo $rows['Id']; ?>"> <i class="fas fa-trash">
                        </i>Delete</a></button></td>
<?php

        }
    }
}

?>