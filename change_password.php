<?php
	include_once('header.php');
	if(isset($_POST['btn_update']))
	{		
		$updatePasswordSql = "CALL updatePassword('".$row_login['user_id']."' , '".$_POST['txt_newpwd']."')";
		
		
		echo $updatePasswordSql;
		
		
		if(!mysqli_query($con,$updatePasswordSql))
		{
			die("Not Updated.".mysqli_error($con));
		}
		else
		{
			echo "<script>window.location = 'logout.php';</script>";
		}
	}
?>

<link rel="stylesheet" href="assets/vendor/dropify/css/dropify.min.css">
<div class="block-header">
	<div class="row">
		<div class="col-lg-5 col-md-8 col-sm-12">                        
			<h2><a href="#" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> My Profile</h2>
			<ul class="breadcrumb">
				<li class="breadcrumb-item"><a href="dashboard.php"><i class="icon-home"></i></a></li>                            
				<li class="breadcrumb-item">Forms</li>
				<li class="breadcrumb-item active">Update Profile</li>
			</ul>
		</div>            
		<div class="col-lg-7 col-md-4 col-sm-12 text-right">
			<div class="inlineblock text-center m-r-15 m-l-15 hidden-sm">
				<div class="sparkline text-left" data-type="line" data-width="8em" data-height="20px" data-line-Width="1" data-line-Color="#00c5dc"
					data-fill-Color="transparent">3,5,1,6,5,4,8,3</div>
				<span>Visitors</span>
			</div>
			<div class="inlineblock text-center m-r-15 m-l-15 hidden-sm">
				<div class="sparkline text-left" data-type="line" data-width="8em" data-height="20px" data-line-Width="1" data-line-Color="#f4516c"
					data-fill-Color="transparent">4,6,3,2,5,6,5,4</div>
				<span>Visits</span>
			</div>
		</div>
	</div>
</div>

<form action="" method="post" name="frmMyProfile" id="frmMyProfile" enctype="multipart/form-data">
	<div class="row clearfix">           
	<!--<div class="col-lg-4 col-md-12">
		<div class="card">
			<div class="header">
				<h2>Change Profile</h2>
			</div>
			<div class="body">
				<input type="file" id="dropify-event" data-default-file="../images/user_image/<?php if(isset($row_login['user_image'])) { echo $row_login['user_image']; } else { echo 'default.JFIF'; } ?>" name="user_img" id="user_img">
			</div>
		</div>
	</div>-->
	<div class="col-lg-8 col-md-12">
		 <div class="card">
			<div class="body">
				<h6>Change Password</h6>
				<div class="row clearfix">
					<div class="col-lg-12 col-md-12">
						<div class="form-group">                                                
							<input type="text" class="form-control" placeholder="Username" name="txt_uname" id="txt_uname" disabled="disabled" value="<?php if(isset($row_login['username'])) { echo $row_login['username']; } ?>">
						</div>
						<div class="form-group">                                                
							<input type="email" class="form-control" placeholder="Email" name="txt_email" id="txt_email" maxlength="100" disabled="disabled" value="<?php if(isset($row_login['email'])) { echo $row_login['email']; } ?>" >
						</div>
						<div class="form-group">                                                
							<input type="password" class="form-control" placeholder="New Password" name="txt_newpwd" id="txt_newpwd" maxlength="20" >
						</div>
					</div>
					
				</div>
				<button type="submit" id="btn_update" name="btn_update" class="btn btn-primary">Update</button> &nbsp;&nbsp;
				<button type="button" id="btn_cancel" name="btn_cancel" class="btn btn-default">Cancel</button>
			</div>
		 </div>

	</div>
</div>
</form>


<?php
	include_once('footer.php');
?>