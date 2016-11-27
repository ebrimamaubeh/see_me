<?php 

	require_once("includes/include_files.php");

	if(isset($_POST['submit_button']))
	{

		$content = clean_input($_POST['content']);
		$comment_id = $_POST['comment_id'];

		if(empty($_POST['content']))
		{
			echo "<p> please type some text.</p>";
		}
		else
		{
			if(save_reply($comment_id, $content))
			{
				echo "<p>Posted</p>";
			}
		}
	}



	if(isset($_POST['submit_btn']))
	{
		$content = clean_input($_POST['content']);

		if(save_comment($_SESSION['user_id'], $content))
		{
			echo "posted<br>";
		}
		else
		{
			echo "NOT posted<br>";
		}

	}


	// what's on your mind comments.
	echo "
		<br>
		<form id = 'on_your_mind' action='?var=comments' method='POST'>
		 <textarea name = 'content'
		 placeholder = \"What's on your mind\"></textarea><br>
		 <input  class=\"btn btn-primary btn-large active\" type='submit' name=\"submit_btn\" value = 'POST'/>
		 </form><br><br>";





	$comments_result = get_all_comments();

	while($comments_row = mysql_fetch_array($comments_result))
	{

		$comment = $comments_row['content'];
		$comment_id = $comments_row['id'];
		$from_id = $comments_row['from_id'];

		$filename = get_profile_image_name($from_id);

		
		$reply_result = get_comment_replies($comment_id);

		echo "<div id ='comments'> ".show_friend_profile($filename, $from_id).
		"$comment </div>";	

		// a form for users to reply.
		echo "
		<br>
		<form id = 'comments_form' action='?var=comments' method='POST'>
		 <textarea id = 'textarea_comment' name = 'content'
		 placeholder = 'reply to this comment'></textarea><br>
		 <input type = 'hidden' name = 'comment_id' value =\"$comment_id\" />
		 <input  class=\"btn btn-primary btn-large active\" type='submit' name=\"submit_button\" value = 'Comment'/>
		 </form>";



		// output the replies.
		while($reply_row = mysql_fetch_assoc($reply_result))
		{
			$reply = $reply_row['content'];
			$reply_from_id = $reply_row['from_id'];

			$reply_sender_filename = get_profile_image_name($reply_from_id);

			echo "<div id = 'replies'>".
				show_friend_profile($reply_sender_filename, $reply_from_id)
			."$reply </div>";
		}


	}




 ?>

 
