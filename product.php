<?php
	include_once('header.php');
	
	if(isset($_GET['product_id']))
	{
	 	
		$fetchSql = "SELECT * FROM  product_tbl WHERE product_id =  '".$_GET['product_id']."' ";
		//echo $fetchSql;
		$result_data = mysqli_query($con,$fetchSql);
		$row_data = mysqli_fetch_array($result_data);
		
	}
	
	if(isset($_POST['btn_product_save']))
	{		
		if($_POST['product_id'] == '')
		{
			if(!empty($_FILES["product_image"]["name"]))
			{	
				$img3=$_FILES["product_image"]["name"];
				$img3 = pathinfo($img3, PATHINFO_FILENAME).mt_rand(600000,999999).".".pathinfo($img3, PATHINFO_EXTENSION);				
				$tmp_name3=$_FILES["product_image"]["tmp_name"];
				if(is_uploaded_file($tmp_name3))
				{
					copy($tmp_name3,"../images/product_image/".$img3);
				}
			}
			else
			{
				$img3 = "";//$row['product_image']
			}	
		
		
			$sql = "CALL insertProduct('".$_POST['cmb_business']."','".$_POST['txt_product_title']."' ,'".$_POST['txt_product_price']."', '".$_POST['txt_description']."','".$img3."')";
			
		}
		else
		{
			$sql_select_image = "SELECT * FROM product_tbl WHERE product_id = '".$_POST['product_id']."'";
			$run_select_image = mysqli_query($con,$sql_select_image);
			$row_image = mysqli_fetch_array($run_select_image);
			
			if(!empty($_FILES['product_image']['name']))
			{
				$old_image = $row_image['product_image'];
				$path = $_SERVER['DOCUMENT_ROOT'].'/tryon_project_btv/images/product_image/';
				if(file_exists($path.$old_image))
				{
					unlink($path.$old_image);
				}
				$img3=mt_rand(600000,999999).$_FILES["product_image"]["name"];
				//$img3 = pathinfo($img3, PATHINFO_FILENAME).mt_rand(600000,999999).".".pathinfo($img3, PATHINFO_EXTENSION);				
				$tmp_name=$_FILES["product_image"]["tmp_name"];
				if(is_uploaded_file($tmp_name))
				{
					copy($tmp_name,"../images/product_image/".$img3);
				}
			}
			else
			{
				$img3 = $row_image['product_image'];
			}
			
			$sql = "CALL updateProduct('".$_POST['product_id']."','".$_POST['cmb_business']."','".$_POST['txt_product_title']."','".$_POST['txt_product_price']."','".$img3."')";
		}
		
		$result = mysqli_query($con,$sql);
		if(!$result)
		{
			die("Not Inserted".mysqli_error($con));
		}
		else
		{			
			/*echo "<script>window.location = 'view_product.php';</script>";*/
		}	
	}				
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
			<h2><a href="#" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Manage Products</h2>
			<ul class="breadcrumb">
				<li class="breadcrumb-item"><a href="dashboard.php"><i class="icon-home"></i></a></li>                            
				<li class="breadcrumb-item">Forms</li>
				<li class="breadcrumb-item active">Manage Products</li>
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
				<h2>Add New Product</h2>
			</div>
			<div class="body">
				<form id="frmProduct" name="frmProduct" method="post" enctype="multipart/form-data" novalidate>
				<div class="row clearfix">
					<div class="col-md-6">
						<div class="form-group">
							<label>Business Profile</label>
							<select name="cmb_business" id="cmb_business" class="form-control">
							<option value= "<?php if(isset($_GET['product_id'])){ echo $row_data['business_id']; } ?>">SELECT Name</option> 
            <?php 
             $sql_select = "SELECT business_id, firstname FROM business_profile_tbl"; 
             $rs_select = mysqli_query($con, $sql_select); 
              
             if(!$rs_select) 
             { 
              die('no category found'.mysqli_error($con)); 
             } 
              
             while($row_select = mysqli_fetch_array($rs_select)) 
             { 
              if(isset($_GET['product_id'])) 
              {  
               if($row_data['business_id'] == $row_select['business_id']) 
               { 
               ?> 
                
               <option value="<?php echo $row_select['business_id']; ?>" selected="selected"><?php echo $row_select['firstname']; ?></option>  
               <?php 
               } 
               else 
               { 
               ?> 
               <option value="<?php echo $row_select['business_id']; ?>"><?php echo $row_select['firstname']; ?></option> 
               <?php 
               } 
                 } 
              else 
              { 
              ?> 
               
              <option value="<?php echo $row_select['business_id']; ?>"><?php echo $row_select['firstname']; ?></option> 
              <?php 
              }         
              
            ?> 
             
            <?php 
             } 
            ?>
													</select>
						</div>
					</div>
					
					<div class="col-md-6">
						<div class="form-group">
							<label>Product Name</label>
							<input type="text" class="form-control" id="txt_product_title" name="txt_product_title" value= "<?php if(isset($_GET['product_id'])){ echo $row_data['product_title']; } ?>" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Product Price</label>
							<input type="number" class="form-control" id="txt_product_price" name="txt_product_price" value= "<?php if(isset($_GET['product_id'])){ echo $row_data['product_price']; } ?>" required>
						</div>
					</div>
					<div class="col-md-5">
						<div class="form-group">
							<label>Product Image</label>
							<input type="file" class="form-control" id="product_image" name="product_image" value= "<?php if(isset($_GET['product_id'])){ echo $row_data['product_image']; } ?>" accept="image/*" onchange="ValidateSize(this)"  required>
						</div>
					</div>
					<div class="col-md-1">
						<div class="form-group">
							<img src="../images/product_image/<?php if(isset($_GET['product_id'])){ echo $row_data['product_image']; } ?>" id="imgprw" height="80px" width="80px" border="5" style="margin-bottom:15px;" />
						</div>
					</div>
					<div class="body">
					<label>Description</label>
                            <div class="summernote">
							  
                            </div>
                    </div>
					
			</div>
					
					<input type="hidden" id="product_id" name="product_id" value="<?php if(isset($_GET['product_id'])){ echo $row_data['product_id']; } ?>" />
					<input type="hidden" name="txt_description" id="txt_description"/>
					<button type="submit" id="btn_product_save" name="btn_product_save" class="btn btn-primary" 
					onclick="getData();">Save</button>
				</form>
			</div>
		</div>
	</div>
	
</div>


<?php
	include_once('footer.php');
?>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

<script>
	var n = jQuery.noConflict();
	
	$(document).ready(function(){
		
		$('.note-editable').bind('DOMSubtreeModified', function () {
 			 console.log('changed');
			 
			 var desc = $(this).html();
			 
			 console.log(desc);
			 
			 $('#txt_description').val(desc);
		});
		
	});	
	
</script>
