<?php
	include_once('connection.php');
?>

<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'> 
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<script src='js/jquery-3.2.1.min.js' type='text/javascript'></script>
<script src='js/select2.min.js' type='text/javascript'></script>

<link href='css/select2.min.css' rel='stylesheet' type='text/css'>


<body>
<div class="form-group">
	<label>Title</label>
	<select name="cmb_title_insert" id="cmb_title_insert" class="form-control">
	  <option value="">Select Title</option> 
	 <?php
		$sql_select = "SELECT title_id, title_type FROM title_tbl";
		$rs_select = mysqli_query($con, $sql_select);													
		
		if(!$rs_select)
		{
			die('no category found'.mysqli_error($con));
		}
															
		while($row_select = mysqli_fetch_array($rs_select))
		{
	 ?>
				
		<option value="<?php echo $row_select['title_id']; ?>"><?php echo $row_select['title_type']; ?></option>
				
	<?php

		}
	?>
  </select>
</div>


<script>
$(document).ready(function(){
            
            // Initialize select2
            $("#cmb_title_insert").select2();
			
			
		});
</script>
</body>
<script src="js/bootstrap.min.js"></script>
<script src="js/own-menu.js"></script>
<script src="js/jquery.counterup.min.js"></script> 
<script src="js/owl.carousel.min.js"></script>
<script src="js/main.js"></script>