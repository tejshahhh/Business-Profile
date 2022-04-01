<?php
	include_once('header.php');
	
	
	//START GET DATA BY ID
	if(isset($_GET['business_id']))
	{
	 	
		$fetchSql = "SELECT * FROM  business_profile_tbl WHERE business_id =  '".$_GET['business_id']."' ";
		//echo $fetchSql;
		$result_data = mysqli_query($con,$fetchSql);
		$row_data = mysqli_fetch_array($result_data);
		
		$fetchSqled = " SELECT * FROM  education_tbl WHERE business_id =  '".$_GET['business_id']."' ";
		$result_ed_data = mysqli_query($con,$fetchSqled);
		$row_edu_data = mysqli_fetch_array($result_ed_data);
		
		$fetchSqlex = " SELECT * FROM  experience_tbl WHERE business_id =  '".$_GET['business_id']."' ";
		$result_ex_data = mysqli_query($con,$fetchSqlex);
		$row_exp_data = mysqli_fetch_array($result_ex_data);
		
			
		//echo $row_data['profile_img'];
		//echo "<br>";
		//echo $row_data['background_img'];
	}
		
	
	//END GET DATA BY ID
	
	
	
	
	if(isset($_POST['btn_save']))
	{			
		if($_POST['business_id'] == '')
		{
			//echo "Insert COde";
			//INSERTED QUERY
			//echo $_POST['dtp_date'];
			//echo "Hello World";
			
			if(!empty($_FILES["profile_image"]["name"]))
			{
				
				$img1= $_FILES["profile_image"]["name"];
				$img1 = pathinfo($img1, PATHINFO_FILENAME).mt_rand(600000,999999).".".pathinfo($img1, PATHINFO_EXTENSION);				
				$tmp_name=$_FILES["profile_image"]["tmp_name"];
				if(is_uploaded_file($tmp_name))
				{
					copy($tmp_name,"../images/profile_image/".$img1);
				}
			}
			else
			{
				$img1 = "";
			}
			
			//echo $img1;
				
			
			//BACKGROUND IMGE
			
			if(!empty($_FILES["background_image"]["name"]))
			 {
				
				$img2= $_FILES["background_image"]["name"];
				$img2= pathinfo($img2, PATHINFO_FILENAME).mt_rand(600000,999999).".".pathinfo($img2, PATHINFO_EXTENSION);				
				$tmp_name=$_FILES["background_image"]["tmp_name"];
				if(is_uploaded_file($tmp_name))
				{
					copy($tmp_name,"../images/background_image/".$img2);
				}
			}
			else
			{
				$img2 = "";
			}
			
			
			//START INSERT BUSINESS TABLE
			$sqlData = "INSERT INTO business_profile_tbl (user_id,firstname, lastname, additional_name, gender, contact_no, email, birth_month,birth_day, username, pass_word, address, city, state_province, country, url, profile_img, background_img) values ('".$row_login['user_id']."','".$_POST['txt_fname']."','".$_POST['txt_lname']."', '".$_POST['txt_aname']."', '".$_POST['rdb_gender']."', '".$_POST['txt_mno']."', '".$_POST['txt_email']."', '".$_POST['cmb_birthmonth']."','".$_POST['cmb_birthday']."', '".$_POST['txt_uname']."', '".$_POST['txt_pwd']."', '".$_POST['txt_address']."', '".$_POST['txt_city']."', '".$_POST['txt_state']."', '".$_POST['cmb_country']."', '".$_POST['txt_http']."', '".$img1."', '".$img2."')";
			
			//echo $sqlData;
			
		
			$resultData = mysqli_query($con,$sqlData);
			$business_id = mysqli_insert_id($con);
			
			
			if(!$resultData)
			{
				die("Not Inserted".mysqli_error($con));
			}
			else
			{	
				//echo $business_id ;
				//START INSERT EDUCATION TABLE
				$sqled = "CALL inserteducation('".$business_id."','".$_POST['txt_school_name']."', '".$_POST['cmb_degree']."', '".$_POST['cmb_startmonth']."', '".$_POST['cmb_endmonth']."','".$_POST['txt_act_soc']."', '".$_POST['txt_grade']."', '".$_POST['cmb_field']."', '".$_POST['cmb_startyear']."', '".$_POST['cmb_endyear']."','".$_POST['txt_desc']."','".$row_login['user_id']."')";
				//echo $sqled;
				
				$resulted = mysqli_query($con,$sqled);
				
				
				//END INSERT EDUCTION TABLE
				
				
				//START INSERT EXPERIANCE TABLE
				
				$sqlen = "CALL insertexperience('".$business_id."','".$_POST['cmb_title']."', '".$_POST['cmb_emp']."', '".$_POST['cmb_smonth']."','".$_POST['cmb_emonth']."', '".$_POST['txt_head']."', '".$_POST['txt_company_name']."', '".$_POST['txt_loc']."', '".$_POST['cmb_syear']."', '".$_POST['cmb_eyear']."', '".$_POST['cmb_industry']."','".$row_login['user_id']."')";
				//echo $sqlen;
				
				$resulten = mysqli_query($con,$sqlen);
				
				
				//END INSERT EXPERIANCE TABLE
					
				//('location:view_business_profile.php');
				echo "<script>window.location = 'view_business_profile.php';</script>";
			}
		
			//END INSERT BUSINESS TABLE
			
			
			
			
		 }
		else
		{
			if(!empty($_FILES["profile_image"]["name"]))
			 {
			 	
				$image1 =  $row_data['profile_img'];
				$path = $_SERVER['DOCUMENT_ROOT'].'/tryon_project_btv/images/profile_image/';
				if(file_exists($path.$image1))
				{
					unlink($path.$image1);
				}
				
				$img1= $_FILES["profile_image"]["name"];
				$img1 = pathinfo($img1, PATHINFO_FILENAME).mt_rand(600000,999999).".".pathinfo($img1, PATHINFO_EXTENSION);				
				$tmp_name=$_FILES["profile_image"]["tmp_name"];
				if(is_uploaded_file($tmp_name))
				{
					copy($tmp_name,"../images/profile_image/".$img1);
				}
			}
			else
			{
				$img1 =  $row_data['profile_img'];
			}
				
			
			//BACKGROUND IMGE
			
			if(!empty($_FILES["background_image"]["name"]))
			 {
			 
			 	$image2 =  $row_data['background_img'];
				$path = $_SERVER['DOCUMENT_ROOT'].'/tryon_project_btv/images/background_image/';
				if(file_exists($path.$image2))
				{
					unlink($path.$image2);
				}
				
				$img2= $_FILES["background_image"]["name"];
				$img2= pathinfo($img2, PATHINFO_FILENAME).mt_rand(600000,999999).".".pathinfo($img2, PATHINFO_EXTENSION);				
				$tmp_name=$_FILES["background_image"]["tmp_name"];
				if(is_uploaded_file($tmp_name))
				{
					copy($tmp_name,"../images/background_image/".$img2);
				}
			}
			else
			{
				$img2 = $row_data['background_img'];
			}
			//echo "update Code";
			//UPDATED QUERY
			$sqlData = "UPDATE business_profile_tbl SET firstname = '".$_POST['txt_fname']."',lastname = '".$_POST['txt_lname']."',additional_name = '".$_POST['txt_aname']."',gender = '".$_POST['rdb_gender']."',contact_no = '".$_POST['txt_mno']."', email = '".$_POST['txt_email']."', birth_month = '".$_POST['cmb_birthmonth']."', birth_day = '".$_POST['cmb_birthday']."',username = '".$_POST['txt_uname']."',pass_word = '".$_POST['txt_pwd']."',address = '".$_POST['txt_address']."',city = '".$_POST['txt_city']."', state_province = '".$_POST['txt_state']."', country = '".$_POST['cmb_country']."', url = '".$_POST['txt_http']."', profile_img = '".$img1."', background_img = '".$img2."' WHERE business_id = '".$_POST['business_id']."'";
			
			//echo $sqlData;
			
			 
			$resultData = mysqli_query($con,$sqlData);
			
			
			$sqled = "CALL updateEducation ('".$_POST['business_id']."',  '".$_POST['txt_school_name']."', '".$_POST['cmb_degree']."', '".$_POST['cmb_startmonth']."','".$_POST['cmb_endmonth']."','".$_POST['txt_act_soc']."', '".$_POST['txt_grade']."', '".$_POST['cmb_field']."', '".$_POST['cmb_startyear']."', '".$_POST['cmb_endyear']."','".$_POST['txt_desc']."')";
			
			$resulted = mysqli_query($con,$sqled);
			
			
			$sqlen = "CALL updateExperience('".$_POST['business_id']."', '".$_POST['cmb_title']."', '".$_POST['cmb_emp']."', '".$_POST['cmb_smonth']."', '".$_POST['cmb_emonth']."','".$_POST['txt_head']."', '".$_POST['txt_company_name']."', '".$_POST['txt_loc']."', '".$_POST['cmb_syear']."', '".$_POST['cmb_eyear']."','".$_POST['cmb_industry']."')";
			
			$resulten = mysqli_query($con,$sqlen);
			
			echo "<script>window.location = 'view_business_profile.php';</script>";
			
		}	
	
	  		
		
	}			
	else
	{}	
