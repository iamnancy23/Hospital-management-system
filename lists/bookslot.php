<?php
include_once('../define/define.php');
include_once(login .'connect.php');
if (!isset($_SESSION['login'])) {
  header("location:".login."login.php");
  exit();
}
if (!empty($_REQUEST['Id'])) {
  $doc_id = $_REQUEST['Id'];
}

if (isset($_REQUEST['submit'])) {
  // echo $_REQUEST['Id'];

  $name = $_REQUEST['Name'];
  $email = $_REQUEST['Email'];
  $mob = $_REQUEST['Mobile'];
  $dob = $_REQUEST['Date'];
  $slot = $_REQUEST['Slot'];




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

  if (empty($dob)) {
    $err['doberror'] = "Date is Required";
  }
  if (empty($email)) {
    $err['emerror'] = "Email is Required";
  } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $err['emerror'] = "Invalid email format";
  }



  if (empty($err)) {
    $st="Booked";



    $sql = "INSERT INTO book_slot (Name,Email,Mobile,Date,Time,Doc_Id,Status) VALUES ('$_REQUEST[Name]','$_REQUEST[Email]', '$_REQUEST[Mobile]','$_REQUEST[Date]',' $_REQUEST[Slot]','$doc_id','$st')";
  
    if ($conn->query($sql)) {
      $slot = 1;

      $_REQUEST['Name'] = '';
      $_REQUEST['Email'] = '';
      $_REQUEST['Mobile'] = '';
      $_REQUEST['Date'] = '';
      $_REQUEST['Slot'] = '';
      $success = 'Slot Booked  !';
?>

<?php



    } else {
      echo "Could not insert record into table: %s<br />", $mysqli->error;
    }
  }
}


?>

<?php
$title="Book Slot";
include_once(nav.'header.php');
?>


  <style>
    .timeslot {
      /* background-color: #00c09d; */
      width: 150px;
      height: 50px;
      color: white;
      padding: 7px;
      margin-top: 5px;
      font-size: 18px;
      border-radius: 3px;
      vertical-align: center;
      text-align: center;
    }

    .timeslot:hover {
      background-color: #2CA893;
      cursor: pointer;
    }
  </style>


<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <?php include_once(nav.'rightnav.php');
    include_once(nav.'leftnav.php');
    ?>

   

 


    <!-- /.navbar -->



    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Book Appointment</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Book Appointment</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>


      <h3 style="color: green;"><?php echo isset($success) ? $success : ''; ?></h3>

      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- jquery validation -->
              <div class="card card-primary">
                <div class="card-header">
                  <!-- <h3 class="card-title">Quick Example <small>jQuery Validation</small></h3> -->
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form id="quickForm" action="../tables/blank.php">
                  <div class="card-body">
                    <div class="form-group">
                      <label for="exampleInputName">Full Name</label>
                      <input type="text" name="Name" class="form-control" id="exampleInputEmail1" placeholder="Enter Name" value="<?php if (isset($_REQUEST['Name'])) {
                                                                                                                                    echo $_REQUEST['Name'];
                                                                                                                                  } ?>">
                      <span style=" color: red;" class="error" id="nspan"><?php echo isset($err['nerror']) ? '**' . $err['nerror'] : ''; ?></span>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Email address</label>
                      <input type="email" name="Email" class="form-control" id="exampleInputEmail1" placeholder="Enter Email" value="<?php if (isset($_REQUEST['Email'])) {
                                                                                                                                        echo $_REQUEST['Email'];
                                                                                                                                      } ?>">
                      <span style=" color: red;" class="error" id="nspan"><?php echo isset($err['emerror']) ? '**' . $err['emerror'] : ''; ?></span>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Mobile</label>
                      <input type="tel" name="Mobile" class="form-control" id="exampleInputEmail1" placeholder="Enter Number" value="<?php if (isset($_REQUEST['Mobile'])) {
                                                                                                                                        echo $_REQUEST['Mobile'];
                                                                                                                                      } ?>">
                      <span style=" color: red;" class="error" id="nspan"><?php echo isset($err['moberror']) ? '**' . $err['moberror'] : ''; ?></span>
                    </div>
                    <div class="form-group">
                   <?php   $tomorrow = date("Y-m-d", strtotime("+1 day"));
                   $seven = date("Y-m-d", strtotime("+7 day"));?>
                      <label for="exampleInputEmail1">Date</label>
                      <input type="date" name="Date" class="form-control" id="exampleInputEmail1" min="<?php echo $tomorrow ?>" max="<?php echo $seven ?>" value="<?php if (isset($_REQUEST['Date'])) {
                                                                                                            echo $_REQUEST['Date'];
                                                                                                          } ?>">
                      <span style=" color: red;" class="error" id="nspan"><?php echo isset($err['doberror']) ? '**' . $err['doberror'] : ''; ?></span>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Time Slot :</label>
                      <br>
                      <select name="Slot" id="">
                        <option value="">Select Slot</option>
                        <option value="morning" <?php if (isset($_REQUEST['Slot']) && $_REQUEST['Slot'] == "morning") {
                                                  echo "selected";
                                                } ?>>10:00am-2:00pm</option>
                        <option value="evening" <?php if (isset($_REQUEST['Slot']) && $_REQUEST['Slot'] == "evening") {
                                                  echo "selected";
                                                } ?>> 6:00pm-10:00pm</option>
                      </select>
                      <?php
                      if (isset($err['generror'])) {
                        echo '<span id="gspan" style="color: red;" >' . $err['generror'] . '</span>';
                      }
                      ?>
                    </div>

                    <div class="form-group mb-0">
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="terms" class="custom-control-input" id="exampleCheck1">
                        <label class="custom-control-label" for="exampleCheck1">I agree to the <a href="#">terms of service</a>.</label>
                      </div>
                    </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="submit" name="submit" class="btn btn-primary" value="submit">Submit</button>
                    <input type="hidden" class="btn btn-primary" id="Id" name="Id" value="<?php if (isset($doc_id)) echo $doc_id;
                                                                                          else echo ''; ?>" />

                  </div>
                </form>
              </div>
              <!-- /.card -->
            </div>
            <!--/.col (left) -->
            <!-- right column -->
            <div class="col-md-6">

            </div>
            <!--/.col (right) -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
 <?php
 include_once(nav.'footer.php');
 ?>
 
  <script>
    $(function() {
      $.validator.setDefaults({
        submitHandler: function() {
          alert("Form successful submitted!");
        }
      });
      $('#quickForm').validate({
        rules: {
          Email: {
            required: true,
            Email: true,
          },
          Name: {
            required: true,
            name: true
          },
          Mobile: {
            required: true,
            Mobile: true
          },
          Date: {
            required: true,
            Date: true
          },
          Slot: {
            required: true,
            Slot: true
          },
          terms: {
            required: true
          },
        },
        messages: {
          Email: {
            required: "Please enter a email address",
            Email: "Please enter a valid email address"
          },
          Name: {
            required: "Please enter a Name",
            Name: "Please enter a Name"
          },
          Mobile: {
            required: "Please enter a Number",
            Mobile: "Please enter a Number"
          },
          Date: {
            required: "Please enter a Date",
            Date: "Please enter a Date"
          },
          Slot: {
            required: "Please select a Slot",
            Slot: "Please select a Slot"
          },
          terms: "Please accept our terms"
        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
          error.addClass('invalid-feedback');
          element.closest('.form-group').append(error);
        },
        highlight: function(element, errorClass, validClass) {
          $(element).addClass('is-invalid');
        },
        unhighlight: function(element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
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
</body>

</html>