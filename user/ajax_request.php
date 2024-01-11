 
<?php 
include_once('../define/define.php');
include_once(login .'connect.php');
	
	if(isset($_POST['status']) && $_POST['status'] !='')
	{
		$countryID = $_POST['status'];
      
        if($countryID=="Activate")
        {
            $st=1;
        }
        else{
            $st=0;
        }

		$sql = "select * from user_data where Status = '".$st."' AND Unique_id=2 order by Name ASC";
		$rs = mysqli_query($conn,$sql);
		$numRows = mysqli_num_rows($rs);
		
		if($numRows == 0)
		{
		
		}
		else
		{
            $query = "SELECT * FROM user_data where Unique_id=2 ";
            $result = $conn->query($query);
            ?>
            
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
			
		
			while($status = mysqli_fetch_assoc($rs))
			{
                $n=$status['Name'];
                $e=$status['Email'];
                $a=$status['Address'];
                $w=$status['Whatsapp'];
                $m=$status['Mobile'];
                $g=$status['Gender'];
                echo '<tr class="success"><td>'.$status['Name'].'</td><td>'.$status['Email'].'</td><td>'.$status['Mobile'].'</td><td>'.$status['Whatsapp'].'</td><td>'.$status['Address'] . '</td> 
              <td>'.$status['Gender'] . '</td>'; 
                ?>
                
                <td> <button class="<?php echo $status['Status'] == '1' ? 'btn btn-success' : 'btn btn-danger'; ?> status-button" id="status_<?php echo $status['Id']; ?>" data-user-id="<?php echo $status['Id']; ?>" data-status="<?php echo $status['Status']; ?>" value="<?php echo $status['Status'] == '1' ? 'Activate' : 'Deactivate'; ?>" onclick="colorchange(<?php echo $status['Id'] ?>);">
                              <?php echo $status['Status'] == '1' ? 'Activate' : 'Deactivate';  ?>
                            </button></td>
                            <td id="editdel_<?php echo $status['Id']; ?>"><button style="background-color:dodgerblue;color:white" id="edit_<?php echo $status['Id']; ?>" value="<?php echo $status['Id']; ?>" onclick="changedata(<?php echo $status['Id']; ?>);"><i class="fas fa-pencil-alt"></i>Edit</button> <button style="background-color:red;color:white;" onclick=" return condelete()"><a style="color:aliceblue" href="deletedata.php?Id=<?php echo $status['Id']; ?>"><i class="fas fa-trash">
                                                                </i>Delete</a></button></td>
                      </tr>
          </tr>
            
                <?php
            }}
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
  
 <?php
			
		
			

		
		}
		
	}
 
?>

