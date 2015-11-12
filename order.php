<!DOCTYPE HTML>
<HTML lang="pl">
<head>
<title>Podsumowanie</title>
<meta charset="utf-8"/>
</head>
<body>
<?php
	$piw = $_POST['piwa'];
	$win = $_POST['wina'];
	$suma = 5*$piw + 15*$win;
	
	echo<<<END
	<h1>ilosc zamowionych piw:$piw</br>
	ilosc zamowionych win:$win</h1>
	<table border="1" cellpadding="15" cellspacing="0">
	<tr>
		<td>piwo 5zł/szt</td> <td>$piw</td>
	</tr>
	<tr>
		<td>WINO 15zł/szt</td> <td>$win</td>
	</tr>
	<tr>
		<td>SUMA</td> <td>$suma PLN</td>
	</tr>
		
	</table>
	<br><a href="index.php">powrot</a>
END;
?>
</body>
</html>