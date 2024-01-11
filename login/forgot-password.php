<?php
define("cssfiles","../css/");
include_once('connect.php');
if (isset($_REQUEST['Button'])) {


  $email = $_REQUEST['Email'];
 
  $err = array();

  if (empty($email)) {
      $err['emerror'] = "Email is Required";
  } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $err['emerror'] = "Invalid email format";
  }
  

  if (empty($err)) {
    $query = "SELECT Id FROM  user_data WHERE Email='$email' ";
    $result = $conn->query($query);
    $rows = $result->fetch_assoc();

    
       
          header("Location:recover-password.php? Id=$rows[Id]");
      
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Forgot Password</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo cssfiles; ?>plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo cssfiles; ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo cssfiles; ?>dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../../index3.php"><b>Admin </b>Login</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>

      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="Email" placeholder="Email" value="<?php echo isset($_REQUEST['Email']) ? $_REQUEST['Email'] : ''; ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope" id="nspan" style="color: red;" class="error"><?php echo isset($err['emerror']) ?$err['emerror'] : ''; ?></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" name="Button" class="btn btn-primary btn-block">Request new password</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mt-3 mb-1">
        <a href="login.php">Login</a>
      </p>
      <p class="mb-0">
        <a href="register.php" class="text-center">Register a new membership</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?php echo cssfiles; ?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo cssfiles; ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo cssfiles; ?>dist/js/adminlte.min.js"></script>
</body>
</html>
