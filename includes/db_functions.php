<?php 

	include("include_files.php");

	// NB! this function must have parameters or else
	// it will not work. find out why.
	function connect_and_select_db($host, $user, $pass, $database)
	{
		$connection = 
		mysql_connect($host, $user, $pass);

		mysql_select_db($database) or die("Error: ".mysql_error());

		return $connection;
	}

	// Costom query function. This will remove dublicates.
	function query_mysql($query, $function_constant, $file_constant)
	{
		$result =mysql_query($query) or 
			die("In function: ".$function_constant.
				"File: ".$file_constant."<br>".mysql_error());

		return $result;

	}

	function clean_input($string)
	{	
		
		if(get_magic_quotes_gpc())
		{
			stripcslashes($string);
		}

		$string = strip_tags($string);

		$string = htmlentities($string);

		$string = mysql_real_escape_string(trim($string));

		return $string;
	}


 ?>







