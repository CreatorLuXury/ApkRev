<?php

include 'fetch.php';
session_start();
if (isset($_SESSION['login'])) {
    $login = $_SESSION['login'];
}
else header('Location: index.php');
include 'navbar.php';
include 'show_user_img.php';
?>

<!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profil <?= $login ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/creator.css">


</head>
<body>
<div class="center">
    <div class ="inside">
    <div class="card">
        <div class="card-header border-0">
            <?php
            echo "<img src='upload/$pics[url]' alt='zdjecie profilowe' width='140vw' height='130vh' class=\"rounded-circle\">";
            ?></div>
            <div class="card-body">
                <h5 class="card-title"><?= $login ?></h5>
            <div id="upload"  style="display:none;">
                <?=include 'profileimg.php'?>
                <input  class="btn btn-outline-secondary" type="button" name="hide" value="Ukryj panel" onclick="hideDiv()" />

            </div>
            <div id="hider" style="display:block;"><input  class="btn btn-outline-secondary"  type="button" name="zdjecie" value="Zmień zdjęcie profilowe" onclick="showDiv()" />
            </div>
            </div>
        </div>
    </div>
</div>

    <script>function showDiv() {
            document.getElementById('upload').style.display = "block";
            document.getElementById('hider').style.display = "none";
        }</script>
    <script>function hideDiv() {
        document.getElementById('upload').style.display = "none";
        document.getElementById('hider').style.display = "block";
    }</script>

</body>
</html>
