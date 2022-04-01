<?php
	include_once('connection.php');
	
	//echo $_POST['cmb_title'];
			
		if($_POST['experience_ID'] == '')
		{
			//echo "IF"; 
			$sql = "CALL insertClientExperience('".$_POST['business_id']."' , '".$_POST['cmb_title_insert']."' ,'".$_POST['cmb_employ']."','".$_POST['cmb_startmonth']."', '".$_POST['cmb_endmonth']."' , '".$_POST['txt_head']."', '".$_POST['txt_company']."' , '".$_POST['txt_location']."' ,'".$_POST['cmb_startyear']."' ,'".$_POST['cmb_endyear']."' ,'".$_POST['cmb_industry_insert']."' ,'".$_POST['txt_description']."')";
				
		}
		
		else
		{
			//echo "ELSE";
			$sql = "CALL updateExperienceProfile('".$_POST['experience_ID']."' ,'".$_POST['business_id']."', '".$_POST['cmb_title_insert']."' ,'".$_POST['cmb_employ']."','".$_POST['cmb_startmonth']."', '".$_POST['cmb_endmonth']."' , '".$_POST['txt_head']."', '".$_POST['txt_company']."' , '".$_POST['txt_location']."' ,'".$_POST['cmb_startyear']."' ,'".$_POST['cmb_endyear']."' ,'".$_POST['cmb_industry_insert']."' ,'".$_POST['txt_description']."')";
			
			//echo $sql;
		}
		
		echo $sql;
		$result = mysqli_query($con,$sql);
		if(!$result)
		{
			die("Not Inserted".mysqli_error($con));
		}
		else
		{			
			//header('location:manage_user.php');
			echo "Experience Inserted";
		}	
		
				
		
?>