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
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <title>Admin - Member</title>
</head>
<body>
    <?php 
        include("assets/nav.php");
    ?>
    <div class="container">
        <h1>Admin Membres</h1>
        <?php 
            if(isset($_GET['update']))
            {
                echo '<div class="alert alert-warning">Vous avez bien modifié le membre <strong>n°'.$_GET['update'].'</strong></div>';
            }
        ?>
        <table class='table table-striped'>
           
        </table>
    </div>
</body>
</html>