<?php 

	
	if (isset($_GET['search_text'])) 
	{
		$full_name = $_GET['search_text'];

		$result = get_searched_friend($full_name);

		if($row = mysql_fetch_array($result))
		{
			$user_id = $row['id'];

			$about_me = get_about_me_text($user_id);

			$image_name = get_profile_image_name($user_id);
			showProfile($image_name);

			echo "<div id = 'about_me'>$about_me</div>";

			$location = get_user_dir($user_id);

			echo "<br><br>";

			get_images($location);

		}
		
	}

 ?>