<?php
include_once('../define/define.php');
include_once(login .'connect.php');
if (!isset($_SESSION['login'])) {
  header("location:".login."login.php");
  exit();
}

if (!empty($_REQUEST['Id'])) {

    $id = $_REQUEST['Id'];
}





if (isset($_REQUEST['submit'])) {




    $name = $_REQUEST['Name'];

    $spe = $_REQUEST['Status'];
    $amount = $_REQUEST['Amount'];
    $normal = $_REQUEST['normal'];
    $kname = $_REQUEST['kname'];









    if (empty($name)  || trim($name) === '') {
        $err['nerror'] = "Name is Required";
    } else if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
        $err['nerror'] = "Only alphabets and white space are allowed";
    }


    if (empty($spe)) {
        $err['generror'] = "Status is required";
    }
    if (empty($amount)) {
        $err['amerror'] = "Amount is required";
    } else if (!preg_match('/^[0-9]+$/', $amount)) {
        $err['amerror'] = "Invalid Amount Format";
    }



    if (empty($err)) {

        if (!empty($_REQUEST['Id'])) {


            //update query
            $query = "UPDATE tests
      SET c_name='$name',c_id='$spe',amount='$amount'
         WHERE Id='$id' ";




            $exec = mysqli_query($conn, $query);
            $exe = mysqli_query($conn, $q);




            if ($exec && $exe) {
                $_REQUEST['Name'] = '';

                $_REQUEST['Status'] = '';
                $_REQUEST['Amount'] = '';


                $success = "Data Edited Successfully!";
                // header('location:data.php');
            } else {
                $msg = "Error: " . $query . "<br>" . mysqli_error($conn);
                echo $msg;
            }
        } else {






            if ($_REQUEST['Status'] == 1) {

                $s = "INSERT INTO tests (c_name,c_id,amount,normalval,k_name) VALUES ('$_REQUEST[Name]',0 ,'$amount','$_REQUEST[normal]','$_REQUEST[kname]')";
                if ($conn->query($s)) {
                    $_REQUEST['Name'] = '';

                    $_REQUEST['Status'] = '';
                    $_REQUEST['Amount'] = '';
                    $_REQUEST['normal'] = '';
                    $_REQUEST['kname'] = '';


                    $success = "Added Succesfully!";
                }
            } else if ($_REQUEST['Status'] == 2) {
                $st = $_REQUEST['category'];
                $s = "INSERT INTO tests (c_name,c_id,amount,normalval,k_name) VALUES ('$_REQUEST[Name]','$st','$amount','$_REQUEST[normal]','$_REQUEST[kname]' )";
                if ($conn->query($s)) {
                    $_REQUEST['Name'] = '';

                    $_REQUEST['Status'] = '';
                    $_REQUEST['Amount'] = '';
                    $_REQUEST['normal'] = '';
                    $_REQUEST['kname'] = '';

                    $success = "Added Succesfully!";
                }
            } else if ($_REQUEST['Status'] == 3) {
                $st = $_REQUEST['subcategory'];
                $s = "INSERT INTO tests (c_name,c_id,amount,normalval,k_name) VALUES ('$_REQUEST[Name]','$st','$amount','$_REQUEST[normal]','$_REQUEST[kname]' )";
                if ($conn->query($s)) {
                    $_REQUEST['Name'] = '';

                    $_REQUEST['Status'] = '';
                    $_REQUEST['Amount'] = '';
                    $_REQUEST['normal'] = '';
                    $_REQUEST['kname'] = '';



                    $success = "Added Succesfully!";
                }
            }
        }
    }
}

if (isset($_REQUEST['Id'])) {
    $q = "SELECT * FROM tests WHERE Id='$id'";
    $result = $conn->query($q);
    $roww = mysqli_fetch_assoc($result);
}

?>

