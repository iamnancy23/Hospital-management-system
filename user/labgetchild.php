<?php
include_once('../define/define.php');
include_once(login .'connect.php');
if (!isset($_SESSION['login'])) {
  header("location:".login."login.php");
  exit();
}
$subcat = $_REQUEST['subcat'];
$name = $_REQUEST['name'];



if (isset($_REQUEST['submit'])) {
    print_r($_REQUEST);
    die;

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


        $sql = "INSERT INTO prescription (Name,Age,Mobile,Symptoms,Disease,Prescription,Tests) VALUES ('$_REQUEST[Name]','$_REQUEST[Age]','$_REQUEST[Mobile]', '$_REQUEST[Symptoms]','$_REQUEST[Disease]',' $_REQUEST[Prescription]','$_REQUEST[Tests]')";
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
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-12">

                                            <!-- /.card -->

                                            <div class="card">
                                                <div class="card-header"><?php
                                                                            $sq = "select * from tests Where Id='$subcat' ";
                                                                            $r = mysqli_query($conn, $sq);
                                                                            $row = mysqli_fetch_assoc($r);

                                                                            ?>
                                                    <h3 id="subcat" class="card-title" style="align-content: center;"><b><?php echo $row['c_name']; ?></b></h3>
                                                </div>
                                                <!-- /.card-header -->

                                                <div class="card-body">
                                                    <table id="example1" class="table table-bordered table-striped">
                                                        <thead>
                                                            <tr>

                                                                <th style="text-align: center;">Test Categories</th>
                                                                <th style="text-align: center;">Kit Name</th>

                                                                <th style="text-align: center;">Kit Used </th>






                                                            </tr>
                                                        </thead>
                                                        <?php
                                                        $sq = "select * from tests Where c_id='$subcat' ";
                                                        $rs = mysqli_query($conn, $sq);

                                                        while ($state = mysqli_fetch_assoc($rs)) {
                                                        ?>
                                                            <tr>



                                                                <td style="width:300px;text-align: center;"><?php echo $state['c_name']; ?></td>

                                                                <td style="width:300px;text-align: center;" id="<?php echo $state['Id']; ?>"><?php echo $state['k_name']; ?></td>
                                                                <td><input style="width:1000px;height:50px" name="Patval" type="number" id="<?php echo $state['Id']; ?>" placeholder="Enter  Value" value="<?php echo isset($_REQUEST['Patval']) ? $_REQUEST['Patval'] : ''; ?>" onchange="savedata(<?php echo $state['Id']; ?>)" /><br>
                                                                    <span style=" color: red;" class="error" id="nspan"></span>
                                                                </td>


                                                            </tr>
                                                        <?php
                                                        }
                                                        ?>

                                                        </tbody>
                                                        <tfoot>
                                                            <tr>

                                                                <th style="text-align: center;">Test Categories</th>
                                                                <th style="text-align: center;">Kit Name</th>

                                                                <th style="text-align: center;">Kit Used </th>



                                                            </tr>

                                                        </tfoot>

                                                    </table>
                                                    <button id="submit-button" style="float: right; color: white; background-color: dodgerblue" name="submit" value="<?php echo $_REQUEST['name'] ?>">Submit</button>
                                                </div>

                                                <!-- /.card-body -->
                                            </div>
                                            <!-- Add this button to your HTML -->


                                            <!-- /.card -->
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->
                                </div>
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
    </script>

    <script>
        $(document).ready(function() {

            $('#submit-button').on('click', function() {
            

                var dataToSubmit = [];
                var name=$('#submit-button').val();
                alert(name);


                $('table tbody tr').each(function() {

                    var kitId = $(this).find('input[type="number"]').attr('id');
                    var kitname = $('#'+kitId).text();
                    var kitUsed = $(this).find('input[type="number"]').val();

                    // Push the data for this row into the array
                    dataToSubmit.push({
                        kitId: kitId,
                        kitname:kitname,
                        kitUsed: kitUsed
                    });
                });


                $.ajax({
                    url: 'insertlab.php',
                    method: 'POST',
                    data: {
                        data: dataToSubmit,
                        name:name
                    },
                    success: function(response) {
                    //     if (response.d == true) {
                    // alert("You will now be redirected.");
                    window.location = "location:labgetchild.php";
                // }

                   
                    },

                });
            });
        });
    </script>

</body>

</html>