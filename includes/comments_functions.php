<?php 

	require_once("includes/include_files.php");


	function get_all_comments()
	{
		$query = "SELECT * FROM comments ORDER BY id DESC";

		$result = mysql_query($query) or die(mysql_error());

		return $result;
	}

	function get_comment_replies($comment_id)
	{
		$query = "SELECT * FROM comments_reply 
				WHERE comment_id = '$comment_id'";

		$result = mysql_query($query) or die(mysql_error());

		return $result;

	}

	function save_reply($comment_id, $content)
	{
		$query = "INSERT INTO comments_reply (from_id, comment_id, content)
				VALUES ('{$_SESSION['user_id']}', '$comment_id', '$content')";

		$result = mysql_query($query) or die(mysql_error());

		return $result;// true or false.
	}

	function get_comment_poster($comment_id)
	{
		$query = "SELECT * FROM comments WHERE id = '$comment_id'";

		$result = mysql_query($query) or die(mysql_error());

	}


	function save_comment($from_id, $content)
	{
		$query = "INSERT INTO comments (from_id, content)
				VALUES ('$from_id', '$content')";

		$result = mysql_query($query) or die(mysql_error());

		return $result;// true or false.

	}




 ?>