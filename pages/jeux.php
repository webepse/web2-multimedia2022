<?php 
   $reqcount = $bdd->query("SELECT id FROM produits WHERE type='Jeux vidéo'");
   $count = $reqcount->rowCount();
   $limit = 6;
   $nbpage = ceil($count/$limit); 
?>
<h1>Les jeux vidéos</h1>
<div class="container">
    <?php
        if(isset($_GET['page']))
        {
            $pg = htmlspecialchars($_GET['page']);
        }else{
            $pg=1;
        }

        $offset = ($pg-1)*$limit;

      
        $req = $bdd->prepare("SELECT * FROM produits WHERE type='Jeux vidéo' ORDER BY id DESC LIMIT :offset, :limit");
        $req->bindParam(':offset',$offset, PDO::PARAM_INT);
        $req->bindParam(':limit',$limit, PDO::PARAM_INT);
        $req->execute();
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
        $req->closeCursor();
        
        echo "<div id='pagination'>";
            if($pg>1)
            {
                echo " &nbsp;<a href='index.php?action=jeux&page=".($pg-1)."'> < </a>";
            }
            echo "Page ".$pg." ";
            if($pg!=$nbpage)
            {
                echo " &nbsp;<a href='index.php?action=jeux&page=".($pg+1)."'> > </a>";
            }
        echo "</div>";
    
    
    ?>




</div>