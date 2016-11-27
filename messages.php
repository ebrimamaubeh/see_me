<?php 

	confirm_logged_in();// authenticate user.

	$connection = connect_and_select_db($db_hostname, 
					$db_username, $db_password, $db_database);

	if(isset($_GET['show_msg']))
	{
		var_dump($_GET);exit;
	}


	// check to see if message should be shown.
	if(isset($_GET['stage']) and $_GET['stage'] == "show_msg")
	{
		$id = $_GET['msg_id'];

		$msg_result = get_selected_message($id);

		while($msg_row = mysql_fetch_array($msg_result))
		{
			// this output the messages in the inbox.
			echo "<div>{$msg_row['content']}<div>";
		}

	}

	// show inbox of this user.
	if(isset($_GET['stage']) && $_GET['stage'] === "inbox")
	{

		//echo "in inbox<br>";exit;

		$sender_result =  get_message_senders();

		if(mysql_num_rows($sender_result) > 0)
		{
			while($sender_row = mysql_fetch_array($sender_result))
			{
				$msg_id = $sender_row['msg_id'];

				echo "
					<div class = 'listing_names'>
						<a href = \"?var=messages&stage=show_msg&msg_id=$msg_id\">
						{$sender_row['first_name']}
						{$sender_row['last_name']}
						</a>
					</div>";

			}// end while.

		}
		else
		{
			echo "No messages in your inbox.<br>";
		}
		
	}// end if.

	// proccess friend request confimation.
	if(isset($_GET['stage']) AND $_GET['stage'] == "notifications" AND isset( $_GET['notice']) AND $_GET['notice'] == "notices")
	{
		$friend_id = $_POST['friend_id'];
		$friend_name = $_POST['friend_name'];

		if(isset($_POST['confirm']))
		{
			if(confirm_friend_request($friend_id))
			{
				echo "$friend_name is now your friend!!!<br><br>";
			}
			else
			{
				echo "$friend_name NOT added Please contact the administration
					for more details<br>";
			}

		}
		else
		{
			if(reject_friend_request($friend_id))
			{
				echo "$friend_name  Rejected<br><br>";
			}
			else
			{
				echo "$friend_name NOT rejected Please contact the administration
					for more details<br><br>";
			}
			
		}
	}

	// show the drafts of the user.
	if(isset($_GET['stage']) AND ($_GET['stage'] == "list_draft" or $_GET['stage'] == "show_draft" ))
	{

		if($_GET['stage'] == "show_draft")
		{

			if(isset($_GET['msg_id']))
			{
				$msg_id = $_GET['msg_id'];
				$selected_result = get_selected_draft($msg_id);

				if($row = mysql_fetch_assoc($selected_result))
				{

					$draft = $row['draft'];
					$title = $row['title'];
					$username = $row['username'];

					if($title == NULL)
					{
						$title = "";//empty title.
					}

					echo '<div class = "msg_form">

					<form name = "draft_form" method="POST" 
					action="?stage=send&var=messages" >';
					
					echo "<input type='text' name = 'recipient' placeholder = 'recipiant' value = \"$username\"/>	
					<input type=\"text\" name = \"title\" placeholder = \"Title\" value = \"$title\"/>";

					echo "<textarea id = \"textarea\" name = \"msg_content\" >$draft</textarea>";

					echo '<input type = "submit" id = "cancel" name = "cancel" value="Cancel">
					<input type = "submit" id = "send" name = "send" value="Send" >

					</form>
					</div>';
				}

			}
		}
		else
		{
			$draft_result = get_draft();

			if(mysql_num_rows($draft_result) > 0)
			{

				// list the draft names and recipients.
				while($row = mysql_fetch_assoc($draft_result))
				{
					$name = $row['first_name']." ".$row['last_name'];
					$msg_id = $row['msg_id'];
					$msg_title = $row['title'];
					// default title.
					if($msg_title == NULL)
					{
						$msg_title = "No title";
					}
					echo "<div class = 'listing_names' > 
					NAME: $name<br>
					Title:
					<a href='?var=messages&stage=show_draft&msg_id=$msg_id'> $msg_title </a>

					 </div>";
				}


			}
			else
			{
				echo "You have no Draft<br>";
			}
			
		}
	}


	// handle new messages.
	if(isset($_GET['stage']) && $_GET['stage'] == "new_msg")
	{
		echo '

	<div class = "msg_form">
	
		<form name = "msg_form" method="POST" 
		action="?stage=send&var=messages" >
		
		<input type="text" name = "recipient" placeholder = "recipiant" />	
		<input type="text" name = "title" placeholder = "Title" />	
		<textarea id = "textarea" name = "msg_content" ></textarea>

		<input type = "submit" id = "cancel" name = "cancel" value="Cancel">
		<input type = "submit" id = "send" name = "send" value="Send" >

		</form>
	</div>';

	}

	// handle sending of messages.
	if(isset($_GET['stage']) AND $_GET['stage'] == "send")
	{
		// proccess the message.
		include("process_messages.php");
	}

	if(isset($_GET['stage']) AND $_GET['stage'] == "notifications")
	{
		$notices = get_notifications();

		$hasNotifications = false;

		// output the notifications.
		while($row = mysql_fetch_array($notices))
		{
			$friend_id = $row['friend_request'];

			$friend_result = get_friend($friend_id);

			//die("friend num rows = ".mysql_num_rows($friend_result));

			if($friend_row = mysql_fetch_array($friend_result))
			{
				$hasNotifications = true;
				$name = $friend_row['first_name']." ".$friend_row['last_name'];
				$current_user = get_current_user_name();

				echo "
				<div id  = 'notifications'>
				Hi $current_user, $name wants to be your freind<br>
				<form method='POST' action=\"?stage=notifications&notice=notices&var=messages\">
					<input type = 'hidden' name = 'friend_id' value = \"$friend_id\" />
					<input type = 'hidden' name = 'friend_name' value = \"$name\" />
					<input type = 'submit'  name = 'confirm' value = 'Confirm' />
					<input type = 'submit'  name = 'reject' value = 'Reject' />
				</form>
				<div>";

			}

		}

		if(!$hasNotifications){
			echo "You have no notifications<br><br>";
		}
	}
	
	

	
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<link rel="stylesheet" type="text/css" href="css/my_styles.css">
 </head>
 <body>


 
 </body>
 </html>