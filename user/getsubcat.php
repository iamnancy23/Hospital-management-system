<?php
include_once('../define/define.php');
include_once(login .'connect.php');

if (isset($_POST['c_id']) && $_POST['c_id'] != '') {
	$statusID = $_POST['c_id'];
	$sql = "select * from tests Where c_id='$statusID'  order by c_name ASC";
	$rs = mysqli_query($conn, $sql);
	$numRows = mysqli_num_rows($rs);

	if ($numRows == 0) {
		echo '<option value="">select Sub Category</option>';
	} else {
		echo '<label>Sub Category: </label>';
		echo '<select class="form-control" name="subcategory" id="subcategory">';
		echo '<option value="">Select Sub Category</option>';





		while ($state = mysqli_fetch_assoc($rs)) {
			echo '<option value="' . $state['Id'] . '"  >' . $state['c_name'] . '</option>';
		}
		echo '</select>';
	}
}

?>
<br>
<br>
<div id="childtable">

</div>
<script>
        $(document).ready(function() {
            changeCity();
            // $("#state").html('<option value="">Select State</option>');



        });

        function changeCity() {
            $("#subcategory").change(function() {
                var getstatusID = $(this).val();


                



                    $.ajax({
                        type: 'post',
                        data: {
                            subc_id: getstatusID
                        },
                        url: 'childtable.php',
                        success: function(returnData) {



                            $("#childtable").html(returnData);
                        }
                    });
              
                
                

            })
        }
    </script>