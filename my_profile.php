<?php
	include_once('header.php');
	
	if(isset($_POST['btn_update']))
	{
		if(!empty($_FILES["user_img"]["name"]))
		{
			$image1 = $row_login['user_image'];
			$path = $_SERVER['DOCUMENT_ROOT'].'/Project/images/user_image/';
			if (file_exists($path.$image1)) 
			{
				unlink($path.$image1);
			}
			
			$img3=$_FILES["user_img"]["name"];
			$img3 = pathinfo($img3, PATHINFO_FILENAME).mt_rand(600000,999999).".".pathinfo($img3, PATHINFO_EXTENSION);				
			$tmp_name3=$_FILES["user_img"]["tmp_name"];
			if(is_uploaded_file($tmp_name3))
			{
				copy($tmp_name3,"../images/user_image/".$img3);
			}
		}
		else
		{
			$img3 = $row_login['user_image'];
		}
		
		$updateProfileSql = "CALL updateProfile('".$row_login['user_id']."' , '".$_POST['txt_fname']."' , '".$_POST['txt_email']."' , '".$_POST['txt_mobile']."', '".$img3."')";
		
		
		//echo $updateProfileSql;
		
		
		if(!mysqli_query($con,$updateProfileSql))
		{
			die("Not Updated.".mysqli_error($con));
		}
		else
		{
			echo "<script>window.location = 'my_profile.php';</script>";
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
	<div class="col-lg-4 col-md-12">
		<div class="card">
			<div class="header">
				<h2>Change Profile</h2>
			</div>
			<div class="body">
				<input type="file" id="dropify-event" data-default-file="../images/user_image/<?php if(isset($row_login['user_image'])) { echo $row_login['user_image']; } else { echo 'default.JFIF'; } ?>" name="user_img" id="user_img">
			</div>
		</div>
	</div>
	<div class="col-lg-8 col-md-12">
		 <div class="card">
			<div class="body">
				<h6>Basic Information</h6>
				<div class="row clearfix">
					<div class="col-lg-12 col-md-12">
						<div class="form-group">                                                
							<input type="text" class="form-control" placeholder="Username" name="txt_uname" id="txt_uname" disabled="disabled" value="<?php if(isset($row_login['username'])) { echo $row_login['username']; } ?>">
						</div>
						<div class="form-group">                                                
							<input type="text" class="form-control" placeholder="Full Name" name="txt_fname" id="txt_fname" maxlength="100" value="<?php if(isset($row_login['fullname'])) { echo $row_login['fullname']; } ?>" >
						</div>
						<div class="form-group">                                                
							<input type="email" class="form-control" placeholder="Email" name="txt_email" id="txt_email" maxlength="100" value="<?php if(isset($row_login['email'])) { echo $row_login['email']; } ?>" >
						</div>
						<div class="form-group">                                                
							<input type="number" class="form-control" placeholder="Mobile" name="txt_mobile" id="txt_mobile" maxlength="10" value="<?php if(isset($row_login['mobile'])) { echo $row_login['mobile']; } ?>" >
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
<script src="light/assets/js/pages/forms/dropify.js"></script>