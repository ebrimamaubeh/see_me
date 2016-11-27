<?php 

	
	if(isset($_GET['search_text']))
	{
		$search_text = $_GET['search_text'];
	}

	if(@mysql_connect("localhost", "root", "computerScience"))
	{
		if(@mysql_select_db("see_me"))
		{
			$search_text = mysql_real_escape_string(trim($search_text));

			if(!empty($search_text))
			{
				
				$query = "SELECT first_name , last_name FROM users 
				WHERE first_name LIKE '$search_text%'
				OR last_name LIKE '$search_text%'";

				$result = mysql_query($query) or die("Error: ".mysql_error());

				// default text.
				$first_name = $last_name = "";

				while($row = mysql_fetch_assoc($result))
				{
					// always append a new line character, else it will not  work.
					$first_name = $row['first_name']."\n";
					$last_name = $row['last_name']."\n";
					echo $first_name." ".$last_name;
				}

			}


		}
	}

 ?>