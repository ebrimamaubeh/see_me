<?php 

	header('Content-Type: text/plain');
	require_once("includes/include_files.php");

	// this will cause the \n character to work. because the 
	// broswer sometimes ignores it.

	$connection = connect_and_select_db($db_hostname, 
					$db_username, $db_password, $db_database);


	// initialized the serarch_text.
	if(isset($_GET['search_text']))
	{
		$search_text = $_GET['search_text'];

		$search_text = mysql_real_escape_string(trim($search_text));

		if(!empty($search_text))
		{
			
			$query = "SELECT * FROM users 
			WHERE first_name LIKE '$search_text%'";

			$result = mysql_query($query) or die("Error: ".mysql_error());

			// default text.
			$first_name ="";

			while($row = mysql_fetch_assoc($result))
			{
				// always append a new line character, else it will not  work.
				$last_name 	= $row['last_name'];
				$first_name = $row['first_name'];

				 $name = "$first_name $last_name";

				 echo $name;
			}

		}

	}// end search.



 ?>