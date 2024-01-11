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
if (!empty($_REQUEST['UserId'])) {

  $userid = $_REQUEST['UserId'];
}




if (isset($_REQUEST['submit'])) {


  $name = $_REQUEST['Name'];
  $email = $_REQUEST['Email'];
  $mob = $_REQUEST['Mobile'];
  $add = $_REQUEST['Address'];
  $gen = $_REQUEST['Gender'];
  $spe = $_REQUEST['Specialist'];
  if (!isset($_REQUEST['Id'])) {
    $pass = $_REQUEST['Password'];
    $conf_pass = $_REQUEST['ConPassword'];
  }



  if (!empty($_FILES["Image"]["name"])) {
    $im = file_get_contents($_FILES['Image']['tmp_name']);
    $base = base64_encode($im);
  }





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
  if (!isset($_REQUEST['Id'])) {
    if (empty($pass)) {
      $err['passerror'] = "Password is Required";
    }
    if (empty($conf_pass)) {
      $err['conpasserror'] = "Confirm Password is required";
    } else if ($conf_pass != $pass) {
      $err['conpasserror'] = "Password do not match";
    }
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
  if (empty($spe)) {
    $err['generror'] = "Specialist is required";
  }
  if (!isset($_GET['Id'])) {
    $duplicate = mysqli_query($conn, "select * from doctor_data where  Email='$email'");
    if (mysqli_num_rows($duplicate) > 0) {
      $err['emerror'] = "Email already exists";
    }
  } else {
    $duplicate = mysqli_query($conn, "select Email from doctor_data where not Id='$_GET[Id]'");
    while ($r = mysqli_fetch_assoc($duplicate)) {

      if ($r['Email'] == $email) {
        $err['emerror'] = "Email already assigned";
      }
    }
  }
  if (!isset($_REQUEST['Id'])) {
    // echo "gjhghj";
    // die;
    $duplicate = mysqli_query($conn, "select * from doctor_data where  Email='$email'");
    if (mysqli_num_rows($duplicate) > 0) {
      $err['emerror'] = "Email already exists";
    }
  } else {
    $duplica = mysqli_query($conn, "select Email from doctor_data where not Email='$_REQUEST[Email]'");
    while ($r = mysqli_fetch_assoc($duplica)) {

      if ($r['Email'] == $email) {
        $err['emerror'] = "Email already assigned";
      }
    }
  }










  if (empty($err)) {

    if (!isset($_REQUEST['UserId'])) {
      $password = md5($pass);
    }
    if (!empty($_REQUEST['Id'])) {
      if (!empty($_FILES["Image"]["name"])) {
        $query = "UPDATE doctor_data
        SET Name='$name',
        Email='$email',
        Mobile='$mob',
        Address='$add',
        Gender='$gen',Specialist='$spe',image='$base'
         WHERE Id='$id' ";

        $q = "UPDATE user_data
           SET Name='$name',
           Email='$email',
           Mobile='$mob',
           Address='$add',
           Gender='$gen'
            WHERE Id='$userid' ";
      } else {

        //update query
        $query = "UPDATE doctor_data
        SET Name='$name',
        Email='$email',
        Mobile='$mob',
        Address='$add',
        Gender='$gen',Specialist='$spe'
         WHERE Id='$id' ";

        $q = "UPDATE user_data
SET Name='$name',
Email='$email',
Mobile='$mob',
Address='$add',
Gender='$gen'
 WHERE Id='$userid' ";
      }

      $exec = mysqli_query($conn, $query);
      $exe = mysqli_query($conn, $q);




      if ($exec && $exe) {
        $_REQUEST['Name'] = '';
        $_REQUEST['Email'] = '';
        $_REQUEST['Mobile'] = '';
        $_REQUEST['Address'] = '';
        $_REQUEST['Gender'] = '';
        $_REQUEST['Specialist'] = '';
        $_REQUEST['Password'] = '';
        $_REQUEST['ConPassword'] = '';

        $success = "Data Edited Successfully!";
        // header('location:data.php');
      } else {
        $msg = "Error: " . $query . "<br>" . mysqli_error($conn);
        echo $msg;
      }
    } else {





      $sql = "INSERT INTO doctor_data (Name,Email,Mobile,Address,Gender,Specialist,Image) VALUES ('$_REQUEST[Name]','$_REQUEST[Email]', '$_REQUEST[Mobile]','$_REQUEST[Address]',' $_REQUEST[Gender]','$_REQUEST[Specialist]','$base')";
      if ($conn->query($sql)) {


        $s = "INSERT INTO user_data (Name,Email,Mobile,Address,Gender,Password,Unique_id,Status) VALUES ('$_REQUEST[Name]','$_REQUEST[Email]', '$_REQUEST[Mobile]','$_REQUEST[Address]',' $_REQUEST[Gender]','$password',1,1 )";
        if ($conn->query($s)) {
          $_REQUEST['Name'] = '';
          $_REQUEST['Email'] = '';
          $_REQUEST['Mobile'] = '';
          $_REQUEST['Address'] = '';
          $_REQUEST['Gender'] = '';
          $_REQUEST['Specialist'] = '';
          $_REQUEST['Password'] = '';
          $_REQUEST['ConPassword'] = '';
          $success = "Added Succesfully!";
        }
      } else if ($conn->errno) {
        echo "Could not insert record into table: %s<br />", $mysqli->error;
      }
    }
  }
}


if (!empty($_REQUEST['Id'])) {
  $q = "SELECT * FROM doctor_data WHERE Id='$id'";
  $result = $conn->query($q);
  $roww = mysqli_fetch_assoc($result);
}

?>




<?php
$title="Add Doctor";
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
              <h1> Add Doctor/Edit Doctor</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?php echo login; ?>index3.php">Home</a></li>
                <li class="breadcrumb-item active">Add Doctor</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
      <div>

      </div>

      <!-- Main content -->
      <h3 style="color: green;"><?php echo isset($success) ? $success : ''; ?></h3>
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card" style="width:1600px">

           
              <!-- /.card-header -->
              <!-- form start -->
              <div>
                <form class="centre" enctype="multipart/form-data" method="post" autocomplete="off">
                  <div class="card-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Full Name</label>

                      <input type="text" name="Name" class="form-control" id="exampleInputEmail1" placeholder="Enter name" value="<?php if (isset($_REQUEST['Name'])) {
                                                                                                                                    echo $_REQUEST['Name'];
                                                                                                                                  } else { if
                                                                                                                                    ( isset($roww['Name'])) {echo $roww['Name'];}else{ echo '';}
                                                                                                                                  } ?>">
                      <span style=" color: red;" class="error" id="nspan"><?php echo isset($err['nerror']) ? '**' . $err['nerror'] : ''; ?></span>


                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email address</label>

                      <input type="email" name="Email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="<?php if (isset($_REQUEST['Email'])) {
                                                                                                                                        echo $_REQUEST['Email'];
                                                                                                                                      } else {
                                                                                                                                        echo isset($roww['Email']) ? $roww['Email'] : '';
                                                                                                                                      } ?>">
                      <span style=" color: red;" class="error" id="nspan"><?php echo isset($err['emerror']) ? '**' . $err['emerror'] : ''; ?></span>


                    </div>
                    <?php
                    if (!isset($_REQUEST['Id'])) {
                    ?>
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
                    <?php
                    }
                    ?>
                    <div class="form-group">
                      <label for="Mobile">Mobile</label>
                      <input type="tel" class="form-control" name="Mobile" id="Mobile" placeholder="Mobile" value="<?php if (isset($_REQUEST['Mobile'])) {
                                                                                                                      echo $_REQUEST['Mobile'];
                                                                                                                    } else {
                                                                                                                      echo isset($roww['Mobile']) ? $roww['Mobile']  : '';
                                                                                                                    } ?>">
                      <span style=" color: red;" class="error" id="mobspan"><?php echo isset($err['moberror']) ? '**' . $err['moberror'] : ''; ?></span>
                    </div>
                    <div class="form-group">
                      <label for="Address">Address</label>
                      <input type="text" class="form-control" name="Address" id="Address" placeholder="Address" value="<?php if (isset($_REQUEST['Address'])) {
                                                                                                                          echo $_REQUEST['Address'];
                                                                                                                        } else {
                                                                                                                          echo isset($roww['Address']) ? $roww['Address'] : '';
                                                                                                                        } ?>">

                      <span style=" color: red;" class="error" id="add1span"><?php echo isset($err['a1error']) ? '**' . $err['a1error'] : ''; ?></span>
                    </div>
                    <div class="form-group">
                      <label>Gender:</label>
                      <select class="form-control" id="Gender" name="Gender">
                        <option value="">Select one</option>

                        <option value="male" <?php if (isset($_REQUEST['Gender']) && $_REQUEST['Gender'] == "male") echo "selected";
                                              else {
                                                if (isset($roww['Gender']) && $roww['Gender'] == "male") echo "selected";
                                              } ?>>Male</option>
                        <option value="female" <?php if (isset($_REQUEST['Gender']) && $_REQUEST['Gender'] == "female")  echo "selected";
                                                else {
                                                  if (isset($roww['Gender']) && $roww['Gender'] == "female")  echo "selected";
                                                } ?>>Female</option>
                        <option value="others" <?php if (isset($_REQUEST['Gender']) && $_REQUEST['Gender'] == "others") echo "selected";
                                                else {
                                                  if (isset($roww['Gender']) && $roww['Gender'] == "others") echo "selected";
                                                } ?>>others</option>
                      </select>
                      <br>
                      <?php

                      if (isset($err['generror'])) {
                        echo '<span id="gspan" style="color: red;" >' . $err['generror'] . '</span>';
                      }
                      ?>
                    </div>
                    <div class="form-group">
                      <label>Specialist:</label>
                      <select class="form-control" id="Specialist" name="Specialist">
                        <option value="">Select one</option>

                        <option value="Physician" <?php if (isset($_REQUEST['Specialist']) && $_REQUEST['Specialist'] == "Physician") echo "selected";
                                                  else {
                                                    if (isset($roww['Specialist']) && $roww['Specialist'] == "Physician") echo "selected";
                                                  } ?>>Physician</option>
                        <option value="Surgeon" <?php if (isset($_REQUEST['Specialist']) && $_REQUEST['Specialist'] == "Surgeon")  echo "selected";
                                                else {
                                                  if (isset($roww['Specialist']) && $roww['Specialist'] == "Surgeon")  echo "selected";
                                                } ?>>Surgeon</option>
                        <option value="Neurologist" <?php if (isset($_REQUEST['Specialist']) && $_REQUEST['Specialist'] == "Neurologist") echo "selected";
                                                    else {
                                                      if (isset($roww['Specialist']) && $roww['Specialist'] == "Neurologist") echo "selected";
                                                    } ?>>Neurologist</option>
                        <option value="Psychiatrist" <?php if (isset($_REQUEST['Specialist']) && $_REQUEST['Specialist'] == "Psychiatrist")  echo "selected";
                                                      else {
                                                        if (isset($roww['Specialist']) && $roww['Specialist'] == "Psychiatrist")  echo "selected";
                                                      } ?>>Psychiatrist</option>
                        <option value="others" <?php if (isset($_REQUEST['Specialist']) && $_REQUEST['Specialist'] == "others") echo "selected";
                                                else {
                                                  if (isset($roww['Specialist']) && $roww['Specialist'] == "others") echo "selected";
                                                } ?>>others</option>
                      </select>
                      <br>
                      <?php

                      if (isset($err['generror'])) {
                        echo '<span id="gspan" style="color: red;" >' . $err['generror'] . '</span>';
                      }
                      ?>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputFile">File input</label>
                      <div class="input-group">
                        <div>
                          <input type="file" id="" name="Image">
                          <!-- <label  for="exampleInputFile">Choose file</label> -->
                        </div>

                      </div>
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
<?php 
include_once(nav.'footer.php');
?>
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