<?php
include_once('../define/define.php');
include_once(login .'connect.php');

if (isset($_REQUEST['id'])) {
    $userid = $_REQUEST['id'];

    $name = $_REQUEST['name'];
  
    $mobile = $_REQUEST['mob'];
    $pres=$_REQUEST['pres'];
    $dis = $_REQUEST['dis'];
    $age = $_REQUEST['age'];
  
    $test = $_REQUEST['test'];
    $sym = $_REQUEST['sym'];




    $sql = "select * from prescription where Id = '" . $userid . "' ";
    $id=1;
    $rs = mysqli_query($conn, $sql);
    $numRows = mysqli_num_rows($rs);
    if ($numRows == 1) {
        while ($rows = mysqli_fetch_assoc($rs)) {
?>
<td><?php echo  $id++; ?> </td>
            <td><?php echo  $rows['Name']; ?> </td>

            <td><?php echo  $rows['Age'];  ?></td>
            <td><?php echo  $rows['Mobile'];  ?> </td>
            <td><?php echo  $rows['Symptoms'];  ?> </td>
            <td><?php echo $rows['Disease'];  ?> </td>
            <td><?php echo $rows['Prescription'];  ?> </td>

            <?php
                        if($rows['Tests']==0){
                        ?>
                        <td style="width:50px">No Tests Required</td>
                        <?php 
                        }else{
                            $qu = "SELECT * FROM tests Where Id='$rows[Tests]'  ";
                            $re = $conn->query($qu);
                            $r=mysqli_fetch_assoc($re);
                        ?>
                         <td style="width:50px"><?php echo $r['c_name']; ?></td>
                         <?php } ?>
       

                 <td id="editdel_<?php echo $ro['Id']; ?>"><button style="background-color:dodgerblue;color:white" id="edit_<?php echo $ro['Id']; ?>" value="<?php echo $ro['Id']; ?>" onclick="changedata(<?php echo $ro['Id']; ?>);"><i class="fas fa-pencil-alt"></i>Edit</button> <button style="background-color:red;color:white;" onclick=" return condelete()"><a style="color:aliceblue" href="delpres.php?Id=<?php echo $ro['Id']; ?>"><i class="fas fa-trash">
                                                                </i>Delete</a></button></td>
                     <?php
       


        }
    }
}

?>