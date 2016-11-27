<?php 

	require_once("includes/include_files.php");


	confirm_logged_in();// authenticate user.

	$connection = connect_and_select_db($db_hostname, 
					$db_username, $db_password, $db_database);

	// show inbox of this user.
		if(isset($_GET['var']) && $_GET['var'] === "inbox")
		{
			$sender_result =  get_message_senders();

			if(mysql_num_rows($sender_result) > 0)
			{
				while($sender_row = mysql_fetch_array($sender_result))
				{
					$msg_id = $sender_row['msg_id'];

					echo "
						<li>
							<a href = \"home_page.php?var=show_msg&msg_id=$msg_id\">
							{$sender_row['first_name']}
							{$sender_row['last_name']}
							</a>
						</li>";

				}// end while.

			}
			else
			{
				echo "<p id='welcom_msg'>No messages in your inbox.</p>";
			}


			
		}// end if.



 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>INBOX</title>
 	<link rel="stylesheet" type="text/css" href="css/my_styles.css">
 </head>
 <body>
 
 </body>
 </html>