?>



<div class="block-header">
	<div class="row">
		<div class="col-lg-5 col-md-8 col-sm-12">                        
			<h2><a href="#" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>Business Profile</h2>
			<ul class="breadcrumb">
				<li class="breadcrumb-item"><a href="dashboard.php"><i class="icon-home"></i></a></li>                            
				<li class="breadcrumb-item">Forms</li>
				<li class="breadcrumb-item active">Business Profile</li>
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

<div class="row clearfix">
                <div class="col-lg-12">
                    <diV class="card">
						
						<form action="" method="post" name="frmBusinessProfile" id="frmBusinessProfile" enctype="multipart/form-data">
						
                        <div class="body">
                            <ul class="nav nav-tabs">                                
                                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#Settings">Business Profile</a></li>
                                
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#preferences">Education</a></li>
								<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#billings">Experience</a></li>
								<li style="position: absolute;right: 20px;">
									<div class="text-right">
									
									<input type="hidden" id="business_id" name="business_id" value="<?php if(isset($_GET['business_id'])){ echo $row_data['business_id']; } ?>" />
									<button type="submit" id="btn_save" name="btn_save" class="btn btn-primary">Save</button>
								</div> 
								</li>
                            </ul>
							
                        </div>
                        <diV class="tab-content">
    
                            <diV class="tab-pane active" id="Settings">

                                <diV class="body">
								
									<div class="row clearfix">
                                        <div class="col-lg-6 col-md-12">
											<h6>Profile Photo</h6>
											<div class="media">
												<div class="media-right m-r-15">
													<img src = "../images/profile_image/<?php if(isset($_GET['business_id'])){ echo $row_data['profile_img']; } ?>" id="imgprw" height="80px" width="80px" border="5" style="margin-bottom:15px;" />
												</div>
												<div class="media-body">
													<p>Upload your photo.</p>
												<input type="file" class="form-control"  id="profile_image" name="profile_image" accept="image/*" onchange="ValidateSize1(this)"  />
												</div>
											</div>
										</div>
										
										 <div class="col-lg-6 col-md-8">
										 	 <h6>Background Photo</h6>
                                    		<div class="media">
                                        <div class="media-right m-r-15">
                                            <img src="../images/background_image/<?php if(isset($_GET['business_id'])){ echo $row_data['background_img']; } ?>" id="imgprw1" height="80px" width="80px" border="5" style="margin-bottom:15px;" />
                                        </div>
                                        <div class="media-body">
                                            <p>Upload your photo.</p>
                                            
                                            <input type="file" class="form-control"  id="background_image" name="background_image" accept="image/*" onchange="ValidateSize2(this)" />
                                        </div>
                                    </div>
										 </div>
									</div>
                                </div>
																
                                <div class="body">
                                    <h6>Basic Information</h6>
                                    <div class="row clearfix">
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">                                                
                                                <input type="text" class="form-control" name="txt_fname" id="txt_fname" placeholder="First Name" value="<?php if(isset($_GET['business_id'])){ echo $row_data['firstname']; } ?>" />
                                            </div>
                                            <div class="form-group">                                                
                                                <input type="text" class="form-control" name="txt_lname" id="txt_lname" placeholder="Last Name" value="<?php if(isset($_GET['business_id'])){ echo $row_data['lastname']; } ?>">
                                            </div>
											<div class="form-group">                                                
                                                <input type="text" class="form-control" name="txt_aname" id="txt_aname" placeholder="Additional Name" value= "<?php if(isset($_GET['business_id'])){ echo $row_data['additional_name']; } ?>"/>
                                            </div>
                                            <div class="form-group">
                                                <div>
                                                    <label class="fancy-radio">
                                                        <input value="male" type="radio" name="rdb_gender" id="rdb_gender" checked value= "<?php if(isset($_GET['business_id'])){ echo $row_data['gender']; } ?>">
                                                        <span><i></i>Male</span>
                                                    </label>
                                                    <label class="fancy-radio">
                                                        <input value="female" type="radio" name="rdb_gender" id="rdb_gender" value= "<?php if(isset($_GET['business_id'])){ echo $row_data['gender']; } ?>">
                                                        <span><i></i>Female</span>
                                                    </label>
                                                </div>
                                            </div>
											
											<div class="form-group">
                                                <input type="number" class="form-control" name="txt_mno" id="txt_mno" placeholder="Contact No" value= "<?php if(isset($_GET['business_id'])){ echo $row_data['contact_no']; } ?>">
                                            </div>
											
											<div class="form-group">
                                                <input type="email" class="form-control" name="txt_email" id="txt_email" placeholder="Email" value= "<?php if(isset($_GET['business_id'])){ echo $row_data['email']; } ?>">
                                            </div>
          								 <div class="row"> 
            							<div class="col-md-6" > 
               <div class="form-group"> 
              <select name="cmb_birthmonth" id="cmb_birthmonth" class="form-control" style="margin-top: 10px;" value= "<?php if(isset($_GET['business_id'])){ echo $row_data['birth_month']; } ?>"> 
              <option value="">Birth Month</option> 
              <option value="January">January</option> 
              <option value="February">February</option> 
              <option value="March">March</option> 
              <option value="April">April</option> 
              <option value="May">May</option> 
              <option value="June">June</option> 
              <option value="July">July</option> 
              <option value="August">August</option> 
              <option value="September">September</option> 
              <option value="October">October</option> 
              <option value="November">November</option> 
              <option value="December">December</option> 
              </select> 
             </div> 
             </div> 
            							 <div class="col-md-6"> 
             <div class="form-group"> 
             <select name="cmb_birthday" id="cmb_birthday" class="form-control" style="margin-top: 10px;" value= "<?php if(isset($_GET['business_id'])){ echo $row_data['birth_day']; } ?>"> 
             <option value="">Birth Day</option> 
             <option value="1">1</option> 
             <option value="2">2</option> 
             <option value="3">3</option> 
             <option value="4">4</option> 
             <option value="5">5</option> 
             <option value="6">6</option> 
             <option value="7">7</option> 
             <option value="8">8</option> 
             <option value="9">9</option> 
             <option value="10">10</option> 
             <option value="11">11</option> 
             <option value="12">12</option> 
             <option value="13">13</option> 
             <option value="14">14</option> 
             <option value="15">15</option> 
             <option value="16">16</option> 
             <option value="17">17</option> 
             <option value="18">18</option> 
             <option value="19">19</option> 
             <option value="20">20</option> 
             <option value="21">21</option> 
             <option value="22">22</option> 
             <option value="23">23</option> 
             <option value="24">24</option> 
             <option value="25">25</option> 
             <option value="26">26</option> 
             <option value="27">27</option> 
             <option value="28">28</option> 
             <option value="29">29</option> 
             <option value="30">30</option> 
             <option value="31">31</option> 
             </select> 
            </div> 
            </div> 
           								 </div> 
                                            
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">                                                
                                                <input type="text" class="form-control" name="txt_uname" id="txt_uname" placeholder="UserName"  value= "<?php if(isset($_GET['business_id'])){ echo $row_data['username']; } ?>">
                                            </div>
											<div class="form-group">                                                
                                                <input type="password" class="form-control" name="txt_pwd" id="txt_pwd" placeholder="Password"  value= "<?php if(isset($_GET['business_id'])){ echo $row_data['pass_word']; } ?>">
                                            </div>
											<div class="form-group">                                                
                                                <div class="form-group">
                                                <input type="address" class="form-control" name="txt_address" id="txt_address" placeholder="Adrdress"  value= "<?php if(isset($_GET['business_id'])){ echo $row_data['address']; } ?>">
                                            </div>
                                            
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="txt_city" id="txt_city" placeholder="City"  value= "<?php if(isset($_GET['business_id'])){ echo $row_data['city']; } ?>">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="txt_state" id="txt_state" placeholder="State/Province"  value= "<?php if(isset($_GET['business_id'])){ echo $row_data['state_province']; } ?>">
                                            </div>
                                            <div class="form-group">
                                                <select class="form-control" name="cmb_country" id="cmb_country" >
                                                    <option value="">-- Select Country --</option>
                                                    <option value="Afghanistan" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Afghanistan')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Afghanistan</option>
                                                    <option value="Åland Islands" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Åland Islands')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Åland Islands</option>
                                                    <option value="Albania" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Albania')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Albania</option>
                                                    <option value="Algeria" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Algeria')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Algeria</option>
                                                    <option value="American Samoa" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'American Samoa')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>American Samoa</option>
                                                    <option value="Andorra" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Andorra')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Andorra</option>
                                                    <option value="Angola" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Angola')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Angola</option>
                                                    <option value="Anguilla" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Anguilla')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Anguilla</option>
                                                    <option value="Antarctica" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Antarctica')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Antarctica</option>
                                                    <option value="Antigua and Barbuda" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Antigua and Barbuda')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Antigua and Barbuda</option>
                                                    <option value="Argentina" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Argentina')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Argentina</option>
                                                    <option value="Armenia" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Armenia')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Armenia</option>
                                                    <option value="Aruba" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Aruba')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Aruba</option>
                                                    <option value="Australia" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Australia')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Australia</option>
                                                    <option value="Austria" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Austria')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Austria</option>
                                                    <option value="Azerbaijan" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Azerbaijan')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Azerbaijan</option>
                                                    <option value="Bahamas" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Bahamas')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Bahamas</option>
                                                    <option value="Bahrain" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Bahrain')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Bahrain</option>
                                                    <option value="Bangladesh" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Bangladesh')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Bangladesh</option>
                                                    <option value="Barbados" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Barbados')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Barbados</option>
                                                    <option value="Belarus" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Belarus')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Belarus</option>
                                                    <option value="Belgium" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Belgium')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Belgium</option>
                                                    <option value="Belize" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Belize')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Belize</option>
                                                    <option value="Benin" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Benin')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Benin</option>
                                                    <option value="Bermuda" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Bermuda')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Bermuda</option>
                                                    <option value="Bhutan" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Bhutan')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Bhutan</option>
                                                    <option value="Bolivia, Plurinational State of" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Bolivia, Plurinational State of')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Bolivia, Plurinational State of</option>
                                                    <option value="Bonaire, Sint Eustatius and Saba" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Bonaire, Sint Eustatius and Saba')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Bonaire, Sint Eustatius and Saba</option>
                                                    <option value="Bosnia and Herzegovina" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Bosnia and Herzegovina')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Bosnia and Herzegovina</option>
                                                    <option value="Botswana" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Botswana')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Botswana</option>
                                                    <option value="Bouvet Island" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Bouvet Island')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Bouvet Island</option>
                                                    <option value="Brazil" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Brazil')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Brazil</option>
                                                    <option value="British Indian Ocean Territory" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'British Indian Ocean Territory')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>British Indian Ocean Territory</option>
                                                    <option value="Brunei Darussalam" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Brunei Darussalam')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Brunei Darussalam</option>
                                                    <option value="Bulgaria" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Bulgaria')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Bulgaria</option>
                                                    <option value="Burkina Faso" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Burkina Faso')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Burkina Faso</option>
                                                    <option value="Burundi" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Burundi')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Burundi</option>
                                                    <option value="Cambodia" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Cambodia')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Cambodia</option>
                                                    <option value="Cameroon" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Cameroon')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Cameroon</option>
                                                    <option value="Canada" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Canada')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Canada</option>
                                                    <option value="Cape Verde" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Cape Verde')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Cape Verde</option>
                                                    <option value="Cayman Islands" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Cayman Islands')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Cayman Islands</option>
                                                    <option value="Central African Republic" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Central African Republic')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Central African Republic</option>
                                                    <option value="Chad" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Chad')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Chad</option>
                                                    <option value="Chile" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Chile')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Chile</option>
                                                    <option value="China" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'China')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>China</option>
                                                    <option value="Christmas Island" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Christmas Island')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Christmas Island</option>
                                                    <option value="Cocos (Keeling) Islands" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Cocos (Keeling) Islands')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Cocos (Keeling) Islands</option>
                                                    <option value="Colombia" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Colombia')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Colombia</option>
                                                    <option value="Comoros" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Comoros')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Comoros</option>
                                                    <option value="Congo" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Congo')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Congo</option>
                                                    <option value="Congo, the Democratic Republic of the" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Congo, the Democratic Republic of the')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Congo, the Democratic Republic of the</option>
                                                    <option value="Cook Islands" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Cook Islands')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Cook Islands</option>
                                                    <option value="Costa Rica" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Costa Rica')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Costa Rica</option>
                                                    <option value="Côte d'Ivoire" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Côte d Ivoire')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Côte d'Ivoire</option>
                                                    <option value="Croatia" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Croatia')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Croatia</option>
                                                    <option value="Cuba" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Cuba')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Cuba</option>
                                                    <option value="Curaçao" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Curaçao')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Curaçao</option>
                                                    <option value="Cyprus" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Cyprus')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Cyprus</option>
                                                    <option value="Czech Republic" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Czech Republic')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Czech Republic</option>
                                                    <option value="Denmark" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Denmark')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Denmark</option>
                                                    <option value="Djibouti" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Djibouti')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Djibouti</option>
                                                    <option value="Dominica" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Dominica')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Dominica</option>
                                                    <option value="Dominican Republic" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Dominican Republic')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Dominican Republic</option>
                                                    <option value="Ecuador" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Ecuador')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Ecuador</option>
                                                    <option value="Egypt" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Egypt')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Egypt</option>
                                                    <option value="El Salvador" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'El Salvador')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>El Salvador</option>
                                                    <option value="Equatorial Guinea" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Equatorial Guinea')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Equatorial Guinea</option>
                                                    <option value="Eritrea" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Eritrea')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Eritrea</option>
                                                    <option value="Estonia" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Estonia')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Estonia</option>
                                                    <option value="Ethiopia" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Ethiopia')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Ethiopia</option>
                                                    <option value="Falkland Islands (Malvinas)" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Falkland Islands (Malvinas)')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Falkland Islands (Malvinas)</option>
                                                    <option value="Faroe Islands" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Faroe Islands')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Faroe Islands</option>
                                                    <option value="Fiji" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Fiji')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Fiji</option>
                                                    <option value="Finland" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Finland')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Finland</option>
                                                    <option value="France" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'France')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>France</option>
                                                    <option value="French Guiana" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'French Guiana')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>French Guiana</option>
                                                    <option value="French Polynesia" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'French Polynesia')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>French Polynesia</option>
                                                    <option value="French Southern Territories"<?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'French Southern Territories')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>French Southern Territories</option>
                                                    <option value="Gabon" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Gabon')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Gabon</option>
                                                    <option value="Gambia" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Gambia')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Gambia</option>
                                                    <option value="Georgia" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Georgia')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Georgia</option>
                                                    <option value="Germany" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Germany')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Germany</option>
                                                    <option value="Ghana" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Ghana')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Ghana</option>
                                                    <option value="Gibraltar" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Gibraltar')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Gibraltar</option>
                                                    <option value="Greece" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Greece')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Greece</option>
                                                    <option value="Greenland" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Greenland')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Greenland</option>
                                                    <option value="Grenada" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Grenada')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Grenada</option>
                                                    <option value="Guadeloupe" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Guadeloupe')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Guadeloupe</option>
                                                    <option value="Guam" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Guam')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Guam</option>
                                                    <option value="Guatemala" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Guatemala')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Guatemala</option>
                                                    <option value="Guernsey" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Guernsey')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Guernsey</option>
                                                    <option value="Guinea" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Guinea')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Guinea</option>
                                                    <option value="Guinea-Bissau" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Guinea-Bissau')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Guinea-Bissau</option>
                                                    <option value="Guyana" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Guyana')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Guyana</option>
                                                    <option value="Haiti" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Haiti')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Haiti</option>
                                                    <option value="Heard Island and McDonald Islands" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Heard Island and McDonald Islands')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Heard Island and McDonald Islands</option>
                                                    <option value="Holy See (Vatican City State)" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Holy See (Vatican City State)')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Holy See (Vatican City State)</option>
                                                    <option value="Honduras" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Honduras')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Honduras</option>
                                                    <option value="Hong Kong" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Hong Kong')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Hong Kong</option>
                                                    <option value="Hungary" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Hungary')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Hungary</option>
                                                    <option value="Iceland" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Iceland')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Iceland</option>
                                                    <option value="India" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'India')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>India</option>
                                                    <option value="Indonesia" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Indonesia')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Indonesia</option>
                                                    <option value="Iran, Islamic Republic of" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Iran, Islamic Republic of')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Iran, Islamic Republic of</option>
                                                    <option value="Iraq" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Iraq')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Iraq</option>
                                                    <option value="Ireland" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Ireland')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Ireland</option>
                                                    <option value="Isle of Man" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Isle of Man')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Isle of Man</option>
                                                    <option value="Israel" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Israel')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Israel</option>
                                                    <option value="Italy" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Italy')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Italy</option>
                                                    <option value="Jamaica" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Jamaica')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Jamaica</option>
                                                    <option value="Japan" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Japan')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Japan</option>
                                                    <option value="Jersey" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Jersey')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Jersey</option>
                                                    <option value="Jordan" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Jordan')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Jordan</option>
                                                    <option value="Kazakhstan" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Kazakhstan')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Kazakhstan</option>
                                                    <option value="Kenya" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Kenya')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Kenya</option>
                                                    <option value="Kiribati" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Kiribati')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Kiribati</option>
                                                    <option value="Korea, Democratic People's Republic of" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Korea, Democratic People Republic of')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Korea, Democratic People's Republic of</option>
                                                    <option value="Korea, Republic of" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Korea, Republic of')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Korea, Republic of</option>
                                                    <option value="Kuwait" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Kuwait')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Kuwait</option>
                                                    <option value="Kyrgyzstan" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Kyrgyzstan')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Kyrgyzstan</option>
                                                    <option value="Lao People's Democratic Republic" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Lao People Democratic Republic')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Lao People's Democratic Republic</option>
                                                    <option value="Latvia" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Latvia')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Latvia</option>
                                                    <option value="Lebanon" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Lebanon')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Lebanon</option>
                                                    <option value="Lesotho" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Lesotho')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Lesotho</option>
                                                    <option value="Liberia" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Liberia')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Liberia</option>
                                                    <option value="Libya" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Libya')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Libya</option>
                                                    <option value="Liechtenstein" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Liechtenstein')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Liechtenstein</option>
                                                    <option value="Lithuania" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Lithuania')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Lithuania</option>
                                                    <option value="Luxembourg" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Luxembourg')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Luxembourg</option>
                                                    <option value="Macao" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Macao')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Macao</option>
                                                    <option value="Macedonia, the former Yugoslav Republic of" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Macedonia, the former Yugoslav Republic of')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Macedonia, the former Yugoslav Republic of</option>
                                                    <option value="Madagascar" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Madagascar')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Madagascar</option>
                                                    <option value="Malawi" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Malawi')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Malawi</option>
                                                    <option value="Malaysia" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Malaysia')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Malaysia</option>
                                                    <option value="Maldives" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Maldives')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Maldives</option>
                                                    <option value="Mali" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Mali')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Mali</option>
                                                    <option value="Malta" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Malta')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Malta</option>
                                                    <option value="Marshall Islands" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Marshall Islands')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Marshall Islands</option>
                                                    <option value="Martinique" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Martinique')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Martinique</option>
                                                    <option value="Mauritania" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Mauritania')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Mauritania</option>
                                                    <option value="Mauritius" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Mauritius')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Mauritius</option>
                                                    <option value="Mayotte" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Mayotte')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Mayotte</option>
                                                    <option value="Mexico" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Mexico')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Mexico</option>
                                                    <option value="Micronesia, Federated States of" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Micronesia, Federated States of')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Micronesia, Federated States of</option>
                                                    <option value="Moldova, Republic of" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Moldova, Republic of')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Moldova, Republic of</option>
                                                    <option value="Monaco" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Monaco')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Monaco</option>
                                                    <option value="Mongolia" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Mongolia')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Mongolia</option>
                                                    <option value="Montenegro" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Montenegro')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Montenegro</option>
                                                    <option value="Montserrat" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Montserrat')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Montserrat</option>
                                                    <option value="Morocco" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Morocco')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Morocco</option>
                                                    <option value="Mozambique" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Mozambique')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Mozambique</option>
                                                    <option value="Myanmar" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Myanmar')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Myanmar</option>
                                                    <option value="Namibia" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Namibia')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Namibia</option>
                                                    <option value="Nauru" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Nauru')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Nauru</option>
                                                    <option value="Nepal" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Nepal')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Nepal</option>
                                                    <option value="Netherlands" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Netherlands')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Netherlands</option>
                                                    <option value="New Caledonia" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'New Caledonia')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>New Caledonia</option>
                                                    <option value="New Zealand" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'New Zealand')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>New Zealand</option>
                                                    <option value="Nicaragua" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Nicaragua')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Nicaragua</option>
                                                    <option value="Niger" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Niger')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Niger</option>
                                                    <option value="Nigeria" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Nigeria')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Nigeria</option>
                                                    <option value="Niue" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Niue')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Niue</option>
                                                    <option value="Norfolk Island" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Norfolk Island')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Norfolk Island</option>
                                                    <option value="Northern Mariana Islands" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Northern Mariana Islands')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Northern Mariana Islands</option>
                                                    <option value="Norway" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Norway')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Norway</option>
                                                    <option value="Oman" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Oman')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Oman</option>
                                                    <option value="Pakistan" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Pakistan')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Pakistan</option>
                                                    <option value="Palau" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Palau')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Palau</option>
                                                    <option value="Palestinian Territory, Occupied" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Palestinian Territory, Occupied')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Palestinian Territory, Occupied</option>
                                                    <option value="Panama" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Panama')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Panama</option>
                                                    <option value="Papua New Guinea" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Papua New Guinea')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Papua New Guinea</option>
                                                    <option value="Paraguay" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Paraguay')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Paraguay</option>
                                                    <option value="Peru" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Peru')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Peru</option>
                                                    <option value="Philippines" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Philippines')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Philippines</option>
                                                    <option value="Pitcairn" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Pitcairn')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Pitcairn</option>
                                                    <option value="Poland" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Poland')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Poland</option>
                                                    <option value="Portugal" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Portugal')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Portugal</option>
                                                    <option value="Puerto Rico" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Puerto Rico')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Puerto Rico</option>
                                                    <option value="Qatar" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Qatar')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Qatar</option>
                                                    <option value="Réunion" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Réunion')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Réunion</option>
                                                    <option value="Romania" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Romania')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Romania</option>
                                                    <option value="Russian Federation" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Russian Federation')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Russian Federation</option>
                                                    <option value="Rwanda" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Rwanda')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Rwanda</option>
                                                    <option value="Saint Barthélemy" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Saint Barthélemy')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Saint Barthélemy</option>
                                                    <option value="Saint Helena, Ascension and Tristan da Cunha" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Saint Helena, Ascension and Tristan da Cunha')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Saint Helena, Ascension and Tristan da Cunha</option>
                                                    <option value="Saint Kitts and Nevis" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Saint Kitts and Nevis')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Saint Kitts and Nevis</option>
                                                    <option value="Saint Lucia" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Saint Lucia')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Saint Lucia</option>
                                                    <option value="Saint Martin (French part)" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Saint Martin (French part)')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Saint Martin (French part)</option>
                                                    <option value="Saint Pierre and Miquelon" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Saint Pierre and Miquelon')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Saint Pierre and Miquelon</option>
                                                    <option value="Saint Vincent and the Grenadines" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Saint Vincent and the Grenadines')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Saint Vincent and the Grenadines</option>
                                                    <option value="Samoa" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Samoa')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Samoa</option>
                                                    <option value="San Marino" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'San Marino')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>San Marino</option>
                                                    <option value="Sao Tome and Principe" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Sao Tome and Principe')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Sao Tome and Principe</option>
                                                    <option value="Saudi Arabia" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Saudi Arabia')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Saudi Arabia</option>
                                                    <option value="Senegal" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Senegal')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Senegal</option>
                                                    <option value="Serbia" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Serbia')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Serbia</option>
                                                    <option value="Seychelles" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Seychelles')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Seychelles</option>
                                                    <option value="Sierra Leone" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Sierra Leone')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Sierra Leone</option>
                                                    <option value="Singapore" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Singapore')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Singapore</option>
                                                    <option value="Sint Maarten (Dutch part)" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Sint Maarten (Dutch part)')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Sint Maarten (Dutch part)</option>
                                                    <option value="Slovakia" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Slovakia')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Slovakia</option>
                                                    <option value="Slovenia" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Slovenia')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Slovenia</option>
                                                    <option value="Solomon Islands" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Solomon Islands')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Solomon Islands</option>
                                                    <option value="Somalia" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Somalia')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Somalia</option>
                                                    <option value="South Africa" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'South Africa')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>South Africa</option>
                                                    <option value="South Georgia and the South Sandwich Islands" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'South Georgia and the South Sandwich Islands')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>South Georgia and the South Sandwich Islands</option>
                                                    <option value="South Sudan" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'South Sudan')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>South Sudan</option>
                                                    <option value="Spain" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Spain')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Spain</option>
                                                    <option value="Sri Lanka" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Sri Lanka')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Sri Lanka</option>
                                                    <option value="Sudan" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Sudan')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Sudan</option>
                                                    <option value="Suriname" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Suriname')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Suriname</option>
                                                    <option value="Svalbard and Jan Mayen" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Svalbard and Jan Mayen')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Svalbard and Jan Mayen</option>
                                                    <option value="Swaziland" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Swaziland')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Swaziland</option>
                                                    <option value="Sweden" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Sweden')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Sweden</option>
                                                    <option value="Switzerland" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Switzerland')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Switzerland</option>
                                                    <option value="Syrian Arab Republic" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Syrian Arab Republic')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Syrian Arab Republic</option>
                                                    <option value="Taiwan, Province of China" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Taiwan, Province of China')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Taiwan, Province of China</option>
                                                    <option value="Tajikistan" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Tajikistan')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Tajikistan</option>
                                                    <option value="Tanzania, United Republic of" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Tanzania, United Republic of')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Tanzania, United Republic of</option>
                                                    <option value="Thailand" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Thailand')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Thailand</option>
                                                    <option value="Timor-Leste" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Timor-Leste')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Timor-Leste</option>
                                                    <option value="Togo" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Togo')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Togo</option>
                                                    <option value="Tokelau" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Tokelau')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Tokelau</option>
                                                    <option value="Tonga" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Tonga')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Tonga</option>
                                                    <option value="Trinidad and Tobago" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Trinidad and Tobago')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Trinidad and Tobago</option>
                                                    <option value="Tunisia" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Tunisia')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Tunisia</option>
                                                    <option value="Turkey" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Turkey')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Turkey</option>
                                                    <option value="Turkmenistan" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Turkmenistan')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Turkmenistan</option>
                                                    <option value="Turks and Caicos Islands" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Turks and Caicos Islands')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Turks and Caicos Islands</option>
                                                    <option value="Tuvalu" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Tuvalu')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Tuvalu</option>
                                                    <option value="Uganda" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Uganda')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Uganda</option>
                                                    <option value="Ukraine" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Ukraine')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Ukraine</option>
                                                    <option value="United Arab Emirates" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'United Arab Emirates')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>United Arab Emirates</option>
                                                    <option value="United Kingdom" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'United Kingdom')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>United Kingdom</option>
                                                    <option value="United States" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'United States')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>United States</option>
                                                    <option value="United States Minor Outlying Islands" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'United States Minor Outlying Islands')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>United States Minor Outlying Islands</option>
                                                    <option value="Uruguay" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Uruguay')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Uruguay</option>
                                                    <option value="Uzbekistan" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Uzbekistan')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Uzbekistan</option>
                                                    <option value="Vanuatu" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Vanuatu')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Vanuatu</option>
                                                    <option value="Venezuela, Bolivarian Republic of" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Venezuela, Bolivarian Republic of')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Venezuela, Bolivarian Republic of</option>
                                                    <option value="Viet Nam" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Viet Nam')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Viet Nam</option>
                                                    <option value="Virgin Islands, British" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Virgin Islands, British')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Virgin Islands, British</option>
                                                    <option value="Virgin Islands, U.S." <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Virgin Islands, U.S.')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Virgin Islands, U.S.</option>
                                                    <option value="Wallis and Futuna" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Wallis and Futuna')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Wallis and Futuna</option>
                                                    <option value="Western Sahara" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Western Sahara')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Western Sahara</option>
                                                    <option value="Yemen" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Yemen')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Yemen</option>
                                                    <option value="Zambia" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Zambia')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Zambia</option>
                                                    <option value="Zimbabwe" <?php if(isset($_GET['business_id']))
																					  { 
																					  	if($row_data['country'] == 'Zimbabwe')
																						{
																					  		echo 'selected';
																						}
																					  } 
																				?>>Zimbabwe</option>
                                                </select>
                                            </div>
											<div class="form-group">
                                                <input type="text" class="form-control" name="txt_http" id="txt_http" placeholder="http://" value= "<?php if(isset($_GET['business_id'])){ echo $row_data['url']; } ?>">
                                            </div>
											
                                        </div>
                                    </div>
                                   
                                </div>   
								                        
                       			
                            </div>                         
									
                        	</div>
						
							<div class="tab-pane" id="preferences">
									<div class="body">
										
										<h6>Education</h6>
										<div class="row clearfix">
											<div class="col-lg-6 col-md-12">
												<div class="form-group">                                                
												<input type="text" class="form-control" name="txt_school_name" id="txt_school_name" placeholder="Enter School" value= "<?php if(isset($_GET['business_id'])){ echo $row_edu_data['activities_socilities']; } ?>">	
												</div>
												<div class="form-group">
													<select name="cmb_degree" id="cmb_degree" class="form-control" >
					<option value= "<?php if(isset($_GET['business_id'])){ echo $row_edu_data['degree_id']; } ?>">SELECT DEGREE</option>
					<?php
						$sql_select = "SELECT degree_id, degree FROM degree_tbl";
						$rs_select = mysqli_query($con,$sql_select);
						
						if(!$rs_select)
						{
							die('no category found'.mysqli_error($con));
						}
						
						while($row_select = mysqli_fetch_array($rs_select))
													{
														if(isset($_GET['business_id']))
														{ 
															if($row_edu_data['degree_id'] == $row_select['degree_id'])
															{
															?>
															
															<option value="<?php echo $row_select['degree_id']; ?>" selected="selected"><?php echo $row_select['degree']; ?></option>	
															<?php
															}
															else
															{
															?>
															<option value="<?php echo $row_select['degree_id']; ?>"><?php echo $row_select['degree']; ?></option>
															<?php
															}
													    }
														else
														{
														?>
														
														<option value="<?php echo $row_select['degree_id']; ?>"><?php echo $row_select['degree']; ?></option>
														<?php
														} 							
													
												?>
												
												<?php
													}
												?>
												</select>
												</div>
												<div class="form-group">
													<div class="input-group">
														<select name="cmb_startmonth" id="cmb_startmonth" class="form-control" value= "<?php if(isset($_GET['business_id'])){ echo $row_edu_data['startmonth']; } ?>">
														<option value="Select Month">Starting Month</option>
														<option value="January">January</option>
														<option value="February">February</option>
														<option value="March">March</option>
														<option value="April">April</option>
														<option value="May">May</option>
														<option value="June">June</option>
														<option value="July">July</option>
														<option value="August">August</option>
														<option value="September">September</option>
														<option value="October">October</option>
														<option value="November">November</option>
														<option value="December">December</option>
														</select> 
													</div>
												</div>
												<div class="form-group">
													<div class="input-group">
														<select name="cmb_endmonth" id="cmb_endmonth" class="form-control" value= "<?php if(isset($_GET['business_id'])){ echo $row_edu_data['endmonth']; } ?>">
														<option value="">Ending Month</option>
														<option value="January">January</option>
														<option value="February">February</option>
														<option value="March">March</option>
														<option value="April">April</option>
														<option value="May">May</option>
														<option value="June">June</option>
														<option value="July">July</option>
														<option value="August">August</option>
														<option value="September">September</option>
														<option value="October">October</option>
														<option value="November">November</option>
														<option value="December">December</option>
														</select> 
													</div>
												</div>
												<div class="form-group">
													<input type="text" class="form-control" name="txt_act_soc" id="txt_act_soc" placeholder="Activities & Socilities" value= "<?php if(isset($_GET['business_id'])){ echo $row_edu_data['activities_socilities']; } ?>">
												</div>
											</div>
											<div class="col-lg-6 col-md-12">
												<div class="form-group">                                                
													<input type="text" class="form-control" name="txt_grade" id="txt_grade" placeholder="Grade"  value= "<?php if(isset($_GET['business_id'])){ echo $row_edu_data['grade']; } ?>">
												</div>
												<div class="form-group">
													<select name="cmb_field" id="cmb_field" class="form-control">
					<option value="SELECT CATEGORY">SELECT FIELD OF STUDY</option>
					<?php
						$sql_select = "SELECT field_of_study_id , field_of_study_name FROM field_of_study_tbl";
						$rs_select = mysqli_query($con, $sql_select);
						
						if(!$rs_select)
						{
							die('no category found'.mysqli_error($con));
						}
						
						while($row_select = mysqli_fetch_array($rs_select))
													{
														if(isset($_GET['business_id']))
														{ 
															if($row_edu_data['field_of_study_id'] == $row_select['field_of_study_id'])
															{
															?>
															
															<option value="<?php echo $row_select['field_of_study_id']; ?>" selected="selected"><?php echo $row_select['field_of_study_name']; ?></option>	
															<?php
															}
															else
															{
															?>
															<option value="<?php echo $row_select['field_of_study_id']; ?>"><?php echo $row_select['field_of_study_name']; ?></option>
															<?php
															}
													    }
														else
														{
														?>
														
														<option value="<?php echo $row_select['field_of_study_id']; ?>"><?php echo $row_select['field_of_study_name']; ?></option>
														<?php
														} 							
													
												?>
												
												<?php
													}
												?>
												</select>
												</div>
												<div class="form-group">
													<div class="input-group">
														<select name="cmb_startyear" id="cmb_startyear" class="form-control" value= "<?php if(isset($_GET['business_id'])){ echo $row_edu_data['startyear']; } ?>">
													<option value="">Starting Year</option>
													<?php 
													for($i=1921;$i<=strftime("%Y");$i++)
													{
													?>
													<option value = "<?php echo $i;?>"><?php echo $i;?></option>
													<?php }?>
													</select> 
													</div>
												</div>
												<div class="form-group">
													<div class="input-group">
														<select name="cmb_endyear" id="cmb_endyear" class="form-control" value= "<?php if(isset($_GET['business_id'])){ echo $row_edu_data['endyear']; } ?>">
													<option value="">Ending Year</option>
													<?php 
													for($i=1921;$i<=strftime("%Y");$i++)
													{
													?>
													<option value = "<?php echo $i;?>"><?php echo $i;?></option>
													<?php }?>
													</select> 
													</div>
												</div>
												<div class="form-group">
													<input type="text" name="txt_desc" id="txt_desc" class="form-control" placeholder="Description" value= "<?php if(isset($_GET['business_id'])){ echo $row_edu_data['description_name']; } ?>">
												</div>
											</div>
										</div>
									   
									</div>
								</div>                         
						
							<div class="tab-pane" id="billings">
							
							<div class="body">
								
								<h6>Experience</h6>
								<div class="row clearfix">
									<div class="col-lg-6 col-md-12">
										<div class="form-group">                                                
											<select name="cmb_title" id="cmb_title" class="form-control">
												<option value= "<?php if(isset($_GET['business_id'])){ echo $row_exp_data['title_id']; } ?>">SELECT TITLE TYPE</option>
												<?php
													$sql_select = "SELECT title_id, title_type FROM title_tbl";
													$rs_select = mysqli_query($con, $sql_select);
													
													if(!$rs_select)
													{
														die('no category found'.mysqli_error($con));
													}
													
													while($row_select = mysqli_fetch_array($rs_select))
													{
														if(isset($_GET['business_id']))
														{ 
															if($row_exp_data['title_id'] == $row_select['title_id'])
															{
															?>
															
															<option value="<?php echo $row_select['title_id']; ?>" selected="selected"><?php echo $row_select['title_type']; ?></option>	
															<?php
															}
															else
															{
															?>
															<option value="<?php echo $row_select['title_id']; ?>"><?php echo $row_select['title_type']; ?></option>
															<?php
															}
													    }
														else
														{
														?>
														
														<option value="<?php echo $row_select['title_id']; ?>"><?php echo $row_select['title_type']; ?></option>
														<?php
														} 							
													
												?>
												
												<?php
													}
												?>
												</select>
										</div>
										<div class="form-group">
											<select name="cmb_emp" id="cmb_emp" class="form-control">
												<option value= "<?php if(isset($_GET['business_id'])){ echo $row_exp_data['employement_type_id']; } ?>">SELECT EMPLOYEMENT TYPE</option>
												<?php
													$sql_select = "SELECT employement_type_id , employement_type_name FROM employement_type_tbl";
													$rs_select = mysqli_query($con, $sql_select);
													
													if(!$rs_select)
													{
														die('no category found'.mysqli_error($con));
													}
													
													while($row_select = mysqli_fetch_array($rs_select))
													{
														if(isset($_GET['business_id']))
														{ 
															if($row_exp_data['employement_type_id'] == $row_select['employement_type_id'])
															{
															?>
															
															<option value="<?php echo $row_select['employement_type_id']; ?>" selected="selected"><?php echo $row_select['employement_type_name']; ?></option>	
															<?php
															}
															else
															{
															?>
															<option value="<?php echo $row_select['employement_type_id']; ?>"><?php echo $row_select['employement_type_name']; ?></option>
															<?php
															}
													    }
														else
														{
														?>
														
														<option value="<?php echo $row_select['employement_type_id']; ?>"><?php echo $row_select['employement_type_name']; ?></option>
														<?php
														} 							
													
												?>
												
												<?php
													}
												?>
												</select>
										</div>
							   
										<div class="form-group">
													<div class="input-group">
														<select name="cmb_smonth" id="cmb_smonth" class="form-control" value= "<?php if(isset($_GET['business_id'])){ echo $row_exp_data['start_month']; } ?>">
														<option value="">Starting Month</option>
														<option value="January">January</option>
														<option value="February">February</option>
														<option value="March">March</option>
														<option value="April">April</option>
														<option value="May">May</option>
														<option value="June">June</option>
														<option value="July">July</option>
														<option value="August">August</option>
														<option value="September">September</option>
														<option value="October">October</option>
														<option value="November">November</option>
														<option value="December">December</option>
														</select> 
													</div>
												</div>
										<div class="form-group">
													<div class="input-group">
														<select name="cmb_emonth" id="cmb_emonth" class="form-control" value= "<?php if(isset($_GET['business_id'])){ echo $row_exp_data['end_month']; } ?>">
														<option value="">Ending Month</option>
														<option value="January">January</option>
														<option value="February">February</option>
														<option value="March">March</option>
														<option value="April">April</option>
														<option value="May">May</option>
														<option value="June">June</option>
														<option value="July">July</option>
														<option value="August">August</option>
														<option value="September">September</option>
														<option value="October">October</option>
														<option value="November">November</option>
														<option value="December">December</option>
														</select> 
													</div>
												</div>
										<div class="form-group">
											<input type="text" class="form-control" name="txt_head" id="txt_head" placeholder="Headline" value= "<?php if(isset($_GET['business_id'])){ echo $row_exp_data['headline']; } ?>">
										</div>
									</div>
									
									<div class="col-lg-6 col-md-12">
										<div class="form-group">                                                
											<input type="text" class="form-control" name="txt_company_name" id="txt_company_name" placeholder="Enter Company" value= "<?php if(isset($_GET['business_id'])){ echo $row_exp_data['company_name']; } ?>">
										</div>
										<div class="form-group">
											<input type="text" class="form-control" name="txt_loc" id="txt_loc" placeholder="Location" value= "<?php if(isset($_GET['business_id'])){ echo $row_exp_data['location']; } ?>">
										</div>
										
										<div class="form-group">
													<div class="input-group">
														<select name="cmb_syear" id="cmb_syear" class="form-control" value= "<?php if(isset($_GET['business_id'])){ echo $row_exp_data['start_year']; } ?>">
													<option value="">Starting Year</option>
													<?php 
													for($i=1921;$i<=strftime("%Y");$i++)
													{
													?>
													<option value = "<?php echo $i;?>"><?php echo $i;?></option>
													<?php }?>
													</select> 
													</div>
												</div>
										<div class="form-group">
													<div class="input-group">
														<select name="cmb_eyear" id="cmb_eyear" class="form-control" value= "<?php if(isset($_GET['business_id'])){ echo $row_exp_data['end_year']; } ?>">
													<option value="">Ending Year</option>
													<?php 
													for($i=1921;$i<=strftime("%Y");$i++)
													{
													?>
													<option value = "<?php echo $i;?>"><?php echo $i;?></option>
													<?php }?>
													</select> 
													</div>
												</div>
										<div class="form-group">
											<select name="cmb_industry" id="cmb_industry" class="form-control">
												<option value= "<?php if(isset($_GET['business_id'])){ echo $row_exp_data['industry_id']; } ?>">SELECT INDUSTRY</option>
												<?php
													$sql_select = "SELECT industry_id  , industry_type FROM  industry_tbl";
													$rs_select = mysqli_query($con, $sql_select);
													
													if(!$rs_select)
													{
														die('no category found'.mysqli_error($con));
													}
													while($row_select = mysqli_fetch_array($rs_select))
													{
														if(isset($_GET['business_id']))
														{ 
															if($row_exp_data['industry_id'] == $row_select['industry_id'])
															{
															?>
															
															<option value="<?php echo $row_select['industry_id']; ?>" selected="selected"><?php echo $row_select['industry_type']; ?></option>	
															<?php
															}
															else
															{
															?>
															<option value="<?php echo $row_select['industry_id']; ?>"><?php echo $row_select['industry_type']; ?></option>
															<?php
															}
													    }
														else
														{
														?>
														
														<option value="<?php echo $row_select['industry_id']; ?>"><?php echo $row_select['industry_type']; ?></option>
														<?php
														} 							
													
												?>
												
												<?php
													}
												?>
												</select>
										</div>
									</div>
									
								</div>
								
							</div>
							<br>
						</div>
						
                    	</div>
						
						</form>
                </div>
            </div>
			
