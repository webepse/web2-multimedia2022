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
            if(isset($_GET['flashDelete']))
            {
                echo '<div class="alert alert-danger">Vous avez bien supprimé le membre <strong>n°'.$_GET['flashDelete'].'</strong></div>';
            }
        ?>
        <table class='table table-striped'>
           <thead>
                <th>id</th>
                <th>Login</th>
                <th>E-mail</th>
                <th>Level</th>
                <th>Action</th>
           </thead>
           <tbody>
                <?php
                    $members = $bdd->query("SELECT * FROM membre");
                    while($donMember = $members->fetch())
                    {
                        echo "<tr>";
                            echo "<td>".$donMember['id']."</td>";
                            echo "<td>".$donMember['login']."</td>";
                            echo "<td>".$donMember['mail']."</td>";
                            echo "<td>".$donMember['level']."</td>";
                            echo "<td>";
                                echo "<a href='updateMember.php?id=".$donMember['id']."' class='btn btn-warning mx-3'>Modifier</a>";
                                if($_SESSION['id']!=$donMember['id'])
                                {
                                    echo "<a href='' class='btn btn-danger mx-3'>Supprimer</a>";
                                }
                            echo "</td>";
                        echo "</tr>";
                    }
                    $members->closeCursor();
                ?>
           </tbody>
        </table>
    </div>
</body>
</html>