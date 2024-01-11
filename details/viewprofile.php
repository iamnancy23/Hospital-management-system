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
    $mob = $_REQUEST['Mobile'];
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
      if(empty($err))
      {
       
        
        $q="SELECT * FROM patient_profile WHERE Name='$_REQUEST[Name]' AND Mobile='$_REQUEST[Mobile]'";
   
       
        $res=$conn->query($q);
        $roww=mysqli_fetch_assoc($res);
       
        if(mysqli_num_rows($res)>0){
         
        header("location:../lists/patprofile.php?Id='$roww[Id]'");}
        else{
          $error="Details Entered are wrong!";
        }
      }else{
        $error="User doesn't exist!";
      }
      }
     



?>









<?php
$title="View Profile";
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
              <h1>View Profile</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?php echo login; ?>index3.php">Home</a></li>
                <li class="breadcrumb-item active">View Profile</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        
        <h5 style="text-align: center;color:crimson"><?php if(isset($error)){ echo $error;}else{ echo "";} ?></h5>
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
                  <div class="form-group">
                    <label for="exampleInputPassword1">Mobile</label>
                    <input name="Mobile" type="tel" class="form-control" id="exampleInputPassword1" placeholder="Enter Number" value="<?php echo isset($_REQUEST['Mobile'])? $_REQUEST['Mobile']:''; ?>">
                    <span style=" color: red;" class="error" id="nspan"><?php echo isset($err['moberror']) ? '**' . $err['moberror'] : ''; ?></span>
                  </div>
                 
                  
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
 <?php
 include_once(nav.'footer.php'); ?>
  <!-- <script src="../dist/js/demo.js"></script> -->

</body>


</html>