<?php
include_once('../define/define.php');
include_once(login .'connect.php');

if (isset($_POST['S_id']) && $_POST['S_id'] != '') {
	$statusID = $_POST['S_id'];
	$sql = "select * from tests Where c_id='$statusID'  order by c_name ASC";
	$rs = mysqli_query($conn, $sql);
	$numRows = mysqli_num_rows($rs);

	if ($numRows == 0) {
		echo '<option value="">select Category</option>';
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
<div class="form-group" id="childcategory">

</div>
<script>
     $(document).ready(function() {
            changesubcategory();

        });

        function changesubcategory() {
            $("#subcategory").change(function() {
              
                var getsubID = $(this).val();

                if (getsubID != '') {


                    $.ajax({
                        type: 'post',
                        data: {
                            S_id: getsubID
                        },
                        url: 'prodajaxchild.php',
                        success: function(returnData) {

                            $("#childcategory").html(returnData);
                        }
                    });
                } else {
                    $("#childcategory").html('');
                }

            })
        }
</script>