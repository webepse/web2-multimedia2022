<div class="container-product">
    <?php
        if(isset($_GET['id']))
        {
            $id = htmlspecialchars($_GET['id']);
            $product = $bdd->prepare("SELECT * FROM produits WHERE id=?");
            $product->execute([$id]);
            if(!$donProduct = $product->fetch())
            {
                echo '<div class="alert">Le produit que vous cherchez n\'existe pas (plus)</div>';
            }else{
        ?>
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
            }
           
            
        }else{
        ?>    
        
        
    <?php
    }
    ?>

</div>