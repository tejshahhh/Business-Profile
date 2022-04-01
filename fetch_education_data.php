<?php
	include_once('connection.php');
	$response = array();
	if(isset($_POST['edit']))
	{
		if(isset($_POST['id']))
		{
			$fetchSql = "SELECT edu.*,deg.degree,fos.field_of_study_name
						FROM education_tbl edu 
						LEFT JOIN degree_tbl deg ON edu.degree_id = deg.degree_id
						LEFT JOIN field_of_study_tbl fos ON edu.field_of_study_id = fos.field_of_study_id
						WHERE education_id = '".$_POST['id']."'";       
	
			$resultedu = mysqli_query($con, $fetchSql);	
				//echo $fetchSql;
			while($row = mysqli_fetch_array($resultedu))
			{			
				$response["school"] = $row["school"];			
				$response["degree"] = $row["degree"];
				$response["degree_id"] = $row["degree_id"];
				$response["startmonth"] = $row["startmonth"];
				$response["endmonth"] = $row["endmonth"];
				$response["activities_socilities"] = $row["activities_socilities"];
				$response["grade"] = $row["grade"];
				$response["field_of_study_name"] = $row["field_of_study_name"];
				$response["field_of_study_id"] = $row["field_of_study_id"];
				$response["startyear"] = $row["startyear"];
				$response["endyear"] = $row["endyear"];
				$response["description_name"] = $row["description_name"];				
			}		
		}		
	}
	else
	{
		$response["Fail"] = 1;
	}
	echo json_encode($response);
	
?>