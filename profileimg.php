<?php

$user="$login";
$pull="select * from uzytkownicy where login='$user'";
$allowedExts = array("jpg", "jpeg", "gif", "png","JPG");
$extension = @end(explode(".", $_FILES["file"]["name"]));
if(isset($_POST['pupload'])){
    if ((($_FILES["file"]["type"] == "image/gif")
            || ($_FILES["file"]["type"] == "image/jpeg")
            || ($_FILES["file"]["type"] == "image/JPG")
            || ($_FILES["file"]["type"] == "image/png")
            || ($_FILES["file"]["type"] == "image/pjpeg"))
        && ($_FILES["file"]["size"] < 400000)
        && in_array($extension, $allowedExts))
    {
        if ($_FILES["file"]["error"] > 0)
        {
            echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
        }
        else
        {
            echo '<div class="plus">';
            echo "Załadowano pomyślnie";
            echo '</div>';echo"<br/><b><u>Szczegóły</u></b><br/>";
            echo "Name: " . $_FILES["file"]["name"] . "<br/>";
            echo "Type: " . $_FILES["file"]["type"] . "<br/>";
            echo "Size: " . ceil(($_FILES["file"]["size"] / 1024)) . " KB";
            if (file_exists("/var/www/projekty/zal/upload/" . $_FILES["file"]["name"]))
            {
                unlink("upload/" . $_FILES["file"]["name"]);
            }
            else{
                $pic=$_FILES["file"]["name"];
                $conv=explode(".",$pic);
                $ext=$conv['1'];
                move_uploaded_file($_FILES["file"]["tmp_name"],"/var/www/projekty/zal/upload/".$user.".".$ext);
                echo "Stored in as: " . "upload/".$user.".".$ext;
                $url=$user.".".$ext;
                $query="update uzytkownicy set url='$url', lastUpload=now() where login='$user'";
                if($upl=mysqli_query($polaczenie,$query)){
                    echo "<br/>Zapisano Pomyślnie";
                    header("Refresh:0");
                }
            }
        }
    }else{
        echo "File Size Limit Crossed 400 KB Use Picture Size less than 400 KB";
    }
}
?>

<form action="" method="post" enctype="multipart/form-data">
    <?php
    $result=mysqli_query($polaczenie,$pull);
    $pics=mysqli_fetch_assoc($result);
    echo '<div class="imgLow">';
    echo "Podgląd :<img src='upload/$pics[url]' alt='zdjecie profilowe podgląd' width='80 height='64' ></div>";
    ?>
    <input type="file" name="file" />
    <input class="btn btn-warning" type="submit" name="pupload" class="button" value="Zmień"/>
</form>