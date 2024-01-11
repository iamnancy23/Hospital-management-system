<?php
include_once('../define/define.php');
include_once(login .'connect.php');
if (!isset($_SESSION['login'])) {
  header("location:".login."login.php");
  exit();
}




if (isset($_REQUEST['submit'])) {
    $name = $_REQUEST['Name'];
    $email = $_REQUEST['Email'];
    $mob = $_REQUEST['Mobile'];
    $add = $_REQUEST['Address'];
    $gen = $_REQUEST['Gender'];
    print_r($_REQUEST);



    if (empty($name)  || trim($name) === '') {
        $err['nerror'] = "Name is Required";
    } else if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
        $err['nerror'] = "Only alphabets and white space are allowed";
    }



    if (empty($mob)) {
        $err['moberror'] = "Number is Required";
    } else if (!preg_match('/^[0-9]{10}+$/', $mob)) {
        $err['moberror'] = "Invalid Number Format";
    }

    if (empty($add)) {
        $err['a1error'] = "Address is Required";
    }
    if (empty($email)) {
        $err['emerror'] = "Email is Required";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $err['emerror'] = "Invalid email format";
    }

    if (empty($gen)) {
        $err['generror'] = "Gender is required";
    }

    $duplicate = mysqli_query($conn, "select * from user_data where  Email='$email'");
    if (mysqli_num_rows($duplicate) > 0) {
        $err['emerror'] = "Email already exists";
    }





    if (empty($err)) {


        $sql = "INSERT INTO user_data (Name,Email,Mobile,Address,Gender) VALUES ('$_REQUEST[Name]','$_REQUEST[Email]', '$_REQUEST[Mobile]','$_REQUEST[Address]',' $_REQUEST[Gender]')";
        if ($conn->query($sql)) {

            $_REQUEST['Name'] = '';
            $_REQUEST['Email'] = '';
            $_REQUEST['Mobile'] = '';
            $_REQUEST['Address'] = '';
            $_REQUEST['Gender'] = '';
        } else if ($conn->errno) {
            echo "Could not insert record into table: %s<br />", $mysqli->error;
        }
    }
}

?>
<?php
$title="Product List";
include_once(nav.'header.php');
?>






