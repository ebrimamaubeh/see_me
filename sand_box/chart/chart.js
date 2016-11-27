$(document).ready(function()
{

	var interval = setInterval(function()
	{

		$.ajax(
		{
				url: 'chart_msg.php', 
				success: function(data)
				{
					$("#messages").html(data);
				}
			});

	}, 1000);


});