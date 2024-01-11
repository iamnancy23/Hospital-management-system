<?php

include_once('connect.php');
if (isset($_SESSION['user'])) {
  header('location:index3.php');
}

if (isset($_REQUEST['Button'])) {
  // $otp = $_REQUEST['OTP'];

  $email = $_REQUEST['Email'];

  $pass = $_REQUEST['Password'];
  $err = array();

  if (empty($email)) {
    $err['emerror'] = "Email is Required";
  } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $err['emerror'] = "Invalid email format";
  }
  if (empty($pass)) {
    $err['passerror'] = "Password is Required";
  }
  if (empty($err)) {
    $password = md5($pass);
    $log = mysqli_query($conn, "select * from user_data where  Email='$email' AND Password = '" . $password . "' ");
    if (mysqli_num_rows($log) == 1) {
      $row = mysqli_fetch_assoc($log);
    } else {
      $err['passerror'] = "Password does not match";
    }
    $logs = mysqli_query($conn, "select * from user_data where  Email='$email' ");

    $rows = mysqli_fetch_assoc($logs);
    if (mysqli_num_rows($logs) == 1) {
      if ($rows['Status'] == 0) {
        $err['userstatus'] = "User Inactive";
      }
    }
    
    session_destroy();
    session_start();
    $_SESSION['user'] = $row["Name"];
    $_SESSION['Id']=$row['Id'];

    $_SESSION['inc_num'] = 1;

    $_SESSION['login'] = "open";
    $_SESSION['data']=rand(1,100);
  }
}
?>






<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Login</title>

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

  <!-- <h5 id="userst" style="color:dodgerblue;">Health Care Hospital</h5> -->
  <div class="login-box" style="background-color:azure;">
    <div class="login-logo">
      <a href="" style="color:dodgerblue;"><b style="color:dodgerblue;">Health Care </b>Hospital</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <!-- <p class="login-box-msg" style="color:red">Press Login and Wait for a minute to enter otp.</p> -->

        <form method="post">
          <div class="input-group mb-3">
            <input id="Email" type="email" class="form-control" name="Email" placeholder="Email" value="<?php echo isset($_REQUEST['Email']) ? $_REQUEST['Email'] : ''; ?>">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope" id="nspan" style="color: red;" class="error"><?php echo isset($err['emerror']) ? $err['emerror'] : ''; ?></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input id="Password" type="password" class="form-control" name="Password" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock" id="pspan" style="color: red;" class="error"><?php echo isset($err['passerror']) ? $err['passerror'] : ''; ?></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">

              <div class="icheck-primary">
                <input type="checkbox" id="remember">
                <label for="remember">
                  Remember Me
                </label>
              </div>
            </div>


            <!-- <div class="otp-input" style="display: none;">
              <div class="input-group mb-3">
                <input id="otp" type="number" class="form-control" name="OTP" placeholder="Enter OTP">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock" id="otpspan" style="color: red;" class="error" ><?php //echo isset($err['otperror']) ? $err['otperror'] : ''; 
                                                                                              ?></span>
                  </div>
                </div>


                <button type="submit" name="Button" class="btn btn-primary btn-block" onclick="verifyOtp()" >Login</button>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button id="btn" type="submit" name="Button" class="btn btn-primary btn-block">Login</button>

            </div>



            <!-- /.col -->
          </div>
        </form>



        <!-- /.social-auth-links -->

        <p class="mb-1">
          <a href="forgot-password.php">I forgot my password</a>
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
  <script src="../css/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../css/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../css/dist/js/adminlte.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>

</html>
<script>
  function validate() {
    err = [];
    var email = document.getElementById("Email").value;
    var pass = document.getElementById("Password").value;
    if (email == null || email == '') {
      document.getElementById("nspan").innerHTML = "**Email is Required";
      err.push(err["**Email is Required"]);
    } else {
      document.getElementById("nspan").innerHTML = "";
    }

    if (pass == null || pass == '') {
      document.getElementById("pspan").innerHTML = "**Password is Required";
      err.push(err["**Password is Required"]);
    } else {
      document.getElementById("pspan").innerHTML = "";
    }

    if (err.length > 0) {

      return false;
    }
    return true;

  }
</script>
<script>
  // var otp = '';

  // function generateOtp() {
  //   event.preventDefault();
  //   var val = validate();
  //   if (val == true) {
  //     var email = $('#Email').val();
  //     var pass = $('#Password').val();


  //     console.log(email);

  //     $.ajax({

  //       type: 'post',
  //       url: 'emailotp.php',
  //       data: {
  //         email: email,
  //         pass: pass
  //       },
  //       success: function(response) {
  //         var data = JSON.parse(response);
  //         if (data.status === 'success') {
  //           otp = data.otp;

  //           $('.otp-input').css("display", "block");
  //           $('#btn').css("display", "none");
  //         } else {

  //           var errors = data.errors;
  //           if (errors.hasOwnProperty('emerror')) {
  //             $('#nspan').text(errors['emerror']);
  //           } else {
  //             $('#nspan').text('');
  //           }
  //           if (errors.hasOwnProperty('passerror')) {
  //             $('#pspan').text(errors['passerror']);
  //           } else {
  //             $('#pspan').text('');
  //           }

  //         }
  //       }
  //     });
  //   }
  // }


  // function verifyOtp() {
  //   event.preventDefault();
  //     var otp = $('#otp').val();
  //     var email = $('#Email').val();

  //     console.log(email);
  //     console.log(otp);

  //     $.ajax({

  //       type: 'post',
  //       url: 'verifyotp.php',
  //       data: {
  //         email: email,
  //       otp: otp
  //       },
  //       success: function(response) {
  //         console.log(response);

  //         var data = JSON.parse(response);
  //         if (data.status === 'success') {
  //           location.replace("http://localhost/hospital/login/invlog.php")



  //         } else {

  //           var errors = data.errors;
  //           if (errors.hasOwnProperty('otperror')) {
  //             $('#otpspan').text(errors['otperror']);
  //           }
  //           if (errors.hasOwnProperty('userstatus')) {
  //             $('#userst').text(errors['userstatus']);
  //           }
  //         //   // // Handle OTP error here
  //         //   // $('#otpspan').text('OTP does not match');
  //         }

  //       }
  //     });
  //   }
</script>