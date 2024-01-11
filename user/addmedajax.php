<?php 
include_once('../define/define.php');
include_once(login .'connect.php');
	
	if(isset($_POST['med']) && $_POST['med'] !='')
	{ print_r($_POST);
		$med = $_POST['med'];

        $sql = "select * from medi_his where m_name='$_POST[med]'";
		$rs = mysqli_query($conn,$sql);
		$numRows = mysqli_num_rows($rs);
        if($numRows==0){
		
        $s = "INSERT INTO medi_his(m_name) VALUES ('$_POST[med]')";
        echo $s;
        if ($conn->query($s)) {
            $_POST['med'] = '';
          
        }}
       
    }
        ?>