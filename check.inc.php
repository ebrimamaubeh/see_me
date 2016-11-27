<?php 

	
	require_once("includes/include_files.php");

	$connection = connect_and_select_db($db_hostname, 
					$db_username, $db_password, $db_database);

	
	if(isset($_POST['user']))
	{
		if(empty($_POST['user']))
		{
			echo "<font color=red>&nbsp;&larr;
				Username required</font>";
		}
		else
		{
			$user = clean_input($_POST['user']);

			$query = "SELECT username FROM users WHERE username = '$user'";

			$result = query_mysql($query, __FUNCTION__, __FILE__);

			if(mysql_num_rows($result))// true if rows >=1
			{
				echo "<font color=red>&nbsp;&larr;
				Sorry, already taken</font>";
			}
			else
			{
				echo "<font color=green>&nbsp;&larr;
				Username available</font>";
			}
		}

	}// end checking user.

	


 ?>