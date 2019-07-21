
<?php
    if($login != NULL) {
        include "show_user_img.php";// img config
    }
?>

<head>
    <!-- bootstrap -->
</head>

<body>


<nav class="navbar navbar-expand-sm navbar-dark" style="background-color: darkolivegreen;">
    <div class="imaged"><img src="img/arcc.png" class="img-fluid" alt="logo strony"></div>
    <a class="navbar-brand" href="index.php">Apk Review</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">

        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="formularz.php">Propozycje gier</a>
            </li>
        </ul>
<!--        <form class="form-inline my-2 my-lg-0">-->
<!--            <input class="form-control mr-sm-2" type="search" placeholder="Szukaj" aria-label="Search">-->
<!--            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>-->
<!--        </form>-->
        <ul class="navbar-nav ml-auto">
            <?php
            if(isset($_SESSION['login']) and isset($_SESSION['isadmin'])) {
                if($_SESSION['isadmin'] == '1'){
                    echo '<li class="nav-item"><a class="nav-link" href="creator.php">Stwórz artykuł</a></li>';
                }
                echo "<img src='upload/$pics[url]' alt='zdjecie profilowe' width='50vw' height='40vh' class=\"rounded-circle\">";
                echo '<li class="nav-item"><a class="nav-link" href="profil.php">'.$login.'</a></li>';
                echo '<li class="nav-item"><a class="nav-link" href="logout.php">Wyloguj się</a></li>';
            }
            else {
                echo '<li class="nav-item"><a class="nav-link" href="rejestracja.php">Zarejestruj się</a></li>';
                echo '<li class="nav-item"><a class="nav-link" href="logowanie.php">Zaloguj się</a></li>';
            }
            ?>
        </ul>
    </div>
</nav>

</html>
