<?php
    session_start();
    if(isset($_SESSION['level']) AND $_SESSION['level']=="administrateur" AND isset($_GET['id']) AND !empty($_GET['id'])){
        require "connexion.php";
        $id = htmlspecialchars($_GET['id']);
        $req = $bdd->prepare("SELECT * FROM commentaires WHERE id=?");
        $req->execute([$id]);
        if(!$don = $req->fetch())
        {
            $req->closeCursor();
            header("LOCATION:404.php");
        }
        $req->closeCursor();

        $pId = $don["id_produit"];

        // req de suppression
        $delete = $bdd->prepare("DELETE FROM commentaires WHERE id=?");
        $delete->execute([$id]);
        $delete->closeCursor();
        header("LOCATION:index.php?action=produit&id=".$pId);

    }else{
        header("LOCATION:index.php");
    }