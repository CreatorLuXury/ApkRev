<?php
session_start();
$id = $_GET['id'];
include 'fetch.php';
global $login;
if (isset($_SESSION['login'])) {
    $login = $_SESSION['login'];
}
date_default_timezone_set('Europe/Warsaw');
$date = date('d/m/Y h:i:s a', time());
include 'navbar.php';
$query = "SELECT * FROM artykul WHERE id=$id";
$result = mysqli_query($polaczenie, $query);
$fetch = mysqli_fetch_assoc($result);

?>
<html lang="pl">
<head>
    <title><?=$fetch['nstrony']?></title>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#fafafa">
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="manifest" href="site.webmanifest">
    <link rel="apple-touch-icon" href="favicon.ico">
<!--    <link rel="icon" href="favicon.ico">-->
    <link rel="stylesheet" href="css/artykul.css">

    <link href="https://fonts.googleapis.com/css?family=Wendy+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/lightbox.css">

</head>
<body>

    <h1> <?=$fetch['nazwa']?></h1>
    <div class="main">
    <div id="cardcarousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#cardcarousel" data-slide-to="0" class="active"></li>
            <li data-target="#cardcarousel" data-slide-to="1"></li>
            <li data-target="#cardcarousel" data-slide-to="2"></li>
            <li data-target="#cardcarousel" data-slide-to="3"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <a href="<?=$fetch['obraz']?>" data-lightbox="roadtrip"><img class="d-block w-100" src="<?=$fetch['obraz']?>" alt="miniatura"></a>
            </div>
            <div class="carousel-item">
                <a href="<?=$fetch['obraz2']?>" data-lightbox="roadtrip"><img class="d-block w-100" src="<?=$fetch['obraz2']?>" alt="miniatura"></a>
            </div>
            <div class="carousel-item">
                <a href="<?=$fetch['obraz3']?>" data-lightbox="roadtrip"><img class="d-block w-100" src="<?=$fetch['obraz3']?>" alt="miniatura"></a>
            </div>
            <div class="carousel-item">
                <a href="<?=$fetch['obraz4']?>" data-lightbox="roadtrip"><img class="d-block w-100" src="<?=$fetch['obraz4']?>" alt="miniatura"></a>
            </div>
        </div>
        <a class="carousel-control-prev" href="#cardcarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#cardcarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    </div>

    <section>
        <article>
            <?=$fetch['opis_dlugi']?>
        </article>
    </section>


    <div class="one">
        <div class="secbox">
            <div class="kont">
            <h3 class="heading">Komentarze do <?=$fetch['nazwa']?>:</h3>
            <form action="savecom.php" method="get">
                <textarea type="text" name="tekst" required placeholder="Komentarz Max 200 znaków"></textarea>
                <br>
                <?php
                if($login != NULL){
                    echo '<input type="hidden" name="id" value="'.$id.'">';
                    echo '<input type="submit" name="send" value="Wyślij">';
                }
                else {
                    echo'<input type="submit" name="nsend" value="Wyślij" disabled>';
                    echo '<br><p>Zaloguj się aby komentować</p>';
                }
                ?>
                <br>
            </form>
            </div>
        </div>


    <div class = "secbox" >
        <?php

    $zapytanie="SELECT * FROM komentarze where id_artykulu = $id";

    $wynik= mysqli_query($polaczenie,$zapytanie);

    while($wiersz=mysqli_fetch_assoc($wynik))
    {
        $login = $wiersz['uzytkownik'];
        include 'show_user_img.php';
        echo '<div class="comments">';
        echo "<img src='upload/$pics[url]' alt='zdjecie proftilowe' width='80vw' height='70vh' class=\"rounded-circle\">";
    	echo $wiersz ['uzytkownik']." ".$wiersz['data']."<br>";
    	echo '<div class="box">';
    	echo $wiersz ['tresc'];
    	echo '<br></div></div>';
    }

     mysqli_close($polaczenie);

    ?>
    </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
        <script src="js/lightbox.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>


</body>
</html>