<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <?php
        include_once(nav.'rightnav.php');
        include_once(nav.'leftnav.php');
        ?>


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Inventory Details</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?php echo login; ?>index3.php">Home</a></li>
                                <li class="breadcrumb-item active">Inventory Details</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>


            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Inventory Details</h3>
                                </div>

                                <!-- /.card-header -->
                                <!-- form start -->
                                <!--  -->


                                <?php
                                $id = 1;
                                $query = "SELECT * FROM brand_details  ";
                                $result = $conn->query($query);
                                ?>

                                <!-- /.card-header -->
                                <div class="card-body">
                                    <!-- <div class="btn-group">
                                        <select id="status">
                                            <option value="select status">select status</option>
                                            <option value="Available" id="Available">Available</option>
                                            <option value="Unavailable" id="Unavailable">Unavailable</option>



                                        </select>


                                    </div> -->


                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>S.No.</th>
                                                <th>Brand Name</th>
                                                <th>Kit Name</th>

                                                <th>Kit Status</th>
                                                <th>Total Kit</th>
                                                <th>Used Kit</th>
                                                <th>Category</th>
                                                <th>Sub Category</th>
                                                <th>Child Category</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php



                                            while ($rows = $result->fetch_assoc()) {





                                            ?>


                                                <tr id="body_<?php echo $rows['Id']; ?>">
                                                    <td><?php echo $id++; ?></td>
                                                    <td> <?php echo $rows['b_name']; ?></td>
                                                    <td> <?php echo $rows['k_name']; ?></td>


                                                    <td> <button class="<?php echo $rows['b_status'] == 'Available' ? 'btn btn-success' : 'btn btn-danger'; ?> status-button" id="status_<?php echo $rows['Id']; ?>" data-user-id="<?php echo $rows['Id']; ?>" data-status="<?php echo $rows['b_status']; ?>" value="<?php echo $rows['b_status'] == 'Available' ? 'Available' : 'Unavailable'; ?>" >
                                                            <?php echo $rows['b_status'] == 'Available' ? 'Available' : 'Unavailable';  ?>
                                                        </button></td>
                                                    <td><?php echo $rows['total_kit']; ?></td>
                                                    <?php
                                                    $sum = 0;
                                                    $que = "SELECT * FROM patvalue where category=$rows[childcategory]  ";

                                                    $resu = $conn->query($que);
                                                    while ($r = $resu->fetch_assoc()) {

                                                        $sum++;
                                                    }

                                                    ?>
                                                    <td><?php echo $sum; ?></td>
                                                    <?php $av = $rows['total_kit'] - $sum;
                                               
                                                    if ($av != 0) {
                                                        $sql = "UPDATE brand_details SET b_status='Available' WHERE Id=$rows[Id]";

                                                        if ($conn->query($sql)) {
                                                       
                                                        }
                                                    }
                                                    else{
                                                        $sql = "UPDATE brand_details SET b_status='Unavailable' WHERE Id=$rows[Id]";

                                                        if ($conn->query($sql)) {
                                                     
                                                        }

                                                    } ?>
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
                                                </tr>
                                            <?php

                                                if (isset($_REQUEST['status_check'])) {
                                                }



                                                if (isset($_REQUEST['toggle'])) {

                                                    $val = $_REQUEST['toggle'];
                                                    $q = "SELECT Id FROM user_data WHERE Id='$rows[Id]'";
                                                    $res = $conn->query($q);
                                                    if (mysqli_num_rows($res) > 0) {
                                                        if ($val == 'Activate') {
                                                            $qu = "UPDATE user_data SET Status='1' Where Id='$rows[Id]'";
                                                        } else {
                                                            $qu = "UPDATE user_data SET Status='0' Where Id='$rows[Id]'";
                                                        }
                                                        if ($conn->query($qu)) {
                                                            echo "done";
                                                        } else {
                                                            echo "Error updating record: " . $conn->error;
                                                        }
                                                    }
                                                }
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>S.No.</th>
                                                <th>Brand Name</th>
                                                <th>Kit Name</th>

                                                <th>Kit Status</th>
                                                <th>Total Kit</th>
                                                <th>Used Kit</th>
                                                <th>Category</th>
                                                <th>Sub Category</th>
                                                <th>Child Category</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <?php include_once(nav.'footer.php');
        ?>
   
    <script>
        function constatus() {


            var agree = confirm("Are you sure?");
            if (agree == true) {
                return true;
            } else {
                return false;
            }

        }

    



        $(document).ready(function() {
            selectstatus();


        });

        function selectstatus() {
            $("#status").change(function() {

                var status = $(this).val();
                alert(status);
                console.log(status);



                if (status == 'select status') {
                    void(0);
                } else {



                    $.ajax({
                        type: 'post',
                        data: {
                            status: status
                        },
                        url: 'ajax_requestbrand.php',
                        success: function(returnData) {
                            var $tr = $('<tr/>');
                            $tr.append($('<td/>').html(returnData.n));
                            $tr.append($('<td/>').html(returnData.t));
                            $tr.append($('<td/>').html(returnData.m));
                            $tr.append($('<td/>').html(returnData.m));
                            $tr.append($('<td/>').html(returnData.a));
                            $tr.append($('<td/>').html(returnData.g));
                            $('.table tr:last').before($tr);



                            $("#example1").html(returnData);
                        }
                    });
                }


            })
        }




        function condelete() {
            var agree = confirm("Are you sure?");
            if (agree == true) {
                return true;
            } else {
                return false;
            }

        }

        function changedata(id) {



            var getID = $('#edit_' + id).val();




            if (getID != '') {



                $.ajax({
                    type: 'post',
                    data: {
                        user_id: getID
                    },
                    url: 'ajbrandedit.php',
                    success: function(returnData) {



                        $("#body_" + id).html(returnData);
                    }
                });
            }


        }
        
    (function() {
            var nav = document.getElementsByClassName('nav-link ');
            var current = window.location.href;
            // console.log(current);

            for (var i = 0; i < nav.length; i++) {
            //   console.log("cu"+nav[i].href);
              if (nav[i].href === current) {
                nav[i].classList.add('active');
              }
            
            }
          })();
    </script>

</body>

</html>