<?php
include_once('../define/define.php');
include_once(login .'connect.php');
if (!isset($_SESSION['login'])) {
  header("location:".login."login.php");
  exit();
}





if (isset($_REQUEST['submit'])) {
   
    





    $name = $_REQUEST['Name'];
   
    $drname = $_REQUEST['Drname'];
    $gen = $_REQUEST['Gender'];
    $date = $_REQUEST['Date'];
    $cat = $_REQUEST['Category'];
    if(!empty($_REQUEST['subcategory'])){
    $subcat = $_REQUEST['subcategory'];}







    if (empty($name)  || trim($name) === '') {
        $err['nerror'] = "Name is Required";
    } else if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
        $err['nerror'] = "Only alphabets and white space are allowed";
    }
    if (empty($drname)  || trim($drname) === '') {
        $err['drnerror'] = "Doctor Name is Required";
    } else if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
        $err['drnerror'] = "Only alphabets and white space are allowed";
    }


    if (empty($date)) {
        $err['dateerror'] = "Date is Required";
    }
    if (empty($cat)) {
        $err['caterror'] = "Category is Required";
    }




    if (empty($gen)) {
        $err['generror'] = "Gender is Required";
    }


   
 if(!empty($_REQUEST['subcategory'])){
    if (empty($err)) {

        $sql = "INSERT INTO labinvoice (p_name,d_name,gender,date,category,subcategory) VALUES ('$name','$drname','$gen','$date','$cat','$subcat')";
   
        if ($conn->query($sql)) {
        
            $_REQUEST['Name']='';
       
            $_REQUEST['Drname']='';
            $_REQUEST['Gender']='';
            $_REQUEST['Date']='';
            $_REQUEST['Category']='';
            $_REQUEST['subcategory']='';

            $succ = "yes";
            echo "inserted";
        } else {
            $succ = "no";
        }
        if ($succ == "yes") {
          
        }
        header("location:labgetchild.php?subcat=$subcat&name=$name");
    }
}}


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
                            <h1>Patient Lab Invoice</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?php  echo login;?>index3.php">Home</a></li>
                                <li class="breadcrumb-item active">Patient Lab Invoice</li>
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
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Patient Name</label>
                                                    <input autocomplete="off" type="text" name="Name" style="width: 100%;" class="form-control" id="exampleInputEmail1" placeholder="Enter name" value="<?php echo (isset($_REQUEST['Name'])) ? $_REQUEST['Name'] : ''; ?>">
                                                    <span style=" color: red;" class="error" id="nspan"><?php echo isset($err['nerror']) ? '**' . $err['nerror'] : ''; ?></span>


                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">REF BY Doctor Name</label>
                                                    <input autocomplete="off" type="text" name="Drname" style="width: 100%;" class="form-control" id="exampleInputEmail1" placeholder="Enter Doctor Name" value="<?php echo (isset($_REQUEST['Drname'])) ? $_REQUEST['Drname'] : ''; ?>">
                                                    <span style=" color: red;" class="error" id="nspan"><?php echo isset($err['drnerror']) ? '**' . $err['drnerror'] : ''; ?></span>


                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Date</label>

                                                    <input autocomplete="off" type="date" name="Date" class="form-control" id="exampleInputEmail1" placeholder="Enter Date" value="<?php echo (isset($_REQUEST['Date'])) ? $_REQUEST['Date'] : ''; ?>">
                                                    <span style=" color: red;" class="error" id="nspan"><?php echo isset($err['dateerror']) ? '**' . $err['dateerror'] : ''; ?></span>


                                                </div>
                                                <div class="form-group">
                                                    <label>Gender:</label>
                                                    <select class="form-control" id="Gender" name="Gender">
                                                        <option value="">Select one</option>

                                                        <option value="male" <?php if (isset($_REQUEST['Gender']) && $_REQUEST['Gender'] == "male") {
                                                                                    echo "selected";
                                                                                } else {
                                                                                    '';
                                                                                } ?>>Male</option>
                                                        <option value="female" <?php if (isset($_REQUEST['Gender']) && $_REQUEST['Gender'] == "female") {
                                                                                    echo "selected";
                                                                                } else {
                                                                                    '';
                                                                                } ?>>Female</option>
                                                        <option value="others" <?php if (isset($_REQUEST['Gender']) && $_REQUEST['Gender'] == "others") {
                                                                                    echo "selected";
                                                                                } else {
                                                                                    '';
                                                                                } ?>>others</option>
                                                    </select>

                                                    <?php

                                                    if (isset($err['generror'])) {
                                                        echo '<span id="gspan" style="color: red;" >' . $err['generror'] . '</span>';
                                                    }
                                                    ?>
                                                </div>

                                            </div>
                                            <div class="col-md-6">
                                            
                                                <div class="form-group">
                                                    <label>Category</label>
                                                    <select class="form-control" id="Category" name="Category">

                                                        <option value="">Select one</option>
                                                        <?php
                                                        $sql = "select * from tests Where c_id=0  order by c_name ASC";
                                                        $rs = mysqli_query($conn, $sql);
                                                        while ($ro = mysqli_fetch_assoc($rs)) {
                                                        ?>

                                                            <option value="<?php echo $ro['Id']; ?>" <?php if (isset($_REQUEST['Category']) && $_REQUEST['Category'] ==  "$ro[Id]") {
                                                                                                            echo "selected";
                                                                                                        } else {
                                                                                                            '';
                                                                                                        } ?>><?php echo $ro['c_name']; ?></option>
                                                        <?php }
                                                        ?>

                                                    </select>

                                                    <?php

                                                    if (isset($err['caterror'])) {
                                                        echo '<span  style="color: red;" >' . $err['caterror'] . '</span>';
                                                    }
                                                    ?>
                                                </div>
                                               
                                                

                                            </div>


                                            <div class="col-md-6">
                                            
                                            </div>
                                        </div>
                                        <div class="col-md-12">

                                            <div class="form-group" id="divstatus">

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
        $(document).ready(function() {
            changeCity();
            // $("#state").html('<option value="">Select State</option>');



        });

        function changeCity() {
            $("#Category").change(function() {
                var getstatusID = $(this).val();






                $.ajax({
                    type: 'post',
                    data: {
                        c_id: getstatusID
                    },
                    url: 'labgetsub.php',
                    success: function(returnData) {



                        $("#divstatus").html(returnData);
                    }
                });




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