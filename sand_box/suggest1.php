 <!DOCTYPE html>
 <html>
 <head>
 	<title>Search Engine</title>
 	<script type="text/javascript">

 	function findMatch()
 	{

 		if(window.XMLHttpRequest)
 		{
 			xmlhttp = new XMLHttpRequest();
 		}
 		else
 		{
 			xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
 		}

 		xmlhttp.onreadystatechange = function()
 		{
 			// this makes sure that we have some results back.
 			if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
 			{
 				document.getElementById('search_result').innerHTML = xmlhttp.responseText;
 			}
 		}

 		xmlhttp.open('GET', 'search.inc.php?search_text='+document.search.search_text.value, true);

 		xmlhttp.send();

 		// testing ...

 		var inputField = document.getElementById('search_text');
 		var searchLink = document.getElementById('search_result');

 		searchLink.onmousedown = function()
 		{
 			inputField.value = xmlhttp.responseText;
 		}

 	}// end findMatch.

 </script>
 	<link rel="stylesheet" type="text/css" href="drop_down.css">
 </head>

 <body>

<section class="main">
 <form class="search" method="post" name = "search" action="suggest1.php" >
	 <input type="text" id = "search_text" name="search_text" placeholder="Find friend..." 
	 	 	onkeyup="findMatch();"/>

	 <ul class="results" >
		 <li >
			 <a href="drop_down.php" id = "search_result" ></a>
		 </li>
	 </ul>
 </form>
</section>

 </body>
 </html>