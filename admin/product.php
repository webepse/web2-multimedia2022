<?php
    session_start();
    if(isset($_SESSION['level']))
    {
        if($_SESSION['level']!="administrateur")
        {
            header("LOCATION:../403.php");
        }
    }else{
        header("LOCATION:../403.php");
    }

    require "../connexion.php";

    if(isset($_GET['delete']))
    {
        $id = htmlspecialchars($_GET['delete']);
        $reqDel = $bdd->prepare("SELECT * FROM produits WHERE id=?");
        $reqDel->execute([$id]);
        if(!$donDel = $reqDel->fetch())
        {
            $reqDel->closeCursor();
            header("LOCATION:product.php");
        }
        $reqDel->closeCursor();

        // supp les images
        unlink("../images/".$donDel['image']);
        unlink("../images/mini_".$donDel['image']);

        $delete = $bdd->prepare("DELETE FROM produits WHERE id=?");
        $delete->execute([$id]);
        $delete->closeCursor();

        header("LOCATION:product.php?flashDelete=".$id);

    }


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <title>Admin - Product</title>
</head>
<body>
    <?php 
        include("assets/nav.php");
    ?>
    <div class="container">
        <h1>Admin Produits</h1>
        <?php
            if(isset($_GET['add']))
            {
                echo '<div class="alert alert-success">Vous avez bien ajouté un produit à la base de données</div>';
            }
            if(isset($_GET['update']))
            {
                echo '<div class="alert alert-warning">Vous avez bien modifié le produit <strong>n°'.$_GET['update'].'</strong></div>';
            }
            if(isset($_GET['flashDelete']))
            {
                echo '<div class="alert alert-danger">Vous avez bien supprimé le produit <strong>n°'.$_GET['flashDelete'].'</strong></div>';
            }
        ?>
        <a href="addProduct.php" class='btn btn-primary'>Ajouter</a>
        <table class='table table-striped'>
            <thead>
                <th>Id</th>
                <th>Marque</th>
                <th>Nom</th>
                <th>Prix</th>
                <th>Type</th>
                <th>Action</th>
            </thead>
            <tbody>
                <?php 
                    $products = $bdd->query("SELECT * FROM produits");
                    while($donProd = $products->fetch())
                    {
                        echo "<tr>";
                            echo "<td>".$donProd['id']."</td>";
                            echo "<td>".$donProd['marque']."</td>";
                            echo "<td>".$donProd['nom']."</td>";
                            echo "<td>".$donProd['prix']."€</td>";
                            echo "<td>".$donProd['type']."</td>";
                            echo "<td>";
                                echo "<a href='updateProduct.php?id=".$donProd['id']."' class='btn btn-warning mx-3'>Modifier</a>";
                                echo "<a href='product.php?delete=".$donProd['id']."' class='btn btn-danger mx-3'>Supprimer</a>";
                            echo "</td>";
                        echo "</tr>";
                    }
                    $products->closeCursor();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>