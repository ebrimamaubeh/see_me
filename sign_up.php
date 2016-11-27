<?php 

	
	require_once("includes/include_files.php");

	if(is_logged_in())
	{
		redirect_to("home_page.php");
	}

	
	$connection = connect_and_select_db($db_hostname, 
					$db_username, $db_password, $db_database);

	$first_name = $last_names = $user_error = $pass_error =$first_error=
	$last_error= $gender_error = "";


	// Store data in the database.
	if(isset($_POST['submit']))
	{
		
		$valid = true;

		$first_name = clean_input($_POST['first_name']);
		$last_names = clean_input($_POST['last_names']);
		$user 		= clean_input($_POST['user']);
		$pass 	 	= clean_input($_POST['pass']);
		$gender 	= $_POST['gender'];

		if(strlen($user) < 6 && is_valid_name($user))
		{
			$valid = false;
			$user_error = "Invalid Username<br>Username must be at least 6.";
		}

		if(strlen($pass) < 6 )
		{
			$valid = false;
			$pass_error = "Username must be at least 6 chatacters.";
		}

		if (empty($gender)) 
		{
			$gender_error = "gender is empty";
			$valid = false;
		}

		if($valid)
		{
			$query = "INSERT INTO users (first_name, last_name, username, password)
				VALUES ('$first_name', '$last_names', '$user', '$pass') ";

			$result = query_mysql($query, __FUNCTION__, __FILE__);

			$id = mysql_insert_id();

			//log in the user.

			$_SESSION['user_id'] = $id;
			$_SESSION['username'] = $user;

			set_default_image();

			redirect_to("home_page.php?new_user=$first_name&var=comments");

		}

	}



 ?>

<!DOCTYPE html>
<html>
<head>
	<title>The Sign up page</title>

	<!-- CSS -->
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" >
		<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.min.css" >
		<link rel="stylesheet" type = "text/css" href = "css/my_styles.css" />
		<link rel="stylesheet" type = "text/css" href = "css/main.css" />
</head>
<body>
	<center>
		<h1>WELCOME TO SEE-ME CHAT_ROOM</h1>
		<h1>Sign up for FREE!!!!</h1>
		<form action="sign_up.php" method="POST" id = "login_form">

			<?php echo "$first_error"; ?><br>
				<input type="text" name = "first_name" class="span5" placeholder= "First Name" 
				value = "<?php echo $first_name; ?>" required><br>

			<?php echo "$last_error"; ?><br>
				<input type="text" name = "last_names" class="span5" placeholder= "Last Names" 
				value = "<?php echo $last_names; ?>" required><br>


				<?php echo $gender_error; ?>
				<select id = "gender" name="gender">
					<option vlaue = "">Gender</option>
					<option vlaue = "male">Male</option>
					<option vlaue = "female">Female</option>
				</select>

				<br>

			<?php echo "<p style = 'color: red;' > $user_error</p>"; ?><br>
				<input type="text" placeholder="Username" class="span5" onblur="checkUser(this);" 
				name="user" maxlength="25" required>
				<span id = "info"></span><br>

			<?php echo "<p style = 'color: red;' >$pass_error </p>"; ?><br>
				<input type="password" placeholder="password" class="span5" name="pass" maxlength="25" required>
				<br>

				<button type = "submit" name = "submit" class="btn btn-primary btn-large active" value = "Sign up">Sign up</button>
			
		</form>
	</center>
	<script type="text/javascript" src = "javascript/sign_up.js"></script>
</body>
</html>