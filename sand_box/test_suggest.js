// a function to find the matches.
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
			document.getElementById('results').innerHTML = xmlhttp.responseText;

		}
	}

	xmlhttp.open('GET', 'search.inc.php?search_text='+document.search.search_text.value, true);

	xmlhttp.send();

}// end findMatch.