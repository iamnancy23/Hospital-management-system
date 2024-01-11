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
<div class="form-group">
	<label for="exampleInputEmail1">Amount</label>

	<input type="number" name="Amount" class="form-control" id="exampleInputEmail1" placeholder="Enter Amount" value="<?php if (isset($_REQUEST['Amount'])) {
																															echo $_REQUEST['Amount'];
																														} else {
																															echo isset($rows['Amount']) ? $rows['Amount'] : '';
																														} ?>">
	<span style=" color: red;" class="error" id="nspan"><?php echo isset($err['amerror']) ? '**' . $err['amerror'] : ''; ?></span>


</div>
<div class="form-group">
	<label for="exampleInputEmail1">Normal Value</label>

	<input type="text" name="normal" class="form-control" id="exampleInputEmail1" placeholder="Enter Normal Range" value="<?php if (isset($_REQUEST['normal'])) {
																															echo $_REQUEST['normal'];
																														} else {
																															echo isset($rows['normal']) ? $rows['normal'] : '';
																														} ?>">
	<span style=" color: red;" class="error" id="nspan"><?php echo isset($err['noerror']) ? '**' . $err['noerror'] : ''; ?></span>


</div>
<div class="form-group">
	<label for="exampleInputEmail1">Kit Name Used</label>

	<input type="text" name="kname" class="form-control" id="exampleInputEmail1" placeholder="Enter Kit Used" value="<?php if (isset($_REQUEST['kname'])) {
																															echo $_REQUEST['kname'];
																														} else {
																															echo isset($rows['k_name']) ? $rows['k_name'] : '';
																														} ?>">
	<span style=" color: red;" class="error" id="nspan"><?php echo isset($err['noerror']) ? '**' . $err['noerror'] : ''; ?></span>


</div>