<!DOCTYPE html>
<?php
session_start(); // 1
?>
<html lang="pl">
<head>
    <title>Logowanie AR</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/form.css">


</head>
<body>
<div class="center">
    <div class="pic"><img src="img/arcc.png" alt="logo strony AR"></div><div class="header">APK REVIEW</div>
    <div class="inside">
        <form action="logowanie.php" method="POST">

            <input type="text" name="login" required placeholder="Login""
                   title="Login nie może zawierać znaków specjalnych!"><br>

            <input type="password" name="haslo" required placeholder="Hasło"><br>

            <input type="submit" value="Zaloguj"><br>

        </form>
<?php

include 'fetch.php';

if (isset($_POST['login']) && isset($_POST['haslo'])) {

    $login = $_POST['login'];
    $haslo = $_POST['haslo'];
    $haslo = addslashes($haslo);
    $login = addslashes($login);
    $login = htmlspecialchars($login);

    if (!$login OR empty($login)) {
        echo '<p class="alert">Wypełnij pole z loginem!</p>';
        exit;
    }

    if (!$haslo OR empty($haslo)) {
        echo '<p class="alert">Wypełnij pole z hasłem!</p>';
        exit;
    }

    $zapytanie = "SELECT * FROM uzytkownicy";

    $queryh = "SELECT * FROM uzytkownicy WHERE login='$login'";

    $haslo = md5($haslo);

    $resulth = mysqli_query($polaczenie, $queryh);
    $resultu = mysqli_query($polaczenie, $queryh);
    $passch = mysqli_fetch_assoc($resulth);
    $user = mysqli_fetch_assoc($resultu);


    if ($user['login'] != $_POST['login']) {
        echo "<br> Użytkownik nie istnieje!";
    } else if ($passch['haslo'] != $haslo) {
        echo "<br>Nieprawidłowe hasło logowania!";
    } else {
        $_SESSION['login'] = $_POST['login'];
        $_SESSION['isadmin'] = $user['isadmin'];

        header('Location: index.php');
    }
}
?>
        <div>
            <form action="logowanie.php" method="GET">
                <input type="submit" name="rejestracja" value="Zarejestruj">
            </form>

        </div>
</div>
</div>


<?php
if (isset($_GET['rejestracja'])) {
    header('Location: rejestracja.php');
}
?>
</body>
</html>