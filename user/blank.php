<?php
include_once('../define/define.php');
include_once(login .'connect.php');
if (!isset($_SESSION['login'])) {
  header("location:".login."login.php");
  exit();
}
$st="Booked";
$doc_id = $_REQUEST['Id'];
$name = $_REQUEST['Name'];
$email = $_REQUEST['Email'];
$mob = $_REQUEST['Mobile'];
$date = $_REQUEST['Date'];
$time = $_REQUEST['Slot'];

$sql = "INSERT INTO book_slot (Name,Email,Mobile,Date,Time,Doc_Id,Status) VALUES ('$_REQUEST[Name]','$_REQUEST[Email]', '$_REQUEST[Mobile]','$_REQUEST[Date]',' $_REQUEST[Slot]','$doc_id','$st')";
if ($conn->query($sql)) {
}


?>

<?php 
$title="Appointment Slip";
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
              <h1>Appointment Slip</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Appointment Slip</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-6">
              <div class="card">


                <!-- /.card -->

              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->

            <!-- /.card -->

            <div class="card">


              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->


        <!-- /.row -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">


                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">


                    <div class="input-group-append">

                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 300px;">
                <table class="table table-head-fixed text-nowrap">

                  <thead>
                    <tr>
                      <th>Slot Number</th>
                      <th>Patient Name</th>
                      <th>Date</th>
                      <th>Time</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>


                    <tr>
                      <?php
                    $sl=rand(1,1000);



                      $slot = $doc_id . '' .$sl;
                      ?>
                      <td><?php echo $slot; ?></td>
                      <td><?php echo $name; ?></td>
                      <td><?php echo $date; ?></td>
                      <td><span class="tag tag-success"><?php echo $time; ?></span></td>
                      <td>Approved</td>

                    </tr>
                    <?php



                    $query = "Update  book_slot SET Slot_No='$slot' Where Email='$email'";
                    if ($conn->query($query)) {
                    }




                    ?>

                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>


    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include_once(nav.'footer.php');
   ?>
  <!-- /.control-sidebar -->
  </div>
 
  <script>
    
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