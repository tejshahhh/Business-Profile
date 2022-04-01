<?php
	session_start();
	include_once('../connection.php');
	
	if(isset($_POST['btn_login']))
	{
		//$sql_login = " select * from tbl_student where ( username='".$_POST['signin-email']."' or contact='".$_POST['signin-email']."' or email='".$_POST['signin-email']."' ) and password='".$_POST['signin-password']."' ";
		
		$sql_login = "CALL viewLogin('".$_POST['signin-email']."','".$_POST['signin-password']."')";
//		echo $sql_login;
		$rs_login = mysqli_query($con,$sql_login);
		$row_count = mysqli_num_rows($rs_login);
		
		if($row_count > 0)
		{
			$row_data = mysqli_fetch_array($rs_login);
			$_SESSION['uname'] = $row_data['username'];
			header('location:dashboard.php');
		}
		else
		{
			die("invalid username and password".mysqli_error($con));
			
		}
	}
?>

<!doctype html>
<html lang="en">


<head>
<title>:: Lucid :: Login</title>
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
                            <p class="lead">Login to your account</p>
                        </div>
                        <div class="body">
                            <form class="form-auth-small" action="" method="post">
                                <div class="form-group">
                                    <label for="signin-email" class="control-label sr-only">Email</label>
                                    <input type="text" class="form-control" name="signin-email" id="signin-email" placeholder="Enter Username">
                                </div>
                                <div class="form-group">
                                    <label for="signin-password" class="control-label sr-only">Password</label>
                                    <input type="password" class="form-control" name="signin-password" id="signin-password" placeholder="Enter Password">
                                </div>
                               <!-- <div class="form-group clearfix">
                                    <label class="fancy-checkbox element-left">
                                        <input type="checkbox">
                                        <span>Remember me</span>
                                    </label>								
                                </div>-->
                                <button type="submit" name="btn_login" id="btn_login" class="btn btn-primary btn-lg btn-block">LOGIN</button>
                                <div class="bottom">
                                    <span class="helper-text m-b-10"><i class="fa fa-lock"></i> <a href="forgot_password.php">Forgot Password ?</a></span>
                                   <!-- <span>Don't have an account? <a href="page-register.html">Register</a></span>-->
                                </div>
                            </form>
                        </div>
                    </div>
				</div>
			</div>
		</div>
	</div>
	<!-- END WRAPPER -->
</body>


</html>
