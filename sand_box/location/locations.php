<!DOCTYPE html>
<html lang= "en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv ="X-UA-Compatible" content= "IE-edge"/>
		<title>Fabba INN Motel</title>
		
		<!-- meta -->
		<meta name="author" content= "Lamin Jatta Aid by Abd Al-Ala Camara"/>
		<meta name="description" content= ""/>
		<meta name="viewpoint" content= "weith=device-widrh, initial-scale=1"/>
		
		<!-- css -->
		<link rel="stylesheet" type="text/css" href="css/main.css" >
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" >
		<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.min.css" >

		 <style>
      		#map-canvas {
        	width: 500px;
        	height: 400px;
      		}
    	</style>
    	<script src="https://maps.googleapis.com/maps/api/js"></script>
    	<script>
      		function initialize() {
        	var mapCanvas = document.getElementById('map-canvas');
        	var mapOptions = {
          	center: new google.maps.LatLng(13.006897, -16.731118),
          	zoom: 8,
          	mapTypeId: google.maps.MapTypeId.ROADMAP
        	}
        		var map = new google.maps.Map(mapCanvas, mapOptions)
      		}
      			google.maps.event.addDomListener(window, 'load', initialize);
    	</script>
	</head>
	<body>
		<div class  = "container">
			<div class  = "header">
				<a class="logo" href="index.html"><img src="images/logo.png" alt="Fabba INN Motel"></a>
				<p>Live INN and Feel at Home</p>
				<nav class  = "nav">
					<ul>
						<li>
							<a href="index.php">Home</a>
						</li>
						<li>
							<a href="locations.php">Location &amp; Direction</a>
						</li>
						<li>
							<a href="rates.php">Rates</a>
						</li>
						<li>
							<a href="amenities.php">Amenities</a>
						</li>
						<li>
							<a href="contact_us.php">Contact-Us</a>
						</li>
						<li>
							<a href="guestbook.php">Guest Book</a>
						</li>
						<li>
							<a href="gallery.php">Gallery</a>
						</li>
					</ul>
				</nav><!-- End of nav -->
			</div><!-- End of header -->

			<div class="featured">
				<img src="images/Faba.jpg" alt="featured Image">

			</div><!-- End of Featured-->
			
			<div class  = "main">
				<div class="content">
					<!-- <form method='post' action='upload.php' enctype="multipart/form-data">
							<div>
								<label for="name">Full Name:</label>
								<input type="text" name="fullname"/><br/>
							</div>
							<div>
								<label for="name">E-Mail:</label>
								<input type="text" name="email"/><br/>
							</div>
							<div>
								<label for="name">Comments:</label><br/>
								<textarea>

								</textarea>
							</div>
							
							<div>
							<input type="submit" value="Post Comments"/>
							</div>
						</form>
					<?php
						
					?> -->
												
				</div><!--End of content-->
				 <!-- <div class="sidebar">
					<h1>Contact Us</h1>

						<form action="" method="">
							<div>
								<label for="name">Name</label>
								<input type="text" id="name">
							</div>
							<div>
								<label for="email">Email</label>
								<input type="email" id="email">
							</div>
							<div>
								<label for="subject">Subject</label>
								<input type="text" id="subject">
							</div>
							<div>
								<label for="message">Message</label>
							<textarea>

							</textarea>
							</div>
							<div>
							<input type="submit" value="send">
							</div>
						</form>
				</div><!--End of sidebar -->
			</div><!-- End of main -->
			
			<div class  = "footer">
				<small>copyright 2014</small>
			</div><!-- End of footer -->
		</div><!-- End of  container-->
		<script type="text/javascript" src="js/vendor/jquery-1.11.2.min.js"></script>
		<script src="js/vendor/bootstrap.min.js"></script>
		<div id="map-canvas"></div>
	</body>
</html>