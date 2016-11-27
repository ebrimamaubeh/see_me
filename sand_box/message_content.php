<?php 

	confirm_logged_in();// authenticate user.

	$connection = connect_and_select_db($db_hostname, 
					$db_username, $db_password, $db_database);




	// check to see if message should be shown.
	if(isset($_GET['var']) and $_GET['var'] === "show_msg")
	{
		/* 
			display all the messages that the selectetd user has 
			sent to the current user.
		*/

		$id = $_GET['msg_id'];

		$msg_result = get_selected_message($id);

		while($msg_row = mysql_fetch_array($msg_result))
		{

		echo "<li>
				{$msg_row['content']}</a>
			</li>";
		}

	}



 ?>