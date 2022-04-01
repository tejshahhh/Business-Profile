<?php
	include_once('connection.php');
			
		if($_POST['education_ID'] == '')
		{
			//echo "IF"; 
			$sql = "CALL insertClientEducation('".$_POST['business_id']."' , '".$_POST['txt_school']."' ,'".$_POST['cmb_degree']."','".$_POST['cmb_start_month']."','".$_POST['cmb_end_month']."' , '".$_POST['txt_act']."', '".$_POST['txt_grade']."' , '".$_POST['cmb_field']."' ,'".$_POST['cmb_start_year']."' ,'".$_POST['cmb_end_year']."' ,'".$_POST['txt_desc']."')";
				
		}
		
		else
		{
			//echo "ELSE";
			$sql = "CALL updateEducationProfile('".$_POST['education_ID']."' ,'".$_POST['business_id']."', '".$_POST['txt_school']."' ,'".$_POST['cmb_degree']."','".$_POST['cmb_start_month']."', '".$_POST['cmb_end_month']."' , '".$_POST['txt_act']."', '".$_POST['txt_grade']."' , '".$_POST['cmb_field']."' ,'".$_POST['cmb_start_year']."' ,'".$_POST['cmb_end_year']."' ,'".$_POST['txt_desc']."')";
			
			//echo $sql;
		}
		echo $_POST['education_ID'];
		echo $_POST['cmb_degree'];
		echo $_POST['cmb_field'];
		$result = mysqli_query($con,$sql);
		if(!$result)
		{
			die("Not Inserted".mysqli_error($con));
		}
		/* else
		{			
			//header('location:manage_user.php');
			echo "Education Inserted";
		} */
		
				
		
?>