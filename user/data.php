<?php
include_once('../define/define.php');
include_once(login .'connect.php');
if (!isset($_SESSION['login'])) {
  header("location:".login."login.php");
  exit();
}




if (isset($_REQUEST['submit'])) {
  $name = $_REQUEST['Name'];
  $email = $_REQUEST['Email'];
  $mob = $_REQUEST['Mobile'];
  $add = $_REQUEST['Address'];
  $gen = $_REQUEST['Gender'];
  print_r($_REQUEST);



  if (empty($name)  || trim($name) === '') {
    $err['nerror'] = "Name is Required";
  } else if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
    $err['nerror'] = "Only alphabets and white space are allowed";
  }



  if (empty($mob)) {
    $err['moberror'] = "Number is Required";
  } else if (!preg_match('/^[0-9]{10}+$/', $mob)) {
    $err['moberror'] = "Invalid Number Format";
  }

  if (empty($add)) {
    $err['a1error'] = "Address is Required";
  }
  if (empty($email)) {
    $err['emerror'] = "Email is Required";
  } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $err['emerror'] = "Invalid email format";
  }

  if (empty($gen)) {
    $err['generror'] = "Gender is required";
  }

  $duplicate = mysqli_query($conn, "select * from user_data where  Email='$email'");
  if (mysqli_num_rows($duplicate) > 0) {
    $err['emerror'] = "Email already exists";
  }





  if (empty($err)) {


    $sql = "INSERT INTO user_data (Name,Email,Mobile,Address,Gender) VALUES ('$_REQUEST[Name]','$_REQUEST[Email]', '$_REQUEST[Mobile]','$_REQUEST[Address]',' $_REQUEST[Gender]')";
    if ($conn->query($sql)) {

      $_REQUEST['Name'] = '';
      $_REQUEST['Email'] = '';
      $_REQUEST['Mobile'] = '';
      $_REQUEST['Address'] = '';
      $_REQUEST['Gender'] = '';
    } else if ($conn->errno) {
      echo "Could not insert record into table: %s<br />", $mysqli->error;
    }
  }
}

