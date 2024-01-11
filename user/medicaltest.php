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
    <!-- Navbar -->
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
                  <h3 class="card-title">Medical Tests and Diagnostic Categories</h3>
                </div>
                <!-- /.card-header -->
                <?php
                $q = "SELECT * FROM tests Where c_id=0 ORDER BY c_name";
                $result = $conn->query($q);
                $id = 1;
                ?>
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>S.No</th>
                        <th>Test Categories</th>
                        <th>Sub Categories</th>
                        <th>Amount</th>
                        <th>Book Slot</th>

                      </tr>
                    </thead>
                    <?php
                    while ($rows = mysqli_fetch_assoc($result)) {
                    ?>
                      <tr>


                        <td><?php echo $id++; ?>
                        </td>
                        <td><?php echo $rows['c_name']; ?></td>






                        <td><a class="nav-link" href="medicallistsubcategory.php?Category=<?php echo $rows['c_name']; ?>">
                            <i class="fas fa-sign-out-alt"></i> <!-- Replace with your preferred logout icon -->
                            Sub Categories
                          </a></td>
                        <?php
                        $amou = 0;
                        $que = "SELECT * FROM tests Where c_id='$rows[Id]' ORDER BY c_name";


                        $res = $conn->query($que);
                        while ($roww = mysqli_fetch_assoc($res)) {
                          $amou = $amou + $roww['amount'];
                        }
                        ?>
                        <td><?php echo "Rs" . $amou; ?></td>
                        <?php
                        if ($amou != 0) {
                          $que = " 
                                                      UPDATE tests
                                                        SET amount='$amou'
                                                         WHERE Id='$rows[Id]' ";
                          $res = $conn->query($que);
                        }

                        ?>


                        <td>
                          <label style="text-align: center;" for="bookslot">Book Slot</label>
                          <input style="text-align:center;width:30px" type="checkbox" name="book_slots[]" id="book_<?php echo $rows['Id']; ?>" value="<?php echo $rows['Id']; ?>">

                        </td>

                      </tr>
                    <?php
                    }

                    // if (isset($_POST["book_slots"]) && is_array($_POST["book_slots"])) {
                    //   $bookSlots = $_POST["book_slots"];

                    //   // Loop through selected book slots
                    //   foreach ($bookSlots as $slotId) {
                    //     print_r($bookSlots);
                    //     // Handle each selected slot
                    //     // You can perform actions for each selected slot here
                    //     // Example: Book the selected slots
                    //   }
                    // }
                    ?>

                    </tbody>
                    <tfoot>
                      <tr>
                        <th>S.No</th>
                        <th>Test Categories</th>
                        <th>Sub Categories</th>
                        <th>Amount</th>
                        <th> <a href="" id="bookSelectedSlots" class="btn btn-primary"> <i class="fas fa-folder">
                            </i>Book Slots</a>


                        </th>

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



    // function myfun(id) {
    //   alert('hi');


    //   var samenum = $('#book_' + id).val();


    //   console.log(samenum);




    //   if (samenum != '') {



    //     $.ajax({
    //       type: 'post',
    //       data: {
    //         user_id: samenum
    //       },
    //       url: 'ajaxarray.php',
    //       success: function() {



    //       }
    //     });
    //   }


    // }
    $(document).ready(function() {
      // Capture the click event on the "Book Slots" anchor tag
      $("#bookSelectedSlots").click(function(e) {
        e.preventDefault(); // Prevent the default behavior of the anchor tag


        selectedSlots = ($("input[name='book_slots[]']:checked"));
        if ($("input[name='book_slots[]']:checked").length === 0) {
          alert("Please select at least one slot to book.");
        } else {
          arr = [];
          selectedSlots.each(function() {
            arr.push($(this).val());
          });
          console.log("hgfhg" + arr);
          
          location.href = 'testslot.php?arr='+arr;
          // $.ajax({
          //   type: 'POST',
          //   url: 'testslot.php',
          //   data: {
          //     arr: arr
          //   },
          //   success: function() {
           

          //   }
          // });
        }
      });
    });
  </script>
</body>

</html>