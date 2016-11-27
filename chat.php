<?php 
	
	require_once("includes/include_files.php");


	confirm_logged_in();// authenticate user.

	$connection = connect_and_select_db($db_hostname, 
					$db_username, $db_password, $db_database);	

	//default friend name.
	$friend_name = "";

	// process sent message.
	if(isset($_POST['send']))
	{

		$receiver_id = $_GET['f_id'];
		$message = clean_input($_POST['message']);

	//	echo "sender: $sender<br>message: $message<br>";exit;

		if(!empty($receiver_id) AND !empty($message))
		{
			if(send_chart($receiver_id, $message))
			{
				echo "Your message is sent.<br>";
			}
			else
			{
				echo "Message Faild to send<br>";
			}
		}
		else
		{
			echo "Please fill both message and sender.<br><br>";
		}
	}
	
	if(isset($_POST['choose']))
	{
		$friend_id = $_POST['friend_id'];

		$friend_result = get_friend($friend_id);

		// get the friend's name.
		if($row = mysql_fetch_array($friend_result))
		{
			$friend_name = $row['first_name'];
		}
	}

	if(isset($_GET['f_id']))
	{
		$friend_id = $_GET['f_id'];

		$friend_result = get_friend($friend_id);

		// get the friend's name.
		if($row = mysql_fetch_array($friend_result))
		{
			$friend_name = $row['first_name'];
		}
		else
		{
			echo "No freind choosen.<br>";
		}

	}
	
	// first visit..
	if(!isset($_GET['f_id']) AND !isset($_POST['choose']))
	{

		// choose a friend to chart with.
		$friend_result = get_user_friends();
		echo "<br><br>";

		if(mysql_num_rows($friend_result) > 0)
		{
			while($row = mysql_fetch_array($friend_result))
			{
				// dont include the current user in the list of friends, 
				// he can chat with.
	
				echo '<form action = "?var=chat" method = "POST">';
				$name = $row['first_name']." ".$row['last_name'];
				echo "<a href = '#'> $name </a>";
				$friend_id = $row['friend_id'];
				echo "<input type ='hidden' name = 'friend_id' value = \"$friend_id\"/>
					<input type  = 'submit' class=\"btn btn-primary btn-large active\" name = 'choose' value = 'Chat'/><br><br>
					</form>";

			}
		}
		else
		{
			echo "You Don't have friends yet !!!";
		}
	}
	else
	{
		// display the messages of the selected person's chart.

		echo "<div id ='messages'>";

		// output the messages here.
		$messages = get_chart($friend_id);// this should return an arrray of messages.

		foreach($messages AS $message)
		{
			echo "<strong>".$message['sender']."  Said</strong><br> ";
			echo $message['message']."<br><br>";
		}

		echo "</div>";
		// show the chart list.
		echo "
		<div id =\"input\">
			<form action=\"?var=chat&f_id=$friend_id\" method='POST'>
		 	<div>Name:</div>
		 	<input type = \"text\" name = \"receiver\" value=\"$friend_name\">
		 	<div >Message:</div>	
		 	<textarea name='message'></textarea>
		 	<input type='submit' name = 'send' value='Send'>
		 	</form>
		</div>";

		
	}



 ?>

<!DOCTYPE html>
<html>
<head>
	<title>The chart mark up</title>
	<!-- <link rel="stylesheet" type="text/css" href="css/chart_styles.css"> -->
	<link rel="stylesheet" type="text/css" href="css/my_styles.css">

</head>
<body>



</body>
</html>