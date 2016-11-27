<?php 

	require_once("includes/include_files.php");

	confirm_logged_in();// authenticate user.

	$connection = connect_and_select_db($db_hostname, 
					$db_username, $db_password, $db_database);

	$wellcome_msg = "";

	if(isset($_GET['new_user']))
	{
		$user = $_GET['new_user'];
		$wellcome_msg = "Hello $user Thank you for signing up.";
	}

?>

<!-- lamin's html-->

<!DOCTYPE html>
<html lang= "en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv ="X-UA-Compatible" content= "IE-edge"/>
		<title>SEE-ME</title>
		
		<!-- meta -->
		<meta name="author" content= "Lamin Jatta Aid by Abd Al-Ala Camara"/>
		<meta name="description" content= ""/>
		<meta name="viewpoint" content= "weith=device-widrh, initial-scale=1"/>
		
		<!-- css -->
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.min.css">
		<link rel="stylesheet" type="text/css" href="css/my_styles.css">
		<link rel="stylesheet" type="text/css" href="css/main.css" >
		<link rel="stylesheet" type="text/css" href="css/drop_down.css">
		
	</head>
	<body>

		<div class  = "container">
			<div class  = "header">
						<div class="featured">
				<!-- display the users image.-->
		<?php 
				echo "<p id = 'welcom_msg'>$wellcome_msg</p>"; 
				set_up_and_showPrfile();			
		?>
			</div><!-- End of Featured-->
				<div class="appname">
 				<a href="logout.php" class = "hover" hovertext = "leave see me"><button class="btn btn-primary btn-large active">Sign out</button></a>
			</div>
				<nav class  = "nav">
					<ul>
						<li>
							<a href="home_page.php?var=comments">Home</a>
						</li>
						<li>
							<a href="?var=messages">Messages</a>
							<ul>
								<li>
									<a href="?stage=new_msg&var=messages">New Message</a></li>
								<li>
									<a href="?stage=inbox&var=messages">Inbox</a>
								</li>
								<li>
									<a href="?stage=notifications&var=messages">Notifications</a>
								</li>
							</ul>	
						</li>

							<li>
								<a href="?var=friends">Friends</a>
								<ul>
									<li>
										<a href="?var=find" >Search Friend</a>
									</li>
									<li>
										<a href="?var=friends">Show All</a>
									</li>
								</ul>
							</li>
						<li>
							<a href="?var=profile" class = "hover" 
							hovertext = "Check your profile">Profile</a>
							<!-- drop down list of profile  options.-->
							<ul>
								<li>
									<a href="?var=profile&stage=set_profile_pic">Set profile picture</a>
								</li>
								<li>
									<a href="?var=profile&stage=upload_img">Upload image</a>
								</li>
								<li>
									<a href="?var=profile&stage=about_me_txt">About Me</a>
								</li>
							</ul>
						</li>
					</ul>
				</nav><!-- End of nav -->
			</div><!-- End of header -->

			<div class  = "main">
				<div class="aside">
				<ul>
					<li id = "new_msg" >
						<a href="?var=messages&stage=new_msg" >Compose Message</a>
					</li>
					<li>
						<a href="?var=messages&stage=inbox">Inbox</a>
					</li>

					<li><a href="?var=chat">Chat</a></li>
					<li>
						<a href="?var=messages&stage=list_draft">Drafts</a>
					</li>
						
					<li>
						<a href="?var=friends">Find Friend</a>
					</li>
					<li>
						<a href="?var=profile">Photos</a>
					</li>
				</ul>
				</div><!--End of aside-->
				<div class="content">
					<?php 
		
		/*echo "Find should have it's own page, so that it can be the only thin that shows up.<br>
		And if a search is made it should go to that users profile page.<br><br>";
*/
		// go to the specified pages.
		if(isset($_GET['var']))
		{

			switch ($_GET['var']) 	
			{
				case 'friends':
					include 'friends.php';
					break;

				case 'find':
					include('find_friends.php');
					break;

				case 'profile':
					include 'profile.php';
					break;

				case 'chat':
					include 'chat.php';
					break;

				case 'comments':
					include("comments.php");
					break;

				case 'messages':
					include 'messages.php';
					break;	

				default: 
					echo "There is an error in your request, please try again<br>";
					break;

			}

		}

		if(isset($_GET['search_text']))
		{
			include('search_results.php');
		}	

	 ?>

<script type="text/javascript" src="javascript/jquery.js"></script>
<script type="text/javascript" src = "javascript/auto_suggest.js"></script>
<script type="text/javascript" src = "javascript/slide.js"></script>
	

					
	</div><!--End of content-->

				
		</div><!--End of sidebar-->
	</div><!-- End of main -->
	
	
</div><!-- End of  container-->

		<?php 

	mysql_close($connection);
	ob_end_flush();

 ?>
		
	</body>
</html>

<!--lamin's html-->


