<?php
	include_once('header.php');
	
	if(isset($_POST['btn_save']))
	{			
		if($_POST['company_id'] == '')
		{
			if(!empty($_FILES["company_logo"]["name"]))
			{	
				$img3=$_FILES["company_logo"]["name"];
				$img3 = pathinfo($img3, PATHINFO_FILENAME).mt_rand(600000,999999).".".pathinfo($img3, PATHINFO_EXTENSION);				
				$tmp_name3=$_FILES["company_logo"]["tmp_name"];
				if(is_uploaded_file($tmp_name3))
				{
					copy($tmp_name3,"../images/company_logo/".$img3);
				}
			}
			else
			{
				$img3 = "";//$row['company_logo']
			}
			
			$sql = "CALL insertManageCompany('".$_POST['txt_cname']."','".$_POST['txt_mno']."','".$_POST['txt_amno']."','".$_POST['txt_email']."','".$_POST['txt_address']."','".$_POST['txt_city']."','".$_POST['txt_state']."','".$_POST['txt_gst']."','".$_POST['txt_bank']."','".$_POST['txt_acno']."','".$_POST['txt_ifsc']."','".$_POST['txt_pan']."','".$_POST['txt_tin']."','".$_POST['txt_cst']."','".$_POST['txt_stax']."','".$_POST['txt_lic']."','".$img3."')";
		
		}
		else
		{
			$sql_select_image = "SELECT * FROM company_tbl WHERE company_id = '".$_POST['company_id']."'";
			$run_select_image = mysqli_query($con,$sql_select_image);
			$row_image = mysqli_fetch_array($run_select_image);
			
			if(!empty($_FILES['company_logo']['name']))
			{
				$old_image = $row_image['company_logo'];
				$path = $_SERVER['DOCUMENT_ROOT'].'/tryon_project_btv/images/company_logo/';
				if(file_exists($path.$old_image))
				{
					unlink($path.$old_image);
				}
				$img3=mt_rand(600000,999999).$_FILES["company_logo"]["name"];
				//$img3 = pathinfo($img3, PATHINFO_FILENAME).mt_rand(600000,999999).".".pathinfo($img3, PATHINFO_EXTENSION);				
				$tmp_name=$_FILES["company_logo"]["tmp_name"];
				if(is_uploaded_file($tmp_name))
				{
					copy($tmp_name,"../images/company_logo/".$img3);
				}
			}
			else
			{
				$img3 = $row_image['company_logo'];
			}
			
			$sql = "CALL updateManageCompany('".$_POST['company_id']."','".$_POST['txt_cname']."','".$_POST['txt_mno']."','".$_POST['txt_amno']."','".$_POST['txt_email']."','".$_POST['txt_address']."','".$_POST['txt_city']."','".$_POST['txt_state']."','".$_POST['txt_gst']."','".$_POST['txt_bank']."','".$_POST['txt_acno']."','".$_POST['txt_ifsc']."','".$_POST['txt_pan']."','".$_POST['txt_tin']."','".$_POST['txt_cst']."','".$_POST['txt_stax']."','".$_POST['txt_lic']."','".$img3."')";
		
		}
		//echo $sql;
		
		$result = mysqli_query($con,$sql);
		if(!$result)
		{
			die("Not Inserted".mysqli_error($con));
		}
		else
		{			
			//header('location:manage_user.php');
			/*echo "<script>window.location = 'manage_company.php';</script>";*/
		}		
	}			
	else
	{}	
?>




<script type="text/javascript" language="javascript">

	//RESTRIC FILE SIZE 2 MB
	function ValidateSize(file) {
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
        }
		return true;
    }
	function RemoveImage()
	{		
		document.getElementById('imgprw').removeAttribute('src');		
	}
</script>

