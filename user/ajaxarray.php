 
<?php 
include_once('../define/define.php');
include_once(login .'connect.php');
	
	if(isset($_POST['user_id']) && $_POST['user_id'] !='')
	{
        $err=array();
        $countryID = $_POST['user_id'];
        if(empty($err))
        {
        $i=0;
        $err[$i]=$countryID;
        $i++;}
        else{

        
		
      
      
       $err[$i]=$countryID;
       $i++;}
       print_r($err);

	
    }