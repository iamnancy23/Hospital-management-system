<?php
include_once('../define/define.php');
include_once(login .'connect.php');
if (!isset($_SESSION['login'])) {
  header("location:".login."login.php");
  exit();
}


if (isset($_REQUEST['Id'])) {
    $usid = $_REQUEST['Id'];
}

if (isset($_REQUEST['submit'])) {
    // echo $_REQUEST['Id'];

    $name = $_REQUEST['Name'];
    $age = $_REQUEST['Age'];
    $sym = $_REQUEST['Symptoms'];
    $dis = $_REQUEST['Disease'];
    $pre = $_REQUEST['Prescription'];
    $tests = $_REQUEST['Tests'];
    $mob = $_REQUEST['Mobile'];





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



    if (empty($age)) {
        $err['ageerror'] = "Age is Required";
    }


    if (empty($sym)) {
        $err['symerror'] = "Symptoms is Required";
    }
    if (empty($dis)) {
        $err['diserror'] = "Disease is Required";
    }
    if (empty($pre)) {
        $err['preerror'] = "Prescription is required";
    }




    if (empty($err)) {


        $sql = "INSERT INTO prescription (Name,Age,Mobile,Symptoms,Disease,Prescription,Tests,user_id) VALUES ('$_REQUEST[Name]','$_REQUEST[Age]','$_REQUEST[Mobile]', '$_REQUEST[Symptoms]','$_REQUEST[Disease]',' $_REQUEST[Prescription]','$_REQUEST[Tests]','$usid')";
        // echo $sql;die;
        if ($conn->query($sql)) {

            $_REQUEST['Name'] = '';
            $_REQUEST['Age'] = '';
            $_REQUEST['Symptoms'] = '';
            $_REQUEST['Disease'] = '';
            $_REQUEST['Prescription'] = '';
            $_REQUEST['Tests'] = '';
            $_REQUEST['Mobile'] = '';
            $success = "Data Added Succesfully!";
        } else {
            echo "Could not insert record into table: %s<br />", $mysqli->error;
        }
    }
}