<script type="text/javascript" language="javascript">

	//RESTRIC FILE SIZE 2 MB
	//profile image
	function ValidateSize1(file) {
        var FileSize = file.files[0].size / 1024 / 1024; // in MB
        if (FileSize > 2) {
            alert('File size exceeds 2 MB');
			file.value = '';
			return false;
           // $(file).val(''); //for clearing with Jquery
        }
		else 
		{
			document.getElementById('imgprw').src = window.URL.createObjectURL(file.files[0]);
			//document.getElementById('imgprw1').src = window.URL.createObjectURL(file.files[0]);		
        }
		return true;
    }
	function RemoveImage()
	{		
		document.getElementById('imgprw').removeAttribute('src');
		//document.getElementById('imgprw1').removeAttribute('src');		
	}


	//RESTRIC FILE SIZE 2 MB
	//background image
	function ValidateSize2(file) {
        var FileSize = file.files[0].size / 1024 / 1024; // in MB
        if (FileSize > 2) {
            alert('File size exceeds 2 MB');
			file.value = '';
			return false;
           // $(file).val(''); //for clearing with Jquery
        }
		else 
		{
			//document.getElementById('imgprw').src = window.URL.createObjectURL(file.files[0]);
			document.getElementById('imgprw1').src = window.URL.createObjectURL(file.files[0]);		
        }
		return true;
    }
	function RemoveImage()
	{		
		//document.getElementById('imgprw').removeAttribute('src');
		document.getElementById('imgprw1').removeAttribute('src');		
	}
</script>

<?php
	include_once('footer.php');
?>
<script>
    $(function() {
        // photo upload
        $('#btn-upload-photo').on('click', function() {
            $(this).siblings('#filePhoto').trigger('click');
        });

        // plans
        $('.btn-choose-plan').on('click', function() {
            $('.plan').removeClass('selected-plan');
            $('.plan-title span').find('i').remove();

            $(this).parent().addClass('selected-plan');
            $(this).parent().find('.plan-title').append('<span><i class="fa fa-check-circle"></i></span>');
        });
    });
</script>
<script>
    $(function() {
        // photo upload
        $('#btn-upload-photo1').on('click', function() {
            $(this).siblings('#filePhoto').trigger('click');
        });

        // plans
        $('.btn-choose-plan').on('click', function() {
            $('.plan').removeClass('selected-plan');
            $('.plan-title span').find('i').remove();

            $(this).parent().addClass('selected-plan');
            $(this).parent().find('.plan-title').append('<span><i class="fa fa-check-circle"></i></span>');
        });
    });
</script>