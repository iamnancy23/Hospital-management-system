<?php
include_once('../define/define.php');
include_once(login .'connect.php');
if (!isset($_SESSION['login'])) {
  header("location:".login."login.php");
  exit();
}




if (isset($_REQUEST['submit'])) {
    print_r($_REQUEST);
  


    $name = $_REQUEST['Name'];
    $kname = $_REQUEST['KName'];
    $val = $_REQUEST['Total'];
    $st = $_REQUEST['Status'];
    $cat=$_REQUEST['category'];
    $subcat=$_REQUEST['subcategory'];
    $childcat=$_REQUEST['childcategory'];

    if (empty($name)  || trim($name) === '') {
        $err['nerror'] = "Brand Name is Required";
    } else if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
        $err['nerror'] = "Only alphabets and white space are allowed";
    }
    if (empty($kname)  || trim($kname) === '') {
        $err['knerror'] = " Kit Name is Required";
    } else if (!preg_match("/^[a-zA-Z ]*$/", $kname)) {
        $err['knerror'] = "Only alphabets and white space are allowed";
    }
    if (empty($val)  || trim($val) === '') {
        $err['valerror'] = "Value is Required";
    }


    if (empty($err)) {


        $sql = "INSERT INTO brand_details (b_name,k_name,b_status,total_kit,category,subcategory,childcategory) VALUES ('$_REQUEST[Name]','$_REQUEST[KName]','$_REQUEST[Status]','$_REQUEST[Total]','$_REQUEST[category]','$_REQUEST[subcategory]','$_REQUEST[childcategory]')";
        if ($conn->query($sql)) {

            $_REQUEST['Name'] = '';
            $_REQUEST['KName'] = '';
            $_REQUEST['Status'] = '';
            $_REQUEST['Total'] = '';


            $success = "Data Added Succesfully!";
           
        } else {
            echo "Could not insert record into table: %s<br />", $mysqli->error;
        }
    }
}

?>
<?php
$title="Add Product";
include_once(nav.'header.php');
?>




<body class="hold-transition sidebar-mini">
    <div class="wrapper">
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
                            <h1> Add Product</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?php echo login; ?>index3.php">Home</a></li>
                                <li class="breadcrumb-item active">Add Product</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <div>

            </div>
            <h3 style="color: green;text-align:center"><?php echo isset($success) ? $success : ''; ?></h3>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">


                                <!-- /.card-header -->
                                <!-- form start -->
                                <div>
                                    <form class="centre" autocomplete="off">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Brand Name</label>

                                                <input autocomplete="off" type="text" name="Name" class="form-control" id="exampleInputEmail1" placeholder="Enter name" value="<?php echo (isset($_REQUEST['Name'])) ? $_REQUEST['Name'] : ''; ?>">
                                                <span style=" color: red;" class="error" id="nspan"><?php echo isset($err['nerror']) ? '**' . $err['nerror'] : ''; ?></span>


                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Kit Name</label>

                                                <input autocomplete="off" type="text" name="KName" class="form-control" id="exampleInputEmail1" placeholder="Enter kit name" value="<?php echo (isset($_REQUEST['KName'])) ? $_REQUEST['KName'] : ''; ?>">
                                                <span style=" color: red;" class="error" id="nspan"><?php echo isset($err['knerror']) ? '**' . $err['knerror'] : ''; ?></span>


                                            </div>
                                            <div class="form-group">
                                                <label>Brand Status:</label>
                                                <select class="form-control" id="Status" name="Status">


                                                    <option value="Available" <?php if (isset($_REQUEST['Status']) && $_REQUEST['Status'] == "available") {
                                                                                    echo "selected";
                                                                                } else {
                                                                                    '';
                                                                                } ?>>Available</option>
                                                    <option value="Unavailable" <?php if (isset($_REQUEST['Status']) && $_REQUEST['Status'] == "unavailable") {
                                                                                    echo "selected";
                                                                                } else {
                                                                                    '';
                                                                                } ?>>Unavailable</option>

                                                </select>

                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Total Kit</label>

                                                <input autocomplete="off" type="number" name="Total" class="form-control" id="exampleInputEmail1" placeholder="Enter Value" value="<?php echo (isset($_REQUEST['Total'])) ? $_REQUEST['Total'] : ''; ?>">
                                                <span style=" color: red;" class="error" id="nspan"><?php echo isset($err['valerror']) ? '**' . $err['valerror'] : ''; ?></span>


                                            </div>
                                            <?php
                                            $sql = "select * from tests Where c_id=0  order by c_name ASC";
                                            $rs = mysqli_query($conn, $sql); ?>
                                            <div class="form-group">
                                                <label>Category </label>
                                                <select class="form-control" id="category" name="category">
                                                    <option value="">Select one</option>
                                                    <?php
                                                    while ($state = mysqli_fetch_assoc($rs)) { ?>


                                                        <option value="<?php echo $state['Id']; ?>" <?php if (isset($_REQUEST['category']) && $_REQUEST['category'] == $state['Id']) echo "selected";
                                                                                                    else {echo 
                                                                                                       '';
                                                                                                    } ?>><?php echo $state['c_name']; ?></option>
                                                    <?php } ?>

                                                </select>

                                                <?php

                                                if (isset($err['generror'])) {
                                                    echo '<span id="gspan" style="color: red;" >' . '*' . $err['generror'] . '</span>';
                                                }
                                                ?>
                                            </div>
                                            <div class="form-group" id="Subcategory">

                                            </div>








                                        </div>


                                        <div class="card-footer">
                                            <!-- <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button> -->
                                            <input type="submit" class="btn btn-primary" name="submit" value="Submit" />


                                        </div>
                                    </form>
                                </div>



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
     $(document).ready(function() {
            changesubcategory();

        });

        function changesubcategory() {
            $("#category").change(function() {
              
                var getsubID = $(this).val();

                if (getsubID != '') {


                    $.ajax({
                        type: 'post',
                        data: {
                            S_id: getsubID
                        },
                        url: 'prodajax.php',
                        success: function(returnData) {

                            $("#Subcategory").html(returnData);
                        }
                    });
                } else {
                    $("#Subcategory").html('');
                }

            })
        }


        
    (function() {
            var nav = document.getElementsByClassName('nav-link ');
            var current = window.location.href;
            // console.log(current);

            for (var i = 0; i < nav.length; i++) {
            //   console.log("cu"+nav[i].href);
              if (nav[i].href === current) {
                nav[i].classList.add('active');
              }
            
            }
          })();
</script>
</body>

</html>