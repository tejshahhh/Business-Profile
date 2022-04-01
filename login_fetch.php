<?php
	include_once('connection.php');
	$response = array();
		
		
		if (isset($_POST['loginDetails']))
		{
			$fetchSql = " select * from business_profile_tbl where ( username='".$_POST['login_uname']."' or contact_no='".$_POST['login_uname']."' or email='".$_POST['login_uname']."' ) and pass_word='".$_POST['login_password']."' ";
			$result = mysqli_query($con, $fetchSql);
			
			if (mysqli_num_rows($result) < 1)
			{
				$response['Not_exists'] = 1;
			}
			else
			{
				$response['exists'] = 1;
			}
		}
		else
		{
			$response["Fail"] = 1;
		}
		
		echo json_encode($response);
?>