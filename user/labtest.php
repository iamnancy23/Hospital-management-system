<?php
include_once('../define/define.php');
include_once(login .'connect.php');
if (!isset($_SESSION['login'])) {
  header("location:".login."login.php");
  exit();
}
$_SESSION['selected_categories'] = array();
?>

<?php
$title="Medical Tests";
include_once(nav.'header.php');
?>
<style>
  .clickable {
  cursor: pointer;
}
</style>


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
              <h1>Medical Tests</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Medical Tests</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <section class="content">
          <div class="container-fluid">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">Medical Tests</h3>
              </div> <!-- /.card-body -->
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-3" style="border:1px solid black;text-align:center;background-color:cyan">

                    <p><b><u>Test Categories</u></b></p>

                    <div>
                      <?php
                      $q = "SELECT * FROM tests Where c_id=0 ORDER BY c_name";
                      $result = $conn->query($q);
                      $id = 1;
                      ?>
                      <?php
                      while ($rows = mysqli_fetch_assoc($result)) {
                      ?>

                        <p class="clickable" data-color="black" data-background-color="ghostwhite" style="width: 400px;" id="cat_<?php echo $rows['Id']; ?>" value="<?php echo $rows['Id']; ?>" onclick="changestatus(<?php echo $rows['Id']; ?>);"><?php echo $rows['c_name']; ?></p><br>
                      <?php } ?>
                    </div>
                  </div>
                  <div class="col-sm-3" style="border:1px solid black;text-align:center;background-color:cyan">
                    <p><b><u>Sub Categories</u></b></p>
                    <div class="subcategories-column">

                    </div>
                  </div>
                  <div class="col-sm-3" style="border:1px solid black;text-align:center;background-color:cyan">
                    <p><b><u>Child Categories</u></b></p>
                    <div class="childcat"></div>
                  </div>
                  <div class="col-sm-3" style="border:1px solid black;text-align:center;background-color:cyan">
                    <p><b><u>Selected Categories</u></b></p>
                    <div style="text-align: center;">
                      <table class="table" style="text-align: center;">
                        <thead>
                          <th>Categories</th>
                          <th>Amount</th>
                        </thead>
                        <tbody class="selected-categories">

                        </tbody>
                        <tfoot>
                          <tr>
                            <th>Total</th>
                            <th><span id="totalAmount">0.00</span></th>
                          </tr>
                         
                        </tfoot>
                      </table>
                     


                    </div>
                    
                  </div>
                </div>
                <a style="float: right;" href="" id="bookSelectedSlots" class="btn btn-primary"> <i class="fas fa-folder">
                            </i>Book Slots</a>


              </div><!-- /.card-body -->
            </div>

          </div><!-- /.container-fluid -->
        </section>





        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
  <?php include_once(nav.'footer.php');
  ?>
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

    function changestatus(id) {
 
  
     
      if (id !== '') {
        $.ajax({
          type: 'post',
          data: {
            c_id: id
          },
          url: 'labsub.php',
          success: function(returnData) {

            var subcategories = returnData;


            $(".subcategories-column").html(subcategories);
          }

        });
      }
    }
    $(document).ready(function() {
  $(".clickable").click(function() {
    // Reset color of all paragraphs
    $(".clickable").css("color", "black");
    $(".clickable").css("background-color", "cyan");

    // Set the color of the clicked paragraph to red
    $(this).css("color", "white");
    $(this).css("background-color", "black");
  });
});

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