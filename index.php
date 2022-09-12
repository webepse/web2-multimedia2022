<?php
    session_start();
    require "connexion.php";
    $tabMenu = [
        "home" => "home.php",
        "smartphone" => "smartphone.php",
        "jeux" => "jeux.php",
        "produit"=>"produit.php",
        "connexion"=>"connect.php",
        "update"=>"updateCom.php",
        "register"=>"register.php"
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
            }elseif($_GET['action']=="connexion")
            {
                if(isset($_SESSION['login']))
                {
                    $menu = $tabMenu['home']; 
                }else{
                    $menu = $tabMenu[$_GET['action']];
                }
            }elseif($_GET['action']=="update")
            {
                if(isset($_GET['id']) AND !empty($_GET['id']))
                {
                    $comId= htmlspecialchars($_GET['id']);
                    $reqCom = $bdd->prepare("SELECT * FROM commentaires WHERE id=?");
                    $reqCom->execute([$comId]);
                    if(!$donCom = $reqCom->fetch())
                    {
                        $reqCom->closeCursor();
                        header("LOCATION:index.php");
                    }else{
                        $reqCom->closeCursor();
                        if($_SESSION['id']==$donCom['id_membre'])
                        {
                            $menu = $tabMenu['update'];
                        }else{
                            header("LOCATION:403.php");
                        }
                    }
                }else{
                    header("LOCATION:404.php");
                }
            }
            elseif($_GET['action']=="register")
            {
                if(isset($_SESSION['login']))
                {
                    header("LOCATION:index.php");
                }else{
                    $menu = $tabMenu['register'];
                }
            }
            else{
                $menu = $tabMenu[$_GET['action']];
            }


        }else{
            header("LOCATION:404.php");
        }
    }else{
        $menu = $tabMenu['home']; 
    }

    //déconnexion
    if(isset($_GET['deco'])){
        session_destroy();
        header("LOCATION:index.php");
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
            <?php
                if(!isset($_SESSION['login'])){
                    echo '<a href="index.php?action=register">Inscription</a>';
                    echo '<a href="index.php?action=connexion">Connexion</a>';
                }else{
                    echo "Bonjour, ".$_SESSION['login'].'<br>';
                    if($_SESSION['level']=="administrateur")
                    {
                        echo "<a href='admin/'>Administration</a><br>";
                    }

                    echo "<a href='index.php?deco=ok'>Déconnexion</a>";
                }
            ?>
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