// validate empty field.
function check_empty()
{
	if(document.getElementById("name").value == "" || 
		document.getElementById("email").value == "" ||
		document.getElementById("msg").value == "")
	{
		alert("Please Fill in all fields.");
	}
	else
	{
		document.getElementById('form').submit();// submit the form.
		alert("form was submited successfully.");
	}

}

// function to show the pop up.

function div_show()
{
	document.getElementById('the_div').style.display = "bolck";
}

// a function to show the pop up.
function div_hide()
{
	document.getElementById('the_div').style.display = "none";
}