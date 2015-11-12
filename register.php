<?php
	
require_once "connect.php";
$polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);
if($polaczenie->connect_errno!=0)
	{echo "ERROR".$polaczenie-connect_errno;}
	else{
		
$sql=@mysql_query("INSERT INTO users SET id='6' AND login='A' AND pass='b' AND email='c'");

	}

$polaczenie->close();
 

?>