 <?php
include_once('../define/define.php');
include_once(login .'connect.php');

    if (isset($_POST['status']) && $_POST['status'] != '') {
        $countryID = $_POST['status'];



        $sql = "select * from brand_details where b_status = '" . $countryID . "' order by b_name ASC";
        $rs = mysqli_query($conn, $sql);
        $numRows = mysqli_num_rows($rs);

        if ($numRows == 0) {
        } else {
            $query = "SELECT * FROM brand_details ";
            $result = $conn->query($query);
    ?>

         <table id="example1" class="table table-bordered table-striped">
             <thead>
                 <tr>
                     <th>S.No.</th>
                     <th>Brand Name</th>

                     <th>Brand Status</th>
                     <th>Total Product</th>
                     <th>Action</th>
                 </tr>
             </thead>
             <tbody>



                 <?php
                 $id=1;
                    while ($rows = $result->fetch_assoc()) {


                        while ($status = mysqli_fetch_assoc($rs)) {
                            $n = $status['b_name'];
                            $t = $status['total_brand'];
                         
                            echo '<tr class="success"><td>' . $id++ . '</td><td>' . $status['b_name'] . '</td>';
                    ?>

                         <td> <button class="<?php echo $rows['b_status'] == 'Available' ? 'btn btn-success' : 'btn btn-danger'; ?> status-button" id="status_<?php echo $rows['Id']; ?>" data-user-id="<?php echo $rows['Id']; ?>" data-status="<?php echo $rows['b_status']; ?>" value="<?php echo $rows['b_status'] == 'Available' ? 'Available' : 'Unavailable'; ?>" onclick="colorchange(<?php echo $rows['Id'] ?>);">
                                                            <?php echo $rows['b_status'] == 'Available' ? 'Available' : 'Unavailable';  ?>
                                                        </button></td>
                             <td><?php echo $status['total_brand']; ?></td>
                             <td id="editdel_<?php echo $rows['Id']; ?>"><button id="edit_<?php echo $rows['Id']; ?>" value="<?php echo $rows['Id']; ?>" onclick="changedata(<?php echo $rows['Id']; ?>);">Edit</button> <button onclick=" return condelete()"><a href="delbrand.php?Id=<?php echo $rows['Id']; ?>">Delete</a></button></td>
                         </tr>
                         </tr>

                 <?php
                        }
                    }
                    ?>
             </tbody>
             <tfoot>
             <tr>
                                                <th>S.No.</th>
                                                <th>Brand Name</th>

                                                <th>Brand Status</th>
                                                <th>Total Product</th>
                                                <th>Action</th>
                                            </tr>
             </tfoot>
         </table>

 <?php





        }
    }

    ?>