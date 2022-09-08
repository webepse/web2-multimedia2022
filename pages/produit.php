<div class="container-product">
   
            <h3><?= $donProduct['marque'] ?></h3>
            <h1><?= $donProduct['nom'] ?></h1>
            <div class="image">
                <a href="image/<?= $donProduct['image'] ?>">
                    <img src="image/<?= $donProduct['image'] ?>" alt="image de <?= $donProduct['nom'] ?>">
                </a>
            </div>
            <h3><?= $donProduct['prix'] ?>€</h3>
            <div class="text">
                <?= nl2br($donProduct['description']) ?>
            </div>
            <div class="commentaires">
                <h1>Les avis</h1>
            </div>
        <?php
            $coms = $bdd->prepare("SELECT commentaires.texte AS ctexte, DATE_FORMAT(commentaires.date, '%d/%m/%Y %Hh%i') AS mydate, membre.login AS mlogin, commentaires.id AS cid FROM commentaires INNER JOIN membre ON commentaires.id_membre = membre.id WHERE commentaires.id_produit=? ORDER BY commentaires.date DESC");
            $coms->execute([$id]);
            while($donComs = $coms->fetch())
            {
                echo "<div class='coms'>";
                    echo "<div class='comsInfo'>";
                        echo "<a href='#' class='author'>";
                            echo $donComs['mlogin'];
                        echo "</a>";
                        echo "<div class='date'>".$donComs['mydate']."</div>";
                    echo "</div>";
                    echo "<div class='comTxt'>".nl2br($donComs['ctexte'])."</div>";
                echo "</div>";
            }
            $coms->closeCursor();
        ?>    
</div>