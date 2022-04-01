<?php
	include_once('connection.php');
	
	//echo count($_POST['dy_web']);
	if(isset($_POST['dy_web']))
	{
		$totalwebsite = count($_POST['dy_web']);
		
		for($i = 0; $i<$totalwebsite;$i++)
		{
		  $sql_website = "INSERT INTO website_tbl(business_id,website_name,website_type) VALUES ('".$_POST['business_id']."','".$_POST['dy_web'][$i]."','".$_POST['drb_web'][$i]."')";
				  
		  $run_website = mysqli_query($con,$sql_website);
		  
		}

	}
			
	if(isset($_POST['inst_msg']))
	{
		$totalmessenger = count($_POST['inst_msg']);
		//echo $totalmessenger;
		
		for($i = 0; $i<$totalmessenger;$i++)
		{
		  $sql_instant = "INSERT INTO instant_messenger_tbl(business_id,instant_messenger_name,instant_messenger_type) VALUES ('".$_POST['business_id']."','".$_POST['inst_msg'][$i]."','".$_POST['drb_msg'][$i]."')";
				  
		  $run_instant = mysqli_query($con,$sql_instant);
		  
		}

	}
	
	$updateContactSql = "CALL updateContactProfile('".$_POST['business_id']."' , '".$_POST['txt_contact']."' ,'".$_POST['cmb_hwm']."' ,'".$_POST['cmb_birthmonth']."','".$_POST['cmb_birthday']."','".$_POST['txt_address']."')";
				
				
		if(!mysqli_query($con,$updateContactSql))
		{
			die("Not Updated.".mysqli_error($con));
		}
		else
		{
			echo "Contact Updated";
		}
		
				
?>