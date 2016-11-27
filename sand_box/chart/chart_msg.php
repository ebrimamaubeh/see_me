<?php 

	require_once("functions.php");
	require_once("db_login.php");

	// output the messages here.
	$messages = get_message();// this should return an arrray of messages.

	foreach($messages AS $message)
	{
		echo "<strong>".$message['sender']."  Said</strong><br> ";
		echo $message['message']."<br><br>";
	}


 ?>