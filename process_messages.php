<?php 


	require_once("includes/include_files.php");

	confirm_logged_in();// authenticate user.

	
	$connection = connect_and_select_db($db_hostname, 
					$db_username, $db_password, $db_database);

	// store message to the database.
	if(isset($_POST['send']))// the form is sent.
	{
	
		$username = clean_input($_POST['recipient']);

		$msg_content = clean_input($_POST['msg_content']);

		if(empty($username) || empty($msg_content))// some fields are empty.
		{
			echo "<p style = 'color: red;'>
				Please select the recipient and type some message
			</p>";
		}
		else// not empty , send the message.
		{
			$result = get_message_recipient($username);

			if(is_valid_recipient($result))// usrename valid, send message.
			{	
				$row = mysql_fetch_array($result);

				$is_sent = send_message($_SESSION['user_id'], $row['id'], $msg_content);

				if($is_sent)
				{
					echo "Your message has been sent.";
				}
				else
				{
					echo "Message Not sent";
				}

			}
			else// invalid user.
			{
				echo "Invalid recipient.<br>";
			}

		}// end else for sending the message.

		
	}

	// if the cancel button is pressed , save the message to the draft.
	if(isset($_POST['cancel']))
	{
		$username = clean_input($_POST['recipient']);

		// get the recipient
		$recipient = get_recipient_id($username);

		$msg_content = clean_input($_POST['msg_content']);

		if(!empty($username) AND !empty($msg_content))
		{
			$success = save_to_draft($_SESSION['user_id'],$recipient, $msg_content);

			if(!$success)
			{
				echo "Error: Not saved to draft<br>";
			}
			else
			{
				echo "Saved to draft<br>";
			}

		}

	}
	

	

	



 ?>