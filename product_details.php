<?php
	include_once('header.php');
	
	if(isset($_GET['id']))
	{
		$sql_product_details = "SELECT pro.* FROM product_tbl pro
								WHERE product_id = '".base64_decode($_GET['id'])."' ";
								
		$run_product_details = mysqli_query($con,$sql_product_details);
		if(!$run_product_details)
		{
			die('Product Details Not Found'.mysqli_error($con));
		}
		else
		{
			$row_details = mysqli_fetch_array($run_product_details);
			
		}	
		
	}
	
	$sql_email = "SELECT enq.*,bus.email FROM enquiry_tbl enq
				  LEFT JOIN business_profile_tbl bus ON bus.business_id = enq.business_id
				  WHERE enq.business_id = '".$row_login['business_id']."'";
	
	$result = mysqli_query($con,$sql_email);
	
	$rows_num=mysqli_num_rows($result);

	if(isset($_POST['btn_save_enquiry']))
	{
		if($_POST['enquiry_id']=='')
		{
			$sql_enquiry =  "CALL insertEnquiry('".$row_login['business_id']."','".$row_details['product_id']."','".$_POST['txt_name']."','".$_POST['txt_contact']."','".$_POST['txt_email']."','".$_POST['txt_message']."')";
			
			$run_enquiry = mysqli_query($con,$sql_enquiry);
		}
		
		$name=$_POST['txt_name'];
		$phone=$_POST['txt_contact'];
		$email=$_POST['txt_email'];
		$message=$_POST['txt_message'];
		
		$msg="Name: ". $name . "<br>" . "Email Id: ". $email . "<br>" . "Phone No: ". $phone . "<br>" .
 		"Message: ". $message . "<br>" .
 		"Product Name: ".$row_details['product_title'];
		
	if($rows_num > 0)
	{
		$row_password_select = mysqli_fetch_array($result);
		$to = $row_password_select['email'];
		$subject = "Inquiry Received";
		$sender = "$email";
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
		$headers .= "from: " . $sender."\n";
		
		if(mail($to, $subject, $msg, $headers))
		{
		echo "Email has been sent.";
		}
		else
		{
		echo "Error !!";
		}
	}
}
?>
<style>
.compny-thumbnail img{
	height: 300px;
	width: 100%;
}
#btn_enquiry{
background:yellow;
border-radius: 15px;
}
.btn-primary > a{
background-color: yellow;
color: black;
border-radius: 3px;
}
</style>

<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'> 
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>


<div class="modal" id="modal2">
				  <div class="modal-dialog">
					<div class="modal-content" style="background:white;">
				
					  <!-- Modal Header -->
					  <div class="modal-header">
						<h4 class="modal-title"><?php echo $row_details['product_title']?></h4>
						<button type="button" id="btn_close_enquiry" class="btn-close"></button>
					  </div>
				
					  <!-- Modal body -->
					  <div class="modal-body">
						 <div class="col-md-12">
										<div class="body">
											 <form id="frmEnquiry" name="frmEnquiry" method="post" novalidate >
												
												<div class="form-group">
													<label>Name</label>
													<input type="text" name="txt_name" id="txt_name" class="form-control" />
												</div>
												
												<div class="row">
												<div class="col-md-6">
												   <div class="form-group" style="margin-top: 15px;">
														<label>Contact</label>
														<input type="number" name="txt_contact" id="txt_contact" class="form-control" />
													</div>
												</div>
												<div class="col-md-6">
												 <div class="form-group" style="margin-top: 14px;">
													<label>E-mail</label>
													<input type="email" name="txt_email" id="txt_email" class="form-control" />
												</div>
												</div>
												</div>
												
												<div class="form-group" style="margin-top: 5px;">
													<label>Message</label>
													<textarea name="txt_message" id="txt_message" class="form-control" required></textarea>
												</div>
											   <div class="modal-footer">
											   <input type="hidden" id="business_id" name="business_id" value=<?php if(isset($row_login['business_id'])){ echo $row_login['business_id'];} ?> />
											   <input type="hidden" id="enquiry_id" name="enquiry_id" />
											   <input type="hidden" id="product_id" name="product_id" value=<?php if(isset($row_details['product_id'])){ echo $row_details['product_id'];} ?> />
												<button type="submit" name="btn_save_enquiry" id="btn_save_enquiry" class="btn btn-primary" data-bs-dismiss="modal">Save</button>
											  </div>
											</form>
										</div>	
						</div>
					  </div>
				   </div>	
							
					 
				
					  <!-- Modal footer -->
					  
					
				  </div>
				 </div>

 <section class="padding-bottom-100">
      <div class="compny-profile"> 
        <!-- SUB Banner -->
       
        
        <!-- Profile Company Content -->
        <div class="profile-company-content main-user">
          <div class="container"> 
            
            <!-- Nav Tabs -->
            
            <div class="row"> 
              <!-- SIDE BAR -->
              <div class="col-lg-4"> 
                
                <!-- Company Information -->
                <div class="sidebar"> 
                  
                  <!-- Heading for mobile Collapse -->
                  
                  <div class="navbar-expand-lg"> 
                    <!-- Heading for mobile Collapse --> 
                    <a class="collapsed main-title fr-mob" data-toggle="collapse" data-target="#cmpny-info" aria-expanded="false"> Company Information </a>
                    <div class="collapse navbar-collapse" id="cmpny-info">
                      <div class="side-bar-indide"> 
                        
                        <!-- Company Images -->
                        <div class="compny-thumbnail"> <img src="../tryon_project_btv/images/product_image/<?php { echo $row_details['product_image']; } ?>"  alt="" class="img-response"> </div>
                        
                        <!-- Company Information -->
                        
                      </div>
                    </div>
                  </div>
                </div>
                
                <!-- Company Rating -->
                
              </div>
              
              <!-- Tab Content -->
              <div class="col-lg-6">
                <div class="tab-content"> 
                  
                  <!-- About Company -->
                  <div id="about" class="tab-pane fade show active">
                    <div class="profile-main">
                      <h3>Product Details</h3>
                      <div class="profile-in">
					  <p> <?php echo $row_details['product_title']?></p>
                      <p><?php echo $row_details['product_description']?> </p>
                        <p><b>₹<?php echo $row_details['product_price']?></p>
                      </div>
                    </div>
                  </div>
                </div>
				<button id="btn_enquiry" class="btn btn-primary" data-bs-dismiss="modal"><a href="#mymodal2" class="float-right margin-right-0"  class="" data-bs-toggle="modal" data-bs-target="#modal2">Enquiry</a></button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
 

<?php
	include_once('footer.php');
?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script>
$(document).ready(function(){
$('#btn_close_enquiry').click(function() {
		$('#modal2').modal('hide');
	});
});
</script>

