<h1>Les jeux vidéos</h1>
<div class="container">
    <?php
        $req = $bdd->query("SELECT * FROM produits WHERE type='Jeux vidéo' ORDER BY id DESC ");
        while($don = $req->fetch())
        {
    ?>
        <div class="card">
            <div class="card-img">
                <img src="image/<?= $don['image'] ?>" alt="image de <?= $don['nom'] ?>">
            </div>
            <div class="card-body">
                <div class="model"><a href="index.php?action=produit&id=<?= $don['id']?>"><?= $don['nom'] ?></a></div>
                <div class="mark"><?= $don['marque'] ?></div>
                <div class="price"><?= $don['prix'] ?></div>
            </div>
        </div>
    <?php
        }
        $req->closeCursor();
    ?>


</div>