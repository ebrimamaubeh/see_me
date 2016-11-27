<!DOCTYPE html>
<html>
<head>
	<title>Playing some videos, w3c tutorial 1</title>
</head>
<body>

<video width = "400" hight = "349" controls>
	<source src = "one.mp4" type = "video/mp4" />
	<source src = "video_files/two.mp4" type = "video/mp4" />
	<source src = "video_files/three.mp4" type = "video/mp4" />
	<object data="movie.mp4" width = "200" hight = "249">
		<embed src="two.mp4" width = "200" hight = "249"/>
	</object>
</video>

</body>
</html>