<?php 

	$dir = "../lightbox/img/demopage/";

	$directry_handler = opendir($dir);

	while(false !== ($filename = readdir($directry_handler)))
	{
		if($filename != "." && $filename != "..")
			$files[] = $filename;
	}

	sort($files);

	echo "<pre>";
	print_r($files);

	echo "</pre>";







 ?>