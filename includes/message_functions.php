<?php 

	require_once("include_files.php");

	function get_message_recipient($username)
	{
		$query = "SELECT * FROM users WHERE username = '$username' ";

		$result = mysql_query($query) or die("Error: ".mysql_error());

		return $result;
	}

	// this function validates if the repicient exist and is unique.
	function is_valid_recipient($resource)
	{
		return mysql_num_rows($resource) == 1;
	}

	function send_message($from_id, $to_id, $content)
	{
		$query = "INSERT INTO message (from_id, to_id, content, visible)
				VALUES ('$from_id,' ,'$to_id', '$content' , 1)";

		$result = mysql_query($query) or die("Error: ".mysql_error());

		return $result;// true or false;
	}

	function save_to_draft($from_id, $to_id, $content)
	{
		$query = "INSERT INTO message(from_id,to_id, draft)
		VALUES ('$from_id','$to_id', '$content')";

		$result = mysql_query($query) or 
					die("Error: function save_to_draft: ".mysql_error());

		return $result;// true of false.
	}

	function get_recipient_id($username)
	{
		$query = "SELECT * FROM users WHERE username = '$username'";

		$result = mysql_query($query) or die(mysql_error());

		if($row = mysql_fetch_assoc($result)) 
		{
			$id = $row['id'];
			return $id;
		}
		else
		{
			return false;
		}
	}

	function get_draft()
	{
		
		$query = "SELECT u.id, u.first_name, u.last_name, u.username,  msg.id 
					AS msg_id, msg.to_id, msg.draft , msg.title 
					FROM message AS msg
					INNER JOIN users AS u
					ON u.id = msg.to_id
					WHERE from_id = '{$_SESSION['user_id']}'
					AND msg.draft IS NOT NULL";

		$result = mysql_query($query) or die(mysql_error());

		return $result;
	}

	function get_selected_draft($msg_id)
	{
		$query = "SELECT u.username, msg.title, msg.draft
					FROM message AS msg 
					INNER JOIN users AS u 
					ON u.id = msg.to_id
					WHERE msg.id = '$msg_id'";

		$result = mysql_query($query) or die(mysql_error());

		return $result;
	}

	function get_notifications()
	{

		$query = "SELECT u.id AS u_id, u.first_name, u.last_name, 
				f.id AS f_id, f.friend_id, f.friend_request, f.visible
				FROM friends AS f
				INNER JOIN users AS u 
				ON u.id = f.user_id
				WHERE u.id = '{$_SESSION['user_id']}'
				AND f.friend_id =0";

		$result = mysql_query($query) or die(mysql_error());

		return $result;
	}


 ?>