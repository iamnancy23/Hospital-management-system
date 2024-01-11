<?php

include_once('../define/define.php');
include_once(login .'connect.php');

if (isset($_POST['c_id']) && $_POST['c_id'] != '') {
  $statusID = $_POST['c_id'];
  $sql = "select * from tests Where c_id='$statusID'  order by c_name ASC";
  $rs = mysqli_query($conn, $sql);
  $numRows = mysqli_num_rows($rs);

  if ($numRows == 0) {
    echo 'No Records found!';
  } else {






    while ($state = mysqli_fetch_assoc($rs)) {
?>
      <p  id="cat_<?php echo $state['c_name'] ?>" style="width:300px" value=" <?php echo $state['amount']; ?> " onclick="addSelectedCategory('<?php echo $state['c_name']; ?>')"><?php echo $state['c_name']; ?> <br></p>
<?php
    }
  }
}




?>
<script>
  var selectedCategories = [];


  function addSelectedCategory(categoryName) {


    if (selectedCategories.indexOf(categoryName) === -1) {
      var index = selectedCategories.indexOf(categoryName);

      if (index === -1) {
        selectedCategories.push(categoryName);

      } else {
        selectedCategories.splice(index, 1);
      }

      updateSelectedCategories();
    }
  }


  function updateSelectedCategories() {


    $.ajax({
      type: 'POST',
      data: {
        arr: selectedCategories
      },
      url: 'labselect.php',
      success: function(returnData) {
        $(".selected-categories").html(returnData);
      }
    });
  }

  $(document).ready(function() {

    $("#bookSelectedSlots").click(function(e) {
      e.preventDefault();


      if (selectedCategories.length === 0) {
        alert("Please select at least one category to book.");
      } else {

        location.href = 'testslot.php?arr=' + selectedCategories.join(',');
      }
    });
  });
 
</script>