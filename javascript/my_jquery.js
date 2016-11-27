$(".hover").mousemove(

	alert("called");
	function(e)
	{
		var hovertext = $(this).attr("hovertext");
		// set the text.
		$("#hoverdiv").text(hovertext).show();

		$("#hoverdiv").css("top", e.clientY+ 10).css("left", e.clientX + 10);
	}

).mouseout(
function()
{
	$("#hoverdiv").hide();
}

);

document.getElementById("hoverdiv").onclick(alert("helo"))