<?php
	include_once('connection.php');
	if(isset($_POST['btn_recover']))
	{
		$sql_password_select = "SELECT * FROM business_profile_tbl WHERE username = '".$_POST['txt_username']."' OR email = '".$_POST['txt_username']."' OR contact_no = '".$_POST['txt_username']."' ";
		
		
		$rs_password_select=mysqli_query($con,$sql_password_select);
		
		$rows_num=mysqli_num_rows($rs_password_select);
		
		
		if($rows_num > 0)
		{
			$row_password_select = mysqli_fetch_array($rs_password_select);
			$to_mail = $row_password_select['email'] ;
			$subject = 'Message sent from website';
			$message = "Your Old Password is ".$row_password_select['pass_word'];
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
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from demos.webicode.com/html/social-net/login-register.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 08 Jan 2022 05:17:48 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="M_Adnan">
<title>Social Networking Connecting HTML5 Template</title>

<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet">

<!-- Custom CSS -->
<link href="css/main.css" rel="stylesheet">
<link href="fonts/flaticon.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/responsive.css" rel="stylesheet">

<!-- fontawesome  -->
<link href="css/all.min.css" rel="stylesheet">

    
<!-- JavaScripts -->
<script src="js/modernizr.js"></script>

<!-- Online Fonts -->
<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700,800" rel="stylesheet">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

</head>
<body>

<!-- Wrap -->
<div id="wrap"> 
  
  <!-- header -->
  <header class="sticky">
    <div class="container"> 
      
      <!-- Logo -->
      <div class="logo"> <a href="index.html"><img class="img-responsive" src="images/logo-dark.png" alt="" ></a> </div>
      <nav class="navbar ownmenu navbar-expand-lg" id="nav-resposive">
        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
       
        
        <!-- Nav Right -->
        
    <div class="clearfix"></div>
  </header>
  
  <!-- Content -->
  <div id="content"> 
    
    <!-- Login Register -->
    <section class="login-register padding-top-100 padding-bottom-150">
      <div class="container"> 
        
        <!-- Payments Steps -->
        <div class="inside-log-reg">
              
              <!-- Nav Tabs -->
              <!--<ul class="nav" id="myTab" role="tablist">
                <li class="nav-item"> <a class="nav-link active" id="login-tab" data-toggle="tab" href="#log" role="tab" aria-selected="true">Login</a> </li>
                <li class="nav-item"> <a class="nav-link" id="reg-tab" data-toggle="tab" href="#reg" role="tab" aria-selected="false">Register</a> </li>
              </ul>-->
              
              <!-- Login Register Inside -->
              <div class="tab-content" id="myTabContent"> 
                
                <!-- Login -->
                <div class="tab-pane fade show active" id="log" role="tabpanel" aria-labelledby="login-tab">
                  <form action="" method="post">
                    <ul class="row">
                      
                      <!-- Name -->
                      <li class="col-md-12">
                        <label> <b>Recover My Password
                          <input type="text" name="txt_username" id="txt_username" placeholder="Enter Username, Email, Mobile" class="form-control">
                        </label>
                      </li>
                      <!-- LAST NAME -->
                      
                      
                      <!-- LOGIN -->
                      <li class="col-md-4">
                        <button type="submit" name="btn_recover" id="btn_recover" class="btn">Recover Password</button>
                      </li>
                      
                      <!-- FORGET PASS -->
                       
                    </ul>
                    </form>
                </div>    
                        
                        <!-- FORGET PASS -->
                     
                  
                
                <!-- Register -->
                
           
         
        </div>
      </div>
    </section>
  </div>
  
  <!-- Footer -->
  
  <!-- End Footer --> 
  
</div>
<script src="js/jquery-1.11.3.min.js"></script> 
<script src="js/bootstrap.min.js"></script> 
<script src="js/own-menu.js"></script> 
<script src="js/jquery.counterup.min.js"></script> 
<script src="js/owl.carousel.min.js"></script> 
<script src="js/main.js"></script>
</body>

<!-- Mirrored from demos.webicode.com/html/social-net/login-register.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 08 Jan 2022 05:17:48 GMT -->
</html>