<div class="block-header">
	<div class="row">
		<div class="col-lg-5 col-md-8 col-sm-12">                        
			<h2><a href="#" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Manage Company</h2>
			<ul class="breadcrumb">
				<li class="breadcrumb-item"><a href="dashboard.php"><i class="icon-home"></i></a></li>                            
				<li class="breadcrumb-item">Forms</li>
				<li class="breadcrumb-item active">Manage Company</li>
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
	<div class="col-md-12">
		<div class="card">
			<div class="header">
				<h2>Add New Company</h2>
			</div>
			<div class="body">
				<form id="frmManageCompany" name="frmManageCompany" method="post" enctype="multipart/form-data" novalidate>
				<div class="row clearfix">
					<div class="col-md-6">
						<div class="form-group">
							<label>Company Name</label>
							<input type="text" class="form-control" id="txt_cname" name="txt_cname" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Mobile No</label>
							<input type="number" class="form-control" id="txt_mno" name="txt_mno" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Alternate Mobile No</label>
							<input type="number" class="form-control" id="txt_amno" name="txt_amno" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Email</label>
							<input type="email" class="form-control" id="txt_email" name="txt_email" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Address</label>
							<input type="text" class="form-control" id="txt_address" name="txt_address" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>City</label>
							<input type="text" class="form-control" id="txt_city" name="txt_city" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>State</label>
							<input type="text" class="form-control" id="txt_state" name="txt_state" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>GST IN Number</label>
							<input type="text" class="form-control" id="txt_gst" name="txt_gst" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Bank Name</label>
							<input type="text" class="form-control" id="txt_bank" name="txt_bank" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>A/C No</label>
							<input type="number" class="form-control" id="txt_acno" name="txt_acno" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>IFSC Code</label>
							<input type="text" class="form-control" id="txt_ifsc" name="txt_ifsc" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>PAN Card Number</label>
							<input type="text" class="form-control" id="txt_pan" name="txt_pan" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>TIN Number</label>
							<input type="number" class="form-control" id="txt_tin" name="txt_tin" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>CST Number</label>
							<input type="number" class="form-control" id="txt_cst" name="txt_cst" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>STAX Number</label>
							<input type="text" class="form-control" id="txt_stax" name="txt_stax" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>General Lic Number</label>
							<input type="text" class="form-control" id="txt_lic" name="txt_lic" required>
						</div>
					</div>					
					<div class="col-md-6">
						<div class="form-group">
							<label>Company Logo</label>
							<input type="file" class="form-control" id="company_logo" name="company_logo" accept="image/*" onchange="ValidateSize(this)"  required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<img name="imgprw" id="imgprw" height="80px" width="80px" border="5" style="margin-bottom:15px;" />
						</div>
					</div>
				</div>
					
					<br>
					<input type="hidden" id="company_id" name="company_id" />
					<button type="submit" id="btn_save" name="btn_save" class="btn btn-primary">Save</button>
				</form>
			</div>
		</div>
	</div>
	
</div>

