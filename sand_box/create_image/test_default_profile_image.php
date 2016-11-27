<?php 

	$saveto = "default.jpeg";

    $src = imagecreatefromjpeg($saveto); 
	
    $max = 100;

	 
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
	  
	  imagejpeg($tmp, "new_img.jpeg");

	  imagedestroy($tmp);
	  imagedestroy($src);



 ?>


 <img src="new_img.jpeg"  alt="Created image" border='1' align="left">