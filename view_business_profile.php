<?php
	include_once('header.php');
?>

<div class="row clearfix">
 	<div class="col-lg-12">
		<div class="card">
			<div class="header">
				<h2>Business Profile</h2>                            
			</div>
			<div class="body">
			<div class="table-responsive">
				<table class="table table-bordered table-striped table-hover dataTable js-exportable">
					<thead>
						<tr>
							<th>Action</th>
							<th>SR No.</th>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Additional Name</th>
							<th>Gender</th>
							<th>Business Type</th>
							<th>Contact No</th>							
							<th>Email</th>
							<th>Birth Month</th>
							<th>Birth Day</th>
							<th>Username</th>
							<th>Address</th>
							<th>City</th>
							<th>State & Province</th>
							<th>Country</th>
							<th>URL</th>
							<th>Profile Image</th>
							<th>Background Image</th>
							<th>School</th>
							<th>Degree</th>
							<th>Start Month</th>
							<th>End Month</th>
							<th>Activities & Socilities</th>
							<th>Grade</th>
							<th>Field OF Study</th>
							<th>Start Year</th>
							<th>End Year</th>
							<th>Description</th>
							<th>Title</th>
							<th>Employement Type</th>
							<th>Start Month</th>
							<th>End Month</th>
							<th>Headline</th>
							<th>Company Name</th>
							<th>Location</th>
							<th>Start Year</th>
							<th>End Year</th>
							<th>Industry</th>							
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>Action</th>
							<th>SR No.</th>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Additional Name</th>
							<th>Gender</th>
							<th>Business Type</th>
							<th>Contact No</th>							
							<th>Email</th>
							<th>Birth Month</th>
							<th>Birth Day</th>
							<th>Username</th>
							<th>Address</th>
							<th>City</th>
							<th>State & Province</th>
							<th>Country</th>
							<th>URL</th>
							<th>Profile Image</th>
							<th>Background Image</th>
							<th>School</th>
							<th>Degree</th>
							<th>Start Month</th>
							<th>End Month</th>
							<th>Activities & Socilities</th>
							<th>Grade</th>
							<th>Field OF Study</th>
							<th>Start Year</th>
							<th>End Year</th>
							<th>Description</th>
							<th>Title</th>
							<th>Employement Type</th>
							<th>Start Month</th>
							<th>End Month</th>
							<th>Headline</th>
							<th>Company Name</th>
							<th>Location</th>
							<th>Start Year</th>
							<th>End Year</th>
							<th>Industry</th>							
						</tr>
					</tfoot> 
					<tbody>
						<?php					  					  								
							$sql = "SELECT bus.*,edu.*,exp.*,it.industry_type,eoy.employement_type_name,fos.field_of_study_name,deg.degree,tit.title_type FROM business_profile_tbl bus 
									LEFT JOIN education_tbl edu ON edu.business_id = bus.business_id
									LEFT JOIN experience_tbl exp ON exp.business_id = bus.business_id
									 
									left JOIN degree_tbl deg ON deg.degree_id = edu.degree_id
									left JOIN field_of_study_tbl fos ON fos.field_of_study_id = edu.field_of_study_id
									left JOIN title_tbl tit ON tit.title_id = exp.title_id
									left JOIN employement_type_tbl eoy ON eoy.employement_type_id  = exp.employement_type_id
									
									left JOIN industry_tbl it ON it.industry_id = exp.industry_id";
							$result = mysqli_query($con,$sql);
							$counter = 0;
							if(mysqli_num_rows($result) > 0)
							{
								while($row = mysqli_fetch_array($result))
								{?>
									<tr>
										<td class="actions">
											<a href="business_profile.php?business_id=<?php echo $row['business_id']?>" ><button class="btn btn-primary btn-sm btn-icon btn-pure btn-default on-default m-r-5 button-edit" id='<?php echo $row['business_id']?>' name="btn_edit" ><i class="icon-pencil" ></i></button></a>
											<a href="delete_business_profile.php?business_id=<?php echo $row['business_id']?>" ><button class="btn btn-danger btn-sm btn-icon btn-pure btn-default on-default button-remove" id='<?php echo $row['business_id']?>' name="btn_delete" ><i class="icon-trash" ></i></button></a>
										</td>
										<td><?php echo  ++$counter ?></td>
										<td><?php echo $row['firstname']; ?></td>
										<td><?php echo $row['lastname']; ?></td>
										<td><?php echo $row['additional_name']; ?></td>
										<td><?php echo $row['gender']; ?></td>
										<td><?php echo $row['business_type']; ?></td>
										<td><?php echo $row['contact_no']; ?></td>
										<td><?php echo $row['email']; ?></td>
										<td><?php echo $row['birth_month']; ?></td>
										<td><?php echo $row['birth_day']; ?></td>
										<td><?php echo $row['username']; ?></td>
										<td><?php echo $row['address']; ?></td>
										<td><?php echo $row['city']; ?></td>
										<td><?php echo $row['state_province']; ?></td>
										<td><?php echo $row['country']; ?></td>
										<td><?php echo $row['url']; ?></td>
										<td><img src="../images/profile_image/<?php echo $row['profile_img'];?>" height="50px" width="50px"/></td>						
										<td><img src="../images/background_image/<?php echo $row['background_img'];?>" height="50px" width="50px"/></td>						
										<td><?php echo $row['school']; ?></td>
										<td><?php echo $row['degree']; ?></td>
										<td><?php echo $row['startmonth']; ?></td>
										<td><?php echo $row['endmonth']; ?></td>
										<td><?php echo $row['activities_socilities']; ?></td>
										<td><?php echo $row['grade']; ?></td>
										<td><?php echo $row['field_of_study_name']; ?></td>
										<td><?php echo $row['startyear']; ?></td>
										<td><?php echo $row['endyear']; ?></td>
										<td><?php echo $row['description_name']; ?></td>
										<td><?php echo $row['title_type']; ?></td>
										<td><?php echo $row['employement_type_name']; ?></td>
										<td><?php echo $row['start_month']; ?></td>
										<td><?php echo $row['end_month']; ?></td>
										<td><?php echo $row['headline']; ?></td>
										<td><?php echo $row['company_name']; ?></td>
										<td><?php echo $row['location']; ?></td>
										<td><?php echo $row['start_year']; ?></td>
										<td><?php echo $row['end_year']; ?></td>
										<td><?php echo $row['industry_type']; ?></td>
																
										
									</tr>
							<?php	
								}
							}							
							else
							{
								echo "<tr>";
								echo "<td colspan='3'>No Data Found</td>";
								echo "</tr>";
							}							
						?> 
						
					</tbody>
				</table>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script>
	$(document).ready(function()
	{		
		$('.button-remove').click(function(e)
		{
			e.preventDefault();	
			var business_id = $(this).attr("id");
			//alert(business_id);
			if(confirm("Are you sure you want to delete this?"))
			{
				$.ajax({ url: 'delete_business_profile.php',
						 data: {'id': business_id, 'delete': 1},
						 type: 'post',
						 success: function(output) {					 			
									  //window.location.reload();
									  window.location.href = '';
									  //window.location.reload();
								  }
				});				
			}
			else
			{
				return false;
			}
		});
		
		/*$('.button-edit').click(function(e)
		{
			e.preventDefault();	
			var business_id  = $(this).attr("id");						
			if(confirm("Are you sure you want to edit this?"))
			{
				$.ajax({ url: 'business_profile.php',
						 data: {'id': business_id , 'edit': 1},
						 type: 'post',
						 dataType :'json',
						 success: function(data) {
						 					console.log('my message' + data);
										document.getElementById("business_id").value = business_id;
										document.getElementById("txt_fname").value = data.firstname;
										document.getElementById("txt_lname").value = data.lastname;
										document.getElementById("txt_aname").value = data.additional_name;
										document.getElementById("rdb_gender").value = data.gender;
										document.getElementById("txt_mno").value = data.contact_no;
										document.getElementById("txt_email").value = data.email;
										document.getElementById("txt_date").value = data.birthdate;
										document.getElementById("txt_uname").value = data.username;
										document.getElementById("txt_address").value = data.address;
										document.getElementById("txt_city").value = data.city;
										document.getElementById("txt_state").value = data.state_province;
										document.getElementById("cmb_country").value = data.country;
										document.getElementById("txt_http").value = data.url;
										document.getElementById("profile_image").value = data.profile_img;
										document.getElementById("background_image").value = data.background_img;
										document.getElementById("txt_school").value = data.school;
										document.getElementById("cmb_degree").value = data.degree;
										document.getElementById("txt_sdate").value = data.start_date;
										document.getElementById("txt_act_soc").value = data.activities_socilities;
										document.getElementById("txt_grade").value = data.grade;
										document.getElementById("cmb_field").value = data.field_of_study_name;
										document.getElementById("txt_edate").value = data.end_date;
										document.getElementById("txt_desc").value = data.description;
										document.getElementById("txt_title").value = data.title;
										document.getElementById("cmb_emp").value = data.employement_type_name;
										document.getElementById("txt_date").value = data.start_date;
										document.getElementById("txt_head").value = data.headline;
										document.getElementById("txt_company").value = data.company_name;
										document.getElementById("txt_loc").value = data.location;
										document.getElementById("txt_endate").value = data.end_date;
										document.getElementById("cmb_industry").value = data.industry_type;
										
										//document.getElementById("btnUser").value = "Edit User";
										//$('#company_logo').attr('disabled', 'disabled');	
										//$('#cpassword').attr('disabled', 'disabled');		
																		
								  },
						error: function(data) {
						 					console.log('my ERROR' + data.d);								
								  }
				});				
			}
			else
			{
				return false;
			}
		});*/
	}); 
	 
</script>



<?php
	include_once('footer.php');
?>