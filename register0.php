<?php
require_once "connect.php";
$polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);
if($polaczenie->connect_errno!=0)
{echo "ERROR".$polaczenie-connect_errno;}
 
    // jeśli zostanie naciśnięty przycisk "Zarejestruj"
    if(isset($_POST['name'])) {
        // filtrujemy dane...
        $_POST['name'] = clear($_POST['name']);
        $_POST['password'] = clear($_POST['password']);
        $_POST['password2'] = clear($_POST['password2']);
        $_POST['email'] = clear($_POST['email']);
 
        // sprawdzamy czy wszystkie pola zostały wypełnione
        if(empty($_POST['name']) || empty($_POST['password']) || empty($_POST['password2']) || empty($_POST['email'])) {
            echo '<p>Musisz wypełnić wszystkie pola.</p>';
        // sprawdzamy czy podane dwa hasła są takie same
        } elseif($_POST['password'] != $_POST['password2']) {
            echo '<p>Podane hasła różnią się od siebie.</p>';
        // sprawdzamy poprawność emaila
        } elseif(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
            echo '<p>Podany email jest nieprawidłowy.</p>';
        } else {
            // sprawdzamy czy są jacyś uzytkownicy z takim loginem lub adresem email
            $result = mysql_query("SELECT Count(user_id) FROM `users` WHERE `login` = '{$_POST['name']}' OR `email` = '{$_POST['email']}'");
            $row = mysql_fetch_row($result);
            if($row[0] > 0) {
                echo '<p>Już istnieje użytkownik z takim loginem lub adresem e-mail.</p>';
            } else {
                // jeśli nie istnieje to kodujemy haslo...
                $_POST['password'] = codepass($_POST['password']);
                // i wykonujemy zapytanie na dodanie usera
                mysql_query("INSERT INTO `users` (`login`, `pass`, `email`) VALUES ('{$_POST['name']}', '{$_POST['password']}', '{$_POST['email']}')");
                echo '<p>Zostałeś poprawnie zarejestrowany! Możesz się teraz <a href="index.php">zalogować</a>.</p>';
            }
        }
    }
 
    // wyświetlamy formularz
	$name=$_POST['name'];
    echo '<form method="post" action="register.php">
        <p>
            Login:<br>
            <input type="text" value="'.$_POST['name'].'" name="name">
        </p>
        <p>
            Hasło:<br>
            <input type="password" value="'.$_POST['password'].'" name="password">
        </p>
        <p>
            Powtórz hasło:<br>
            <input type="password" value="'.$_POST['password2'].'" name="password2">
        </p>
        <p>
            E-mail:<br>
            <input type="text" value="'.$_POST['email'].'" name="email">
        </p>
        <p>
            <input type="submit" value="Zarejestruj">
        </p>
    </form>';


 $polaczenie->close();
?>