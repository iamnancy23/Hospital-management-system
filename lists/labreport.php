<?php
include_once('../define/define.php');
include_once(login .'connect.php');

$title="Lab Report";
include_once(nav.'header.php'); ?>

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
                            <h1>Lab Report</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Lab Report</li>
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
                                <div class="col-4">
                        <img src="../icons/healthcare.png" alt="logo">
                        </div>

                                    <div class="col-4"><br><br>
                                    
                                        <h4 style="float:left;color:crimson;width:800px">
                                        <b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Health Care Hospital</b>
                                      
                                          
                                        </h4>
                                        <address ><b>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Noida Sector 63 <br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Uttar Pradesh,India<br></b>
                                           


                                        </address>
                                    </div>
                                    <div class="col-4">
                                    
                        <img style="width:200px;float:right" src="../icons/health.jpg" alt="logo">
                        </div>
                                    <!-- /.col -->
                                </div>
                                <!-- info row -->
                                <?php
                                $que = "SELECT * FROM patientdata Where p_name=$_REQUEST[name] ";



                                $res = $conn->query($que);
                                $roww = mysqli_fetch_assoc($res);

                                $q = "SELECT * FROM patvalue Where data_id='$roww[data_id]' ORDER BY category";




                                $r = $conn->query($q);
                                $row = mysqli_fetch_assoc($r);

                                $quer = "SELECT * FROM tests Where Id='$row[category]' ";




                                $resu = $conn->query($quer);
                                $rowss = mysqli_fetch_assoc($resu);

                                $query = "SELECT * FROM tests Where Id='$rowss[c_id]' ";




                                $resul = $conn->query($query);
                                $rows = mysqli_fetch_assoc($resul);


                                $queryy = "SELECT * FROM tests Where Id='$rows[c_id]' ";




                                $result = $conn->query($queryy);
                                $rowsss = mysqli_fetch_assoc($result);
                              


                                ?>
                                <div class="row invoice-info">
                                    <div class="col-sm-4 invoice-col">

                                        <address>
                                            <strong>Name: <?php echo $roww['p_name']; ?></strong><br>
                                            <strong>Ref By: <?php echo $roww['d_name']; ?></strong><br>
                                            <strong>Test Category: <?php  echo $rowsss['c_name']; ?></strong><br>


                                        </address>
                                    </div>
                                    <div class="col-sm-4 invoice-col">

</div>
                                    <!-- /.col -->
                                    <div class="col-sm-4 invoice-col">

                                        <address>
                                            <strong>Date : <?php echo $roww['date']; ?></strong><br>
                                            <strong>Age: <?php echo $roww['age']; ?></strong><br>

                                            <strong>Gender : <?php echo $roww['gender']; ?></strong><br>

                                        </address>
                                    </div>

                                    <!-- /.col -->
                                
                                    <!-- /.col -->
                                </div>
                                <br>
                                
                                <!-- /.row -->

                                <!-- Table row -->
                                <div class="row">
                                    
                                
                                    <div class="col-12 table-responsive">
                                        <h2 ><i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Complete Analysis</i></h2>
                                        <br>
                                      
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th style="text-align: center;">Category</th>
                                                    <th style="text-align: center;">Patient Value</th>
                                                    <th style="text-align: center;">Normal Value</th>

                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php

                                                $q = "SELECT * FROM patvalue Where data_id='$roww[data_id]' ORDER BY category";




                                                $r = $conn->query($q);
                                                while ($row = mysqli_fetch_assoc($r)) {

                                                    $quer = "SELECT * FROM tests Where Id='$row[category]' ORDER BY c_name";



                                                    $resu = $conn->query($quer);
                                                    while ($rowss = mysqli_fetch_assoc($resu)) {



                                                ?>

                                                        <tr>


                                                            <td style="text-align: center;"><?php echo $rowss['c_name']; ?></td>


                                                            <td style="text-align: center;"><?php echo $row['pat_val']; ?>

                                                            </td >
                                                            <td style="text-align: center;"><?php echo $rowss['normalval']; ?>

                                                            </td>



                                                        </tr>
                                                <?php }
                                                } ?>


                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->

                                <div class="row">
                                    <!-- accepted payments column -->

                                    <!-- /.col -->
                                    <div class="col-6">


                                        <div class="table-responsive">

                                        </div>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->

                                <!-- this row will not appear when printing -->
                                <div class="row no-print">
                                    <div class="col-12">
                                        <button style="background-color:lightgrey;" class="btn btn-default" onClick="window.print()"><i class="fas fa-print"></i> Print</button>

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
       <?php include_once(nav.'footer.php'); ?>
  
    <!-- <script src="../../dist/js/demo.js"></script> -->
<script>
    
    (function() {
            var nav = document.getElementsByClassName('nav-link ');
            var current = window.location.href;
            // console.log(current);

            for (var i = 0; i < nav.length; i++) {
            //   console.log("cu"+nav[i].href);
              if (nav[i].href === current) {
                nav[i].classList.add('active');
              }
            
            }
          })();
</script>

</body>

</html>