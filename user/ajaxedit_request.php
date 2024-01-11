 <?php
include_once('../define/define.php');
include_once(login .'connect.php');

    if (isset($_REQUEST['user_id']) && $_REQUEST['user_id'] != '') {
        $userID = $_REQUEST['user_id'];
        $sql = "select * from user_data where Id = '" . $userID . "' ";
        $rs = mysqli_query($conn, $sql);
        $numRows = mysqli_num_rows($rs);


    
        if ($numRows == 1) {
            while ($rows = mysqli_fetch_assoc($rs)) {
    ?>
             <td ><input type="text" name="Name" class="form-control" id="Name" placeholder="Enter name" value="<?php if (isset($_REQUEST['Name'])) {
                                                                                                                                    echo $_REQUEST['Name'];
                                                                                                                                } else {
                                                                                                                                    echo isset($rows['Name']) ? $rows['Name'] : '';
                                                                                                                                } ?>"></td>
             <td ><input type="email" name="Email" class="form-control" id="Email" placeholder="Enter email" value="<?php if (isset($_REQUEST['Email'])) {
                                                                                                                                    echo $_REQUEST['Email'];
                                                                                                                                } else {
                                                                                                                                    echo isset($rows['Email']) ? $rows['Email'] : '';
                                                                                                                                } ?>"></td>
             <td ><input type="tel" class="form-control" name="Mobile" id="Mobile" placeholder="Mobile" value="<?php if (isset($_REQUEST['Mobile'])) {
                                                                                                                    echo $_REQUEST['Mobile'];
                                                                                                                } else {
                                                                                                                    echo isset($rows['Mobile']) ? $rows['Mobile']  : '';
                                                                                                                } ?>"></td>
             <td ><input type="tel" class="form-control" name="Wanumber" id="Wanumber" placeholder="Whatsapp" value="<?php if (isset($_REQUEST['Wanumber'])) {
                                                                                                                    echo $_REQUEST['Wanumber'];
                                                                                                                } else {
                                                                                                                    echo isset($rows['Whatsapp']) ? $rows['Whatsapp']  : '';
                                                                                                                } ?>"></td>                                                                                                   
             <td><input type="text" class="form-control" name="Address" id="Address" placeholder="Address" value="<?php if (isset($_REQUEST['Address'])) {
                                                                                                                        echo $_REQUEST['Address'];
                                                                                                                    } else {
                                                                                                                        echo isset($rows['Address']) ? $rows['Address'] : '';
                                                                                                                    } ?>"></td>

             <td><select id="Gender" name="Gender">
                     <option value="">Select one</option>

                     <option value="male" <?php if (isset($_REQUEST['Gender']) && $_REQUEST['Gender'] == "male") {
                                                echo "selected";
                                            } else {
                                                if (isset($rows['Gender']) && $rows['Gender'] == "male") echo "selected";
                                            } ?>>Male</option>
                     <option value="female" <?php if (isset($_REQUEST['Gender']) && $_REQUEST['Gender'] == "female") {
                                                echo "selected";
                                            } else {
                                                if (isset($rows['Gender']) && $rows['Gender'] == "female")  echo "selected";
                                            } ?>>Female</option>
                     <option value="others" <?php if (isset($_REQUEST['Gender']) && $_REQUEST['Gender'] == "others") {
                                                echo "selected";
                                            } else {
                                                if (isset($rows['Gender']) && $rows['Gender'] == "others") echo "selected";
                                            } ?>>others</option>
                 </select></td>




             <td><button class="<?php echo $rows['Status'] == '1' ? 'btn btn-success' : 'btn btn-danger'; ?> status-button" id="status_<?php echo $rows['Id']; ?>" data-user-id="<?php echo $rows['Id']; ?>" data-status="<?php echo $rows['Status']; ?>" value="<?php echo $rows['Status'] == '1' ? 'Activate' : 'Deactivate'; ?>" onclick="colorchange(<?php echo $rows['Id'] ?>);">
                              <?php echo $rows['Status'] == '1' ? 'Activate' : 'Deactivate';  ?>
                            </button></td>
             <td><button style="background-color:#28a745;color:white" name="submit" onclick="savedata(<?php echo $rows['Id']; ?>);"><i class="fas fa-save"></i>Save</button> <button style="background-color:red;color:white;" onclick="canceldata(<?php echo $rows['Id']; ?>);" ><i class="fas fa-trash"></i>Cancel</button></td>

 <?php

            }
        }
    }
    ?>
      <script>
         function savedata(id) {
   
        

        var name=$('#Name').val();
        console.log(name);
        var email=$('#Email').val();
        console.log(email);
        var mob=$('#Mobile').val();
        var wanum=$('#Wanumber').val();
        // console.log(name);
        var add=$('#Address').val();
        // console.log(name);
        var gen=$('#Gender').val();

            $.ajax({
                url: 'update.php',
                method: 'post',
                data: {name:name,email:email,mob:mob,wanum:wanum,add:add,gen:gen,id:id

                },

                success: function(returnData) {



$("#body_"+id).html(returnData);
},

            });

  

    }




    function canceldata(id) {
   
        

   var name=$('#Name').val();
   console.log(name);
   var email=$('#Email').val();
   console.log(email);
   var mob=$('#Mobile').val();
   var wanum=$('#Wanumber').val();
   // console.log(name);
   var add=$('#Address').val();
   // console.log(name);
   var gen=$('#Gender').val();

       $.ajax({
           url: 'cancel.php',
           method: 'post',
           data: {name:name,email:email,mob:mob,wanum:wanum,add:add,gen:gen,id:id

           },

           success: function(returnData) {



$("#body_"+id).html(returnData);
},

       });



}
    </script>