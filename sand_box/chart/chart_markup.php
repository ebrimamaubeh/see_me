<?php 
	
	
	require_once("functions.php");
	require_once("db_login.php");

	// process sent message.
	if(isset($_POST['send']))
	{

		$receiver = $_POST['receiver'];
		$message = $_POST['message'];

	//	echo "sender: $sender<br>message: $message<br>";exit;

		if(!empty($receiver) AND !empty($message))
		{
			if(send_message($receiver, $message))
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
	elseif(isset($_POST['choose']))
	{
		$friend_id = $_POST['friend_id'];

		$friend_result = get_friend($friend_id);

		// get the friend's name.
		if($row = mysql_fetch_array($friend_result))
		{
			$friend_name = $row['first_name'];
		}


	}
	elseif(isset($_GET['f_id']))
	{
		$friend_id = $_GET['f_id'];

		$friend_result = get_friend($friend_id);

		// get the friend's name.
		if($row = mysql_fetch_array($friend_result))
		{
			$friend_name = $row['first_name'];
		}

	}
	else
	{
		die("<a href ='choose_friend.php'>please choose a freind</a>");
	}



 ?>

<!DOCTYPE html>
<html>
<head>
	<title>The chart mark up</title>
	<link rel="stylesheet" type="text/css" href="chart_styles.css">
</head>
<body>


<div id ="input">
	<form action="chart_markup.php?f_id=<?php echo $friend_id; ?>" method="POST">
 	<label>Name:</label><br>
 	<input type = "text" name = "receiver" value="<?php echo $friend_name;?>"><br>
 	<label>Message</label><br>	
 	<input type="text" name = "message"><br>
 	<input type="submit" name = "send" value="Send">
 	</form>
</div>

 <br>


<!-- the content in this message div will be loaded using jquery.-->
<div id = "messages">

</div>

<script type="text/javascript" src="../../javascript/jquery.js"></script>
<script type="text/javascript" src="chart.js"></script>

</body>
</html>