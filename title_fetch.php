<?php
include_once('../connection.php');
$response = array();
if(isset($_POST['edit']))	
{
	if(isset($_POST['id']))
	{
		$fetchSql = "CALL fetchTitle('".$_POST['id']."')";
		$result = mysqli_query($con,$fetchSql);		
		while($row = mysqli_fetch_array($result))
		{
			$response["title_type"] = $row["title_type"];		
		}		
	}		
}
else
{
	$response["Fail"] = 1;
}
echo json_encode($response);

?>