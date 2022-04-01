<?php
	include_once('connection.php');
	
	$updateInEducation = "CALL updateEducationProfile('".$_POST['education_id']."' ,'".$_POST['business_id']."', '".$_POST['txt_school_edu']."' ,'".$_POST['cmb_deg_edu']."','".$_POST['cmb_s_month_edu']."', '".$_POST['cmb_e_month_edu']."' , '".$_POST['txt_actvities_socities_edu']."', '".$_POST['txt_grd_edu']."' , '".$_POST['cmb_fos_edu']."' ,'".$_POST['cmb_s_year_edu']."' ,'".$_POST['cmb_e_year_edu']."' ,'".$_POST['txt_des_edu']."')";
		
		echo $updateInEducation;
		
		$resultupdate = mysqli_query($con,$updateInEducation);
		$business_id = mysqli_insert_id($con);
		
		
		if(!$resultupdate)
		{
			die("Not Updated.".mysqli_error($con));
		}
		else
		{
			echo "Education Updated";
			/*echo "<script>window.location = 'my_profile.php';</script>";*/
		}
?>