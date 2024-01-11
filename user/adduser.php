<?php
include_once('../define/define.php');
include_once(login .'connect.php');
if (!isset($_SESSION['login'])) {
  header("location:".login."login.php");
  exit();
}




if (isset($_REQUEST['submit'])) {
  // echo $_REQUEST['Id'];

  $name = $_REQUEST['Name'];
  $email = $_REQUEST['Email'];
  $mob = $_REQUEST['Mobile'];
  $add = $_REQUEST['Address'];
  $gen = $_REQUEST['Gender'];
  $pass = $_REQUEST['Password'];
  $conf_pass = $_REQUEST['ConPassword'];
  $wamob = $_REQUEST['Wanumber'];




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
  if (empty($wamob)) {
    $err['wamoberror'] = "Number is Required";
  } else if (!preg_match('/^[0-9]{10}+$/', $wamob)) {
    $err['wamoberror'] = "Invalid Number Format";
  }

  if (empty($add)) {
    $err['a1error'] = "Address is Required";
  }
  if (empty($pass)) {
    $err['passerror'] = "Password is Required";
  }
  if (empty($conf_pass)) {
    $err['conpasserror'] = "Confirm Password is required";
  } else if ($conf_pass != $pass) {
    $err['conpasserror'] = "Password do not match";
  }
  if (empty($email)) {
    $err['emerror'] = "Email is Required";
  } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $err['emerror'] = "Invalid email format";
  }

  if (empty($gen)) {
    $err['generror'] = "Gender is required";
  }
  if (!isset($_REQUEST['Id'])) {
    // echo "gjhghj";
    // die;
    $duplicate = mysqli_query($conn, "select * from user_data where  Email='$email'");
    if (mysqli_num_rows($duplicate) > 0) {
      $err['emerror'] = "Email already exists";
    }
  } else {
    $duplica = mysqli_query($conn, "select Email from user_data where not Email='$_REQUEST[Email]'");
    while ($r = mysqli_fetch_assoc($duplica)) {

      if ($r['Email'] == $email) {
        $err['emerror'] = "Email already assigned";
      }
    }
  }

  if (empty($err)) {
    $password = md5($pass);

    $sql = "INSERT INTO user_data (Name,Email,Mobile,Address,Gender,Password,Unique_id,Whatsapp) VALUES ('$_REQUEST[Name]','$_REQUEST[Email]', '$_REQUEST[Mobile]','$_REQUEST[Address]',' $_REQUEST[Gender]','$password',2,'$wamob')";
    if ($conn->query($sql)) {

      $_REQUEST['Name'] = '';
      $_REQUEST['Email'] = '';
      $_REQUEST['Mobile'] = '';
      $_REQUEST['Address'] = '';
      $_REQUEST['Gender'] = '';
      $_REQUEST['Password'] = '';
      $_REQUEST['ConPassword'] = '';
      $_REQUEST['Wanumber'] = '';
      $success = "Data Added Succesfully!";
    } else {
      echo "Could not insert record into table: %s<br />", $mysqli->error;
    }
  }
}

?>
<?php 
$title="Add User";
include_once(nav.'header.php');
?>




