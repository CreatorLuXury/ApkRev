<?php
session_start();
if (isset($_GET['id'])) {
    $ident = $_GET['id'];
    include 'fetch.php';
    global $login;
    if (isset($_SESSION['login']) and ($_SESSION['isadmin']) == '1') {
        $login = $_SESSION['login'];
        include 'navbar.php';
    } else {
        header('Location: index.php');
    }
    date_default_timezone_set('Europe/Warsaw');
    $date = date('m/d/Y h:i:s', time());
}
else {
    header('Location: index.php');
}


?>
<!doctype html>
<html lang="pl" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <title>Edytor Artykułów</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/creator.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body>
<div class="center">
    <div class="inside">


        <?php
        echo $ident;
        $q = "SELECT * FROM artykul WHERE id='$ident'";
        $r = mysqli_query($polaczenie,$q);
        $a = mysqli_fetch_assoc($r);
        $pic = $a['obraz'];
        $subname = $a['nazwa'];
        $desc = $a['opis'];

        if (isset($_GET['load'])){
            $link = $_GET['obraz'];
            echo '<img src="'.$link.'" width="250vw" height="250vh">';
        }


        else if (isset($_GET['name']) && isset($_GET['obraz']) && isset($_GET['opis'])) {

            $name = $_GET['name'];
            $obraz = $_GET['obraz'];
            $opis = $_GET['opis'];
            $query = "SELECT * FROM artykul";
            $result = mysqli_query($polaczenie, $tresc_zapytania);
            $artykul = mysqli_fetch_assoc($result);

            if (isset($_GET['submit'])) {
              //  $tresc = 'insert into artykul("'.$ident.'","' . $obraz . '","' . $name . '","' . $date . '","' . $opis . '")ON DUPLICATE KEY UPDATE id="'.$ident.'"';
                $tresc = "UPDATE artykul SET nazwa = "bla bla bla" where id = '".$ident."'";
                $dodaj = mysqli_query($polaczenie, $tresc);
                if ($dodaj) {
                    header('Location: index.php');
                } else {
                    echo "Błąd<br>";
                }

            }
        }
        ?>

        <script src="js/vendor/modernizr-3.7.1.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

        <form action="creator.php" method="GET">

            <input type="text" name="name" placeholder="Tytul Główny" value="<?=$subname?>"><br>

            <input type="text" name="obraz" placeholder="Wstaw link do obrazu" value="<?=$pic?>" required><br>
            <input type="submit" name="load" value="Załaduj podgląd"><br>

            <input type="text" name="opis" placeholder="Opis posta" value="<?=$desc?>"><br>

            <input type="submit" name="submit" value="Zatwierdź post"><br>
        </form>
    </div>

</div>
</body>
</html>