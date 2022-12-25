<?php
// Connnect to MySQL
//$link = @mysql_connect("localhost","root","Qwe123","db_edocument") or die(mysql_connect_error()
/*
if(mysql_coonect("localhost","db_edocument","@Qwe123"))
{
	echo "MySQL connect.<br>";
}
else
{
	echo "MySQL connect Failed.<br>";
}
//
if(mysql_select_db("edocument"))
}
	echo "Data Used.<br>";
}
else
{
	echo"connect.<br>";
}
mysql_close();
*/


$host = "localhost";
$username = "root";
$password = "Qwe123";
$objConnect = mysql_connect($host,$username,$password);

if($objConnect)
{
	echo "MySQL Connected";
}
else
{
	echo "MySQL Connect Failed : Error : ".mysql_error();
}

mysql_close($objConnect);

echo "xxxxxx";
?>
