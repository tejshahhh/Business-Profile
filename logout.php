<?php
	session_start();
	include_once('../connection.php');
	if(!isset($_SESSION['uname']))
	{
		header('location:index.php');
	}
	else
	{
		session_destroy(); 
		header('location:index.php');
		
	}
?>