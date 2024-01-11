<?php
include_once('../define/define.php');
include_once(login .'connect.php');
if (!isset($_SESSION['login'])) {
  header("location:".login."login.php");
  exit();
}

?>








<?php 
$title="Patient's Queue";
include_once(nav.'header.php');
?>

<body class="hold-transition sidebar-mini">
  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- Navbar -->
   
    <?php include_once(nav.'rightnav.php');
    include_once(nav.'leftnav.php');
    ?>
     



    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Patient's Queue</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?php echo login; ?>index3.php">Home</a></li>
                <li class="breadcrumb-item active">Patient's Queue</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
      <?php
      $query = "SELECT * FROM doctor_data ";
      $result = $conn->query($query);
      $id = 1;
      ?>


      <!-- Main content -->
      <section class="content">

        <!-- Default box -->
        <div class="card card-solid">
          <div class="card-body pb-0">
            <div class="row">
              <?php
              while ($rows = $result->fetch_assoc()) {
              ?>
                <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                  <div class="card bg-light d-flex flex-fill">
                    <div class="card-header text-muted border-bottom-0">
                      <?php echo $rows['Specialist'] ?>
                    </div>
                    <div class="card-body pt-0">
                      <div class="row">
                        <div class="col-7">
                          <h2 class="lead"><b><?php echo $rows['Name']; ?></b></h2>
                          <p class="text-muted text-sm"><b>About: </b> <?php echo $rows['Specialist'] ?> </p>
                          <ul class="ml-4 mb-0 fa-ul text-muted">
                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Address: <?php echo $rows['Address']; ?></li>
                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone #: <?php echo $rows['Mobile']; ?></li>
                          </ul>
                        </div>
                        <div class="col-5 text-center">
                          <img style="height:200px;" src="data:image/png;base64,<?php echo $rows['image']; ?>" alt="user-avatar" class="img-circle img-fluid">
                        </div>
                      </div>
                    </div>
                    <div class="card-footer">
                      <div class="text-right">
                        <a href="#" class="btn btn-sm bg-teal">
                          <i class="fas fa-comments"></i>
                        </a>
                        <a href="patientlist.php?Id=<?php echo $rows['Id']; ?>" class="btn btn-sm btn-primary">
                          <i class="fas fa-user"></i> View Patient Queue
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              <?php }
              ?>

            </div>
          </div>
        </div>

        <!-- /.card-body -->
        <!-- <div class="card-footer">
          <nav aria-label="Contacts Page Navigation">
             <ul class="pagination justify-content-center m-0">
              <li class="page-item active"><a class="page-link" href="#">1</a></li>
              <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item"><a class="page-link" href="#">4</a></li>
              <li class="page-item"><a class="page-link" href="#">5</a></li>
              <li class="page-item"><a class="page-link" href="#">6</a></li>
              <li class="page-item"><a class="page-link" href="#">7</a></li>
              <li class="page-item"><a class="page-link" href="#">8</a></li>
            </ul> -->
          <!-- </nav>
        </div> -->
        <!-- /.card-footer -->
    </div>
    <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <?php
include_once(nav.'footer.php');
 ?>
  
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