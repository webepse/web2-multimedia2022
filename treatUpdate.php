<?php
    session_start();
    if(isset($_SESSION['id']) AND isset($_GET['id']) AND !empty($_GET['id']))
    {
        $id = htmlspecialchars($_GET['id']);
        require "connexion.php";
        $req=$bdd->prepare("SELECT * FROM commentaires WHERE id=?");
        $req->execute([$id]);
        if(!$don = $req->fetch())
        {
            $req->closeCursor();
            header("LOCATION:index.php");
        }else{
            $req->closeCursor();
            if($_SESSION['id']==$don['id_membre']){
                // === 
                // 1 == "1" v
                // 1 === "1" X
                if(isset($_POST['com']))
                {
                    if(!empty($_POST['com']))
                    {
                        $texte = htmlspecialchars($_POST['com']);
                        $update = $bdd->prepare("UPDATE commentaires SET texte=:txt WHERE id=:id");
                        $update->execute([
                            ":txt" => $texte,
                            ":id"=>$id
                        ]);
                        $update->closeCursor();
                        header("LOCATION:index.php?action=produit&id=".$don['id_produit']);
                    }else{
                        header("LOCATION:index.php?action=update&id=".$id);
                    }
                }else{
                    header("LOCATION:index.php");
                }

            }else{
                header("LOCATION:403.php");
            }
        }

    }else{
        header("LOCATION:index.php");
    }
