<?php
include_once('connect.php');
if (!isset($_SESSION['login'])) {
  header("location:pages/examples/login.php");
  exit();
}
?>




<?php
$title="Contact Us";
 include_once('header.php');
?>

<body class="hold-transition sidebar-mini">
  <!-- Site wrapper -->
  <div class="wrapper">
    
       
  <?php include_once('rightnav.php');
  include_once('leftnav.php');
    ?>

    <!-- /.navbar -->

    

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Contact us</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Contact us</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">

        <!-- Default box -->
        <div class="card">
          <div class="card-body row">
            <div class="col-5 text-center d-flex align-items-center justify-content-center">
              <div class="">
                <h2>Admin<strong>LTE</strong></h2>
                <p class="lead mb-5">123 Testing Ave, Testtown, 9876 NA<br>
                  Phone: +1 234 56789012
                </p>
              </div>
            </div>
            <div class="col-7">
              <div class="form-group">
                <label for="inputName">Name</label>
                <input type="text" id="inputName" class="form-control" />
              </div>
              <div class="form-group">
                <label for="inputEmail">E-Mail</label>
                <input type="email" id="inputEmail" class="form-control" />
              </div>
              <div class="form-group">
                <label for="inputSubject">Subject</label>
                <input type="text" id="inputSubject" class="form-control" />
              </div>
              <div class="form-group">
                <label for="inputMessage">Message</label>
                <textarea id="inputMessage" class="form-control" rows="4"></textarea>
              </div>
              <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Send message">
              </div>
            </div>
          </div>
        </div>

      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php
 include_once('navbars/footer.php');
 ?>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="../../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../../dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <!-- <script src="../../dist/js/demo.js"></script> -->
</body>

</html>