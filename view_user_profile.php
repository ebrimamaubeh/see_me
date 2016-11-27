<?php 

	require_once("includes/include_files.php");

	confirm_logged_in();// authenticate user.

	
	$connection = connect_and_select_db($db_hostname, 
					$db_username, $db_password, $db_database);


 ?>

<!DOCTYPE html>
<html>
<head>
	<title>User Profile</title>
	

	<link rel="stylesheet" type="text/css" href="css/my_styles.css">

	<link href="lightbox/css/lightbox.css" rel="stylesheet" />
</head>
<body>

<?php 

	// output all the images in the body, else the images will not be large.
	// a picture is selected.
	if(isset($_GET['user_id']))
	{
		$user_id = $_GET['user_id'];

		$about_me = get_about_me_text($user_id);

		$image_name = get_profile_image_name($user_id);
		showProfile($image_name);

		echo "<div id = 'about_me'>$about_me</div>";

		$location = get_user_dir($user_id);

		get_images($location);
	}



 ?>

<script src="lightbox/js/jquery-1.11.0.min.js"></script>
<script src="lightbox/js/lightbox.min.js"></script>

</body>
</html>