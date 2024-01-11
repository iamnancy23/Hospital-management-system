<?php 
include_once('../define/define.php');
include_once(login .'connect.php');
	
	if(isset($_POST['c_id']) && $_POST['c_id'] !='')
	{
		$statusID = $_POST['c_id'];
		$sql = "select * from tests Where c_id=0  order by c_name ASC";
		$rs = mysqli_query($conn,$sql);
		$numRows = mysqli_num_rows($rs);
		
		if($numRows == 0)
		{
			echo '<option value="">select state</option>';
		}
		else
		{
			echo '<label>Category: </label>';
			echo '<select class="form-control" name="category" id="category">';
			echo '<option value="">Select Category</option>';
		
		
			
			
		
			while($state = mysqli_fetch_assoc($rs))
			{
				echo '<option value="'.$state['Id'].'"  >'.$state['c_name'].'</option>';

			}
			echo '</select>';
			

		
		}
		
	}
 
?>
  <div class="form-group" id="Subcategory">

</div>
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
                        url: 'ajax_requestsubcat.php',
                        success: function(returnData) {

                            $("#Subcategory").html(returnData);
                        }
                    });
                } else {
                    $("#Subcategory").html('');
                }

            })
        }
</script>