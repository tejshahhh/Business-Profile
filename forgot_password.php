<?php
	include_once('../connection.php');
	if(isset($_POST['btn_recover']))
	{
		$sql_password_select = "SELECT * FROM manage_user_tbl WHERE username = '".$_POST['txt_uname']."' OR email = '".$_POST['txt_uname']."' OR mobile = '".$_POST['txt_uname']."' ";
		
		$rs_password_select = mysqli_query($con,$sql_password_select);
		
		$rows_num = mysqli_num_rows($rs_password_select);
		
		
		if($rows_num > 0)
		{
			$row_password_select = mysqli_fetch_array($rs_password_select);
			
			$to_mail = $row_password_select['email'] ;
			$subject = 'Message sent from website';
			$message = "Your Old Password is ".$row_password_select['password'];
			$header = "From:tejshahhh@gmail.com";
			
			// Send it
			//$sent = mail($to,$subject,$message,$header);
			
			
			if(@mail($to_mail, $subject, $message, $header)) 
			{
				echo 'Your message has been sent successfully!';
			} 
			else
			{
				echo 'Sorry, your message could not send.';
			}
		}
		else
		{
			header('location:index.php');
		}
	}
?>
<!doctype html>
<html lang="en">


<!-- Mirrored from thememakker.com/templates/lucid/html/light/page-forgot-password.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 13 Aug 2018 05:16:18 GMT -->
<head>
<title>:: Lucid :: Forgot Password</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta name="description" content="Lucid Bootstrap 4.1.1 Admin Template">
<meta name="author" content="WrapTheme, design by: ThemeMakker.com">

<link rel="icon" href="favicon.ico" type="image/x-icon">
<!-- VENDOR CSS -->
<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">

<!-- MAIN CSS -->
<link rel="stylesheet" href="light/assets/css/main.css">
<link rel="stylesheet" href="light/assets/css/color_skins.css">
</head>

<body class="theme-cyan">
	<!-- WRAPPER -->
	<div id="wrapper">
		<div class="vertical-align-wrap">
			<div class="vertical-align-middle auth-main">
				<div class="auth-box">
                    <div class="top">
                        <img src="light/assets/img/logo-white.png" alt="Tryon Infosoft">
                    </div>
					<div class="card">
                        <div class="header">
                            <p class="lead">Recover my password</p>
                        </div>
                        <div class="body">
                            <form class="form-auth-small" method="post" name="frm_forget_pass" id="frm_forget_pass">
                                <div class="form-group">                                    
                                    <input type="text" class="form-control" name="txt_uname" id="txt_uname" placeholder="Enter Your Username , Email , Mobile">
                                </div>
								<!--<div class="form-group">                                    
                                    <input type="email" class="form-control" name="txt_email" id="txt_email" placeholder="Enter Your Email">
                                </div>-->
                                <button type="submit" class="btn btn-primary btn-lg btn-block" name="btn_recover" id="btn_recover">Recover Password</button>
                            </form>
                        </div>
                    </div>
				</div>
			</div>
		</div>
	</div>
	<!-- END WRAPPER -->
</body>

<!-- Mirrored from thememakker.com/templates/lucid/html/light/page-forgot-password.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 13 Aug 2018 05:16:18 GMT -->
</html>