<?php
include_once('../define/define.php');
include_once(login .'connect.php');
if (isset($_POST['arr'])) {
    $cat=$_POST['arr'];




   if (($key = array_search($cat, $_SESSION['selected_categories'])) !== false) {
    unset($_SESSION['selected_categories'][$key]);
}
}



?>