<div class="row clearfix">
 	<div class="col-lg-12">
		<div class="card">
			<div class="header">
				<h2>Manage Company List</h2>                            
			</div>
			<div class="body">
			<div class="table-responsive">
				<table class="table table-bordered table-striped table-hover dataTable js-exportable">
					<thead>
						<tr>
							<th>Action</th>
							<th>SR No.</th>
							<th>Company Name</th>
							<th>Mobile No</th>
							<th>Alternate Mobile No</th>
							<th>Email</th>
							<th>Address</th>							
							<th>City</th>
							<th>State</th>
							<th>GST IN Number</th>
							<th>Bank Name</th>
							<th>A/C No</th>
							<th>IFSC Code</th>
							<th>PAN Card Number</th>
							<th>TIN Number</th>
							<th>CST Number</th>
							<th>STAX Number</th>
							<th>General Lic Number</th>
							<th>Company Logo</th>
							
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>Action</th>
							<th>SR No.</th>
							<th>Company Name</th>
							<th>Mobile No</th>
							<th>Alternate Mobile No</th>
							<th>Email</th>
							<th>Address</th>							
							<th>City</th>
							<th>State</th>
							<th>GST IN Number</th>
							<th>Bank Name</th>
							<th>A/C No</th>
							<th>IFSC Code</th>
							<th>PAN Card Number</th>
							<th>TIN Number</th>
							<th>CST Number</th>
							<th>STAX Number</th>
							<th>General Lic Number</th>
							<th>Company Logo</th>
							
						</tr>
					</tfoot> 
					<tbody>
						<?php					  					  								
							$sql = "CALL viewManageCompany()";
							$result = mysqli_query($con,$sql);
							$counter = 0;
							if(mysqli_num_rows($result) > 0)
							{
								while($row = mysqli_fetch_array($result))
								{?>
									<tr>
										<td class="actions">
											<button class="btn btn-primary btn-sm btn-icon btn-pure btn-default on-default m-r-5 button-edit" id='<?php echo $row['company_id']?>' name="btn_edit" ><i class="icon-pencil" ></i></a></button>
											<button class="btn btn-danger btn-sm btn-icon btn-pure btn-default on-default button-remove" id='<?php echo $row['company_id']?>' name="btn_delete" ><i class="icon-trash" ></i></a></button>
									</td>
										<td><?php echo  ++$counter ?></td>
										<td><?php echo $row['company_name']; ?></td>
										<td><?php echo $row['mobile_no']; ?></td>
										<td><?php echo $row['alter_mobile_no']; ?></td>
										<td><?php echo $row['email']; ?></td>
										<td><?php echo $row['address']; ?></td>
										<td><?php echo $row['city']; ?></td>
										<td><?php echo $row['state']; ?></td>
										<td><?php echo $row['gstin_no']; ?></td>
										<td><?php echo $row['bank_name']; ?></td>
										<td><?php echo $row['ac_no']; ?></td>
										<td><?php echo $row['ifsc']; ?></td>
										<td><?php echo $row['pan_no']; ?></td>
										<td><?php echo $row['tin_no']; ?></td>
										<td><?php echo $row['cst_no']; ?></td>
										<td><?php echo $row['stax_no']; ?></td>
										<td><?php echo $row['general_lic_no']; ?></td>
										<td><img src="../images/company_logo/<?php echo $row['company_logo']; ?>" height="50px" width="50px"/></td>												
										
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
			var company_id = $(this).attr("id");
		
			if(confirm("Are you sure you want to delete this?"))
			{
				$.ajax({ url: 'manage_company_delete.php',
						 data: {'id': company_id, 'delete': 1},
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
		
		$('.button-edit').click(function(e)
		{
			e.preventDefault();	
			var company_id  = $(this).attr("id");						
			if(confirm("Are you sure you want to edit this?"))
			{
				$.ajax({ url: 'manage_company_fetch.php',
						 data: {'id': company_id , 'edit': 1},
						 type: 'post',
						 dataType :'json',
						 success: function(data) {
						 					console.log('my message' + data);
										document.getElementById("company_id").value = company_id;
										document.getElementById("txt_cname").value = data.company_name;
										document.getElementById("txt_mno").value = data.mobile_no;
										document.getElementById("txt_amno").value = data.alter_mobile_no;
										document.getElementById("txt_email").value = data.email;
										document.getElementById("txt_address").value = data.address;
										document.getElementById("txt_city").value = data.city;
										document.getElementById("txt_state").value = data.state;
										document.getElementById("txt_gst").value = data.gstin_no;
										document.getElementById("txt_bank").value = data.bank_name;
										document.getElementById("txt_acno").value = data.ac_no;
										document.getElementById("txt_ifsc").value = data.ifsc;
										document.getElementById("txt_pan").value = data.pan_no;
										document.getElementById("txt_tin").value = data.tin_no;
										document.getElementById("txt_cst").value = data.cst_no;
										document.getElementById("txt_stax").value = data.stax_no;
										document.getElementById("txt_lic").value = data.general_lic_no;
										//document.getElementById("company_logo").value = data.company_logo;
										var path = '../images/company_logo/';
										if(data.company_logo != "")
										{
											document.getElementById("company_logo").selectedvalue = path + 	data.company_logo;
											
											document.getElementById("imgprw").src = path + data.company_logo;
										}
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
		});
	}); 
	 
</script>



<?php
	include_once('footer.php');
?>

