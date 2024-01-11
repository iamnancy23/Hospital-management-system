<?php
include_once('../define/define.php');
include_once(login .'connect.php');

// Initialize the $arr array to store all the values
$arr = isset($_SESSION['selected_categories']) ? $_SESSION['selected_categories'] : array();

$html = "";
$sum = 0;

// Push the new values into the $arr array
if (isset($_POST['arr'])) {
    $selectedCategories = $_POST['arr'];
    foreach ($selectedCategories as $category) {
        if (!in_array($category, $arr)) {
            array_push($arr, $category);
        }
    }
}


$_SESSION['selected_categories'] = $arr;
print_r($arr);

foreach ($arr as $category) {
    $sql = "select * from tests where c_name = '" . $category . "' ";
    $rs = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_assoc($rs);

    $html .= "<tr><td id='cat_" . $rows['Id'] . "' >" . $category . "</td><td id='amt_" . $rows['Id'] . "'><b>" . $rows['amount'] . "</b>  </td><td onclick='removeselectedcat(" . $rows['Id'] . ");'><i style='background-color:black;color:white' class='fa fa-minus fa-border' ></i></td></tr>";
    $sum += $rows['amount'];
}

echo $html;

// Add the total amount to the table footer
echo '<script>';
echo 'var totalAmount = ' . $sum . ';';
echo 'updateTotalAmount();';
echo '</script>';
?>


<script type="text/javascript">
    var selectedCategories = <?php echo json_encode($arr); ?>;
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    var totalAmount = $('#totalAmount').text();

    function removeselectedcat(cat) {
     
       
    var categoryName = $('#cat_' + cat).text();
    var index = selectedCategories.indexOf(categoryName);
    if (index !== -1) {
        selectedCategories.splice(index, 1); 
    }
    var amount = parseFloat($('#amt_' + cat).text()); 
    var agree = confirm("Are you sure?");
    if (agree == true) {
        $('#cat_' + cat).closest('tr').remove();
        $.ajax({
            type: 'POST',
            data: { arr: categoryName },
            url: 'labdeselect.php',
            success: function () {
               
            }
        });
        totalAmount -= amount; 
        updateTotalAmount();
        return true;
    } else {
        return false;
    }
}
    function updateTotalAmount() {
        $('#totalAmount').text(totalAmount.toFixed(2)); 
    }

 
</script>

