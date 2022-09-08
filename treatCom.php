<?php
    session_start();
    if(!isset($_SESSION['id']))
    {
        header("LOCATION:404.php");
    }

    if(isset($_GET['id']) AND !empty($_GET['id']) AND isset($_POST['com']))
    {
        $id= htmlspecialchars($_GET['id']);
        $err=0;

        //todo - vérifier si l'id du produit existe

        if(empty($_POST['com']))
        {
            $err=1;
        }else{
            $com = htmlspecialchars($_POST['com']);
        }

        if($err==0)
        {
            require "connexion.php";
            // insertion
            $insert = $bdd->prepare("INSERT INTO commentaires(id_membre,id_produit,texte,date) VALUES(:membre,:produit,:txt, NOW())");
            $insert->execute([
                ":membre"=>$_SESSION['id'],
                ":produit"=>$id,
                ":txt"=>$com
            ]);
            $insert->closeCursor();
            header("LOCATION:index.php?action=produit&id=".$id);
        }else{
            header("LOCATION:index.php?action=produit&id=".$id."&err=".$err);
        }


    }else{
        header("LOCATION:404.php");
    }