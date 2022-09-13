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

    if(isset($_GET['id']))
    {
        $id=htmlspecialchars($_GET['id']);
    }else{
        header("LOCATION:index.php");
    }

    require "../connexion.php";
    $req = $bdd->prepare("SELECT * FROM membre WHERE id=?");
    $req->execute([$id]);
    if(!$don=$req->fetch())
    {
        $req->closeCursor();
        header("LOCATION:index.php");
    }
    $req->closeCursor();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <title>Admin - Update membre</title>
</head>
<body>
    <?php 
        include("assets/nav.php");
    ?>
    <div class="container">
    <h1>Modifier membre: <?= $don['login'] ?></h1>
<div class="container">
    <form action="treatRegister.php" method="POST">
        <div class="form-group my-2">
            <input type="text" name="login" id="login" placeholder="Login" class="form-control" value="<?= $don['login'] ?>">
        </div>
        <div class="form-group my-2">
            <input type="password" name="password" id="password" placeholder="Modifier Mot de passe" class="form-control">
        </div>
        <div class="form-group my-2">
            <input type="email" name="email" id="email" placeholder="Votre adresse E-mail" class="form-control" value="<?= $don['mail'] ?>">
        </div>
        <div class="form-group my-2">
            <input type="submit" value="Modifier" class="btn btn-warning">
        </div>
    </form>
</div>
    <?php
        if(isset($_GET['error']))
        {
            switch($_GET['error'])
            {
                case 1:
                    echo "<div class='alert'>Error Login</div>";
                    break;
                case 2:
                    echo "<div class='alert'>Error Password</div>";
                    break;
                case 3:
                    echo "<div class='alert'>Error E-mail</div>";
                    break;
                case 4:
                    echo "<div class='alert'>Email invalide</div>";
                    break;
                case 5:
                    echo "<div class='alert'>Email existe déjà</div>";
                    break;
                case 6:
                    echo "<div class='alert'>Login existe déjà</div>";
                    break;
                default:
                    echo "<div class='alert'>Error</div>";
            }
        }
    ?>


    </div>
</body>
</html>