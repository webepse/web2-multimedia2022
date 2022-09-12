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

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <title>Admin - AddProduct</title>
</head>
<body>
    <?php 
        include("assets/nav.php");
    ?>
    <div class="container">
        <h2>Ajouter un produit</h2>
       <form action="treatmentAddProduct.php" method="POST" enctype="multipart/form-data">
           <div class="form-group my-3">
               <label for="marque">Marque:</label>
               <input type="text" name="marque" id="marque" class="form-control">
           </div>
            <div class="form-group my-3">
                <label for="nom">Nom:</label>
                <input type="text" id="nom" name="nom" class='form-control'>
            </div>
            <div class="form-group my-3">
                <label for="prix">Prix:</label>
                <input type="number" name="prix" id="prix" step="0.01" class="form-control">
            </div>
            <div class="form-group my-3">
                <label for="description">Description:</label>
                <textarea name="description" id="description" class='form-control' rows="10"></textarea>
            </div>
            <div class="form-group my-3">
                <label for="type">Type:</label>
                <select name="type" id="type" class='form-control'>
                    <option value="Smartphone">Smartphone</option>
                    <option value="Jeux vidéo">Jeux Vidéo</option>
                </select>
            </div>
            <div class="form-group my-3">
                <label for="image">Image</label>
                <input type="file" name="image" id="image" class='form-control'>
            </div>
            <div class="form-group">
                <input type="submit" value="Ajouter" class='btn btn-success my-5'>
            </div>

       </form>
       <?php
            if(isset($_GET['error']))
            {
                echo "<div class='alert alert-danger'>Une erreur est survenue (code: ".$_GET['error']." )</div>";
            }

            if(isset($_GET['errimg']))
            {
                switch($_GET['errimg'])
                {
                    case 1: 
                        echo "<div class='alert alert-danger'>Le format du fichier n'est pas accepté</div>";
                        break;
                    case 2:
                        echo "<div class='alert alert-danger'>La taille du fichier dépasse 2M</div>"; 
                        break;
                    default:
                        echo "<div class='alert alert-danger'>Une erreur est survenue</div>";      
                }
            }
       ?>
    </div>
</body>
</html>