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

    if(isset($_POST['login']))
    {
        $err = 0;

        if(empty($_POST['login']))
        {
            $err=1;
        }else{
            $login=htmlspecialchars($_POST['login']);
            if($_POST['login']!=$don['login'])
            {
                $reqLog = $bdd->prepare("SELECT * FROM membre WHERE login=?");
                $reqLog->execute([$login]);
                if($donLog = $reqLog->fetch())
                {
                    $err=6;
                }
                $reqLog->closeCursor();
            }
        }

        if(empty($_POST['password']))
        {
            $hash = $don['mdp'];
        }else{
            $password=$_POST['password'];
            $hash = password_hash($password, PASSWORD_DEFAULT);
        }

        if(empty($_POST['email']))
        {
            $err=3;
        }else{
            $email=$_POST['email'];
            if(!preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#",$email))
            {
                $err=4;
            }else{
                if($email!=$don['mail'])
                {
                    $reqEmail = $bdd->prepare("SELECT * FROM membre WHERE mail=?");
                    $reqEmail->execute([$email]);
                    if($donEmail = $reqEmail->fetch())
                    {
                        $err=5;
                    }
                    $reqEmail->closeCursor();
                }
            }
        }

        if(empty($_POST['level'])){
            $err=7;
        }else{
            $level = htmlspecialchars($_POST['level']);
        }

        // verif si error
        if($err==0)
        {
            $update = $bdd->prepare("UPDATE membre SET login=:login, mdp=:mdp, mail=:mail, level=:level WHERE id=:id");
            $update->execute([
                ":login" => $login,
                ":mdp" => $hash,
                ":mail" => $email,
                ":level"=> $level,
                ":id" => $id
            ]);
            $update->closeCursor();
            header("LOCATION:member.php?update=".$id);
        }else{
            header("LOCATION:updateMember.php?id=".$id."&error=".$err);
        }


    }else{
        header("LOCATION:index.php");
    }