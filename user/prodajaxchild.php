<?php
include_once('../define/define.php');
include_once(login .'connect.php');

if (isset($_POST['S_id']) && $_POST['S_id'] != '') {
	$statusID = $_POST['S_id'];
	$sql = "select * from tests Where c_id='$statusID'  order by c_name ASC";
	$rs = mysqli_query($conn, $sql);
	$numRows = mysqli_num_rows($rs);

	if ($numRows == 0) {
		echo '<option value="">select Child Category</option>';
	} else {
		echo '<label>Child Category: </label>';
		echo '<select class="form-control" name="childcategory" id="childcategory">';
		echo '<option value="">Select Child Category</option>';





		while ($state = mysqli_fetch_assoc($rs)) {
			echo '<option value="' . $state['Id'] . '"  >' . $state['c_name'] . '</option>';
		}
		echo '</select>';
	}
}

?>