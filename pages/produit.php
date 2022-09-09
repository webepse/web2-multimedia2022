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
                <?php 
                    if(isset($_SESSION['login']))
                    {
                ?>
                    <div class="form-com">
                        <form action="treatCom.php?id=<?= $id ?>" method="POST">
                            <div class="form-log"><?= $_SESSION['login'] ?></div>
                            <div class="form-group">
                                <textarea name="com" id="com" cols="30" rows="10"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Envoyer">
                            </div>
                        </form>
                    </div>
                <?php
                    }

                ?>
            </div>
        <?php
            $coms = $bdd->prepare("SELECT commentaires.texte AS ctexte, DATE_FORMAT(commentaires.date, '%d/%m/%Y %Hh%i') AS mydate, membre.login AS mlogin, commentaires.id AS cid, commentaires.id_membre AS mid FROM commentaires INNER JOIN membre ON commentaires.id_membre = membre.id WHERE commentaires.id_produit=? ORDER BY commentaires.date DESC");
            $coms->execute([$id]);
            while($donComs = $coms->fetch())
            {
                echo "<div class='coms'>";
                    echo "<div class='comsInfo'>";
                        echo "<a href='#' class='author'>";
                            echo $donComs['mlogin'];
                        echo "</a>";
                        echo "<div class='date'>".$donComs['mydate']."</div>";
                        if(isset($_SESSION['level']))
                        {
                            if($_SESSION['level']=="administrateur")
                            {
                                echo "<a href='treatDelete.php?id=".$donComs['cid']."'>Supprimer</a>";
                            }

                            if($_SESSION['id']==$donComs['mid'])
                            {
                                echo "<a href='index.php?action=update&id=".$donComs['cid']."'>Modifier</a>";
                            }
                        }
                    echo "</div>";
                    echo "<div class='comTxt'>".nl2br($donComs['ctexte'])."</div>";
                echo "</div>";
            }
            $coms->closeCursor();
        ?>    
</div>