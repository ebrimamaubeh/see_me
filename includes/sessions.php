<?php 
	
	session_start();
	ob_start();
	

	require_once("include_files.php");

	// don't forget to start the sessions. else sessions woun't work.

	function destroySession()
	{
		$_SESSION = array();

		if(session_id() != "" || isset($_COOKIE[session_name()]))
			setcookie(session_name(), '', time() - 2592000, '/');

		session_destroy();
	}

	function is_logged_in()
	{
		return isset($_SESSION['username']);
	}

	function confirm_logged_in()
	{
		 if(!is_logged_in())
       {
       	  redirect_to("login.php");
       }
	}



 ?>