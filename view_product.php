<?php
	include_once('header.php');
?>

<script>

	var active_page = "";
	
	function fnc_pn(e){
		
		if(e == document.getElementById('btn_next'))
		{
			active_page = document.querySelector('#pagination > .btn-group > button.btn-info').value;
		
			console.log(active_page);
			
			fnc(document.getElementsByName('btn_page[]')[active_page]);
		}
		else if(e == document.getElementById('btn_prev'))
		{
			active_page = document.querySelector('#pagination > .btn-group > button.btn-info').value;
		
			console.log(active_page);
			
			fnc(document.getElementsByName('btn_page[]')[active_page - 2]);
		}
	}
	
	function fnc(e){
		
		var start_date = document.getElementById('txt_start_date').value;
		var end_date = document.getElementById('txt_end_date').value;
		var end_year = end_date.split('-');
		
		if(end_year[0] < 1000)
		{	
			start_date = "";
			end_date = "";
		}
		
		var business_id = document.getElementById('cmb_business').value;
	
		var page_no = e.value;
		
		$.ajax({
				url: 'view_product_fetch.php',
				data: {'page_no': page_no,'start_date': start_date,'end_date': end_date, 'business_id': business_id, 
				'pagging':1},
				type: 'post',
				dataType: 'json',
				success: function(output)
				{
					console.log(output);
					if(output[0].total_records != 0)
					{
					
						$('#product_data').html('');
						
						for(i=0; i<output.length; i++)
						{
							let product_date = output[i].product_date.split(' ');
							let table_data = '<tr><td><a href="product.php?product_id='+output[i].product_id+'"><i class="icon-pencil" ></a></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button class="btn btn-danger btn-sm btn-icon btn-pure btn-default on-default button-remove" id='+output[i].product_id+' name="btn_delete" ><i class="icon-trash" ></i></button></td><td>'+(10 * parseInt( parseInt(page_no) - 1) + parseInt(i) + 1)+'</td><td>'+output[i].firstname+'</td><td>'+product_date[0]+'</td><td>'+output[i].product_title+'</td><td>'+output[i].product_price+'</td><td><img src="../images/product_image/'+output[i].product_image+'" height="50px" width="50px"/></td></tr>';
							
							$('#product_data').append(table_data);
						
						}
						
						$('#pagination > .btn-group').empty();
						
						$('#pagination > .btn-group').append("<button type='button' class='btn btn-secondary mr-1' id='btn_prev' onclick = 'fnc_pn(this)'>Previous</button>");
						
						var len = Math.ceil(output[0].total_records/10);
						
						for(i=1; i<=len; i++)
						{
							$('#pagination > .btn-group').append("<button type='button' class='btn ' value = "+ i +" id='btn_page' name='btn_page[]' onclick = 'fnc(this)'>"+ i +"</button>");
						
						}
						
						$('#pagination > .btn-group').append("<button type='button' class='btn btn-secondary ml-1' id='btn_next' onclick = 'fnc_pn(this)'>Next</button>");
						
						$('#pagination > .btn-group > button').filter(function(){return $(this).text() === page_no;}).addClass('btn-info').siblings().addClass('btn-secondary');
						
						var total_pages = $('#pagination .btn-group').children().length;
						
						console.log(total_pages);
						
						if($('#pagination > .btn-group').find('.btn-info').val() == 1)
						{
							$('#btn_prev').hide();
						}
						else if($('#pagination .btn-group').find('.btn-info').val() == total_pages - 2)
						{
							$('#btn_next').hide();
						}
					}
					else
					{
						$('#pagination > .btn-group').empty();
						$('#product_data').empty();
						$('#product_data').append('<tr><td>No Data Found</td></tr>');
						$('#pagination > .btn-group').append("<button type='button' class='btn btn-info' value = "+1 +" id='btn_page' onclick = 'fnc(this)'>"+ 1 +"</button>");
					}
				
				}
		});
	}
	
	function fnc_filter(){
	
		$('#btn_page').click();
		
	}


</script>

