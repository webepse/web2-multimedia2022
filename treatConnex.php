<?php
    session_start();
    // savoir si form envoyé ou non
    if(isset($_POST['login']))
    {
        // verifier le formulaire
        if(empty($_POST['login']) OR empty($_POST['password']))
        {
            header("LOCATION:index.php?action=connexion&err=1");
        }else{
            require "connexion.php";
            $user = htmlspecialchars($_POST['login']);
            $password = $_POST['password'];
            $req = $bdd->prepare("SELECT * FROM membre WHERE login=?");
            $req->execute([$user]);
            // verifier si login n'existe pas
            if(!$don = $req->fetch())
            {
                header("LOCATION:index.php?action=connexion&err=2");
            }else{
                // vérifier le mot passe
                if(password_verify($password,$don['mdp']))
                {
                    $_SESSION['id'] = $don['id'];
                    $_SESSION['login'] = $don['login'];
                    $_SESSION['level'] = $don['level'];
                    header("LOCATION:index.php");
                }else{
                    header("LOCATION:index.php?action=connexion&err=3");
                }
    
            }
        }

    }else{
        header("LOCATION:404.php");
    }

