<?php
    session_start();
    if(!isset($_SESSION['level']) OR $_SESSION['level']!="administrateur")
    {
        header("LOCATION:../403.php");
    }

    if(isset($_POST['nom']))
    {
        $err=0;
        if(empty($_POST['nom']))
        {
            $err=1;
        }else{
            $nom=htmlspecialchars($_POST['nom']);
        }

        if(empty($_POST['marque']))
        {
            $err=2;
        }else{
            $marque = htmlspecialchars($_POST['marque']);
        }

        if(empty($_POST['prix']))
        {
            $err=3;
        }else{
            if(is_numeric($_POST['prix']))
            {
                $prix=$_POST['prix'];
            }else{
                $err=4;
            }
        }

        if(empty($_POST['type']))
        {
            $err=5;
        }else{
            $type=htmlspecialchars($_POST['type']);
        }

        if(empty($_POST['description']))
        {
            $err=6;
        }else{
            $description=htmlspecialchars($_POST['description']);
        }

        if($err==0)
        {
            $dossier = "../images/"; // ../images/monfichier.jpg
            $fichier = basename($_FILES['image']['name']);
            $taille_maxi = 2000000;
            $taille = filesize($_FILES['image']['tmp_name']);
            $extensions = ['.png','.jpg','.jpeg'];
            $extension = strrchr($_FILES['image']['name'],'.');

            if(!in_array($extension, $extensions))
            {
                $erreur = 1;
            }
            
            if($taille>$taille_maxi){
                $erreur = 2;
            }

            if(!isset($erreur))
            {
                // traitement
                $fichier = strtr($fichier, 
					  'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
					  'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
                $fichier = preg_replace('/([^.a-z0-9]+)/i','-',$fichier); 
                $fichiercptl = rand().$fichier; 
                
                if(move_uploaded_file($_FILES['image']['tmp_name'], $dossier.$fichiercptl))
                {
                    // insertion dans la bdd
                }else{
                    // error
                }

            }else{
                header("LOCATION:addProduct.php?errimg=".$erreur);
            }

        }else{
            header("LOCATION:addProduct.php?error=".$err);
        }


    }else{
        header("LOCATION:../403.php");
    }