<body class="hold-transition sidebar-mini">
  <div class="wrapper">
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
              <h1> Add User</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?php echo login; ?>index3.php">Home</a></li>
                <li class="breadcrumb-item active">Add User</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
      <div>

      </div>
      <h3 style="color: green;"><?php echo isset($success) ? $success : ''; ?></h3>

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
                    <div class="form-group">
                      <label for="exampleInputEmail1">Full Name</label>

                      <input autocomplete="off" type="text" name="Name" class="form-control" id="exampleInputEmail1" placeholder="Enter name" value="<?php echo (isset($_REQUEST['Name'])) ? $_REQUEST['Name'] : ''; ?>">
                      <span style=" color: red;" class="error" id="nspan"><?php echo isset($err['nerror']) ? '**' . $err['nerror'] : ''; ?></span>


                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email address</label>

                      <input type="email" name="Email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="<?php echo (isset($_REQUEST['Email'])) ?
                                                                                                                                        $_REQUEST['Email'] : '';
                                                                                                                                      ?>" autocomplete="off">
                      <span style=" color: red;" class="error" id="nspan"><?php echo isset($err['emerror']) ? '**' . $err['emerror'] : ''; ?></span>


                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Password</label>

                      <input type="password" name="Password" class="form-control" id="exampleInputEmail1" placeholder="Password" value="<?php echo (isset($_REQUEST['Password'])) ?
                                                                                                                                          $_REQUEST['Password'] : '';
                                                                                                                                        ?>" autocomplete="off">
                      <span style=" color: red;" class="error" id="nspan"><?php echo isset($err['passerror']) ? '**' . $err['passerror'] : ''; ?></span>


                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Confirm Password</label>

                      <input type="password" name="ConPassword" class="form-control" id="exampleInputEmail1" placeholder="Retype Password" value="<?php echo (isset($_REQUEST['ConPassword'])) ?
                                                                                                                                                    $_REQUEST['ConPassword'] : '';
                                                                                                                                                  ?>" autocomplete="off">
                      <span style=" color: red;" class="error" id="nspan"><?php echo isset($err['conpasserror']) ? '**' . $err['conpasserror'] : ''; ?></span>


                    </div>
                    <div class="form-group">
                      <label for="Mobile">Mobile</label>
                      <input type="tel" class="form-control" name="Mobile" id="Mobile" placeholder="Mobile" value="<?php echo (isset($_REQUEST['Mobile'])) ?
                                                                                                                      $_REQUEST['Mobile']

                                                                                                                      : '';
                                                                                                                    ?>">
                      <span style=" color: red;" class="error" id="mobspan"><?php echo isset($err['moberror']) ? '**' . $err['moberror'] : ''; ?></span>
                    </div>
                    <div class="form-group">
                      <label for="Wanumber"> Whatsapp Number</label>
                      <label style="float:right" for="same_num">Same as above</label>
                      <input style="float:right;width:30px" type="checkbox" name="same_num" id="same_num" value="Yes" onchange="myfun();">

                      <input type="tel" class="form-control" name="Wanumber" id="Wanumber" placeholder="Whatsapp Number" value="<?php echo (isset($_REQUEST['Wanumber'])) ?
                                                                                                                                  $_REQUEST['Wanumber']

                                                                                                                                  : '';
                                                                                                                                ?>">

                      <span style=" color: red;" class="error" id="mobspan"><?php echo isset($err['wamoberror']) ? '**' . $err['wamoberror'] : ''; ?></span>
                    </div>
                    <div class="form-group">
                      <label for="Address">Address</label>
                      <input type="text" class="form-control" name="Address" id="Address" placeholder="Address" value="<?php echo (isset($_REQUEST['Address'])) ?
                                                                                                                          $_REQUEST['Address'] : '';
                                                                                                                        ?>">

                      <span style=" color: red;" class="error" id="add1span"><?php echo isset($err['a1error']) ? '**' . $err['a1error'] : ''; ?></span>
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
                      <br>
                      <?php

                      if (isset($err['generror'])) {
                        echo '<span id="gspan" style="color: red;" >' . $err['generror'] . '</span>';
                      }
                      ?>
                    </div>


                  </div>


                  <div class="card-footer">
                    <!-- <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button> -->
                    <input type="submit" class="btn btn-primary" name="submit" value="Submit" />
                    <input type="hidden" class="btn btn-primary" id="Id" name="Id" value="<?php if (isset($id)) echo $id;
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

 
  <!-- AdminLTE for demo purposes -->
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
              // console.log("cu"+nav[i].href);
              if (nav[i].href === current) {
                nav[i].classList.add('active');
              }
            
            }
          })();
  </script>
</body>

</html>