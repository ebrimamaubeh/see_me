$(document).ready(
function() 
{
	var speed = 2000;
	$("#top_message").slideDown(speed);

	$("#hide_message").click(

	function()
	{
		$("#top_message").slideUp(speed);
	}

);
}

);