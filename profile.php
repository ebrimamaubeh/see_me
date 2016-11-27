<?php 

	require_once("includes/include_files.php");

	// to do.
	// 1. upload and view images.
	// 2. have and about me message.

	confirm_logged_in();// authenticate user.

	$connection = connect_and_select_db($db_hostname, 
					$db_username, $db_password, $db_database);

	//default text.
	$about_me = "";


// check if the text is sent.
if(isset($_POST['text_submit']))
{

	if(!empty($_POST['text']))
	{
		$about_me = clean_input($_POST['text']);
		save_about_me_text($about_me);
	}
	else
	{
		echo "<p style = 'color: red;'>Please enter some text</p>";
	}

}
else 	// use the old text, if any.
{
	$query = "SELECT * FROM profiles
			 WHERE user_id = '{$_SESSION['user_id']}'";

	$result = query_mysql($query, __FILE__, __FUNCTION__);

	if(mysql_num_rows($result) > 0)
	{
		$row = mysql_fetch_array($result);
		$about_me = $row['about_me'];
	}

}

// set the profile image to the new one.
if(isset($_POST['profile_picture']) && isset($_FILES['image']['name']))
{
	$location = mkdir_if_not_exist();// make a folde for this user.

	// this should be changed lagter.
	if(!$location) die("Folder not found.");

	$name = $_FILES['image']['name'];
	$type = $_FILES['image']['type'];
	$size = $_FILES['image']['size'];
	$tmp_name = $_FILES['image']['tmp_name'];
	 
    $saveto = "uploads/profile_images/$name.jpg";

    if(move_uploaded_file($_FILES['image']['tmp_name'], $saveto))
	{
		//save image name in db.
		save_image_name($saveto);

		set_profile_image($saveto, $type);

	 }
	 else
	 {
	 	echo "Image could not be saved.<br>";
	 }   

    showProfile($saveto);

}
else// user the old image.
{	
	set_up_and_showPrfile();
}

$about_me = get_about_me_text($_SESSION['user_id']);

echo "<div id = 'about_me'>$about_me</div>";

echo "<br>";

?>


<html>
<head>
	<title>PHP Form Upload</title>
	<script src="lightbox/js/jquery-1.11.0.min.js"></script>
	<script src="lightbox/js/lightbox.min.js"></script>

	<link href="lightbox/css/lightbox.css" rel="stylesheet" />
	<link href="css/my_styles.css" rel="stylesheet" />

</head>

<body>

<?php 
	// select which form to show. 
	if(isset($_GET['stage']) AND $_GET['stage'] == "set_profile_pic")
	{
		echo "<form method='post' action='?var=profile' enctype='multipart/form-data'>
				Profile picture<input type='file' name='image' size='10' />
				<input type='submit' name = 'profile_picture' value='Set' />
				</form>";
	}

	if(isset($_GET['stage']) AND $_GET['stage'] == "about_me_txt")
	{
		echo "<form method = 'POST' action='?var=profile'>
				<textarea name = 'text'  id ='about_me_textArea'></textarea>
				<input type='submit' name = 'text_submit' value = 'Post'/>
			</form>";
	}

	if(isset($_GET['stage']) AND $_GET['stage'] == "upload_img")
	{
			echo "<form method='post' action='?var=profile' 
		enctype='multipart/form-data'>

		Upload image: <input type='file' name='filename' size='10' />
		<input type='submit' value='Upload' />
		</form>";
	}
	

 ?>


<?php

if (isset($_FILES['filename']['name']))// file is uploaded.
{

	$name = $_FILES['filename']['name'];
	$type = $_FILES['filename']['type'];
	$tmp_name = $_FILES['filename']['tmp_name'];
	$size = $_FILES['filename']['size'];

	if(!empty($name))
	{
		save_uploaded_image($type, $tmp_name, $name, $size);
	}
	else
	{
		echo "Please choose a file.";
	}

}

echo "<br><br>";
	$location = mkdir_if_not_exist();// make a folde for this user.

	get_images($location."/");

echo "</body></html>";

?>
 