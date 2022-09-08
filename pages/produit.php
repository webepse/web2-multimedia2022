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
     
        ?>    
        

        
   

</div>