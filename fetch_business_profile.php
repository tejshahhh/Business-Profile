<?php
include_once('../connection.php');
$response = array();
if(isset($_POST['edit']))	
{
	if(isset($_POST['id']))
	{
		$fetchSql = "CALL fetchBusinessProfile('".$_POST['id']."')";
		$result = mysqli_query($con,$fetchSql);
			
		while($row = mysqli_fetch_array($result))
		{
			$response["firstname"] = $row["firstname"];
			$response["lastname"] = $row["lastname"];
			$response["additional_name"] = $row["additional_name"];	
			$response["gender"] = $row["gender"];
			$response["contact_no"] = $row["contact_no"];
			$response["email"] = $row["email"];
			$response["birth_month"] = $row["birth_month"];
			$response["birth_day"] = $row["birth_day"];
			$response["username"] = $row["username"];
			$response["address"] = $row["address"];
			$response["city"] = $row["city"];
			$response["state_province"] = $row["state_province"];
			$response["country"] = $row["country"];
			$response["url"] = $row["url"];
			$response["profile_img"] = $row["profile_img"];
			$response["background_img"] = $row["background_img"];
			$response["school"] = $row["school"];	
			$response["degree"] = $row["degree"];
			$response["start_date"] = $row["start_date"];
			$response["activities_socilities"] = $row["activities_socilities"];
			$response["grade"] = $row["grade"];
			$response["field_of_study_name"] = $row["field_of_study_name"];
			$response["end_date"] = $row["end_date"];
			$response["description"] = $row["description"];
			$response["title_type"] = $row["title_type"];
			$response["employement_type_name"] = $row["employement_type_name"];
			$response["start_date"] = $row["start_date"];
			$response["headline"] = $row["headline"];
			$response["company_type"] = $row["company_type"];
			$response["location"] = $row["location"];
			$response["end_date"] = $row["end_date"];
			$response["industry_type"] = $row["industry_type"];		
		}	
			
	}	
	
		
}
else
{
	$response["Fail"] = 1;
}
echo json_encode($response);

?>