<?php
$query="select * from uzytkownicy where login='$login'";
$result=mysqli_query($polaczenie,$query);
$pics=mysqli_fetch_assoc($result);
?>
