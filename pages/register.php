<h1>Inscription</h1>
<div class="container">
    <form action="treatRegister.php" method="POST">
        <div class="form-group">
            <input type="text" name="login" id="login" placeholder="Login">
        </div>
        <div class="form-group">
            <input type="password" name="password" id="password" placeholder="Mot de passe">
        </div>
        <div class="form-group">
            <input type="email" name="email" id="email" placeholder="Votre adresse E-mail">
        </div>
        <div class="form-group">
            <input type="submit" value="Enregistrer">
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

