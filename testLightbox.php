<?php 

	$dir = "uploads/ebrima_1/";

	$directry_handler = opendir($dir);

	while(false !== ($filename = readdir($directry_handler)))
	{
		if($filename != "." && $filename != "..")
			$files[] = $filename;
	}

	sort($files);


 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Test images.</title>
	<script src="lightbox/js/jquery-1.11.0.min.js"></script>
	<script src="lightbox/js/lightbox.min.js"></script>

	<link href="lightbox/css/lightbox.css" rel="stylesheet" />
</head>
<body>

<?php 

	foreach ($files as  $file) 
	{
		echo "<a href=\"$dir$file\" 
		data-lightbox=\"roadtrip\">$file</a><br>";
	}

 ?>

</body>
</html>