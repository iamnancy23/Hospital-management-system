<?php
include_once('connect.php');
if (isset($_REQUEST['register'])) {
  $name = $_REQUEST['Name'];
  $email = $_REQUEST['Email'];
  $pass = $_REQUEST['Password'];
  $mob = $_REQUEST['Mobile'];
  $add = $_REQUEST['Address'];
  $gen = $_REQUEST['Gender'];
  $wanum = $_REQUEST['Wanumber'];


  $conf_pass = $_REQUEST['Conpass'];
  if (empty($name)  || trim($name) === '') {
    $err['nerror'] = "Name is Required";
  } else if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
    $err['nerror'] = "Only alphabets and white space are allowed";
  }

  if (empty($email)) {
    $err['emerror'] = "Email is Required";
  } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $err['emerror'] = "Invalid email format";
  }

  if (empty($pass)) {
    $err['passerror'] = "Password is Required";
  }

  if (empty($conf_pass)) {
    $err['conpasserror'] = "Confirm Password is required";
  } else if ($conf_pass != $pass) {
    $err['conpasserror'] = "Password do not match";
  }
  if (empty($add)) {
    $err['adderror'] = "Address is Required";
  }
  if (empty($gen)) {
    $err['generror'] = "Gender is required";
  }
  if (empty($mob)) {
    $err['moberror'] = "Number is Required";
  } else if (!preg_match('/^[0-9]{10}+$/', $mob)) {
    $err['moberror'] = "Invalid Number Format";
  }
  if (empty($wanum)) {
    $err['wamoberror'] = "Number is Required";
  } else if (!preg_match('/^[0-9]{10}+$/', $wanum)) {
    $err['wamoberror'] = "Invalid Number Format";
  }

  $duplicate = mysqli_query($conn, "select * from user_data where  Email='$email'");
  if (mysqli_num_rows($duplicate) > 0) {
    $err['emerror'] = "Email already exists";
  }

  if (empty($err)) {

    $password = md5($pass);


    $sql = "INSERT INTO user_data (Name,Email,Password,Mobile,Address,Gender,Unique_id,Whatsapp,Status) VALUES ('$_REQUEST[Name]','$_REQUEST[Email]','$password','$_REQUEST[Mobile]','$_REQUEST[Address]','$_REQUEST[Gender]',2,'$wanum',1)";
    if ($conn->query($sql)) {
      echo "<b>Registered successfully.<b><br />";


      $_REQUEST['Name'] = '';
      $_REQUEST['Email'] = '';
      $_REQUEST['Password'] = '';
      $_REQUEST['Conpass'] = '';
      $_REQUEST['Mobile'] = '';
      $_REQUEST['Address'] = '';
      $_REQUEST['Gender'] = '';
      $_REQUEST['Wanumber'] = '';
    } else if ($conn->errno) {
      echo "Could not insert record into table: %s<br />", $mysqli->error;
    }
  }
}


?>











<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registration Page</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../css/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../css/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../css/dist/css/adminlte.min.css">
</head>

<body class="hold-transition register-page">
  <div class="register-box" style="background-color:azure;">
    <div class="register-logo">
    <a href="" style="color:dodgerblue;"><b style="color:dodgerblue;">Health Care </b >Hospital</a>
    </div>

    <div class="card">
      <div class="card-body register-card-body">
        <p class="login-box-msg">Register a new membership</p>

        <form action="" method="post">
          <div class="input-group mb-3">
            <input type="text" class="form-control" name="Name" placeholder="Full Name" value="<?php echo isset($_REQUEST['Name']) ? $_REQUEST['Name'] : ''; ?>">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user" id="nspan" style="color: red;" class="error"><?php echo isset($err['nerror']) ? $err['nerror'] : ''; ?></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="email" class="form-control" name="Email" placeholder="Email" value="<?php echo isset($_REQUEST['Email']) ? $_REQUEST['Email'] : ''; ?>">

            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope" id="espan" style="color: red;" class="error"><?php echo isset($err['emerror']) ? $err['emerror'] : ''; ?></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" name="Password" placeholder="Password" value="<?php echo isset($_REQUEST['Password']) ? $_REQUEST['Password'] : ''; ?>">

            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock" id="pspan" style="color: red;" class="error"><?php echo isset($err['passerror']) ? $err['passerror'] : ''; ?></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" name="Conpass" placeholder="Retype password" value="<?php echo isset($_REQUEST['Conpass']) ? $_REQUEST['Conpass'] : ''; ?>">

            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock" id="cpspan" style="color: red;" class="error"><?php echo isset($err['conpasserror']) ? $err['conpasserror'] : ''; ?></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input id="Mobile" type="tel" class="form-control" name="Mobile" placeholder="Mobile" value="<?php echo isset($_REQUEST['Mobile']) ? $_REQUEST['Mobile'] : ''; ?>">

            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-phone" id="mobspan" style="color: red;" class="error"><?php echo isset($err['moberror']) ? $err['moberror'] : ''; ?></span>
              </div>
            </div>
          </div>
          <div>
            <label style="float: right;font-size:small" for="same_num">Same as above</label>
            <input style="float: right;" type="checkbox" name="same_num" id="same_num" value="Yes" onchange="myfun();">
          </div>

          <div class="input-group mb-3">

            <input id="Wanumber" type="tel" class="form-control" name="Wanumber" placeholder="Whatsapp Number" value="<?php echo isset($_REQUEST['Wanumber']) ? $_REQUEST['Wanumber'] : ''; ?>">


            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-phone" id="wamobspan" style="color: red;" class="error"><?php echo isset($err['wamoberror']) ? $err['wamoberror'] : ''; ?></span>
              </div>
            </div>
          </div>

          <div class="input-group mb-3">
            <input type="text" class="form-control" name="Address" placeholder="Address" value="<?php echo isset($_REQUEST['Address']) ? $_REQUEST['Address'] : ''; ?>">

            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-home" id="addspan" style="color: red;" class="error"><?php echo isset($err['adderror']) ? $err['adderror'] : ''; ?></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">

            <select class="form-control" name="Gender" id="Gender">
              <option value="">Gender</option>

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
            <div class="input-group-append">
              <div class="input-group-text">
                <?php

                if (isset($err['generror'])) {
                  echo '<span class="fas fa-text" id="gspan" style="color: red;" >' . $err['generror'] . '</span>';
                }
                ?>
              </div>
            </div>

          </div>
      </div>

      <div class="row">
        <div class="col-8">

        </div>
        <!-- /.col -->
        <div class="col-4">
          <button type="submit" class="btn btn-primary btn-block" name="register">Register</button>
        </div>
        <!-- /.col -->
      </div>
      </form>



      <a href="login.php" class="text-center">I already have a membership</a>
      <br>
      <a href="login.php" class="text-center">Login</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
  </div>
  <!-- /.register-box -->

  <!-- jQuery -->
  <script src="../css/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../css/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../css/dist/js/adminlte.min.js"></script>
  <!-- <script src="jquery-3.7.1.min.js"></script> -->
  <script>
       
    function myfun() {


      var samenum = $('#same_num').val();
      var mob = $('#Mobile').val();

      if (samenum == "Yes") {

        $('#Wanumber').val(mob);
      }



    }  
  </script>
</body>

</html>