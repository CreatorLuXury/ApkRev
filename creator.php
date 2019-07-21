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
$useragent=$_SERVER['HTTP_USER_AGENT'];
if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
    header('Location: phoneforbidden.html');

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
            extract($_POST);
            $error=array();
            $extension=array("jpeg","jpg","png","gif");

            foreach($_FILES["image"]["tmp_name"] as $key=>$tmp_name) {
                $file_name=$_FILES["image"]["name"][$key];
                $ext=pathinfo($file_name,PATHINFO_EXTENSION);

                if(in_array($ext,$extension)) {

                    $filename = basename($file_name, $ext);
                    $newFileName = $filename . time() . "." . $ext;
                    move_uploaded_file($file_tmp = $_FILES["image"]["tmp_name"][$key], "img/" . $newFileName);
                    $targetFilePath["$key"] = $targetDir . $newFileName;
                    echo $key;
                }
                else {
                    array_push($error,"$file_name, ");
                }
            }

            $obraz1 = $targetFilePath[0];
            resizeImage($obraz1,1300,800);
            $obraz2 = "empty";
            $obraz3 = "empty";
            $obraz4 = "empty";
            if ($key >= 1){
                $obraz2 = $targetFilePath[1];
                resizeImage($obraz2,1300,800);
            }
            if ($key >= 2){
                $obraz3 = $targetFilePath[2];
                resizeImage($obraz3,1300,800);

            }
            if ($key == 3){
                $obraz4 = $targetFilePath[3];
                resizeImage($obraz4,1300,800);

            }

            echo $obraz1;
            echo $obraz2;
            echo $obraz3;
            echo $obraz4;

            $nazwa = $_POST['nazwa'];
            $opis = $_POST['opis'];
            $opdl = $_POST['opdl'];
            $pn = $_POST['pagename'];
            $query = "SELECT * FROM artykul";
            $result = mysqli_query($polaczenie, $query);
            $artykul = mysqli_fetch_assoc($result);

            if (isset($_POST['submit'])) {
                $tresc = "INSERT INTO artykul VALUES (0,'" . $pn . "','" . $obraz1 . "','" . $nazwa . "','" . $date . "','" . $opis . "','" . $opdl . "','" . $obraz2 . "','" . $obraz3 . "','" . $obraz4 . "')";
                $dodaj = mysqli_query($polaczenie, $tresc);
                if ($dodaj) {
                    header('Location: index.php');
                } else {
                    echo "Błąd<br>";
                    unlink($obraz1);
                    unlink($obraz2);
                    unlink($obraz3);
                    unlink($obraz4);
                }

            }
        }

        function resizeImage($filename, $max_width, $max_height)
        {
            list($orig_width, $orig_height) = getimagesize($filename);

            $width = $orig_width;
            $height = $orig_height;

            # taller
            if ($height > $max_height) {
                $width = ($max_height / $height) * $width;
                $height = $max_height;
            }

            # wider
            if ($width > $max_width) {
                $height = ($max_width / $width) * $height;
                $width = $max_width;
            }

            $image_p = imagecreatetruecolor($width, $height);

            $image = imagecreatefromjpeg($filename);

            imagecopyresampled($image_p, $image, 0, 0, 0, 0,
                $width, $height, $orig_width, $orig_height);

            return $image_p;
        }

        ?>

        <form action="creator.php" method="POST" enctype="multipart/form-data">

            <input type="text" name="pagename" placeholder="Tytuł Strony"><br>
            <input type="text" name="nazwa" placeholder="Tytuł Główny"><br>

            <input name="image[]" accept="image/jpeg" id="imgInp" type="file" multiple><br>
            <div id="preview""></div>

    <textarea type="text" name="opis" id="def" placeholder="Opis posta"></textarea><br>
    <textarea type="text" name="opdl" id="def" placeholder="Opis strony posta"></textarea><br>

            <input type="submit" name="submit" id="submit" value="Zatwierdź post"><br>
        </form>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="js/vendor/modernizr-3.7.1.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"
                integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script src="js/preview.js"></script>
        <script src="js/max_files.js"></script>

    </div>

</div>
</body>
</html>

