 

  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->


      <a href="index3.php" class="brand-link">
        <?php 
        $icon = "../icons/ho.jfif";
        ?>
        <img src="<?php echo $icon; ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light" style="color:aqua;">Health Care Hospital</span>
      </a>
      <?php 
      
      $query = "SELECT * FROM user_data where Name='$_SESSION[user]' ";

      $result = $conn->query($query);
     $rows=mysqli_fetch_assoc($result);
     if($rows['Unique_id']==1){
      ?>
       <a href="<?php echo login; ?>index3.php" class="brand-link">
      
      <?php 
       $qu = "SELECT * FROM doctor_data where Name='$_SESSION[user]'  ";
       $res = $conn->query($qu);
      $r=mysqli_fetch_assoc($res); ?>
      <img style="opacity: .8" class="brand-image img-circle " src="data:image/png;base64,<?php echo $r['image']; ?>" />
      <span class="brand-text font-weight-light"><?php echo  $_SESSION['user'] ?></span>
    </a>
    <?php

   }
   else if($rows['Unique_id']==2)
   { ?>
   <a href="<?php echo login; ?>index3.php" class="brand-link">
   
      <?php 
       $qu = "SELECT * FROM patient_profile where Name='$_SESSION[user]'  ";
    
       $res = $conn->query($qu);
      $ro=mysqli_fetch_assoc($res);

      if(mysqli_num_rows($res)>0) {?>
      <img  class="brand-image img-circle elevation-3" src="data:image/png;base64,<?php echo $ro['Image']; ?>" style="opacity: .8" />
      <span class="brand-text font-weight-light"><?php echo  $_SESSION['user'] ?></span>
    </a>
    <?php 
      }else{
        ?>
         <a href="<?php echo login; ?>index3.php" class="brand-link">
        <?php $in = strtoupper(substr($_SESSION['user'], 0, 1));
        $icon = "../icons/icon_" . $in . ".png";
        ?>
        <img src="<?php echo $icon; ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><?php echo  $_SESSION['user'] ?></span>
      </a>

     <?php 

     }}
    
     else{
      ?>
     <a href="<?php echo login; ?>index3.php" class="brand-link">
        <?php $in = strtoupper(substr($_SESSION['user'], 0, 1));
        $icon = "../icons/icon_" . $in . ".png";
        ?>
        <img src="<?php echo $icon; ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><?php echo  $_SESSION['user'] ?></span>
      </a>
      <?php } ?>


      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user (optional) -->
      

        <!-- SidebarSearch Form -->
        <div class="form-inline">
          <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search"> 
            <div class="input-group-append">
              <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item menu-open">
              <a href="<?php echo login; ?>index3.php" class="nav-link ">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
             
                  Dashboard
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>

            </li>
            <li class="nav-item">
              <?php
              $q = "SELECT * FROM user_data WHERE Unique_id=0";
              $res = $conn->query($q);
              $ro = mysqli_fetch_assoc($res);
              if ($ro['Name'] == $_SESSION['user']) {

              ?>
                <a href="#" class="nav-link">
                  <i class="nav-icon far fa-user"></i>
                  <p>
                    User Details
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>

                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo user; ?>data.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>User List</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo user; ?>adduser.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Add User</p>
                    </a>
                  </li>

                </ul>
              <?php
              }
              ?>
            </li>
            <?php
                  $q = "SELECT * FROM user_data WHERE Unique_id=0";
                  $res = $conn->query($q);
                  $ro = mysqli_fetch_assoc($res);
                  if ($ro['Name'] == $_SESSION['user']) {?>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon far fa-user"></i>
                <p>
                  Doctor's Details
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>

              <ul class="nav nav-treeview">

                <li class="nav-item">
                  <a href="<?php echo lists; ?>doctorlist.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Doctors List</p>
                  </a>
                </li>
                <li class="nav-item">
                  <?php
                  $q = "SELECT * FROM user_data WHERE Unique_id=0";
                  $res = $conn->query($q);
                  $ro = mysqli_fetch_assoc($res);
                  if ($ro['Name'] == $_SESSION['user']) {

                  ?>
                    <a href="<?php echo user; ?>adddoctor.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p> Add Doctor</p>
                    </a>
                  <?php }
                  ?>
                </li>
              </ul>
              <?php } ?>
            </li>
            <li class="nav-item">
              <?php
              $q = "SELECT * FROM user_data WHERE Unique_id!=1";
       
              $res = $conn->query($q);
              while ($ro = mysqli_fetch_assoc($res)) {
                if ($ro['Id'] == $_SESSION['Id']) {

              ?>
                <a href="#" class="nav-link nav">
                  <i class="nav-icon far fa-user"></i>
                  <p>
                    Patient Details
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>


                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo user; ?>addprofile.php" class="nav-link nav">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Add Profile</p>
                    </a>
                  </li>


                  <li class="nav-item">

                    <a href="<?php echo details; ?>viewprofile.php" class="nav-link nav">
                      <i class="far fa-circle nav-icon"></i>
                      <p>View Profile</p>
                    </a>

                  </li>

                </ul>
              <?php
              }}
              ?>
            </li>

            <li class="nav-item">
              <?php
              $q = "SELECT * FROM user_data WHERE Unique_id=0";
              $res = $conn->query($q);
              $ro = mysqli_fetch_assoc($res);
                if ($ro['Name'] == $_SESSION['user']) {

              ?>
                  <a href="<?php echo lists; ?>patientqueue.php" class="nav-link">
                    <i class="nav-icon fas fa-calendar-alt"></i>
                    <p>
                      Patient's Queue
                      <span class="badge badge-info right"></span>
                    </p>
                  </a>
              <?php }
               ?>
            </li>
            <li class="nav-item">
              <?php
              $q = "SELECT * FROM user_data WHERE Unique_id=1 ";
              $res = $conn->query($q);
              while ($ro = mysqli_fetch_assoc($res)) {
                if ($ro['Id'] == $_SESSION['Id']) {


              ?>

                  <a href="<?php echo lists; ?>mypatient.php" class="nav-link nav">
                    <i class="nav-icon fas fa-calendar-alt"></i>
                    <p>
                     My Patient's Queue
                      <span class="badge badge-info right"></span>
                    </p>
                  </a>
              <?php
                }
              }
              ?>

            </li>
            <li class="nav-item">
              <?php
              $q = "SELECT * FROM user_data WHERE Unique_id!=1";
              $res = $conn->query($q);
              while ($ro = mysqli_fetch_assoc($res)) {
                if ($ro['Id'] == $_SESSION['Id']) {

              ?>

                  <a href="<?php echo details; ?>userstatus.php" class="nav-link">
                    <i class="nav-icon fas fa-user"></i>
                    <p>
                      Check User Status
                      <span class="badge badge-info right"></span>
                    </p>
                  </a>
              <?php
                }
              }
              ?>

            </li>
            <li class="nav-item">


              <a href="<?php echo user; ?>labtest.php" class="nav-link">
                <i class="nav-icon fas fa-list"></i>
                <p>
                  Medical Tests
                  <span class="badge badge-info right"></span>
                </p>
              </a>


            </li>
            <li class="nav-item">
              <?php
              $q = "SELECT * FROM user_data WHERE Unique_id!=2";
              $res = $conn->query($q);
              while ($ro = mysqli_fetch_assoc($res)) {
                if ($ro['Id'] == $_SESSION['Id']) {

              ?>


                  <a href="<?php echo user; ?>addtest.php" class="nav-link">
                  <i class="nav-icon far fa-plus-square"></i>
                    <p>
                      Add Tests
                      <span class="badge badge-info right"></span>
                    </p>
                  </a>
              <?php
                }
              }
              ?>


            </li>
            
            <li class="nav-item">

              <a href="<?php echo details; ?>patientprescription.php" class="nav-link">
                <i class="nav-icon fas fa-calendar"></i>
                <p>
                  View Prescription
                  <span class="badge badge-info right"></span>
                </p>
              </a>



            </li>
            <li class="nav-item">
              <?php
              $q = "SELECT * FROM user_data WHERE Unique_id!=2";
              $res = $conn->query($q);
              while ($ro = mysqli_fetch_assoc($res)) {
                if ($ro['Id'] == $_SESSION['Id']) {

              ?>

                  <a href="<?php echo user; ?>addlabreport.php" class="nav-link">
                  <i class="nav-icon far fa-plus-square"></i>
                    <p>
                      Add Lab Report
                      <span class="badge badge-info right"></span>
                    </p>
                  </a>
              <?php
                }
              }
              ?>




            </li>
            <li class="nav-item">
        
        <a href="<?php echo details; ?>lab.php" class="nav-link">
          <i class="nav-icon fas fa-calendar"></i>
          <p>
         View Lab Report
            <span class="badge badge-info right"></span>
          </p>
        </a>
     
      
     
      </li>
      <li class="nav-item">
      <?php
              $q = "SELECT * FROM user_data WHERE Unique_id!=2";
              $res = $conn->query($q);
              while ($ro = mysqli_fetch_assoc($res)) {
                if ($ro['Id'] == $_SESSION['Id']) {

              ?>
           
           <a href="#" class="nav-link">
           <i class="nav-icon fas fa-list"></i>
             <p>
               Lab Test Inventory
               <i class="fas fa-angle-left right"></i>
             </p>
           </a>


           <ul class="nav nav-treeview">
             <li class="nav-item">
            
               <a href="<?php echo user; ?>productlist.php" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>Product List</p>
               </a>
             </li>
            
    
             <li class="nav-item">
        
               <a href="<?php echo user; ?>addproduct.php" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>Add Product</p>
               </a>
               <?php
                }
              }
              ?>
             </li>
           

        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>