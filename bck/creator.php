<?php
session_start();
include 'fetch.php';
global $login;
if (isset($_SESSION['login']) and ($_SESSION['isadmin']) == '1') {
    $login = $_SESSION['login'];
    include 'navbar.php';
} else {
    header('Location: index.php');
}
date_default_timezone_set('Europe/Warsaw');
$date = date('d/m/Y h:i:s', time());
?>
<!doctype html>
<html lang="pl" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <title>Kreator Artukułów</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/creator.css">

</head>
<body>

<div class="center">
    <div class="inside">


        <?php

        if (isset($_POST['pagename']) && isset($_POST['nazwa']) && isset($_POST['opis']) && isset($_POST['opdl'])) {

            $targetDir = "img/";
            $fileName = basename($_FILES["image"]["name"]);
            $targetFilePath = $targetDir . $fileName;
            $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
            $allowTypes = array('jpg','png','jpeg','gif','pdf');
            move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath);


            $obraz = $targetFilePath;
            $nazwa = $_POST['nazwa'];
            $opis = $_POST['opis'];
            $opdl = $_POST['opdl'];
            $pn = $_POST['pagename'];
            $query = "SELECT * FROM artykul";
            $result = mysqli_query($polaczenie, $query);
            $artykul = mysqli_fetch_assoc($result);

            if (isset($_POST['submit'])) {
                //$tresc = "INSERT INTO artykul VALUES (0,'text','text1','text2','text3','text4','text5','text6','text7','text8')";
                $tresc = "INSERT INTO artykul VALUES (0,'" . $pn . "','" . $obraz . "','" . $nazwa . "','" . $date . "','" . $opis . "','" . $opdl . "','text6','text7','text8')";
                $dodaj = mysqli_query($polaczenie, $tresc);
                if ($dodaj) {
                    header('Location: index.php');
                } else {
                    echo "Błąd<br>";
                }

            }
        }

        ?>

        <form action="creator.php" method="POST" enctype="multipart/form-data">

            <input type="text" name="pagename" placeholder="Tytuł Strony"><br>
            <input type="text" name="nazwa" placeholder="Tytuł Główny"><br>

            <input name="image" accept="image/jpeg" id="imgInp" type="file">
            <br>
            <img id="blah" src="#" alt="your image" width="80%" height="60%"/><br>

            <input type="text" name="opis" id="def" placeholder="Opis posta"><br>
            <input type="text" name="opdl" id="def" placeholder="Opis strony posta"><br>

            <input type="submit" name="submit" value="Zatwierdź post"><br>
        </form>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="js/vendor/modernizr-3.7.1.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"
                integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

        <script>
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#blah').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#imgInp").change(function () {
                readURL(this);
            });
        </script>
    </div>

</div>
</body>
</html>

