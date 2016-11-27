function checkUser(user)
{

	var info = document.getElementById('info');

	if(info == '')
	{
		info.innerHTML = '';
		return;
	}

	params = "user="+user.value;
	request = new ajaxRequest()
	request.open("POST", "check.inc.php", true);
	request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	request.setRequestHeader("Content-length", params.length);
	request.setRequestHeader("Connection", "close");

	request.onreadystatechange = function()
	{
		if(this.readyState == 4 && this.status == 200)
		{
			if(this.responseText != null)
			{
				info.innerHTML = this.responseText;
			}
			else
			{
				alert("Ajex Error: No data recieved");
			}
		}
		
	}

	request.send(params);

}// end checkUser.

function ajaxRequest()
{
	try
	{
		var request = new XMLHttpRequest();
	}
	catch(e1)
	{
		try
		{
			request = ActiveXObject("Msxml2.XMLHTTP");
		}
		catch(e2)
		{
			try
			{
				request = ActiveXObject("Microsoft.XMLTTP");
			}
			catch(e3)
			{
				return false;
			}
		}
	}

	return request;

}

/*
function requiredField(input)
{



	var element = document.getElementById('first_name');

	// testing.
	if( element == '')
	{
		element.innerHTML = '';
		return;
	}

	params = "first_name="+input.value;
	request = new ajaxRequest()
	request.open("POST", "check.inc.php", true);
	request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	request.setRequestHeader("Content-length", params.length);
	request.setRequestHeader("Connection", "close");

	request.onreadystatechange = function()
	{
		if(this.readyState == 4 && this.status == 200)
		{
			if(this.responseText != null)
			{
				element.innerHTML = this.responseText;
			}
			else
			{
				alert("Ajex Error: No data recieved");
			}
		}
		
	}

	request.send(params);

}

*/

	