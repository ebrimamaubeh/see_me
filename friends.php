<?php 

	require_once("includes/include_files.php");

	confirm_logged_in();// authenticate user.

	
	$connection = connect_and_select_db($db_hostname, 
					$db_username, $db_password, $db_database);


	// proccess adding of users.
	if(isset($_POST['submit_button']))
	{
		$friend_id = $_POST['hidden_user'];
		$friend_name = clean_input($_POST['friend_name']);

		if(is_friend_added($friend_id) == 0)
		{

			// send friend request.
			$request_sent = send_friend_resquest($friend_id);

			if($request_sent)
			{
				echo "Friend request sent to $friend_name<br>";
			}

		}
		else
		{
			echo "$friend_name is already your friend<br>";
		}

	}// end adding users.

	?>

	<!DOCTYPE html>
	<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/my_styles.css">
	</head>
	<body>

	<?php  

	echo "<br>";


	if(isset($_GET['stage']) AND $_GET['stage'] == "view_friend")
	{
		include("view_user_profile.php");
	}
	else
	{
		// Displaying users for friend selection.
		$users_result = find_friends();

		while($row = mysql_fetch_array($users_result))
		{

			$first_name = $row['first_name'];
			$last_name = $row['last_name'];

			$name = $first_name." ".$last_name;

			$user_id = $row['id'];

			// output the friends using a div for styling.
			echo "<div class = 'friend_list'>";
			
			echo "<p>$name</p>";
		
			// show the profile image if the user has one.
			if(has_profile_image($user_id))
			{

				// show image.
				$image_name = get_profile_image_name($user_id);
				//showProfile($image_name);

				show_friend_profile($image_name, $user_id);
			}
			
			$about_me = get_about_me_text($user_id);

			if(!empty($about_me))
			{
				echo "<div id = 'about_me'>$about_me</div>";
			}
			else
			{
				$about_me = "$name has no about me text";
				echo "<div id = 'about_me'>$about_me</div>";
			}

			echo "<form action = \"?var=friends\" method = \"POST\">";

			echo "<input type = \"hidden\" name = \"hidden_user\" value =\"$user_id\" />
			<input type = \"hidden\" name = \"friend_name\" value =\"$name\" />

			 <input type = \"submit\" name = \"submit_button\" value = \"Send request\"/>
			 	<br>";

			echo "</form>";

			echo "</div>";

		}// end while.



	}// end else.
	



 ?>
	
	</body>
	</html>