?>
<?php
$title="User List";
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
              <h1>Users List</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?php echo login; ?>index3.php">Home</a></li>
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
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Users List</h3>
                </div>

                <!-- /.card-header -->
                <!-- form start -->
                <!--  -->


                <?php
                $query = "SELECT * FROM user_data where Unique_id=2 ";
                $result = $conn->query($query);
                ?>

                <!-- /.card-header -->
                <div class="card-body">
                  <div class="btn-group">
                    <select id="status">
                      <option value="select status">select status</option>
                      <option value="Activate" id="Activate">Activate</option>
                      <option value="Deactivate" id="Deactivate">Deactivate</option>



                    </select>
                    <button class="status-select" name="status_check">Submit</button>

                  </div>


                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Whatsapp</th>
                        <th>Address</th>
                        <th>Gender</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php



                      while ($rows = $result->fetch_assoc()) {
                        $id = 1;




                      ?>


                        <tr id="body_<?php echo $rows['Id']; ?>">
                          <td id="name_<?php echo $rows['Id']; ?>"><?php echo $rows['Name']; ?></td>
                          <td id="email_<?php echo $rows['Id']; ?>"><?php echo $rows['Email']; ?></td>
                          <td id="mobile_<?php echo $rows['Id']; ?>"><?php echo $rows['Mobile']; ?></td>
                          <td id="whatsapp_<?php echo $rows['Id']; ?>"><?php echo $rows['Whatsapp']; ?></td>
                          <td id="add_<?php echo $rows['Id']; ?>"><?php echo $rows['Address']; ?></td>
                          <td id="gen_<?php echo $rows['Id']; ?>"><?php echo $rows['Gender']; ?></td>
                          <td> <button class="<?php echo $rows['Status'] == '1' ? 'btn btn-success' : 'btn btn-danger'; ?> status-button" id="status_<?php echo $rows['Id']; ?>" data-user-id="<?php echo $rows['Id']; ?>" data-status="<?php echo $rows['Status']; ?>" value="<?php echo $rows['Status'] == '1' ? 'Activate' : 'Deactivate'; ?>" onclick="colorchange(<?php echo $rows['Id'] ?>);">
                              <?php echo $rows['Status'] == '1' ? 'Activate' : 'Deactivate';  ?>
                            </button></td>
                          <td id="editdel_<?php echo $rows['Id']; ?>"><button style="background-color:dodgerblue;color:white" id="edit_<?php echo $rows['Id']; ?>" value="<?php echo $rows['Id']; ?>" onclick="changedata(<?php echo $rows['Id']; ?>);"><i class="fas fa-pencil-alt"></i>Edit</button> <button style="background-color:red;color:white;" onclick=" return condelete()"><a style="color:aliceblue" href="deletedata.php?Id=<?php echo $rows['Id']; ?>"><i class="fas fa-trash">
                                                                </i>Delete</a></button></td>
                        </tr>
                      <?php

                        if (isset($_REQUEST['status_check'])) {
                        }



                        if (isset($_REQUEST['toggle'])) {

                          $val = $_REQUEST['toggle'];
                          $q = "SELECT Id FROM user_data WHERE Id='$rows[Id]'";
                          $res = $conn->query($q);
                          if (mysqli_num_rows($res) > 0) {
                            if ($val == 'Activate') {
                              $qu = "UPDATE user_data SET Status='1' Where Id='$rows[Id]'";
                            } else {
                              $qu = "UPDATE user_data SET Status='0' Where Id='$rows[Id]'";
                            }
                            if ($conn->query($qu)) {
                              echo "done";
                            } else {
                              echo "Error updating record: " . $conn->error;
                            }
                          }
                        }
                      }
                      ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Whatsapp</th>
                        <th>Address</th>
                        <th>Gender</th>
                        <th>Status</th>
                        <th>Action</th>
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
    <?php include_once(nav.'footer.php');
    ?>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

 
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
      // Initialize DataTable
      var table = $('#example1').DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#button-container');
      $('.status-select').click(function() {
        var st = $('#status').attr('id') === 'activate' ? 'activate' : 'deactivate';
      })


    });
    $(document).ready(function() {
      $('table tbody').on('click', '.status-button', function() {
        var st = constatus();
        if (st == true) {
          const userId = $(this).data('user-id');
          console.log("test" + userId);
          const currentStatus = $(this).data('status');
          console.log("jg" + currentStatus);




          const newStatus = currentStatus == '1' ? '0' : '1';
          console.log(newStatus);

          $(this).text(newStatus == '1' ? 'Activate' : 'Deactivate');
 
          if (newStatus == 1) {
            $(this).removeClass('btn btn-danger ')
            $(this).addClass('btn btn-success ');

          }
          if (newStatus == 0) {

            $(this).removeClass('btn btn-success ')
            $(this).addClass('btn btn-danger ');
          }



         
          $(this).data('status', newStatus);

         
          $.ajax({
            url: 'update_status.php', 
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




    $(document).ready(function() {
      selectstatus();


    });

    function selectstatus() {
      $("#status").change(function() {
        var status = $(this).val();
        console.log(status);



        if (status == 'select status') {
          void(0);
        } else {



          $.ajax({
            type: 'post',
            data: {
              status: status
            },
            url: 'ajax_request.php',
            success: function(returnData) {
              var $tr = $('<tr/>');
              $tr.append($('<td/>').html(returnData.n));
              $tr.append($('<td/>').html(returnData.e));
              $tr.append($('<td/>').html(returnData.m));
              $tr.append($('<td/>').html(returnData.w));
              $tr.append($('<td/>').html(returnData.a));
              $tr.append($('<td/>').html(returnData.g));
              $('.table tr:last').before($tr);



              $("#example1").html(returnData);
            }
          });
        }


      })
    }




    function condelete() {
      var agree = confirm("Are you sure?");
      if (agree == true) {
        return true;
      } else {
        return false;
      }

    }

    function changedata(id) {


      var getID = $('#edit_' + id).val();



      if (getID != '') {



        $.ajax({
          type: 'post',
          data: {
            user_id: getID
          },
          url: 'ajaxedit_request.php',
          success: function(returnData) {



            $("#body_" + id).html(returnData);
          }
        });
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