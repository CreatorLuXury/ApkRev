
<?php
session_start();
include 'fetch.php';
global $login;
if (isset($_SESSION['login'])) {
    $login = $_SESSION['login'];
}
date_default_timezone_set('Europe/Warsaw');
$date = date('d/m/Y h:i:s a', time());
?>
<!doctype html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <title>ApkRev</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#fafafa">
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="manifest" href="site.webmanifest">
    <link rel="apple-touch-icon" href="icon.png">
    <link rel="icon" href="favicon.ico">
    <link rel="stylesheet" href="css/base.css">


</head>

<body>
    <!--[if IE]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a
            href="https://browsehappy.com/">upgrade
        your browser</a> to improve your experience and security.</p>
    <![endif]-->

    <!-- Add your site or application content here -->

    <script src="js/vendor/modernizr-3.7.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery-3.3.1.min.js"><\/script>')</script>
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>

    <?php include("navbar.php"); ?>

    <?php
    $q = "SELECT MAX(ID) FROM artykul";
    $result2 = mysqli_query($polaczenie, $q);
    $data = mysqli_fetch_array($result2);
    $counter = $data[0];
    include 'sider.php';
    while ($counter) {
        $query = "SELECT * FROM artykul WHERE id=$counter";
        $result = mysqli_query($polaczenie, $query);
        $fetch = mysqli_fetch_assoc($result);
        if ($fetch['nazwa'] != NULL) {
            include 'cards.php';
        }
        $counter -= 1;
    }


    ?>

    <!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
    <script>
        window.ga = function () {
            ga.q.push(arguments)
        };
        ga.q = [];
        ga.l = +new Date;
        ga('create', 'UA-XXXXX-Y', 'auto');
        ga('set', 'transport', 'beacon');
        ga('send', 'pageview')
    </script>
    <script src="https://www.google-analytics.com/analytics.js" async defer></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>

</div>
</body>

</html>
