<?php
include_once('../define/define.php');
include_once(login .'connect.php');

if (isset($_REQUEST['user_id']) && $_REQUEST['user_id'] != '') {
    $userID = $_REQUEST['user_id'];
    $sql = "select * from prescription where Id = '" . $userID . "' ";
    $rs = mysqli_query($conn, $sql);
    $numRows = mysqli_num_rows($rs);

    $id = 1;

    if ($numRows == 1) {
        while ($rows = mysqli_fetch_assoc($rs)) {
?>
            <td><?php echo $id++; ?></td>
            <td><input style="width:100px" type="text" name="Name" class="form-control" id="Name" placeholder="Enter name" value="<?php if (isset($_REQUEST['Name'])) {
                                                                                                                                        echo $_REQUEST['Name'];
                                                                                                                                    } else {
                                                                                                                                        echo isset($rows['Name']) ? $rows['Name'] : '';
                                                                                                                                    } ?>"></td>
            <td><input style="width:100px" type="number" name="Age" class="form-control" id="Age" placeholder="Enter Age" value="<?php if (isset($_REQUEST['Age'])) {
                                                                                                                                    echo $_REQUEST['Age'];
                                                                                                                                } else {
                                                                                                                                    echo isset($rows['Age']) ? $rows['Age'] : '';
                                                                                                                                } ?>"></td>
            <td><input style="width:100px" type="tel" class="form-control" name="Mobile" id="Mobile" placeholder="Mobile" value="<?php if (isset($_REQUEST['Mobile'])) {
                                                                                                                                        echo $_REQUEST['Mobile'];
                                                                                                                                    } else {
                                                                                                                                        echo isset($rows['Mobile']) ? $rows['Mobile']  : '';
                                                                                                                                    } ?>"></td>
            <td><input style="width:100px" type="text" class="form-control" name="Symptoms" id="Symptoms" placeholder="Symptoms" value="<?php if (isset($_REQUEST['Symptoms'])) {
                                                                                                                                            echo $_REQUEST['Symptoms'];
                                                                                                                                        } else {
                                                                                                                                            echo isset($rows['Symptoms']) ? $rows['Symptoms']  : '';
                                                                                                                                        } ?>"></td>
            <td><input style="width:100px" style="width:100px" type="text" class="form-control" name="Disease" id="Disease" placeholder="Disease" value="<?php if (isset($_REQUEST['Disease'])) {
                                                                                                                                                                echo $_REQUEST['Disease'];
                                                                                                                                                            } else {
                                                                                                                                                                echo isset($rows['Disease']) ? $rows['Disease'] : '';
                                                                                                                                                            } ?>"></td>
            <td><input style="width:100px" type="text" class="form-control" name="Prescription" id="Prescription" placeholder="Prescription" value="<?php if (isset($_REQUEST['Prescription'])) {
                                                                                                                                                        echo $_REQUEST['Prescription'];
                                                                                                                                                    } else {
                                                                                                                                                        echo isset($rows['Prescription']) ? $rows['Prescription']  : '';
                                                                                                                                                    } ?>"></td>

            <?php
            if ($rows['Tests'] == 0) {
            ?>
                <td>No Tests Required</td>
            <?php
            } else {
            ?>
                <td><select style="width:100px" id="Tests" name="Tests">
                        <option value="">Select one</option>
                        <?php $qu = "SELECT * FROM tests Where c_id='$rows[Tests]'  ";
                        $re = $conn->query($qu);
                        $ro = mysqli_fetch_assoc($re);
                        $q = "SELECT * FROM tests   ";
                        $r = $conn->query($q);
                        while ($row = mysqli_fetch_assoc($r)) {
                        ?>


                            <option value="<?php echo $row['Id']; ?>" <?php if (isset($_REQUEST['Tests']) && $_REQUEST['Tests'] ==  $row['c_name']) {
                                                                            echo "selected";
                                                                        } else {
                                                                            if (isset($rows['Tests']) && $rows['Tests'] == $row['Id']) echo "selected";
                                                                        } ?>><?php echo $row['c_name']; ?></option>
                    <?php }
                    } ?>

                    </select></td>






                <td><button style="background-color:#28a745;color:white" name="submit" onclick="savedata(<?php echo $rows['Id']; ?>);"><i class="fas fa-save"></i>Save</button> <button style="background-color:red;color:white;" onclick="canceldata(<?php echo $rows['Id']; ?>);"><i class="fas fa-trash"></i>Cancel</button></td>

    <?php

        }
    }
}
    ?>
    <script>
        function savedata(id) {



            var name = $('#Name').val();
           
            var age  = $('#Age').val();
         
            var mob = $('#Mobile').val();
            var sym = $('#Symptoms').val();
         
            var dis = $('#Disease').val();
   
            var pres = $('#Prescription').val();
            var test = $('#Tests').val();

            $.ajax({
                url: 'save.php',
                method: 'post',
                data: {
                    name: name,
                    age: age,
                    mob: mob,
                    sym:sym ,
                    dis: dis,
                    pres: pres,
                    test: test,
                    id: id

                },

                success: function(returnData) {



                    $("#body_" + id).html(returnData);
                },

            });



        }




        function canceldata(id) {


            var name = $('#Name').val();
           
           var age  = $('#Age').val();
        
           var mob = $('#Mobile').val();
           var sym = $('#Symptoms').val();
        
           var dis = $('#Disease').val();

           var pres = $('#Prescription').val();
           var test = $('#Tests').val();

            $.ajax({
                url: 'can.php',
                method: 'post',
                data: {
                    name: name,
                    age: age,
                    mob: mob,
                    sym:sym ,
                    dis: dis,
                    pres: pres,
                    test: test,
                    id: id

                },

                success: function(returnData) {



                    $("#body_" + id).html(returnData);
                },

            });



        }
    </script>