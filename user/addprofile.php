<?php
include_once('../define/define.php');
include_once(login . 'connect.php');
if (!isset($_SESSION['login'])) {
    header("location:" . login . "login.php");
    exit();
}

if (!empty($_REQUEST['Id'])) {
    $id = $_REQUEST['Id'];
}


$err = [];

if (isset($_REQUEST['submit'])) {
    // print_r($_REQUEST);




    $name = $_REQUEST['Name'];
    $email = $_REQUEST['Email'];
    $mob = $_REQUEST['Mobile'];
    $add = $_REQUEST['Address1'];
    $gen = $_REQUEST['Gender'];
    $blood = $_REQUEST['Blood'];
    $pin = $_REQUEST['Pincode'];
    $add2 = $_REQUEST['Address2'];
  



    if (!empty($_FILES["Image"]["name"])) {
        $im = file_get_contents($_FILES['Image']['tmp_name']);
        $base = base64_encode($im);
    }





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
    if (empty($pin)) {
        $err['pinerror'] = "Pincode is Required";
    } else if (!preg_match('/^[0-9]{10}+$/', $mob)) {
        $err['pinerror'] = "Invalid Number Format";
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
    if (empty($add2)) {
        $err['add2error'] = "Address is required";
    }
   

    if (empty($err)) {
     
        if (!empty($_REQUEST['Id'])) {
            if (!empty($_FILES["Image"]["name"])) {
                $med = $_REQUEST['Medihis'];
                $chk = "";
                foreach ($med as $chk1) {
                    $chk .= $chk1 . ",";
                }


                $q = "UPDATE patient_profile
            SET Name='$name',
            Email='$email',
            Mobile='$mob',
            Address1='$add',
            Address2='$add2',
            Gender='$gen',
            Pincode='$pin',
            Blood='$blood',
            Medi_his='$chk',
            Image='$base'
             WHERE Id='$id' ";
                $exe = mysqli_query($conn, $q);
                if ($exe) {
                    $_REQUEST['Name'] = '';
                    $_REQUEST['Email'] = '';
                    $_REQUEST['Mobile'] = '';
                    $_REQUEST['Address1'] = '';
                    $_REQUEST['Gender'] = '';
                    $_REQUEST['Blood'] = '';
                    $_REQUEST['Address2'] = '';
                    $_REQUEST['Pincode'] = '';


                    $success = "Data Edited Successfully!";
                    // header('location:data.php');
                }
            } else {
                $med = $_REQUEST['Medihis'];

                $chk = "";
                foreach ($med as $chk1) {
                    $chk .= $chk1 . ",";
                }


                $q = "UPDATE patient_profile
        SET Name='$name',
        Email='$email',
        Mobile='$mob',
        Address1='$add',
        Address2='$add2',
        Gender='$gen',
        Pincode='$pin',
        Blood='$blood',
        Medi_his='$chk'
         WHERE Id='$id' ";
            
                $exe = mysqli_query($conn, $q);




                if ($exe) {
                    $_REQUEST['Name'] = '';
                    $_REQUEST['Email'] = '';
                    $_REQUEST['Mobile'] = '';
                    $_REQUEST['Address1'] = '';
                    $_REQUEST['Gender'] = '';
                    $_REQUEST['Blood'] = '';
                    $_REQUEST['Address2'] = '';
                    $_REQUEST['Pincode'] = '';


                    $success = "Data Edited Successfully!";
                }
            }



        
        }
     else {
       
        if (!empty($_FILES["Image"]["name"])) {
            $med = $_REQUEST['Medihis'];
            $chk = "";
            foreach ($med as $chk1) {
                $chk .= $chk1 . ",";
            }

            $s = "INSERT INTO patient_profile(Name,Email,Mobile,Address1,Address2,Gender,Pincode,Blood,Medi_his,Image) VALUES ('$_REQUEST[Name]','$_REQUEST[Email]', '$_REQUEST[Mobile]','$_REQUEST[Address1]','$_REQUEST[Address2]',' $_REQUEST[Gender]',' $_REQUEST[Pincode]','$_REQUEST[Blood]','$chk','$base')";
       
            if ($conn->query($s)) {
                $_REQUEST['Name'] = '';
                $_REQUEST['Email'] = '';
                $_REQUEST['Mobile'] = '';
                $_REQUEST['Address1'] = '';
                $_REQUEST['Gender'] = '';
                $_REQUEST['Blood'] = '';
                $_REQUEST['Address2'] = '';
                $_REQUEST['Pincode'] = '';


                $success = "Profile Created Succesfully!";
            }
        } else {
            $s = "INSERT INTO patient_profile(Name,Email,Mobile,Address1,Address2,Gender,Pincode,Blood,Medi_his) VALUES ('$_REQUEST[Name]','$_REQUEST[Email]', '$_REQUEST[Mobile]','$_REQUEST[Address1]','$_REQUEST[Address2]',' $_REQUEST[Gender]',' $_REQUEST[Pincode]','$_REQUEST[Blood]','$chk')";
           
            if ($conn->query($s)) {
                $_REQUEST['Name'] = '';
                $_REQUEST['Email'] = '';
                $_REQUEST['Mobile'] = '';
                $_REQUEST['Address1'] = '';
                $_REQUEST['Gender'] = '';
                $_REQUEST['Blood'] = '';
                $_REQUEST['Address2'] = '';
                $_REQUEST['Pincode'] = '';
                $success = "Profile Created Succesfully!";
            }
        }
    }
}

}

if (isset($_REQUEST['Id']) ) {
    $q = "SELECT * FROM patient_profile WHERE Id='$id'";
    $result = $conn->query($q);
    $roww = mysqli_fetch_assoc($result);
}


?>




<?php
$title = "Add Profile";
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
                            <h1> Add Profile</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?php echo login; ?>index3.php">Home</a></li>
                                <li class="breadcrumb-item active">Add Profile</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <div>

            </div>

            <!-- Main content -->
            <h3 style="color: green;text-align:center"><?php echo isset($success) ? $success : ''; ?></h3>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card" style="width:1600px">


                                <!-- /.card-header -->
                                <!-- form start -->
                                <div>
                                    <form class="centre" enctype="multipart/form-data" method="post" >
                                        <div class="card-body">

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Full Name</label>
                                                <?php
                                                if(isset($_SESSION['Id']) && $_SESSION['Id']!=0)
                                                {
                                                    $qu = "SELECT * FROM user_data WHERE Id='$_SESSION[Id]'";
                                                    $re = $conn->query($qu);
                                                    $ro = mysqli_fetch_assoc($re);
                                             
                                                
                                                }
                                                
                                                ?>
                                              
                                                <input type="text" name="Name" class="form-control" id="exampleInputEmail1" placeholder="Enter name" value="<?php if (isset($_REQUEST['Name'])) {
                                                                                                                                                                echo $_REQUEST['Name'];
                                                                                                                                                            } else if(isset($roww['Name'])) {
                                                                                                                                                                echo $roww['Name'];}else{ echo $ro['Name'];
                                                                                                                                                            } ?>">
                                                <span style=" color: red;" class="error" id="nspan"><?php echo isset($err['nerror']) ? '**' . $err['nerror'] : ''; ?></span>


                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email address</label>

                                                <input type="email" name="Email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="<?php if (isset($_REQUEST['Email'])) {
                                                                                                                                                                    echo $_REQUEST['Email'];
                                                                                                                                                                } else if(isset($roww['Email'])){
                                                                                                                                                                    echo  $roww['Email'];} else{ echo $ro['Email'] ;
                                                                                                                                                                } ?>">
                                                <span style=" color: red;" class="error" id="nspan"><?php echo isset($err['emerror']) ? '**' . $err['emerror'] : ''; ?></span>


                                            </div>


                                            <div class="form-group">
                                                <label for="Mobile">Mobile</label>
                                                <input type="tel" class="form-control" name="Mobile" id="Mobile" placeholder="Mobile" value="<?php if (isset($_REQUEST['Mobile'])) {
                                                                                                                                                    echo $_REQUEST['Mobile'];
                                                                                                                                                } else if(isset($roww['Mobile'])) {
                                                                                                                                                    echo  $roww['Mobile']; }else{ echo $ro['Mobile'];
                                                                                                                                                } ?>">
                                                <span style=" color: red;" class="error" id="mobspan"><?php echo isset($err['moberror']) ? '**' . $err['moberror'] : ''; ?></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="Address">Address Line 1</label>
                                                <input type="text" class="form-control" name="Address1" id="Address1" placeholder="Address" value="<?php if (isset($_REQUEST['Address1'])) {
                                                                                                                                                        echo $_REQUEST['Address1'];
                                                                                                                                                    } else if(isset($roww['Address1'])) {
                                                                                                                                                        echo  $roww['Address1'];}else{echo $ro['Address'] ;
                                                                                                                                                    } ?>">

                                                <span style=" color: red;" class="error" id="add1span"><?php echo isset($err['a1error']) ? '**' . $err['a1error'] : ''; ?></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="Address">Address Line 2</label>
                                                <input type="text" class="form-control" name="Address2" id="Address2" placeholder="Address" value="<?php if (isset($_REQUEST['Address2'])) {
                                                                                                                                                        echo $_REQUEST['Address2'];
                                                                                                                                                    } else {
                                                                                                                                                        echo isset($roww['Address2']) ? $roww['Address2'] : '';
                                                                                                                                                    } ?>">

                                            </div>
                                            <div class="form-group">
                                                <label for="Address">Pincode</label>
                                                <input type="number" class="form-control" name="Pincode" id="Pincode" placeholder="Pincode" value="<?php if (isset($_REQUEST['Pincode'])) {
                                                                                                                                                        echo $_REQUEST['Pincode'];
                                                                                                                                                    } else {
                                                                                                                                                        echo isset($roww['Pincode']) ? $roww['Pincode'] : '';
                                                                                                                                                    } ?>">

                                                <span style=" color: red;" class="error" id="add1span"><?php echo isset($err['pinerror']) ? '**' . $err['pinerror'] : ''; ?></span>
                                            </div>
                                            <div class="form-group">
                                                <label>Gender:</label>
                                                <select class="form-control" id="Gender" name="Gender">
                                                    <option value="">Select one</option>

                                                    <option value="male" <?php if (isset($_REQUEST['Gender']) && $_REQUEST['Gender'] == "male") {echo "selected";}
                                                                            else 
                                                                                if (isset($roww['Gender']) && $roww['Gender'] == "male") {echo "selected";}else if(isset($ro['Gender']) && $ro['Gender'] == "male") {echo "selected";
                                                                            } ?>>Male</option>
                                                    <option value="female" <?php if (isset($_REQUEST['Gender']) && $_REQUEST['Gender'] == "female"){ echo "selected";}
                                                                            else 
                                                                                if (isset($roww['Gender']) && $roww['Gender'] == "female"){ echo "selected";}else if(isset($ro['Gender']) && $ro['Gender'] == "female"){echo "selected";
                                                                            } ?>>Female</option>
                                                    <option value="others" <?php if (isset($_REQUEST['Gender']) && $_REQUEST['Gender'] == "others"){ echo "selected";}
                                                                            else 
                                                                                if (isset($roww['Gender']) && $roww['Gender'] == "others") {echo "selected";} else if (isset($ro['Gender']) && $ro['Gender'] == "others") {echo "selected";
                                                                            } ?>>others</option>
                                                </select>

                                                <?php

                                                if (isset($err['generror'])) {
                                                    echo '<span id="gspan" style="color: red;" >' . $err['generror'] . '</span>';
                                                }
                                                ?>
                                            </div>
                                            <div class="form-group">
                                                <label>Blood Group</label>
                                                <select class="form-control" id="Blood" name="Blood">
                                                    <option value="">Select one</option>

                                                    <option value="A+" <?php if (isset($_REQUEST['Blood']) && $_REQUEST['Blood'] == "A+") echo "selected";
                                                                        else {
                                                                            if (isset($roww['Blood']) && $roww['Blood'] == "A+") echo "selected";
                                                                        } ?>>A+</option>
                                                    <option value="O+" <?php if (isset($_REQUEST['Blood']) && $_REQUEST['Blood'] == "O+")  echo "selected";
                                                                        else {
                                                                            if (isset($roww['Blood']) && $roww['Blood'] == "O+")  echo "selected";
                                                                        } ?>>O+</option>
                                                    <option value="B+" <?php if (isset($_REQUEST['Blood']) && $_REQUEST['Blood'] == "B+") echo "selected";
                                                                        else {
                                                                            if (isset($roww['Blood']) && $roww['Blood'] == "B+") echo "selected";
                                                                        } ?>>B+</option>
                                                    <option value="AB+" <?php if (isset($_REQUEST['Blood']) && $_REQUEST['Blood'] == "AB+")  echo "selected";
                                                                        else {
                                                                            if (isset($roww['Blood']) && $roww['Blood'] == "AB+")  echo "selected";
                                                                        } ?>>AB+</option>
                                                    <option value="A-" <?php if (isset($_REQUEST['Blood']) && $_REQUEST['Blood'] == "A-") echo "selected";
                                                                        else {
                                                                            if (isset($roww['Blood']) && $roww['Blood'] == "A-") echo "selected";
                                                                        } ?>>A-</option>
                                                    <option value="B-" <?php if (isset($_REQUEST['Blood']) && $_REQUEST['Blood'] == "A-")  echo "selected";
                                                                        else {
                                                                            if (isset($roww['Blood']) && $roww['Blood'] == "A-")  echo "selected";
                                                                        } ?>>A-</option>
                                                    <option value="O-" <?php if (isset($_REQUEST['Blood']) && $_REQUEST['Blood'] == "O-") echo "selected";
                                                                        else {
                                                                            if (isset($roww['Blood']) && $roww['Blood'] == "O-") echo "selected";
                                                                        } ?>>O-</option>
                                                    <option value="AB-" <?php if (isset($_REQUEST['Blood']) && $_REQUEST['Blood'] == "AB-") echo "selected";
                                                                        else {
                                                                            if (isset($roww['Blood']) && $roww['Blood'] == "AB-") echo "selected";
                                                                        } ?>>AB-</option>
                                                </select>


                                            </div>
                                            <div class="form-group">
                                                <label>Medical History</label>


                                                <div class="form-group">
                                                    <button class="form-control" type="button" id="multiSelectDropdown" style="text-align: left;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Select Medical History
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <?php
                                                        $q = "SELECT * FROM medi_his";
                                                        $result = $conn->query($q);
                                                        while ($row = mysqli_fetch_assoc($result)) { ?>
                                                            <li>
                                                                <label style="width: 1550px;text-align:centre"><input id="inmedhis" style="text-align:left" type="checkbox" name="Medihis[]" value="<?php echo $row['m_name'];  if (isset($_REQUEST['Medihis[]']) && $_REQUEST['Medihis[]'] == "$row[m_name]") echo "selected";
                                                                        else {
                                                                            if (isset($roww['Medi_his']) && $roww['Medi_his'] == "$row[m_name]") echo "selected";
                                                                        } ?>"><?php echo $row['m_name']; ?></label>
                                                            </li>



                                                        <?php }
                                                        ?>

                                                    </ul>
                                                    <br>
                                                    <label for="otherin">Add if medical history is not mention above</label>
                                                    <br>
                                                    <i class=" far fa-plus-square" style="background-color:forestgreen;color:white;font-size:x-large" onclick="addmed();"></i> <i class=" far fa-minus-square" style="background-color:firebrick;color:white;font-size:x-large" onclick="removemed();"></i>

                                                    <input id="addm" class="form-control" type="text" placeholder="Add one medical history at a time">
                                                    <!-- <button >add</button> -->
                                                </div>
                                            </div>




                                            <div class="form-group">
                                                <label for="exampleInputFile">Profile Photo</label>
                                                <div class="input-group">
                                                    <div>
                                                        <input type="file" id="" name="Image">
                                                        <!-- <label  for="exampleInputFile">Choose file</label> -->
                                                    </div>

                                                </div>
                                            </div>


                                        </div>


                                        <div class="card-footer">

                                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>

                                <?php
                                $query = "SELECT * FROM user_data ";
                                $result = $conn->query($query);
                                ?>


                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <?php
        include_once(nav . 'footer.php'); ?>
        <script>
            $(document).ready(function() {
                $('table tbody').on('click', '.status-button', function() {
                    const userId = $(this).data('user-id');
                    const currentStatus = $(this).data('status');

                    // Toggle the status text
                    const newStatus = currentStatus === '1' ? '0' : '1';
                    $(this).text(newStatus === '1' ? 'Activate' : 'Deactivate');

                    // Update the data-status attribute
                    $(this).data('status', newStatus);

                    // Send an AJAX request to update the status in the database
                    $.ajax({
                        url: 'update_status.php', // Replace with your update script
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
                });
            });







            $(document).ready(function() {
                // Initialize DataTable
                var table = $('#example1').DataTable({
                    "responsive": true,
                    "lengthChange": false,
                    "autoWidth": false,
                    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                }).buttons().container().appendTo('#button-container');

                // Define a variable to store the current status filter
                var currentStatusFilter = null;
                var id = $('#status').val();
                console.log(id);

                // Handle the Activate button click
                $('#activate-btn').on('click', function() {
                    // Check if the current status filter is not '1' (Activate)
                    if (currentStatusFilter !== '1') {
                        currentStatusFilter = '1';
                        // Update the DataTable to filter by the '1' status (Activate)
                        table.column(6).search(currentStatusFilter).draw();
                    }
                });

                // Handle the Deactivate button click
                $('#deactivate-btn').on('click', function() {
                    // Check if the current status filter is not '0' (Deactivate)
                    if (currentStatusFilter !== '0') {
                        currentStatusFilter = '0';
                        // Update the DataTable to filter by the '0' status (Deactivate)
                        table.column(6).search(currentStatusFilter).draw();
                    }
                });
            });



            (function() {
                var nav = document.getElementsByClassName('nav-link ');
                var current = window.location.href;
                console.log(current);

                for (var i = 0; i < nav.length; i++) {

                    if (nav[i].href === current) {
                        nav[i].classList.add('active');
                    }

                }
            })();
        </script>
        <script>
            const chBoxes =
                document.querySelectorAll('.dropdown-menu input[type="checkbox"]');
            const dpBtn =
                document.getElementById('multiSelectDropdown');
            let mySelectedListItems = [];

            function handleCB() {
                mySelectedListItems = [];
                let mySelectedListItemsText = '';

                chBoxes.forEach((checkbox) => {
                    if (checkbox.checked) {
                        mySelectedListItems.push(checkbox.value);
                        mySelectedListItemsText += checkbox.value + ', ';
                    }
                });

                dpBtn.innerText =
                    mySelectedListItems.length > 0 ?
                    mySelectedListItemsText.slice(0, -2) : 'Select';
            }

            chBoxes.forEach((checkbox) => {
                checkbox.addEventListener('change', handleCB);
            });

            function addmed() {

                var med = $('#addm').val();


                $.ajax({
                    type: 'post',
                    data: {
                        med: med
                    },
                    url: 'addmedajax.php',
                    success: function(response) {
                        console.log(response);






                    },
                    complete: function(response) {

                        $('#multiSelectDropdown').text(med);
                        $('#btnhid').val(med);

                        var hiddenInput = '<input type="hidden" name="Medihis[]" value="' + med + '">';


                        $('form').append(hiddenInput);

                        $('#addm').val('');


                    }
                });



            }

            function removemed() {

                var med = $('#addm').val();
                $('#addm').val('');

            }
        </script>









</body>

</html>