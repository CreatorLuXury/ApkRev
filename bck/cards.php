<html>
<div class="centering">
    <div class="card flex-row flex-wrap">
        <div class="card-header border-0.hidden-sm-down">
        <img src="<?= $fetch['obraz'] ?>" class="img-fluid" width="300px" height="300px">
        </div>
        <div class="card-body">
            <h5 class="card-title"><?= $fetch['nazwa'] ?></h5>


            <h6 class="card-subtitle mb-2 text-muted">Opublikowano: <?= $fetch['czas'] ?></h6>

            <p class="card-text"><?= $fetch['opis'] ?></p>

            <?php
            echo '<a href="artykul.php?id='.$fetch['id'].'" class="card-link">Więcej</a>';
            if(isset($_SESSION['login']) and isset($_SESSION['isadmin'])) {
            if($_SESSION['isadmin'] == '1'){

                echo'<a href="editor.php?id='.$fetch['id'].'" class="card-link">Edytuj</a>';
                echo'<a href="removetab.php?id='.$fetch['id'].'" class="card-link">Usuń</a>';
                }
            }
            ?>
        </div>
    </div>

</div>
</html>