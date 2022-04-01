<?php
	include_once('connection.php');
	$response = array();
	
	if(isset($_POST['query']))
	{
		$searchCompany = $_POST['query'];
		$query = "SELECT DISTINCT company_name FROM experience_tbl WHERE company_name LIKE '".$searchCompany."%' ";
		$result = mysqli_query($con,$query);
				
		while($row = mysqli_fetch_array($result))
		{
			if(strlen($row['company_name']) > 0 )
			{
				$row_company = $row['company_name'];
				$listed_company =  "<li class='list-group-item' id='company'>".$row_company."</li>";
				$response[] = array("listed_company" => $listed_company);	 
			}
			
						
			
		}	
	}	
	
	if(isset($_POST['query_school']))
	{
		$searchSchool = $_POST['query_school'];
		$query_school = "SELECT DISTINCT school FROM education_tbl WHERE school LIKE '".$searchSchool."%' ";
		$result = mysqli_query($con,$query_school);
		
		
			while($row = mysqli_fetch_array($result))
			{
			
				$row_school = $row['school'];
				$listed_school =  "<li class='list-group-item' id='school'>".$row_school."</li>";
         		 $response[] = array("listed_school" => $listed_school);
				 
			}	
				
	}
	
	echo json_encode($response);
	
?>