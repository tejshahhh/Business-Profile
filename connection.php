<?php
	$con = mysqli_connect('localhost','root','');
	if(!$con)
	{
		die('Not Connected.'.mysqli_error($con));
	}
	$db = mysqli_select_db($con,'tryon_project');
	if(!$db)
	{
		die('Not Connected With DB.'.mysqli_error($con));
	}
?>