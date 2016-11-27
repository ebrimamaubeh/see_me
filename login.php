<?php 

	require_once('includes/include_files.php');

	if(is_logged_in())
	{
		redirect_to("home_page.php");
	}


	if(isset($_POST['submit']))
	{

		$connection = connect_and_select_db($db_hostname,
		 $db_username, $db_password, $db_database);

		$user = $_POST['user'];
		$pass = $_POST["pass"];

		$query = "SELECT * FROM users 
				WHERE username = '$user' AND password  = '$pass'";

		$result = mysql_query($query) or die("Error: ".mysql_error());

		if(mysql_num_rows($result) === 1)
		{
			$row = mysql_fetch_array($result);

			$_SESSION['user_id'] = $row['id'];

			$_SESSION['username'] = $user;

			redirect_to("home_page.php?var=comments");
		}
		else
		{
			echo "<center>Invalid username / password.</center>";
		}


	}// end if.


 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Login page.</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.min.css">
	<!-- <link rel="stylesheet" type="text/css" href="css/drop_down.css"> -->
	<link rel="stylesheet" type = "text/css" href = "css/my_styles.css" />
</head>
<body>
<div class="signup">
    	<p><a href="sign_up.php"><button class="btn btn-primary btn-large active">Sign up</button></a></p>
    </div>
	<center>
		<h1>WELCOME TO SEE-ME CHAT_ROOM</h1>
		<form action = "login.php" method = "POST" id = "login_form">
			<label for="user">Username</label>
			<input type = "text" name = "user" class="span4" placeholder = "Username"/>
			<label for="pass">Password</label>
			<input type = "password" name = "pass" class="span4" placeholder = "Password"/>
			<button type = "submit" name = "submit" class="btn btn-primary btn-large active" value = "">Login</button>
		</form>
	</center>

	<?php 

	if(isset($connection))
	{
		mysql_close($connection);
	}


	 ?>
</body>
</html>