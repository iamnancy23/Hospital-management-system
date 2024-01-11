<?php
include_once('../define/define.php');
include_once(login .'connect.php');

$title="Invoice";
include_once(nav.'header.php'); ?>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <!-- Navbar -->
    <?php
    include_once(nav.'rightnav.php');

    include_once(nav.'leftnav.php');
    $idsParam = isset($_REQUEST['Id']) ? $_GET['Id'] : '';

    // Split the 'Id' parameter value by comma to create an array
    $idArray = explode(',', $idsParam);

    // Trim each element in the array to remove any leading/trailing spaces
    $idArray = array_map('trim', $idArray);

    // Print the resulting array
    // print_r($idArray);
   
   


    ?>



    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Invoice</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Invoice</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">



              <!-- Main content -->
              <div class="invoice p-3 mb-3">
                <!-- title row -->
                <div class="row">
                  <div class="col-12">
                    <h4>
                      <i class="fas fa-globe"></i>Health Care Hospital
                      <?php  $today = date("d/m/Y"); ?>
                      <small class="float-right">Date:<?php echo $today ?></small>
                    </h4>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- info row -->
                <div class="row invoice-info">
                  <div class="col-sm-4 invoice-col">
                    Hospital Address
                    <address>
                      <strong>Health Care Hospital</strong><br>
                      Noida Sector 63<br>
                      Uttar Pradesh ,India<br>
                      Phone: (804) 123-5432<br>
                      Email: info@almasaeedstudio.com
                    </address>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 invoice-col">
                    Patient Details
                    <address>
                      <strong>Name : <?php echo $_REQUEST['name']; ?></strong><br>

                      Phone: <?php echo $_REQUEST['mob']; ?><br>


                    </address>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 invoice-col">
                    <b>Invoice #007612</b><br>

                    <b>Payment Mode:</b>Online<br>

                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- Table row -->
                <div class="row">
                  <div class="col-12 table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>S.No.</th>
                          <th> Categories</th>

                          <th>Amount</th>


                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $id = 1;
                        for ($i = 0; $i < count($idArray); $i++) {
                        


                        ?>
                          <tr>


                            <td><?php echo $id++; ?></td>
                            <td><?php echo $idArray[$i]; ?></td>


                            <td>
                              <?php
                              $qu = "SELECT * FROM tests Where c_name='$idArray[$i]' ORDER BY c_name";



                              $re = $conn->query($qu);
                              while ($row = mysqli_fetch_assoc($re)) {

                              



                              ?><?php echo   $row['amount']; ?>
                              <br>

                          <?php }
                            }
                          ?>
                            </td>



                          </tr>

                      </tbody>
                    </table>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->

                <div class="row">
                  <!-- accepted payments column -->
                  <div class="col-6">
                    <p class="lead">Payment Methods:</p>
                    <img src="../css/dist/img/credit/visa.png" alt="Visa">
                    <img src="../css/dist/img/credit/mastercard.png" alt="Mastercard">
                    <img src="../css/dist/img/credit/american-express.png" alt="American Express">
                    <img src="../css/dist/img/credit/paypal2.png" alt="Paypal">

                    <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                      Select the Card of your choice.
                  </div>
                  <!-- /.col -->
                  <div class="col-6">
                    <p class="lead">Total Amount</p>

                    <div class="table-responsive">
                      <table class="table">
                        <tr>
                          <th style="width:50%">Total:</th>
                          <?php
                          $sum = 0;
                          for ($i = 0; $i < count($idArray); $i++) {

                            $que = "SELECT * FROM tests Where c_name='$idArray[$i]'";
                         



                            $res = $conn->query($que);
                            while ($roww = mysqli_fetch_assoc($res)) {
                         
                              $sum = $sum + $roww['amount'];
                            }
                          }
                          ?>


                          <td><?php echo $sum; ?></td>

                        </tr>


                      </table>
                    </div>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
                <?php
                 $qu = "SELECT * FROM user_data Where Mobile='$_REQUEST[mob]'";
                         



                 $re = $conn->query($qu);
                 $ro = mysqli_fetch_assoc($re);
                
                 $chk = "";
                 for ($i = 0; $i < count($idArray); $i++) {
                     $chk .= $idArray[$i] . ",";
                 
                 }
                 $s = "INSERT INTO book_tests(p_name,p_num,tests,t_amt,user_id) VALUES ('$_REQUEST[name]','$_REQUEST[mob]','$chk','$sum','$ro[Id]')";
           
                 if ($conn->query($s)) {
                     echo "inserted";
                   
                 } ?>

                <!-- this row will not appear when printing -->
                <div class="row no-print">
                  <div class="col-12">
                    <button style="background-color:lightgrey;" class="btn btn-default" onClick="window.print()"><i class="fas fa-print"></i> Print</button>
                    <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                      Payment
                    </button>
                    <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                      <i class="fas fa-download"></i> Generate PDF
                    </button>
                  </div>
                </div>
              </div>
              <!-- /.invoice -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php
    include_once(nav.'footer.php'); ?>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->


  <!-- AdminLTE for demo purposes -->
  <!-- <script src="../../dist/js/demo.js"></script> -->

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