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
            <p class="click" data-color="black" data-background-color="ghostwhite" style="width: 410px;" id="child_<?php echo $_POST['c_id']; ?>" onclick="changestatu(<?php echo $state['Id']; ?>)" style="width:300px" value=" <?php echo $state['Id']; ?> "><?php echo $state['c_name']; ?> <br></p>
        <?php
        } ?>



<?php

    }
}

?>
<script>
    function changestatu(id) {




        if (id !== '') {
            $.ajax({
                type: 'post',
                data: {
                    c_id: id
                },
                url: 'labchild.php',
                success: function(returnData) {
                    $(".childcat").html(returnData);
                    // return false;
                }

            });
        }
    }

    $(document).ready(function() {
  $(".click").click(function() {
    // Reset color of all paragraphs
    $(".click").css("color", "black");
    $(".click").css("background-color", "cyan");

    // Set the color of the clicked paragraph to red
    $(this).css("color", "white");
    $(this).css("background-color", "black");
  });
});




</script>