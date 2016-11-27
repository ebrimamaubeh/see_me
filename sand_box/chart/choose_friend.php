<?php 

	require_once("functions.php");
	require_once("db_login.php");

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Choose a friend</title>
</head>
<body>

<p>Outputting the list of friends this user should chart with
<br> this should be organized later</p><br><br>

<?php 
	
	confirm_logged_in();// authenticate user.

	$connection = connect_and_select_db($db_hostname, 
					$db_username, $db_password, $db_database);
	
	$friend_result = get_user_friends();

	while($row = mysql_fetch_array($friend_result))
	{
		
		echo '<form action = "chart_markup.php" method = "POST">';

		echo $name = $row['first_name']." ".$row['last_name'];
		$friend_id = $row['friend_id'];

		echo "<input type ='hidden' name = 'friend_id' value = \"$friend_id\"/>

			<input type  = 'submit' name = 'choose' value = 'Chart'/><br><br>
			</form>";

	}




 ?>

</body>
</html>