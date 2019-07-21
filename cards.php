<html>
<div class="centering">
    <div class="card flex-row flex-wrap">
        <div class="card-header border-0.hidden-sm-down">
            <div id="cardcarousel" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#cardcarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#cardcarousel" data-slide-to="1"></li>
                    <li data-target="#cardcarousel" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100 h-100" src="<?= $fetch['obraz'] ?>" alt="First slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100 h-100" src="<?= $fetch['obraz2'] ?>" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100 h-100" src="<?= $fetch['obraz3'] ?>" alt="Third slide">
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