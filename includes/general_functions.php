<?php 

	require_once("include_files.php");

	function redirect_to($location)
	{
		header("Location: $location");
		exit;
	}




 ?>