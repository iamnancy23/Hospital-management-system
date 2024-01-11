<?php
include_once('../define/define.php');
include_once(login .'connect.php');
if (!isset($_SESSION['login'])) {
  header("location:".login."login.php");
  exit();
}

?>







<?php 
$title="Doctor List";
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
              <h1>Doctor's List</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Doctor List</li>
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
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Doctor's List</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body p-0">
            <table class="table table-striped projects">
              <thead>
                <tr>
                  <th style="width: 1%">
                    S.No
                  </th>
                  <th style="width: 20%">
                    Doctor Name
                  </th>
                  <th style="width: 30%">
                    Doctor Image
                  </th>
                  
                  <th style="width: 8%" class="text-center">
                    Doctor Status
                  </th>
                  <th style="width: 20%;text-align:center">Action
                  </th>
                </tr>
              </thead>

              <tbody>
                <?php
                while ($rows = $result->fetch_assoc()) {
                ?>
                  <tr>
                    <td>
                      <?php echo $id++;
                      ?>
                    </td>

                    <td>
                      <a>
                        <?php echo $rows['Name']; ?>
                      </a>
                      <br />
                      <!-- <small>
                      Created 01.01.2019
                    </small> -->
                    </td>
                    <td>
                      <ul class="list-inline">
                        <li class="list-inline-item">

                        </li>
                        <li class="list-inline-item">
                          <!-- <img alt="Avatar" class="table-avatar" src="../../dist/img/avatar2.png"> -->
                          <img style="width:90px;height:110px" class="table-avatar" src="data:image/png;base64,<?php echo $rows['image']; ?>" />
                        </li>
                        <li class="list-inline-item">

                        </li>
                        <li class="list-inline-item">

                        </li>
                      </ul>
                    </td>
                   
                    <td class="project-state">
                      <span  class="badge badge-success">Available</span>
                    </td>
                    <td class="project-actions text-right">
                      <a class="btn btn-primary btn-sm" href="bookslot.php?Id=<?php echo $rows['Id']; ?>">
                        <i class="fas fa-folder">
                        </i>
                        Book Slot
                      </a>
                      <a class="btn btn-warning btn-sm" href="docprofile.php?Id=<?php echo $rows['Id']; ?>">
                        <i class="fas fa-folder">
                        </i>
                        View Profile
                      </a>
                      <?php
                      $qu = "SELECT * FROM user_data WHERE Email='administrator@gmail.com'";
                      $res = $conn->query($qu);
                      $ro = mysqli_fetch_assoc($res);

                      if ($ro['Name'] == $_SESSION['user']) {
                        $q = "SELECT * FROM user_data WHERE Email='$rows[Email]'";
                        $r = $conn->query($q);
                        $roww = mysqli_fetch_assoc($r);

                      ?>

                        <button style="background-color:dodgerblue;"><a style="color:aliceblue" href="../user/adddoctor.php?Id=<?php echo $rows['Id']; ?>&UserId=<?php echo $roww['Id']; ?>">
                            <i class="fas fa-pencil-alt">
                            </i>
                            Edit
                          </a>
                          <button style="background-color: red;" onclick=" return condelete()"><a style="color:aliceblue" href="deletedata.php?Id=<?php echo $rows['Id']; ?>&UserId=<?php echo $roww['Id']; ?>">
                              <i class="fas fa-trash">
                              </i>
                              Delete
                            </a></button>
                        <?php

                      }
                        ?>

                    </td>
                  </tr>
                <?php
                }
                ?>






              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <?php
include_once(nav.'footer.php');
 ?>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- <script src="../../dist/js/demo.js"></script> -->
  <script>
    function condelete() {
      var agree = confirm("Are you sure?");
      if (agree == true) {
        return true;
      } else {
        return false;
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