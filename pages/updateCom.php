<h1>Modification d'un commentaire</h1>
<form action="treatUpdate.php?id=<?= $donCom['id'] ?>" method="POST">
    <div class="form-group">
        <textarea name="com" id="com" cols="30" rows="10"><?= $donCom['texte'] ?></textarea>
    </div>
    <div class="form-group">
        <input type="submit" value="Modifier">
    </div>
</form>