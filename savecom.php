<?php
session_start();
include 'fetch.php';
date_default_timezone_set('Europe/Warsaw');
$date = date('d/m/Y h:i:s', time());
global $login;
if (isset($_SESSION['login'])) {
    $login = $_SESSION['login'];
}
else{
    header('Location: login.php');
}

function test_input($data)
{
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
}

$text = $_GET['tekst'];
addslashes($text);
$text = htmlspecialchars($text);
$id = $_GET['id'];

    $tresc = 'insert into komentarze values(0,"' . $login . '","' . $id . '","' . $date . '","' . $text . '")';
    $dodaj = mysqli_query($polaczenie, $tresc);
if ($dodaj) {
    echo "<br>";
    header("Location: artykul.php?id=".$id);
} else {
    echo "Błąd<br>";
}
?>