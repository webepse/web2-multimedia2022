<?php 
    session_start();
    if(isset($_SESSION['login']))
    {
        header("LOCATION:index.php");
    }

    if(isset($_POST['login']))
    {
        require "connexion.php";
        $err = 0;

        if(empty($_POST['login']))
        {
            $err=1;
        }else{
            $login=htmlspecialchars($_POST['login']);
            $reqLog = $bdd->prepare("SELECT * FROM membre WHERE login=?");
            $reqLog->execute([$login]);
            if($donLog = $reqLog->fetch())
            {
                $err=6;
            }
            $reqLog->closeCursor();
        }

        if(empty($_POST['password']))
        {
            $err=2;
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
                $reqEmail = $bdd->prepare("SELECT * FROM membre WHERE mail=?");
                $reqEmail->execute([$email]);
                if($donEmail = $reqEmail->fetch())
                {
                    $err=5;
                }
                $reqEmail->closeCursor();
            }
        }




        // verif si error
        if($err==0)
        {

        }else{
            header("LOCATION:index.php?action=register&error=".$err);
        }


    }else{
        header("LOCATION:index.php");
    }