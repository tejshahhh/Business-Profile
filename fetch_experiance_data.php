<?php
	include_once('connection.php');
	$response = array();
	if(isset($_POST['edit']))
	{
		if(isset($_POST['id']))
		{
			$fetchSql = "SELECT exp.*,it.industry_type,eoy.employement_type_name,tit.title_type 
						FROM experience_tbl exp 
						LEFT JOIN title_tbl tit ON exp.title_id = tit.title_id
						LEFT JOIN employement_type_tbl eoy ON exp.employement_type_id = eoy.employement_type_id
						LEFT JOIN industry_tbl it ON exp.industry_id = it.industry_id 
						WHERE experience_id  = '".$_POST['id']."'";       
	
			$result = mysqli_query($con, $fetchSql);		
			while($row = mysqli_fetch_array($result))
			{			
				$response["title_id"] = $row["title_id"];
				$response["title_type"] = $row["title_type"];			
				$response["employement_type_id"] = $row["employement_type_id"];
				$response["company_name"] = $row["company_name"];
				$response["location"] = $row["location"];
				$response["start_year"] = $row["start_year"];
				$response["end_year"] = $row["end_year"];
				$response["start_month"] = $row["start_month"];
				$response["end_month"] = $row["end_month"];
				$response["headline"] = $row["headline"];
				$response["industry_type"] = $row["industry_type"];
				$response["industry_id"] = $row["industry_id"];
				$response["description"] = $row["description"];				
			}		
		}		
	}
else
{
	$response["Fail"] = 1;
}
echo json_encode($response);

?>