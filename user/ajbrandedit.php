<?php
include_once('../define/define.php');
include_once(login .'connect.php');

if (isset($_REQUEST['user_id']) && $_REQUEST['user_id'] != '') {
    $userID = $_REQUEST['user_id'];
    $sql = "select * from brand_details where Id = '" . $userID . "' ";
    $rs = mysqli_query($conn, $sql);
    $numRows = mysqli_num_rows($rs);

    $id = 1;

    if ($numRows == 1) {
        while ($rows = mysqli_fetch_assoc($rs)) {
?>
            <td><?php echo  $id++; ?></td>

            <td><input type="text" name="Name" class="form-control" id="Name" placeholder="Enter name" value="<?php if (isset($_REQUEST['Name'])) {
                                                                                                                    echo $_REQUEST['Name'];
                                                                                                                } else {
                                                                                                                    echo isset($rows['b_name']) ? $rows['b_name'] : '';
                                                                                                                } ?>"></td>
            <td><input type="text" name="KName" class="form-control" id="KName" placeholder="Enter name" value="<?php if (isset($_REQUEST['KName'])) {
                                                                                                                    echo $_REQUEST['KName'];
                                                                                                                } else {
                                                                                                                    echo isset($rows['k_name']) ? $rows['k_name'] : '';
                                                                                                                } ?>"></td>




            <td> <button class="<?php echo $rows['b_status'] == 'Available' ? 'btn btn-success' : 'btn btn-danger'; ?> status-button" id="status_<?php echo $rows['Id']; ?>" data-user-id="<?php echo $rows['Id']; ?>" data-status="<?php echo $rows['b_status']; ?>" value="<?php echo $rows['b_status'] == 'Available' ? 'Available' : 'Unavailable'; ?>" onclick="colorchange(<?php echo $rows['Id'] ?>);">
                    <?php echo $rows['b_status'] == 'Available' ? 'Available' : 'Unavailable';  ?>
                </button></td>
            <td><input type="number" name="Total" class="form-control" id="Total" placeholder="Enter Value" value="<?php if (isset($_REQUEST['Total'])) {
                                                                                                                        echo $_REQUEST['Total'];
                                                                                                                    } else {
                                                                                                                        echo isset($rows['total_kit']) ? $rows['total_kit'] : '';
                                                                                                                    } ?>"></td>
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
            $sql = "select * from tests Where c_id=0  order by c_name ASC";
            $rs = mysqli_query($conn, $sql); ?>

            <td><select style="width:200px" class="form-control" id="category" name="category">
                    <option value="">Select one</option>
                    <?php
                    while ($state = mysqli_fetch_assoc($rs)) { ?>


                        <option value="<?php echo $state['Id']; ?>" <?php if (isset($_REQUEST['category']) && $_REQUEST['category'] == $state['Id']) echo "selected";
                                                                    else {
                                                                        if (isset($rows['category']) && $rows['category'] == $state['Id']) {
                                                                            echo "selected";
                                                                        } else {
                                                                            echo  '';
                                                                        }
                                                                    } ?>><?php echo $state['c_name']; ?></option>
                    <?php } ?>

                </select></td>
            <?php
            $s = "select * from tests Where c_id=$rows[category]  order by c_name ASC";
            $r = mysqli_query($conn, $s);
            ?>

            <td><select style="width:200px" class="form-control" id="subcategory" name="subcategory">
                    <option value="">Select one</option>
                    <?php
                    while ($st = mysqli_fetch_assoc($r)) { ?>


                        <option value="<?php echo $st['Id']; ?>" <?php if (isset($_REQUEST['subcategory']) && $_REQUEST['subcategory'] == $st['Id']) echo "selected";
                                                                    else {
                                                                        if (isset($rows['subcategory']) && $rows['subcategory'] == $st['Id']) {
                                                                            echo "selected";
                                                                        } else {
                                                                            echo  '';
                                                                        }
                                                                    } ?>><?php echo $st['c_name']; ?></option>
                    <?php } ?>


                </select></td>
            <?php
            $sq = "select * from tests Where c_id=$rows[subcategory]  order by c_name ASC";
            $rq = mysqli_query($conn, $sq);
            ?>
            <td><select style="width:200px" class="form-control" id="childcategory" name="childcategory">
                    <option value="">Select one</option>
                    <?php
                    while ($stq = mysqli_fetch_assoc($rq)) { ?>


                        <option value="<?php echo $stq['Id']; ?>" <?php if (isset($_REQUEST['childcategory']) && $_REQUEST['childcategory'] == $stq['Id']) echo "selected";
                                                                    else {
                                                                        if (isset($rows['childcategory']) && $rows['childcategory'] == $stq['Id']) {
                                                                            echo "selected";
                                                                        } else {
                                                                            echo  '';
                                                                        }
                                                                    } ?>><?php echo $stq['c_name']; ?></option>
                    <?php } ?>


                </select></td>

            <td><button style="background-color:#28a745;color:white" name="submit" onclick="savedata(<?php echo $rows['Id']; ?>);"><i class="fas fa-save"></i>Save</button> <button style="background-color:red;color:white;" onclick="canceldata(<?php echo $rows['Id']; ?>);"><i class="fas fa-trash">
                    </i>Cancel</button></td>

<?php

        }
    }
}
?>
<script>
    function savedata(id) {
       




        var name = $('#Name').val();
        console.log(name);
        var val = $('#Total').val();
        var kname = $('#KName').val();
        var cat = $('#category').val();
        var subcat = $('#subcategory').val();
        var childcat = $('#childcategory').val();



        $.ajax({
            url: 'updatebrand.php',
            method: 'post',
            data: {
                name: name,
                val: val,
                kname: kname,
                cat: cat,
                subcat: subcat,
                childcat: childcat,


                id: id

            },

            success: function(returnData) {



                $("#body_" + id).html(returnData);
            },

        });



    }




    function canceldata(id) {



        var name = $('#Name').val();
        console.log(name);
        var val = $('#Total').val();
        console.log(val);


        $.ajax({
            url: 'cancelbrand.php',
            method: 'post',
            data: {
                name: name,
                val: val,

                id: id

            },

            success: function(returnData) {



                $("#body_" + id).html(returnData);
            },

        });



    }
</script>
<script>
    $(document).ready(function() {

        changesubcategory();

    });

    function changesubcategory() {
        $("#category").change(function() {
            $("#subcategory").html('<option value="">select Category</option>');
            $("#childcategory").html('<option value="">select Category</option>');

            var getsubID = $(this).val();

            if (getsubID != '') {


                $.ajax({
                    type: 'post',
                    data: {
                        S_id: getsubID
                    },
                    url: 'editbrand.php',
                    success: function(returnData) {

                        $("#subcategory").html(returnData);
                    }
                });
            } else {
                $("#subcategory").html('<option value="">select Category</option>');
            }

        })
    }
</script>