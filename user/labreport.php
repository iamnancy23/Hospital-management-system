<?php
include_once('../define/define.php');
include_once(login . 'connect.php');
if (!isset($_SESSION['login'])) {
    header("location:" . login . "login.php");
    exit();
}

if (isset($_REQUEST['name'])) {
    $n = $_REQUEST['name'];
}



if (isset($_REQUEST['submit'])) {





    $name = $_REQUEST['Name'];
    $age = $_REQUEST['Age'];
    $drname = $_REQUEST['Drname'];
    $gen = $_REQUEST['Gender'];
    $date = $_REQUEST['Date'];
  







    if (empty($name)  || trim($name) === '') {
        $err['nerror'] = "Name is Required";
    } else if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
        $err['nerror'] = "Only alphabets and white space are allowed";
    }
    if (empty($drname)  || trim($drname) === '') {
        $err['drnerror'] = "Doctor Name is Required";
    } else if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
        $err['drnerror'] = "Only alphabets and white space are allowed";
    }


    if (empty($age)) {
        $err['ageerror'] = "Age is Required";
    }
    if (empty($date)) {
        $err['dateerror'] = "Date is Required";
    }
  




    if (empty($gen)) {
        $err['generror'] = "Gender is Required";
    }




    if (empty($err)) {
        $sql = "select * from book_tests where p_name='$name' ";
 
		$rss = mysqli_query($conn,$sql);
		$rowww=mysqli_fetch_assoc($rss);
        $sql = "INSERT INTO patientdata (p_name,d_name,gender,age,date,data_id,user_id) VALUES ('$name','$drname','$gen','$age','$date','$_SESSION[data]','$rowww[user_id]')";
        if ($conn->query($sql)) {
            $_REQUEST['Name'] = '';
            $_REQUEST['Age'] = '';
            $_REQUEST['Drname'] = '';
            $_REQUEST['Gender'] = '';
            $_REQUEST['Date'] = '';
          
            $_SESSION['data']++;

            $succ = "yes";
        } else {
            $succ = "no";
        }
        if ($succ == "yes") {
            $_SESSION['data']++;
        }
        // header("location:insert.php?drname=$drname&name=$name&age=$age&cat=$cat&gen=$gen&date=$date&subcat=$subcat");
    }
}


?>
<?php
$title = "Add Report";
include_once(nav . 'header.php');
?>





