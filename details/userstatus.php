<?php


include_once('../define/define.php');
include_once(login .'connect.php');
if (!isset($_SESSION['login'])) {
  header("location:".login."login.php");
  exit();
}
if (isset($_REQUEST['submit'])) {
  $mob = $_REQUEST['mobnum'];




  if (empty($mob)) {
    $err['moberror'] = "Number is Required";
  } else if (!preg_match('/^[0-9]{10}+$/', $mob)) {
    $err['moberror'] = "Invalid Number Format";
  }
}
if(isset($_REQUEST['clear']))
{
    $_REQUEST['mobnum']='';
  
}
?>





<?php
$title="User Status";
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
              <h1>User Status</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?php echo login; ?>index3.php">Home</a></li>
                <li class="breadcrumb-item active">User Status</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid" >
          <div class="row">
            <!-- left column -->
            <div class="col-md-6">
              <!-- general form elements -->
              <div class="card card-primary" style="width: 1500px;">

                <!-- /.card-header -->
                <!-- form start -->
                <form>
                  <div class="card-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Mobile</label>
                      <input name="mobnum" type="tel" class="form-control" id="exampleInputEmail1" placeholder="Enter Number" value="<?php echo isset($_REQUEST['mobnum'])? $_REQUEST['mobnum']:''; ?>">
                      <span style=" color: red;" class="error" id="nspan"><?php echo isset($err['moberror']) ? '**' . $err['moberror'] : ''; ?></span>
                    </div>
                   


                  </div>
                  <!-- /.card-body -->

                  <div class="card-footer">
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    <button type="submit" style="background-color:darkgray;color:black"  name="clear" class="btn btn-primary">Clear</button>
                  </div>
                </form>

                <!-- /.row -->


                <!-- /.row -->




                <!-- /.col -->

                <!-- /.col -->
              </div>

            </div>
            <!-- /.col -->

            <!-- /.col -->
          </div>
        </div><!-- /.container-fluid -->
        <?php
        if (isset($_REQUEST['submit'])) {
          if (empty($err)) {

        ?>
            <div class="container-fluid">
              <div class="row">
                <div class="col-12">

                  <!-- /.card -->

                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">User Status </h3>
                    </div>
                    <!-- /.card-header -->
                    <?php
                    $q = "SELECT * FROM book_slot Where Mobile='$_REQUEST[mobnum]' ";
                    $result = $conn->query($q);

                    ?>
                    <div class="card-body">
                      <table id="example1" class="table table-bordered table-striped">
                        <thead>
                          <tr>
                           
                            <th>Name</th>
                            <th>Email</th>
                            <th>Slot Number</th>
                            
                            <th>Current Status</th>
                            <th>Your Status</th>
                            <th>Doctor Name</th>

                          </tr>
                        </thead>
                        <?php
                        $ro = mysqli_fetch_assoc($result);
                        $id = 1;
                        if (!empty($ro)) {
                        ?>
                          <tr>


                           
                            <td  style="background-color:dodgerblue;color:aliceblue"><?php echo $ro['Name']; ?></td>
                            <td  style="background-color:dodgerblue;color:aliceblue"><?php echo $ro['Email']; ?></td>
                            <td  style="background-color:dodgerblue;color:aliceblue"><?php echo $ro['Slot_No']; ?></td>
                            <td style="background-color:crimson;color:aliceblue"><?php echo "Not Started"; ?></td>
                            <td style="background-color:forestgreen;color:aliceblue"><?php echo "Your Number:". $ro['Id']; ?></td>
                            <?php
                            if ($ro['Doc_Id'] == 0) {
                            ?>
                              <td style="background-color:dodgerblue;color:aliceblue">No Tests Required</td>
                            <?php
                            } else {
                              $qu = "SELECT * FROM doctor_data Where Id='$ro[Doc_Id]'  ";
                              $re = $conn->query($qu);
                              $r = mysqli_fetch_assoc($re);
                            ?>
                              <td  style="background-color:dodgerblue;color:aliceblue"><?php echo $r['Name']; ?></td>
                          <?php }
                          }
                          ?>








                          </tr>


                          </tbody>

                      </table>
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>






        <?php


          }
        } else {
        }
        ?>
      </section>
      <!-- /.content -->

      <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
        <i class="fas fa-chevron-up"></i>
      </a>
    </div>
    <!-- /.content-wrapper -->
<?php
include_once(nav.'footer.php'); ?>
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