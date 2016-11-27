<?php 

	require_once("include_files.php");

	// this function returns the people that send messages
	// to this users inbox.
	function get_message_senders()
	{

		$sender_query = "SELECT users.id AS user_id, msg.id AS msg_id, 
						users.first_name, users.last_name
						FROM users
						INNER JOIN message AS msg ON users.id = msg.from_id
						WHERE msg.to_id = '{$_SESSION['user_id']}'";

		$sender_result = mysql_query($sender_query)
			or die("Error: ".mysql_error());

		return $sender_result;

	}

	function show_user_inbox()
	{
		$sender_result =  get_message_senders();

			
			while($sender_row = mysql_fetch_array($sender_result))
			{
				echo "

				<ul>
					<li>
						{$sender_row['first_name']}
						{$sender_row['last_name']}";

						/* 
							display all the messages that this user has 
							sent to the current user.
						*/

						$msg_result = get_selected_messages(
							$sender_row['from_id'],$sender_row['to_id']);

						while($msg_row = mysql_fetch_array($msg_result))
						{
							// display message
							// this will be changed later.
							echo "<li>{$msg_row['content']}</li>";
						}



				echo "</li>
				</ul>";

			}// end while.


	}// end show_user_inbox.

	// this function gets all the messages of this sender.
	function get_all_messages_of_user()
	{
		$msg_query = "SELECT msg.id, msg.from_id, 
				msg.to_id, msg.time
				FROM users
				INNER JOIN message AS msg 
				ON users.id = msg.to_id";

		$msg_result = mysql_query($msg_query) 
				or die("Error: ".mysql_error());


		return $msg_result;

	}

	// this function gets all messages sent by this user.
	function get_selected_message($id)
	{
		$msg_q = "SELECT content FROM message 
				WHERE id = '$id'";

		$result = mysql_query($msg_q) or die("Error: ".mysql_error());

		return $result;
	}

	// a function to select all users.
	function select_all_users()
	{
		$users_query = "SELECT * FROM users";

		$users_result = mysql_query($users_query) 
				or die("Error: ".mysql_error());


		return $users_result;

	}

	function is_valid_name($name)
	{
		return (preg_match("/[a-zA-Z][a-zA-Z]*/", $name));
	}

	function get_current_user_name()
	{
		$query = "SELECT * FROM users 
		WHERE id = '{$_SESSION['user_id']}'";

		$result = mysql_query($query) or die(mysql_error());

		if($row = mysql_fetch_array($result))
		{
			$name = $row['first_name']." ".$row['last_name'];

			return $name;

		}

		return false;

	}

 ?>
