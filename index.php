<?php
    require "connexion.php";
    $tabMenu = [
        "home" => "home.php",
        "smartphone" => "smartphone.php",
        "jeux" => "jeux.php",
        "produit"=>"produit.php"
    ];

    if(isset($_GET['action']))
    {
        if(array_key_exists($_GET['action'],$tabMenu))
        {
            if($_GET['action']=="produit")
            {
                if(isset($_GET['id']) AND !empty($_GET['id']))
                {
                    $id = htmlspecialchars($_GET['id']);
                    $produit = $bdd->prepare("SELECT * FROM produits WHERE id=?");
                    $produit->execute([$id]);
                    if(!$donProduct = $produit->fetch())
                    {
                        $produit->closeCursor();
                        header("LOCATION:404.php");
                    }else{
                        $menu= $tabMenu['produit'];
                        $produit->closeCursor();
                    }
                }else{
                    header("LOCATION:404.php");
                }
            }else{
                $menu = $tabMenu[$_GET['action']];
            }


        }else{
            header("LOCATION:404.php");
        }
    }else{
        $menu = $tabMenu['home']; 
    }

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <header>
        <div id="logo">Multimédia</div>
        <form action="#">
            <input type="text" name="search" id="search" placeholder="Votre recherche">
            <input type="submit" value="Rechercher">
        </form>
        <div id="connexion">
            <a href="#">Inscription</a>
            <a href="#">Connexion</a>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="index.php?action=jeux">Jeux Vidéo</a></li>
                <li><a href="index.php?action=smartphone">Smartphone</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <?php
            include("pages/".$menu);
        ?>
    </main>
    <footer>
        <p>&copy; Copyright EPSE 2022</p>
    </footer>
</body>
</html>