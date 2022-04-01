<?php
	include_once('header.php');
	
	if(isset($_POST['btn_save']))
	{			
		if($_POST['comp_id'] == '')
		{
			$sql = "CALL insertcompany('".addslashes($_POST['txt_company_type'])."' ,'".$row_login['user_id']."')";
		}
		else
		{
			$sql = "CALL updatecompany('".$_POST['comp_id']."','".addslashes($_POST['txt_company_type'])."')";
		}
		
		$result = mysqli_query($con,$sql);
		if(!$result)
		{
			die("Not Inserted".mysqli_error($con));
		}
		else
		{			
			//header('location:manage_user.php');
			echo "<script>window.location = 'company.php';</script>";
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
			<h2><a href="#" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>Company Type</h2>
			<ul class="breadcrumb">
				<li class="breadcrumb-item"><a href="dashboard.php"><i class="icon-home"></i></a></li>                            
				<li class="breadcrumb-item">Forms</li>
				<li class="breadcrumb-item active">Company Type</li>
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
				<h2>Add New Company Type</h2>
			</div>
			<div class="body">
				<form id="frmBusinessCategory" name="frmBusinessCategory" method="post" novalidate>
				<div class="row clearfix">
					<div class="col-md-6">
						<div class="form-group">
							<label>Company Type</label>
							<input type="text" class="form-control" id="txt_company_type" name="txt_company_type" required>
						</div>
					</div>
				</div>
					
					<br>
					<input type="hidden" id="comp_id" name="comp_id" />
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
				<h2>Company Type List</h2>                            
			</div>
			<div class="body">
			<div class="table-responsive">
				<table class="table table-bordered table-striped table-hover dataTable js-exportable">
					<thead>
						<tr>
							<th>SR No.</th>
							<th>Company Type</th>						
							<th>Date</th>
							<th>Action</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>SR No.</th>
							<th>Company Type</th>						
							<th>Date</th>
							<th>Action</th>
						</tr>
					</tfoot> 
					<tbody>
						<?php					  					  								
							$sql = "CALL viewcompany()";
							$result = mysqli_query($con,$sql);
							$counter = 0;
							if(mysqli_num_rows($result) > 0)
							{
								while($row = mysqli_fetch_array($result))
								{?>
									<tr>
									
									<td><?php echo  ++$counter ?></td>
									<td><?php echo $row['company_type']; ?></td>									
									<td><?php echo date("d-m-Y h:i:sa", strtotime($row['comp_date']))?></td>																	
									<td class="actions">
										
										<button class="btn btn-primary btn-sm btn-icon btn-pure btn-default on-default m-r-5 button-edit" id='<?php echo $row['comp_id'];?>' name="btn_edit" ><i class="icon-pencil" ></i></a></button>
										<button class="btn btn-danger btn-sm btn-icon btn-pure btn-default on-default button-remove" id='<?php echo $row['comp_id'];?>' name="btn_delete" ><i class="icon-trash" ></i></a></button>
									</td>
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
			var comp_id = $(this).attr("id");
		
			if(confirm("Are you sure you want to delete this?"))
			{
				$.ajax({ url: 'company_delete.php',
						 data: {'id': comp_id, 'delete': 1},
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
			var comp_id = $(this).attr("id");						
			if(confirm("Are you sure you want to edit this?"))
			{
				$.ajax({ url: 'company_fetch.php',
						 data: {'id': comp_id, 'edit': 1},
						 type: 'post',
						 dataType :'json',
						 success: function(data) {
						 					console.log('my message' + data);
										document.getElementById("comp_id").value = comp_id;
										document.getElementById("txt_company_type").value = data.company_type;
										//document.getElementById("txt_fname").value = data.fname;
										//document.getElementById("txt_email").value = data.email;
										//document.getElementById("txt_mobile").value = data.mobile;
										//document.getElementById("btnUser").value = "Edit User";	
										//$('#txt_password').attr('disabled', 'disabled');
										//$('#cpassword').attr('disabled', 'disabled');
										//$('#user_img').attr('disabled', 'disabled');									
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
