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
			document.getElementById('search_result').innerHTML = xmlhttp.responseText+"\n";		
		}
	}

	xmlhttp.open('GET', 'search.inc.php?search_text='+document.search.search_text.value, true);

	xmlhttp.send();

	// get the input that was typed.
	var inputField = document.getElementById('search_text');
	var searchLink = document.getElementById('search_result');

	searchLink.onmousedown = function()
	{
		inputField.value = xmlhttp.responseText;
	}
}// end findMatch.















