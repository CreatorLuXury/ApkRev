<!DOCTYPE html>
<?php
session_start();
?>
<html lang="pl">
<head>
    <title>Rejestracja AR</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/form.css">
</head>
<body>

<div class="center">
    <div class="pic"><img src="img/arcc.png" alt="logo strony AR"></div><div class="header">APK REVIEW</div>
    <div class="inside">
        <form action="rejestracja.php" method="POST">

            <input type="text" name="login" placeholder="Login" required"
                   title="Login nie może zawierać znaków specjalnych!"><br>

            <input type="password" name="haslo" placeholder="Hasło"><br>

            <input type="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" placeholder="Email"
                   required><br>

            <input type="submit" name="submit" value="Zarejestruj"><br>
        </form>

        <?php

        include 'fetch.php';

        if (isset($_POST['login']) && isset($_POST['haslo']) && isset($_POST['email'])) {
            $login = $_POST['login'];
            $haslo = $_POST['haslo'];
            $email = $_POST['email'];
            $haslo = addslashes($haslo);
            $login = addslashes($login);
            $login = htmlspecialchars($login);


            if (!$login OR empty($login)) {
                echo '<p class="alert">Wypełnij pole z loginem!</p>';
                exit;
            }

            if (!$email OR empty($email)) {
                echo '<p class="alert">Musisz podać e-mail!</p>';
                exit;
            }

            if (!$haslo OR empty($haslo)) {
                echo '<p class="alert">Wypełnij pole z hasłem!</p>';
                exit;
            }

            $tresc_zapytania = "SELECT * FROM uzytkownicy;";

            $zapytanie = mysqli_query($polaczenie, $tresc_zapytania);

            $queryh = "SELECT * FROM uzytkownicy WHERE login='$login'";
            $querym = "SELECT * FROM uzytkownicy WHERE email='$email'";
            $result = mysqli_query($polaczenie, $queryh);
            $user = mysqli_fetch_assoc($result);
            $resultm = mysqli_query($polaczenie, $querym);
            $userm = mysqli_fetch_assoc($resultm);

            $haslo = md5($haslo);

            if (isset($_POST['submit'])) {
                if ($login) {
                    if ($user['login'] === $login) {
                        echo "Login zajęty użyj innego";
                    }
                    elseif ($userm['email'] === $email) {
                        echo "Email w użyciu!";
                    }
                    else {

                        $tresc = 'insert into uzytkownicy values(0,"' . $login . '","' . $haslo . '","' . $email . '",DEFAULT,DEFAULT,0)';
                        $dodaj = mysqli_query($polaczenie, $tresc);
                        if ($dodaj) {
                            echo "<br>";
                            header('Location: logowanie.php');
                        } else {
                            echo "Błąd<br>";
                        }
                    }
                }
            }
        }

        ?>
    </div>
</div>
</body>
</html>