<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <?php
        include_once(nav . 'rightnav.php');
        include_once(nav . 'leftnav.php');
        ?>



        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1> Add Patient Report</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?php echo login; ?>index3.php">Home</a></li>
                                <li class="breadcrumb-item active">Add Patient Report</li>
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

                                <form class="centre" autocomplete="off">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Patient Name</label>
                                                    <input autocomplete="off" type="text" name="Name" style="width: 100%;" class="form-control" id="exampleInputEmail1" placeholder="Enter name" value="<?php if (isset($_REQUEST['name'])) {
                                                                                                                                                                                                            echo $_REQUEST['name'];
                                                                                                                                                                                                        } else {
                                                                                                                                                                                                            if (isset($_REQUEST['Name'])) {
                                                                                                                                                                                                                echo  $_REQUEST['Name'];
                                                                                                                                                                                                            } else {
                                                                                                                                                                                                                echo '';
                                                                                                                                                                                                            }
                                                                                                                                                                                                        } ?>">
                                                    <span style=" color: red;" class="error" id="nspan"><?php echo isset($err['nerror']) ? '**' . $err['nerror'] : ''; ?></span>


                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">REF BY Doctor Name</label>
                                                    <input autocomplete="off" type="text" name="Drname" style="width: 100%;" class="form-control" id="exampleInputEmail1" placeholder="Enter Doctor Name" value="<?php echo (isset($_REQUEST['Drname'])) ? $_REQUEST['Drname'] : ''; ?>">
                                                    <span style=" color: red;" class="error" id="nspan"><?php echo isset($err['drnerror']) ? '**' . $err['drnerror'] : ''; ?></span>


                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Date</label>

                                                    <input autocomplete="off" type="date" name="Date" class="form-control" id="exampleInputEmail1" placeholder="Enter Date" value="<?php echo (isset($_REQUEST['Date'])) ? $_REQUEST['Date'] : ''; ?>">
                                                    <span style=" color: red;" class="error" id="nspan"><?php echo isset($err['dateerror']) ? '**' . $err['dateerror'] : ''; ?></span>


                                                </div>

                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Patient Age</label>

                                                    <input autocomplete="off" type="number" name="Age" class="form-control" id="exampleInputEmail1" placeholder="Enter age" value="<?php echo (isset($_REQUEST['Age'])) ? $_REQUEST['Age'] : ''; ?>">
                                                    <span style=" color: red;" class="error" id="nspan"><?php echo isset($err['ageerror']) ? '**' . $err['ageerror'] : ''; ?></span>


                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Gender:</label>
                                                    <select class="form-control" id="Gender" name="Gender">
                                                        <option value="">Select one</option>

                                                        <option value="male" <?php if (isset($_REQUEST['Gender']) && $_REQUEST['Gender'] == "male") {
                                                                                    echo "selected";
                                                                                } else {
                                                                                    '';
                                                                                } ?>>Male</option>
                                                        <option value="female" <?php if (isset($_REQUEST['Gender']) && $_REQUEST['Gender'] == "female") {
                                                                                    echo "selected";
                                                                                } else {
                                                                                    '';
                                                                                } ?>>Female</option>
                                                        <option value="others" <?php if (isset($_REQUEST['Gender']) && $_REQUEST['Gender'] == "others") {
                                                                                    echo "selected";
                                                                                } else {
                                                                                    '';
                                                                                } ?>>others</option>
                                                    </select>

                                                    <?php

                                                    if (isset($err['generror'])) {
                                                        echo '<span id="gspan" style="color: red;" >' . $err['generror'] . '</span>';
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                             <div class="form-group">
                                                
                                            <div class="card-body">
                                                <table id="example1" class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>

                                                            <th style="text-align: center;">Test Categories</th>

                                                            <th style="text-align: center;">Patient Value</th>

                                                            <th style="text-align: center;">Normal Value</th>




                                                        </tr>
                                                    </thead>
                                                    <?php
                                                    if(!empty($_REQUEST['name']))
                                                    {
                                                    $q = "SELECT * FROM book_tests where p_name='$_REQUEST[name]' ";}
                                                    else{
                                                        $q = "SELECT * FROM book_tests where  p_name='$name' ";
                                                    }
                                          
                                                    $r = mysqli_query($conn, $q);
                                                    $row = mysqli_fetch_assoc($r);


                                                    $tests = explode(',', $row['tests']);
                                              


                                                   
                                                    ?>
                                                    <tr>


                                                        <?php
                                                  

                                                        

                                                        foreach ($tests as $test) {
                                                            $sql = "select * from tests Where c_name='$test'";
                                                            $rs = mysqli_query($conn, $sql);
                                                          
                                                             while ($state = mysqli_fetch_assoc($rs)) {
                                                            ?>
                                                            <td style="width:300px;text-align: center;"><?php echo $test; ?></td>
                                                          

                                                       
                                                        <td><input style="width:1000px;height:50px" name="Patval" type="text" id="<?php echo $state['Id']; ?>" placeholder="Enter Patient Value" value="<?php echo isset($_REQUEST['Patval']) ? $_REQUEST['Patval'] : ''; ?>" onchange="savedata(<?php echo $state['Id']; ?>)" /><br>
                                                            <span style=" color: red;" class="error" id="nspan"></span>
                                                        </td>
                                                        <td style="width:300px;text-align: center;"><?php echo $state['normalval']; ?></td>


                                                    </tr>
                                                    <?php
                                                    }}
                                                    ?>

                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th style="text-align: center;">Test Categories</th>

                                                            <th style="text-align: center;">Patient Value</th>

                                                            <th style="text-align: center;">Normal Value</th>


                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
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
        <?php include_once(nav . 'footer.php');
        ?>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->


    <script>
      







    </script>
    <script>
        $(document).ready(function() {
            changeCity();
            // $("#state").html('<option value="">Select State</option>');



        });

        function changeCity() {
            $("#Category").change(function() {
                var getstatusID = $(this).val();






                $.ajax({
                    type: 'post',
                    data: {
                        c_id: getstatusID
                    },
                    url: 'getsubcat.php',
                    success: function(returnData) {



                        $("#divstatus").html(returnData);
                    }
                });




            })
        }




        (function() {
            var nav = document.getElementsByClassName('nav-link ');
            var current = window.location.href;
            // console.log(current);

            for (var i = 0; i < nav.length; i++) {
                // console.log("cu" + nav[i].href);
                if (nav[i].href === current) {
                    nav[i].classList.add('active');
                }

            }
        })();
    </script>
    <script>
    function randomIntFromInterval(min, max) { // min and max included 
        return Math.floor(Math.random() * (max - min + 1) + min)
    }

    const rndInt = randomIntFromInterval(1, 999)



    function savedata(id) {
   




        var name = $("#" + id).val();



        $.ajax({
            url: 'insert.php',
            method: 'post',
            data: {
                id: id,
                patval: name,
               


            },

            success: function() {



            },

        });



    }
    </script>
</body>

</html>