<?php
$title="Add Test";
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
                            <h1> Add Medical Tests</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?php echo login; ?>index3.php">Home</a></li>
                                <li class="breadcrumb-item active">Add Medical Tests</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <div>

            </div>

            <!-- Main content -->
            <h3 style="color: green;text-align:center"><?php echo isset($success) ? $success : ''; ?></h3>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">


                                <!-- /.card-header -->
                                <!-- form start -->
                                <div>
                                    <form class="centre" enctype="multipart/form-data" method="post" autocomplete="off">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Category Name</label>

                                                <input type="text" name="Name" class="form-control" id="exampleInputEmail1" placeholder="Enter name" value="<?php if (isset($_REQUEST['Name'])) {
                                                                                                                                                                echo $_REQUEST['Name'];
                                                                                                                                                            } else {
                                                                                                                                                                echo isset($roww['Name']) ? $roww['Name'] : '';
                                                                                                                                                            } ?>">
                                                <span style=" color: red;" class="error" id="nspan"><?php echo isset($err['nerror']) ? '**' . $err['nerror'] : ''; ?></span>


                                            </div>





                                            <div class="form-group">
                                                <label>Category Status:</label>
                                                <select class="form-control" id="Status" name="Status">
                                                    <option value="">Select one</option>

                                                    <option value="1" <?php if (isset($_REQUEST['Status']) && $_REQUEST['Status'] == "1") echo "selected";
                                                                        else {
                                                                            if (isset($roww['c_id']) && $roww['c_id'] == "1") echo "selected";
                                                                        } ?>>Category</option>
                                                    <option value="2" <?php if (isset($_REQUEST['Status']) && $_REQUEST['Status'] == "2")  echo "selected";
                                                                        else {
                                                                            if (isset($roww['Status']) && $roww['Status'] == "2")  echo "selected";
                                                                        } ?>>Sub Category</option>
                                                    <option value="3" <?php if (isset($_REQUEST['Status']) && $_REQUEST['Status'] == "3") echo "selected";
                                                                        else {
                                                                            if (isset($roww['Status']) && $roww['Status'] == "3") echo "selected";
                                                                        } ?>>Child Category</option>

                                                </select>

                                                <?php

                                                if (isset($err['generror'])) {
                                                    echo '<span id="gspan" style="color: red;" >' . '*' . $err['generror'] . '</span>';
                                                }
                                                ?>
                                            </div>
                                            <div class="form-group" id="divstatus">



                                            </div>






                                        </div>

                                        <div class="card-footer">
                                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>

                                <?php
                                $query = "SELECT * FROM user_data ";
                                $result = $conn->query($query);
                                ?>


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
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

   
    <!-- <script src="../../dist/js/demo.js"></script> -->
    <!-- Page specific script -->
    <script>
        $(document).ready(function() {
            $('table tbody').on('click', '.status-button', function() {
                const userId = $(this).data('user-id');
                const currentStatus = $(this).data('status');

                // Toggle the status text
                const newStatus = currentStatus === '1' ? '0' : '1';
                $(this).text(newStatus === '1' ? 'Activate' : 'Deactivate');

                // Update the data-status attribute
                $(this).data('status', newStatus);

                // Send an AJAX request to update the status in the database
                $.ajax({
                    url: 'update_status.php', // Replace with your update script
                    method: 'POST',
                    data: {
                        userId: userId,
                        status: newStatus
                    },
                    success: function(response) {
                        // Handle the response if needed
                        console.log(response);
                    },
                    error: function(xhr, status, error) {
                        // Handle errors if needed
                        console.error(xhr.responseText);
                    }
                });
            });
        });







        $(document).ready(function() {
            // Initialize DataTable
            var table = $('#example1').DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#button-container');

            // Define a variable to store the current status filter
            var currentStatusFilter = null;
            var id = $('#status').val();
            console.log(id);

            // Handle the Activate button click
            $('#activate-btn').on('click', function() {
                // Check if the current status filter is not '1' (Activate)
                if (currentStatusFilter !== '1') {
                    currentStatusFilter = '1';
                    // Update the DataTable to filter by the '1' status (Activate)
                    table.column(6).search(currentStatusFilter).draw();
                }
            });

            // Handle the Deactivate button click
            $('#deactivate-btn').on('click', function() {
                // Check if the current status filter is not '0' (Deactivate)
                if (currentStatusFilter !== '0') {
                    currentStatusFilter = '0';
                    // Update the DataTable to filter by the '0' status (Deactivate)
                    table.column(6).search(currentStatusFilter).draw();
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            changeCity();
            // $("#state").html('<option value="">Select State</option>');



        });

        function changeCity() {
            $("#Status").change(function() {
                var getstatusID = $(this).val();


                if (getstatusID == 2) {



                    $.ajax({
                        type: 'post',
                        data: {
                            c_id: getstatusID
                        },
                        url: 'ajaxstatus_request.php',
                        success: function(returnData) {



                            $("#divstatus").html(returnData);
                        }
                    });
                } else {
                    $("#divstatus").html('');
                }

            })
        }
    </script>
    <script>
        $(document).ready(function() {
            changestatus();
            // $("#state").html('<option value="">Select State</option>');



        });

        function changestatus() {
            $("#Status").change(function() {
                var getstatusID = $(this).val();


                if (getstatusID == 3) {



                    $.ajax({
                        type: 'post',
                        data: {
                            c_id: getstatusID
                        },
                        url: 'ajaxsta_request.php',
                        success: function(returnData) {



                            $("#divstatus").html(returnData);
                        }
                    });
                } else {
                    $("#divstatus").html('');
                }

            })
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