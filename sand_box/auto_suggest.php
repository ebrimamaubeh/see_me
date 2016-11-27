
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


<title>Auto Complete Input box</title>


<link rel="stylesheet" type="text/css" href="jquery.ajaxcomplete.css" />


<script type="text/javascript" src="jquery.js"></script>


<script type="text/javascript" src="jquery.ajaxcomplete.js"></script>


<script>


$(document).ready(function(){


 $("#country").autocomplete("ajaxcomplete.php", {


selectFirst: true


});


});


</script>


</head>

<body>


    <label>Enter Your Country Name : </label>


    <input name="country" type="text" id="country" size="20"/>


</body>


</html>
