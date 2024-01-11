<?php
include_once('../define/define.php');
include_once(login .'connect.php');
if (!isset($_SESSION['login'])) {
  header("location:".login."login.php");
  exit();
}





if (isset($_REQUEST['submit'])) {





    $name = $_REQUEST['Name'];
    $mob=$_REQUEST['Mobile'];
   







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
  


    if (empty($err)) {
       
        header("location:labreport.php?name=$name&mob=$mob");
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

                                <form class="centre" autocomplete="off">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Patient Name</label>
                                                    <input autocomplete="off" type="text" name="Name" style="width: 100%;" class="form-control" id="exampleInputEmail1" placeholder="Enter name" value="<?php echo (isset($_REQUEST['Name'])) ? $_REQUEST['Name'] : ''; ?>">
                                                    <span style=" color: red;" class="error" id="nspan"><?php echo isset($err['nerror']) ? '**' . $err['nerror'] : ''; ?></span>


                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Patient Number</label>
                                                    <input autocomplete="off" type="tel" name="Mobile" style="width: 100%;" class="form-control" id="exampleInputEmail1" placeholder="Enter  Number" value="<?php echo (isset($_REQUEST['Mobile'])) ? $_REQUEST['Mobile'] : ''; ?>">
                                                    <span style=" color: red;" class="error" id="nspan"><?php echo isset($err['moberror']) ? '**' . $err['moberror'] : ''; ?></span>


                                                </div>
                                            </div>
                                            

                                          
                                          

                                            <div class="card-footer">
                                                <!-- <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button> -->
                                                <input type="submit" class="btn btn-primary" name="submit" value="Submit" />


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
    </script>
    <script>
       
        
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