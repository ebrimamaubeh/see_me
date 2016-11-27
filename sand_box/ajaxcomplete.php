
<?php

$q=$_GET['q'];

$my_data=mysql_real_escape_string($q);

$mysqli=mysqli_connect('localhost','root','','test') or die("Database Error");

$sql="SELECT value FROM countries WHERE value LIKE '%$my_data%' ORDER BY value LIMIT 10";

$result = mysqli_query($mysqli,$sql) or die(mysqli_error());

if($result)

{

while($row=mysqli_fetch_array($result))

{

echo $row['value']."\n";

}

}

?>