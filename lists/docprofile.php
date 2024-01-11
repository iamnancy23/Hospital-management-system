<?php
include_once('../define/define.php');
include_once(login .'connect.php');
if (!isset($_SESSION['login'])) {
  header("location:".login."login.php");
  exit();
}
if (isset($_REQUEST['Id'])) {
    $id = $_REQUEST['Id'];
}
?>





<?php
$title = "Profile";
include_once(nav.'header.php');
?>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->


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
                            <h1>Profile</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">About</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3">

                            <?php
                            $query = "SELECT * FROM doctor_data where Id=$id; ";
                            $result = $conn->query($query);
                            $rows = mysqli_fetch_assoc($result);
                            ?>

                            <!-- Profile Image -->
                            <div class="card card-primary card-outline">
                                <div class="card-body box-profile">
                                    <div class="text-center">
                                        <img style="height:250px;width:200px" src="data:image/png;base64,<?php echo $rows['image']; ?>" alt="user-avatar" class="img-circle img-fluid">
                                    </div>

                                    <h3 class="profile-username text-center"><?php echo $rows['Name']; ?></h3>

                                    <p class="text-muted text-center"><?php echo $rows['Specialist']; ?></p>
                                   <p class=" text-center"> <strong style="text-align: center;" ><i class="fas fa-map-marker-alt mr-1"></i> Location</strong><br><?php echo $rows['Address']; ?></p>

                                 

                                
                                </div>
                       
                            </div>
                           
                            <div >
                                <div >
                                  
                                </div>
                             
                            </div>
                            
                        </div>
                        <!-- /.col -->
                        <div class="col-md-9">
                            <div class="card">

                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="active tab-pane" id="activity">

                                            <div class="post">

                                                <div class="tab-pane" id="settings">
                                                    <form class="form-horizontal">
                                                        <div class="form-group row">
                                                            <label for="inputName" class="col-sm-2 col-form-label">Name :</label>
                                                            <div class="col-sm-10">
                                                                <p class="form-control"><b><?php echo $rows['Name']; ?></b></p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="inputEmail" class="col-sm-2 col-form-label">Email :</label>
                                                            <div class="col-sm-10">
                                                                <p class="form-control"><b><?php echo $rows['Email']; ?></b></p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="inputName2" class="col-sm-2 col-form-label">Address :</label>
                                                            <div class="col-sm-10">
                                                                <p class="form-control"><b><?php echo $rows['Address']; ?></b></p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="inputExperience" class="col-sm-2 col-form-label">Mobile :</label>
                                                            <div class="col-sm-10">
                                                                <p class="form-control"><b><?php echo $rows['Mobile']; ?></b></p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="inputSkills" class="col-sm-2 col-form-label">Specialist :</label>
                                                            <div class="col-sm-10">
                                                                <p class="form-control"><b><?php echo $rows['Specialist']; ?></b></p>
                                                                <br>
                                                            </div>
                                                        </div>


                                                    </form>
                                                </div>
                                                <!-- /.tab-pane -->

                                                <!-- /.user-block -->
                                                <div class="row mb-3">

                                                    <!-- /.col -->

                                                </div>
                                                <!-- /.row -->



                                            </div>
                                            <!-- /.post -->
                                        </div>
                                        <!-- /.tab-pane -->
                                      
                                        <!-- /.tab-pane -->
                                    </div>
                                    <!-- /.tab-content -->
                                </div><!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <?php
      include_once(nav.'footer.php');
        ?>
        <!-- /.control-sidebar -->
  
    <!-- <script src="../../dist/js/demo.js"></script> -->
</body>

</html>