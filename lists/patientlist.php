<?php
include_once('../define/define.php');
include_once(login .'connect.php');
if (!isset($_SESSION['login'])) {
  header("location:".login."login.php");
  exit();
}

?>







<?php 
$title="Patient List";
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
              <h1>Patient's List</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Patient List</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>




    

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
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
                    <?php   $tomorrow = date("Y-m-d", strtotime("-2 day"));
                   $seven = date("Y-m-d", strtotime("+1 day"));?>
                      <label for="exampleInputEmail1">Date</label>
                      <input name="date" type="date" class="form-control" id="exampleInputEmail1" min="<?php echo $tomorrow ?>" max="<?php echo $seven ?>" placeholder="Enter Number" value="<?php echo isset($_REQUEST['mobnum'])? $_REQUEST['mobnum']:''; ?>">
                      <span style=" color: red;" class="error" id="nspan"><?php echo isset($err['moberror']) ? '**' . $err['moberror'] : ''; ?></span>
                    </div>
                   


                  </div>
                  <!-- /.card-body -->

                  <div class="card-footer">
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    <button type="submit" style="background-color:darkgray;color:black"  name="clear" class="btn btn-primary">Clear</button>
                    <a href="#" style="float:right"> <i class="fas fa-sign-out-alt"></i>Previous Schedule</a>
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
        
      <?php
      $query = "SELECT * FROM book_slot Where Date='$_REQUEST[date]'  order by Date ASC,Time DESC,Id ASC ";
      $result = $conn->query($query);
      $id = 1;
      ?>
        <!-- Default box -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Patient's List</h3>

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
                  <th style="width: 25%">
                    Patient Name
                  </th>

                  <th style="width: 25%">
                    Mobile
                  </th>
                  <th style="width: 20%">
                    Date/ Slot
                  </th>
                  <th style="width: 10%">
                    Status
                  </th>
                  <th style="width: 20%">
                    Add Prescription
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

                      <?php echo $rows['Name']; ?>


                    </td>
                    <td>

                      <?php echo $rows['Mobile']; ?>

                    </td>
                    <td>

                      <?php echo $rows['Date'];
                      echo " / ";
                      echo $rows['Time']; ?>



                    </td>
                    <td> <button class="<?php echo $rows['Status'] == 'Booked' ? 'btn btn-warning' : 'btn btn-success'; ?> status-button" id="status_<?php echo $rows['Id']; ?>" data-user-id="<?php echo $rows['Id']; ?>" data-status="<?php echo $rows['Status']; ?>" value="<?php echo $rows['Status'] == 'Booked' ? 'Booked' : 'Reached'; ?>" >
                              <?php echo $rows['Status'] == 'Booked' ? 'Booked' : 'Reached';  ?>
                            </button></td>
                            <td id="editdel_<?php echo $rows['Id']; ?>"> <button style="background-color:blue;color:white;" onclick=" return condelete()"><a style="color:aliceblue" href="../tables/addreport.php?Id=<?php echo $rows['Id']; ?>"><i class="fas fa-pencil-alt"></i>
                                                                Add </a></button></td>


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
include_once(nav.'footer.php');
 ?>


</body>
<script>
   function constatus() {


var agree = confirm("Are you sure?");
if (agree == true) {
  return true;
} else {
  return false;
}

}
   $(document).ready(function() {
      $('table tbody').on('click', '.status-button', function() {
        var st = constatus();
        if (st == true) {
          const userId = $(this).data('user-id');
          console.log("test" + userId);
          const currentStatus = $(this).data('status');
          console.log("jg" + currentStatus);




          const newStatus = currentStatus == 'Booked' ? 'Reached' : 'Booked';
          console.log(newStatus);

          $(this).text(newStatus == 'Booked' ? 'Booked' : 'Reached');
 
          if (newStatus == 'Booked') {
            $(this).removeClass('btn btn-success ')
            $(this).addClass('btn btn-warning ');

          }
          if (newStatus == 'Reached') {

            $(this).removeClass('btn btn-warning ')
            $(this).addClass('btn btn-success ');
          }



         
          $(this).data('status', newStatus);

         
          $.ajax({
            url: 'updatest.php', 
            method: 'POST',
            data: {
              userId: userId,
              status: newStatus
            },
            success: function(response) {
              // Handle the response if needed
              console.log(response);
            },
            error: function(xhr, status, error) {
              // Handle errors if needed
              console.error(xhr.responseText);
            }
          });
        }
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

</html>