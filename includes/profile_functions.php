<?php 

	require_once("include_files.php");

	function is_profile_set()
	{
		$query = "SELECT * FROM profiles
				 WHERE user_id = '{$_SESSION['user_id']}'";

		$result = query_mysql($query, __FILE__, __FUNCTION__);

		return mysql_num_rows($result) > 0;

	}

	// this function takes a path relative to the currnet directry.
	function mkdir_if_not_exist()
	{
		// select every thing from  the instructor table to use later 
		$query = "SELECT first_name FROM users 
			WHERE id = '{$_SESSION['user_id']}'";

		$result = query_mysql($query, __FILE__, __FUNCTION__);

		if($row = mysql_fetch_array($result))
		{
			$first_name = $row["first_name"];
			$id = $_SESSION['user_id'];

			$location = "uploads/".$first_name."_".$id;

			if(!is_dir($location))// if it does not have a folder .
			{
				mkdir($location); // then make a folder.
			}

			return $location;

		}

		return false;

	}// function

	function get_user_dir($user_id)
	{
		$query = "SELECT first_name FROM users 
			WHERE id = '$user_id'";

		$result = query_mysql($query, __FILE__, __FUNCTION__);

		if($row = mysql_fetch_array($result))
		{
			$first_name = $row["first_name"];

			$location = "uploads/".$first_name."_".$user_id."/";

			if(is_dir($location))
			{
				return $location;
			}

		}

		return false;
	}

	function get_images($dir)
	{

		$directry_handler = opendir($dir);

		$files = "";

		while(false !== ($filename = readdir($directry_handler)))
		{
			if($filename != "." && $filename != "..")
				$files[] = $filename;
		}

		if($files)// false if the files array empty.
		{
			sort($files);	

			foreach ($files as  $file) 
			{
				echo "<a href=\"$dir$file\" 
				data-lightbox=\"roadtrip\">$file</a><br>";
			}
		}

	}

	function get_user_folder($dir)
	{
		$query = "SELECT first_name FROM users 
					WHERE id = '$dir'";

		$result = query_mysql($query, __FILE__, __FUNCTION__);

		if($row = mysql_fetch_array($result))
		{
			$first_name = $row['first_name'];
			$id = $_SESSION['user_id'];

			$folder_name = $first_name."_".$id;

			return $folder_name;
		}

		return false;

	}

	function showProfile($filename)
	{

		if(file_exists($filename))
		{
			echo "<img src =\"$filename\" border = '1' align ='left' id='profile_pic'/>";	
		}
		
	}

	function show_friend_profile($filename, $user_id)
	{

		if(file_exists($filename))
		{
			echo "<a href=\"?user_id=$user_id&var=friends&stage=view_friend\" style = 'color: black;'>
			<img src =\"$filename\" border = '1' align ='left' id = 'profile_pic'/></a>";	
		}

	}



	function set_profile_image($saveto, $type)
	{
		$typeok = TRUE;

	    switch($type)
	    {
	      case "image/gif":   $src = imagecreatefromgif($saveto); break;
	      case "image/jpeg":  // Both regular and progressive jpegs
	      case "image/pjpeg": $src = imagecreatefromjpeg($saveto); break;
	      case "image/png":   $src = imagecreatefrompng($saveto); break;
	      default:            $typeok = FALSE; break;
	    }

	    if ($typeok)
	    {
	      list($w, $h) = getimagesize($saveto);

	      $max = 100;
	      $tw  = $w;
	      $th  = $h;

	      if ($w > $h && $max < $w)
	      {
	        $th = $max / $w * $h;
	        $tw = $max;
	      }
	      elseif ($h > $w && $max < $h)
	      {
	        $tw = $max / $h * $w;
	        $th = $max;
	      }
	      elseif ($max < $w)
	      {
	        $tw = $th = $max;
	      }

	      $tmp = imagecreatetruecolor($tw, $th);
	      imagecopyresampled($tmp, $src, 0, 0, 0, 0, $tw, $th, $w, $h);

	      imageconvolution(
	      	$tmp, 
	      	array(array(-1, -1, -1),
	        array(-1, 16, -1), 
	        array(-1, -1, -1)), 
	     	 8, 0
	      );

	      // rotating the image.
	      //$tmp = imagerotate($tmp, 90, 0);
	      
	      imagejpeg($tmp, $saveto);

	      imagedestroy($tmp);
	      imagedestroy($src);
	    }

	}



	function save_image_name($name)
	{
		 $update_query = "UPDATE profiles
		 		 SET profile_image_name = '$name', 
		 		 is_image_selected = 1
    			WHERE user_id = '{$_SESSION['user_id']}'";

    	$set_query = "INSERT INTO profiles 
    	(user_id, profile_image_name, is_image_selected) 
			VALUES('{$_SESSION['user_id']}', '$name', 1)";	

    	if(is_profile_set())
		{
			$result = query_mysql($update_query, __FILE__, __FUNCTION__);
		}
		else
		{
			$result = query_mysql($set_query, __FILE__, __FUNCTION__);
		}

    	return $result;
	}

	function get_profile_image_name($id)
	{
		$query = "SELECT profile_image_name FROM profiles 
			WHERE user_id = '$id'";

		$result = query_mysql($query, __FILE__, __FUNCTION__);

		if($row = mysql_fetch_array($result))
		{
			$name = $row['profile_image_name'];

			return $name;
		}

		return false;

	}

	// checks if the user has a profile image.
	function has_profile_image($id)
	{
		$query = "SELECT is_image_selected FROM profiles
				WHERE user_id = '$id'
				AND is_image_selected = 1";

		$result = query_mysql($query, __FILE__, __FUNCTION__);

		return mysql_num_rows($result) > 0;	

	}

	function get_about_me_text($user_id)
	{
		$query = "SELECT about_me FROM profiles 
					WHERE user_id = '$user_id'";

		$result = query_mysql($query, __FILE__, __FUNCTION__);

		$about_me = "";

		if($row = mysql_fetch_assoc($result))
		{
			$about_me = $row['about_me'];
		}

		return $about_me;


	}

	function get_user_profile($user_id)
	{
		// 1. user's images.
		//2. pictures. (get the folder of images.)
		//.3. name of the user.
		//profile_image_name
	}

	

	function set_default_image()
	{

		$image_name = "uploads/profile_images/default.jpeg.jpg";

    	$query = "INSERT INTO profiles 
    	(user_id, profile_image_name, is_image_selected) 
			VALUES('{$_SESSION['user_id']}', '$image_name', 1)";	

		
		$result = query_mysql($query, __FILE__, __FUNCTION__);

    	return $result;
	}

	

	function is_default_image()
	{
		$query = "SELECT * FROM profiles 
			WHERE user_id = '{$_SESSION['user_id']}' 
			AND profile_image_name = 'uploads/profile_images/default.jpeg.jpg'";

		$result = query_mysql($query, __FILE__, __FUNCTION__);

		return mysql_num_rows($result);
	}

	function set_up_and_showPrfile()
	{
		// default image.
		if(is_default_image())
		{
			showProfile("uploads/profile_images/default.jpeg.jpg");
		}
		else
		{
			$folder_name = mkdir_if_not_exist();// make a folde for this user.

			$image_name = get_profile_image_name($_SESSION['user_id']);// returnes imageName or false.

			if($image_name)
			{
				showProfile($image_name);
			}
		}
		
	}

	function save_about_me_text($text)
	{
		$text = clean_input($text);
		$update_query = "UPDATE profiles SET about_me = '$text' 
					WHERE user_id = '{$_SESSION['user_id']}'";

		$set_query = "INSERT INTO profiles (user_id, about_me)
				VALUES ('{$_SESSION['user_id']}', '$text')";


		if(is_profile_set())
		{
			$result = query_mysql($update_query, __FILE__, __FUNCTION__);
		}
		else
		{
			$result = query_mysql($set_query, __FILE__, __FUNCTION__);
		}
	}

	function save_uploaded_image($type, $tmp_name, $name, $size)
	{

		$location = mkdir_if_not_exist();// make a folde for this user.

		switch($type)
		{

			case 'image/jpeg': $ext = "jpg";
				break;
			case 'image/gif': $ext = "gif";
				break;
			case 'image/png': $ext = "png";
				break;
			case 'image/tif': $ext = "tif";
				break;
			default: $ext = "";
				break;

		}

		if($ext)
		{
			if($size < 5000000) //500Mb
			{
				if(move_uploaded_file($tmp_name, $location."/".$name))
				{
					echo "$name uploaded<br/>";
				}
				else
				{
					echo "Not uploaded<br/>";
				}
				
			}
		}
		else
		{
			echo "File extention not supported.</br>";
		}
	}

 ?>