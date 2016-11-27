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

<!DOCTYPE html>
<html>
<head>
	<title>Home Page</title>
	<!-- <link rel="stylesheet" type="text/css" href="css/my_styles.css" /> -->
		<link rel="stylesheet" type="text/css" href="css/drop_down.css">
		<script type="text/javascript" src = "javascript/auto_suggest.js"></script>
	<script type="text/javascript" src = "javascript/home_page_script.js"></script>
</head>
<body>

<h1>Inbox.</h1>

<p><a href="home_page.php?var=friends">Find friends</a></p>
<p><a href="home_page.php?var=profile">Profile</a></p>
<section class="main">
 <form class="search" method="post" name = "search" action="home_page.php" >
	 <input type="text" id = "search_text" name="search_text" placeholder="Find friend..." 
	 	 	onkeyup="findMatch();"/>
	 	<!-- search results are displayed by this ul tag. -->
	 <ul class="results" >
		 <li >
			 <a href="drop_down.php" id = "search_result" ></a>
		 </li>
	 </ul>
 </form>
</section>


<div id = "message_area">
	<!-- This is where the messages from the 
	users inbox will be displayed. -->

	<p>This is the main content area.</p>

	<?php echo "<p>$wellcome_msg</p>"; ?>

	<ul>
	<?php 
		
		// go to the specified pages.
		if(isset($_GET['var']))
		{

			switch ($_GET['var']) 
			{
				case 'new_msg':
					include 'includes/pages/new_msg.php';
					break;
				case 'inbox':
					include 'includes/pages/inbox.php';
					break;

				case 'new_msg':
					include 'includes/pages/new_msg.php';
					break;

				case 'friends':
					include 'includes/pages/friends.php';
					break;

				case 'profile':
					include 'includes/pages/profile.php';
					break;
				
				default:
					# do nothing for 
					break;
			}

		}

		

	 ?>

	 </ul>
</div>

<?php 

	echo "Find should have it's own page, so that it can be the only thin that shows up.<br>
			And if a search is made it should go to that users profile page.";

 ?>

<aside id = "aside">
	<ul>
		<li id = "new_msg" >
			<a href="home_page.php?var=new_msg" >New Message</a>
		</li>
		<li><a href="home_page.php?var=inbox">Inbox</a></li>
		<li>Outbox</li>
		<li>Drafts</li>
		<li>Sent Messages</li>
	</ul>
</aside>



<?php 

	mysql_close($connection);
	ob_end_flush();

 ?>
</body>
</html>