<h1>Les derniers produits</h1>
<div class="container">
    <?php
        $req = $bdd->query("SELECT * FROM produits ORDER BY id DESC LIMIT 0,6");
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