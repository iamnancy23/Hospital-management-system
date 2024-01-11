<?php

include_once('../define/define.php');
include_once(login .'connect.php');
if (!isset($_SESSION['login'])) {
  header("location:".login."login.php");
  exit();
}
if(isset($_REQUEST['submit']))

{
    $name = $_REQUEST['Name'];

    if (empty($name)  || trim($name) === '') {
        $err['nerror'] = "Name is Required";
      } else if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
        $err['nerror'] = "Only alphabets and white space are allowed";
      }
    
    if(empty($err))
    {
        header("location:../lists/labreport.php?name='$name'");
    }
    
   
     
}


?>









<?php
$title="Lab Report";
 include_once(nav.'header.php');
?>

<body class="hold-transition sidebar-mini">
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
              <h1>Lab Report</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?php echo login; ?>index3.php">Home</a></li>
                <li class="breadcrumb-item active">Lab Report</li>
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
            <div class="card card-primary" style="width:1500px">
             
              <!-- /.card-header -->
              <!-- form start -->
              <form >
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" name="Name" class="form-control" id="exampleInputEmail1" placeholder="Enter Name" value="<?php echo (isset($_REQUEST['Name'])) ? $_REQUEST['Name'] : ''; ?>">
                    <span style=" color: red;" class="error" id="nspan"><?php echo isset($err['nerror']) ? '**' . $err['nerror'] : ''; ?></span>

                  </div>
                
                <!-- /.card-body -->

                <div class="card-footer" >
                  <button type="submit"  name="submit" class="btn btn-primary">Submit</button>
                  
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