<div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h3>Product View</h3>                       
                        </div>
                        <div class="body">
							<div class="row clearfix">
                        <div class="col-md-3">
						<div class="form-group">
							<label>Business Person</label>
							<select name="cmb_business" id="cmb_business"  class="form-control" onChange="fnc_filter();">
							<option value="">Select Name</option>
													 <?php
														$sql_select = "SELECT business_id, firstname FROM business_profile_tbl";
														$rs_select = mysqli_query($con, $sql_select);													
														
														if(!$rs_select)
														{
															die('no category found'.mysqli_error($con));
														}
																											
														while($row_select = mysqli_fetch_array($rs_select))
														{
														
														?>
																
															<option value="<?php echo $row_select['business_id']; ?>"><?php echo $row_select['firstname']; ?></option>
																
													<?php

														}
													?>
													</select>
						</div>
					</div>
					
					<div class="col-md-3">
						<div class="form-group">
							<label>From Date</label>
							<input type="date" id="txt_start_date" class="form-control">
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label>To Date</label>
							<input type="date" id="txt_end_date" class="form-control" onChange="fnc_filter();">
						</div>
					</div>
					
							</div>
							<div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped" cellspacing="0" id="addrowExample">
                                <thead>
                                    <tr>
										<th>Actions</th>
										<th>SR NO</th>
										<th>Business Person</th>
                                        <th>Product Date</th>
                                        <th>Product Name</th>
                                        <th>Price</th>
										<th>Image</th>
                                        
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Actions</th>
										<th>SR NO</th>
										<th>Business Person</th>
                                        <th>Product Date</th>
                                        <th>Product Name</th>
                                        <th>Price</th>
										<th>Image</th>
                                    </tr>
                                </tfoot>
                                <tbody id="product_data">
                                    
                                </tbody>
                            </table>
							</div>
							<div id="pagination" class="btn-toolbar" role="toolbar">
								<div class="btn-group" role="group">
									
								</div>
							</div>
                        </div>
                    </div>
                </div>

<?php
	include_once('footer.php');
?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script>
	
	$(document).ready(function(){
		
		$(document).on('click','.button-remove', function(e)
		{
			//alert("hello");
			e.preventDefault();	
			var product_id = $(this).attr("id");
		
			if(confirm("Are you sure you want to delete this?"))
			{
				$.ajax({ url: 'product_delete.php',
						 data: {'id': product_id, 'delete': 1},
						 type: 'post',
						 datatype: 'json',
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
		
		$.ajax({
				url: 'view_product_fetch.php',
				data: {'page_no':1, 'business_id' : '','start_date' : '' ,'end_date': '', 'pagging':1},
				type: 'post',
				dataType: 'json',
				success: function(output)
				{
					console.log(output);
					for(i=0; i<output.length; i++)
					{
						let product_date = output[i].product_date.split(' ');
						let table_data = '<tr><td><a href="product.php?product_id='+output[i].product_id+'"><i class="icon-pencil" ></a></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button class="btn btn-danger btn-sm btn-icon btn-pure btn-default on-default button-remove" id='+output[i].product_id+' name="btn_delete" ><i class="icon-trash" ></i></button></td><td>'+(i + 1)+'</td><td>'+output[i].firstname+'</td><td>'+product_date[0]+'</td><td>'+output[i].product_title+'</td><td>'+output[i].product_price+'</td><td><img src="../images/product_image/'+output[i].product_image+'" height="50px" width="50px"/></td></tr>';
						
						$('#product_data').append(table_data);
					
					}
					$('#pagination > .btn-group').empty();
					
					$('#pagination > .btn-group').append("<button type='button' class='btn btn-secondary mr-1' id='btn_prev' onclick = 'fnc_pn(this)'>Previous</button>");
					
					var len = Math.ceil(output[0].total_records/10);
					for(i=1; i<=len; i++)
					{
						$('#pagination > .btn-group').append("<button type='button' class='btn btn-info' value = "+ i +" id='btn_page' name='btn_page[]' onclick = 'fnc(this)'>"+ i +"</button>");
					}
						
						$('#pagination > .btn-group').append("<button type='button' class='btn btn-secondary ml-1' id='btn_next' onclick = 'fnc_pn(this)'>Next</button>");
						
						$('#btn_prev').hide();
						
						$('#btn_prev').next().siblings().removeClass('btn-info').addClass('btn-secondary');
					
					
				}
			});
		
		
		
	});	
	
</script>