<h1>Connexion</h1>
<div class="container">
    <form action="treatConnex.php" method="POST">
        <div class="form-group">
            <input type="text" name="login" id="login" placeholder="Login">
        </div>
        <div class="form-group">
            <input type="password" name="password" id="password" placeholder="Mot de passe">
        </div>
        <div class="form-group">
            <input type="submit" value="Connexion">
        </div>
    </form>
    <?php
        if(isset($_GET['err']))
        {
            if($_GET['err']=="1")
            {
                echo "<div class='alert'>Veuillez remplir correctement le formulaire</div>";
            }elseif($_GET['err']=="2")
            {
                echo "<div class='alert'>Login incorrect</div>";
            }elseif($_GET['err']=="3"){
                echo "<div class='alert'>Mot de passe incorrect</div>";   
            }else{
                echo "<div class='alert'>error</div>";
            }
        }
    ?>
</div>