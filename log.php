<!DOCTYPE HTML>
<HTML lang="pl">
<head>
<title>login</title>
<meta charset="utf-8"/>
</head>
<body>
<?php
	
require_once "connect.php";
$polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);
if($polaczenie->connect_errno!=0)
{echo "ERROR".$polaczenie-connect_errno;}
else{
	$login = $_POST['login'];
	$pass = $_POST['pass'];
$sql = "SELECT*FROM users WHERE login='$login' AND pass='$pass'";

if($rezultat = @$polaczenie->query($sql))
{
	$ilu_userow =$rezultat->num_rows;
	if($ilu_userow>0)
	{
		$wiersz=$rezultat->fetch_assoc();
		$user=$wiersz['login'];
		$rezultat->close();
		echo "zalogowano do konta:".$user ;
		
		echo '<br><a href="index.php">powrot</a>';
	}else{
		echo 'podano zly login lub haslo <br>
		<a href="index.php">powrot</a>';
	}
}



$polaczenie->close();}	
?>
</body>
</html>