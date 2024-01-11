<?php

include_once('connect.php');
$id=$_GET['Id'];
if(!isset($id))
{
  header('location:login.php');
  echo "kindly register first";
}


if (isset($_REQUEST['Button'])) {


  
  $pass = $_REQUEST['Password'];
  $conf_pass = $_REQUEST['Conpass'];
  $err = array();

  if (empty($pass)) {
    $err['passerror'] = "Password is Required";
  }

  if (empty($conf_pass)) {
    $err['conpasserror'] = "Confirm Password is required";
  } else if ($conf_pass != $pass) {
    $err['conpasserror'] = "Password do not match";
  }

  if (empty($err)) {

    $password = md5($pass);
            //update query
            $query = "UPDATE user_data SET Password='$password' WHERE Id=$id";

            $exec = mysqli_query($conn, $query);

            if ($exec) {
                header('location:login.php');
            } else {
                $msg = "Error: " . $query . "<br>" . mysqli_error($connection);
                echo $msg;
            }
  }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Recover Password</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../css/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../css/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../css/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>Admin </b>Login</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">You are only one step a way from your new password, recover your password now.</p>

      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="Password" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock" id="pspan" style="color: red;" class="error"><?php echo isset($err['passerror']) ? $err['passerror'] : ''; ?></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="Conpass" placeholder="Confirm Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"  id="cpspan" style="color: red;" class="error"><?php echo isset($err['conpasserror']) ? $err['conpasserror'] : ''; ?></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" name="Button" class="btn btn-primary btn-block">Change password</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mt-3 mb-1">
        <a href="login.php">Login</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="../css/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../css/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../css/dist/js/adminlte.min.js"></script>
</body>
</html>
