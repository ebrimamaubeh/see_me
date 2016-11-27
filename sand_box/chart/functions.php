<?php 

	function send_message($reciever, $message)
	{
		$query = "INSERT INTO chart(sender, reciever, message)
			VALUES('{$_SESSION['user_id']}','$reciever','$message')";

		$result = mysql_query($query) ;

		return $result;// true or false;

	}

	// returns an array of messages.
	function get_message()
	{
		// Get latest messages on top.
		$query = "SELECT * FROM chart ORDER BY id DESC";

		$message  = array();

		$result = mysql_query($query) or die("query failed ".mysql_error());

		while($msg = mysql_fetch_array($result))
		{
			$message[]  = array('sender' => $msg['sender'] , 
						'message' => $msg['message']);
		}

		return $message;


	}

	function get_friend($friend_id)
	{
		$query = "SELECT * FROM users WHERE id = '$friend_id'";

		$result = mysql_query($query) or die("Error: ".mysql_error());

		return $result;
	}




 