<?php 

	require_once("include_files.php");

	function add_friend($friend_id)
	{
		$success = true;

		$date = date('h:i:s');// use this later.

		$friend_query = "INSERT INTO friends(user_id,friend_id , visible)
					VALUES ('{$_SESSION['user_id']}', '$friend_id',1)";

		$friend_result = mysql_query($friend_query) or 
						die("Error: ".mysql_error());

		if(!$friend_result)
		{
			$success = false;
		}

		return $success;

	}

	function is_friend_added($friend_id)
	{
		
		$query = "SELECT user_id, friend_id
				FROM friends
				WHERE user_id = '{$_SESSION['user_id']}' 
				AND friend_id = '$friend_id'
				LIMIT 1";


		$result = mysql_query($query) or die("Error: ".mysql_error());

		return mysql_num_rows($result);

	}
	
	function get_friends()
	{
		//use joints to get the names of friends in the users table.

		$query = "SELECT first_name, last_name, friend_id
			FROM friends AS f
			JOIN users ON users.id = friend_id";

		$result = query_mysql($query, __FUNCTION__, __FILE__);

		return $result;
	}

	function send_chart($reciever, $message)
	{
		$message = clean_input($message);

		$query = "INSERT INTO chart(sender_id, reciever_id, message)
			VALUES('{$_SESSION['user_id']}','$reciever','$message')";

		$result = mysql_query($query) or die(mysql_error());

		return $result;// true or false;

	}

	// returns an array of messages.
	function get_chart($reciever_id)
	{
		// Get latest messages on top.
		$query = "SELECT u.id AS user_id, u.first_name, u.last_name, 
				c.id AS chart_id, c.sender_id, c.reciever_id, c.message
					FROM chart AS c
					INNER JOIN users AS u ON u.id = sender_id
					WHERE c.sender_id = '{$_SESSION['user_id']}'
					AND c.reciever_id = '$reciever_id'
					ORDER BY c.id DESC ";

		$message  = array();

		$result = mysql_query($query) or die("query failed ".mysql_error());

		while($msg = mysql_fetch_array($result))
		{
			$message[]  = array('sender' => $msg['first_name'], 
						'message' => $msg['message']);
		}

		return $message;


	}

	function get_user_friends()
	{
		$query = "SELECT *
					FROM users
					INNER JOIN friends
					ON users.id = friends.friend_id 
					OR 
					users.id = friends.user_id
					WHERE users.id != '{$_SESSION['user_id']}'
					GROUP BY users.id";

		$result = mysql_query($query) or die("Error: ".mysql_error());

		return $result;

	}

	function get_friend($friend_id)
	{
		$query = "SELECT * FROM users WHERE id = '$friend_id'";

		$result = mysql_query($query) or die("Error: ".mysql_error());

		return $result;
	}

	function find_friends()
	{
		$query = "SELECT * FROM users
				WHERE id != {$_SESSION['user_id']}";

		$result = mysql_query($query) or die("Error: ".mysql_error());

		return $result;
	}

	function get_searched_friend($full_name)
	{
		$name_array = explode(" ", $full_name);

		$first_name = $name_array[0];
		$last_name = "";//default last name.
		// this may or may not be the last name 
		//if the user has more than one last name.
		if(count($name_array) > 1)
		{
			$last_name = $name_array[1];
		}

		$query = "SELECT *
				FROM `users`
				WHERE first_name = '$first_name'
				AND last_name LIKE '$last_name%'
				LIMIT 1";

		$result = mysql_query($query) or die(mysql_error());

		return $result;

	}

	function send_friend_resquest($friend_id)
	{

		$query = "INSERT INTO friends (user_id, friend_request, visible)
					VALUES ('{$_SESSION['user_id']}', '$friend_id', 1) ";

		$result = mysql_query($query) or die(mysql_error());

		return $result;// true or false.
	}

	function confirm_friend_request($friend_id)
	{
		$query = "UPDATE friends
				SET 
				friend_request = 0,
				friend_id = '$friend_id'
				WHERE user_id = '{$_SESSION['user_id']}'
				AND friend_id = 0
				AND friend_request = '$friend_id'";

		$result = mysql_query($query) or die(mysql_error());

		return $result;// true or false.

	}

	function reject_friend_request($friend_id)
	{
		$query = "DELETE FROM friends 
				WHERE user_id = '{$_SESSION['user_id']}'
				AND friend_id = 0
				AND friend_request = '$friend_id'";

		$result = mysql_query($query) or die(mysql_error());

		return $result;// true or false.		

	}


	


 ?>










