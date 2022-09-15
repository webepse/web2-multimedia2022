<h1>Recherche</h1>
<div class="container">
    <div class='info-search'>
        <p>Résultat pour la rechercher: <strong><?= $search ?></strong></p>
    </div>
    <?php
    $req = $bdd->prepare("SELECT * FROM produits WHERE nom LIKE :search OR marque LIKE :search ORDER BY id DESC");
        $req->execute([
            ":search"=>"%".$search."%"
        ]);
        $nb = $req->rowCount();
        if($nb>0){
            while($don = $req->fetch())
            {
    ?>
        <div class="card">
            <div class="card-img">
                <img src="images/<?= $don['image'] ?>" alt="image de <?= $don['nom'] ?>">
            </div>
            <div class="card-body">
                <div class="model"><a href="index.php?action=produit&id=<?= $don['id']?>"><?= $don['nom'] ?></a></div>
                <div class="mark"><?= $don['marque'] ?></div>
                <div class="price"><?= $don['prix'] ?></div>
            </div>
        </div>
            <?php
            }
        }else{
            echo "<p>Aucun résultat</p>";
        }        
        $req->closeCursor();
    ?>

</div>