?>
<?php
$title="Add Report";
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
                            <h1> Add Patient Report</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?php echo login; ?>index3.php">Home</a></li>
                                <li class="breadcrumb-item active">Add Patient Report</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <div>

            </div>
            <h3 style="color: green;text-align:center"><?php echo isset($success) ? $success : ''; ?></h3>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">


                                <!-- /.card-header -->
                                <!-- form start -->
                                <div>
                                    <form class="centre" autocomplete="off">
                                        <div class="card-body">
                                            <?php
                                            $query = "SELECT * FROM book_slot Where Id='$_REQUEST[Id]'  ";
                                            $result = $conn->query($query);
                                        
                                            $rows = $result->fetch_assoc();


                                            ?>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Patient Name</label>

                                                <input autocomplete="off" type="text" name="Name" class="form-control" id="exampleInputEmail1" placeholder="Enter name" value="<?php if (isset($_REQUEST['Name'])) {
                                                                                                                                                                                    echo $_REQUEST['Name'];
                                                                                                                                                                                } else {
                                                                                                                                                                                    if (isset($rows['Name'])) {
                                                                                                                                                                                        echo $rows['Name'];
                                                                                                                                                                                    } else {
                                                                                                                                                                                        echo '';
                                                                                                                                                                                    }
                                                                                                                                                                                } ?>">
                                                <span style=" color: red;" class="error" id="nspan"><?php echo isset($err['nerror']) ? '**' . $err['nerror'] : ''; ?></span>


                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Mobile</label>

                                                <input autocomplete="off" type="number" name="Mobile" class="form-control" id="exampleInputEmail1" placeholder="Enter Number" value="<?php if (isset($_REQUEST['Mobile'])) {
                                                                                                                                                                                            echo $_REQUEST['Mobile'];
                                                                                                                                                                                        } else {
                                                                                                                                                                                            if (isset($rows['Mobile'])) {
                                                                                                                                                                                                echo $rows['Mobile'];
                                                                                                                                                                                            } else {
                                                                                                                                                                                                '';
                                                                                                                                                                                            }
                                                                                                                                                                                        } ?>">
                                                <span style=" color: red;" class="error" id="nspan"><?php echo isset($err['moberror']) ? '**' . $err['moberror'] : ''; ?></span>


                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Patient Age</label>

                                                <input autocomplete="off" type="number" name="Age" class="form-control" id="exampleInputEmail1" placeholder="Enter age" value="<?php echo (isset($_REQUEST['Age'])) ? $_REQUEST['Age'] : ''; ?>">
                                                <span style=" color: red;" class="error" id="nspan"><?php echo isset($err['ageerror']) ? '**' . $err['ageerror'] : ''; ?></span>


                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Symptoms</label>

                                                <input autocomplete="off" type="text" name="Symptoms" class="form-control" id="exampleInputEmail1" placeholder="Enter Symptoms" value="<?php echo (isset($_REQUEST['Symptoms'])) ? $_REQUEST['Symptoms'] : ''; ?>">
                                                <span style=" color: red;" class="error" id="nspan"><?php echo isset($err['symerror']) ? '**' . $err['symerror'] : ''; ?></span>


                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Disease</label>

                                                <input autocomplete="off" type="text" name="Disease" class="form-control" id="exampleInputEmail1" placeholder="Enter Disease" value="<?php echo (isset($_REQUEST['Disease'])) ? $_REQUEST['Disease'] : ''; ?>">
                                                <span style=" color: red;" class="error" id="nspan"><?php echo isset($err['diserror']) ? '**' . $err['diserror'] : ''; ?></span>


                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Prescription</label>

                                                <input autocomplete="off" type="text" name="Prescription" class="form-control" id="exampleInputEmail1" placeholder="Enter Prescription" value="<?php echo (isset($_REQUEST['Prescription'])) ? $_REQUEST['Prescription'] : ''; ?>">
                                                <span style=" color: red;" class="error" id="nspan"><?php echo isset($err['preerror']) ? '**' . $err['preerror'] : ''; ?></span>


                                            </div>
                                            <div class="form-group">
                                                <label>Tests if any</label>
                                                <?php
                                                $q = "SELECT * FROM tests  ORDER BY c_name";
                                                $result = $conn->query($q);

                                                ?>
                                                <select class="form-control" id="Tests" name="Tests">
                                                    <option value="">Select one</option>
                                                    <?php
                                                    while ($rows = mysqli_fetch_assoc($result)) {
                                                    ?>

                                                        <option value="<?php echo $rows['Id'] ?>" <?php if (isset($_REQUEST['Tests']) && $_REQUEST['Tests'] == "<?php echo $rows[Id] ?>") {
                                                                                                        echo "selected";
                                                                                                    } else {
                                                                                                        '';
                                                                                                    } ?>><?php echo $rows['c_name']; ?></option>

                                                    <?php
                                                    }
                                                    ?>

                                                </select>



                                            </div>




                                        </div>


                                        <div class="card-footer">
                                            <!-- <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button> -->
                                            <input type="submit" class="btn btn-primary" name="submit" value="Submit" />
                                            <input type="hidden" class="btn btn-primary" id="Id" name="Id" value="<?php if (isset($usid)) echo $usid;
                                                                                                                    else echo ''; ?>" />

                                        </div>
                                    </form>
                                </div>



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


                $.ajax({
                    url: 'update_status.php',
                    method: 'POST',
                    data: {
                        userId: userId,
                        status: newStatus
                    },
                    success: function(response) {
                        // Handle the response if needed
                        console.log(response);
                    },
                    // error: function(xhr, status, error) {
                    //   // Handle errors if needed
                    //   console.error(xhr.responseText);
                    // }
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

        function myfun() {

            var samenum = $('#same_num').val();
            var mob = $('#Mobile').val();
            if (samenum == "Yes") {
                $('#Wanumber').val(mob);
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