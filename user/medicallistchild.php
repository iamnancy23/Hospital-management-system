<?php
include_once('../examples/connect.php');
if (!isset($_SESSION['login'])) {
    header("location:pages/examples/login.php");
    exit();
}
?>


<?php 
include_once('header.php');
?>


<body class="hold-transition sidebar-mini">
    <div class="wrapper">
       
    <?php 
include_once('rightnav.php');
include_once('leftnav.php');
?>

        
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Users List</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="../../index3.php">Home</a></li>
                                <li class="breadcrumb-item active">Users List</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">

                            <!-- /.card -->

                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Child Categories of <?php echo $_REQUEST['Subcat']; ?></h3>
                                </div>
                                <!-- /.card-header -->
                                <?php
                                $qu = "SELECT * FROM tests Where c_name='$_REQUEST[Subcat]' ";
                                $re = $conn->query($qu);
                                $r = mysqli_fetch_assoc($re);

                                $q = "SELECT * FROM tests Where c_id='$r[Id]' ORDER BY c_name";
                                $result = $conn->query($q);
                                $id = 1;
                                ?>
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Test Categories</th>
                                              
                                                <th>Action</th>
                                                <th>Amount</th>
                                                <th>Normal Range</th>
                                               
                                                
                                                

                                            </tr>
                                        </thead>
                                        <?php
                                        while ($rows = mysqli_fetch_assoc($result)) {
                                        ?>
                                            <tr>


                                                <td><?php echo $id++; ?>
                                                </td>
                                                <td><?php echo $rows['c_name']; ?></td>








                                                <td><a class="nav-link" href="medicaltest.php">
                                                        <i class="fas fa-sign-in-alt"></i> <!-- Replace with your preferred logout icon -->
                                                        Back
                                                    </a></td>
                                                    <td><?php echo "Rs".$rows['amount']; ?></td>
                                                    <td><?php echo $rows['normalval']; ?></td>
                                                  

                                            </tr>
                                        <?php
                                        }
                                        ?>

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Test Categories</th>
                                                <th>Action</th>
                                                <th>Amount</th>
                                                <th>Normal Range</th>
                                             

                                            </tr>
                                        </tfoot>
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
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <?php include_once('footer.php');
   ?>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="../../plugins/jszip/jszip.min.js"></script>
    <script src="../../plugins/pdfmake/pdfmake.min.js"></script>
    <script src="../../plugins/pdfmake/vfs_fonts.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <!-- <script src="../../dist/js/demo.js"></script> -->
    <!-- Page specific script -->
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
</body>

</html>