<?php

if (isset($_GET['id'])) {
    session_start();
    include 'fetch.php';
    $id = $_GET['id'];
    $queryh = "SELECT * FROM artykul WHERE id = $id";
    $resulth = mysqli_query($polaczenie, $queryh);
    $art = mysqli_fetch_assoc($resulth);

    unlink($art['obraz']);
    unlink($art['obraz2']);
    unlink($art['obraz3']);
    unlink($art['obraz4']);

    $query = "DELETE FROM artykul WHERE id = $id";
    $result = mysqli_query($polaczenie, $query);
    mysqli_fetch_assoc($result);
    header("Location: index.php");
}
else{
    header("Location: index.php");
}
?>