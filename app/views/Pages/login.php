<?php require APP_ROOT ."/includes/header.php"  ?>
            
    <div class="form-container">
        <h3 class="">Se connecter </h3>
        <form action="<?= URL_ROOT ?>/Pages/login" method="POST">
            <div class="form-group">
                <label for="firstname">Pseudo ou email</label>
                <input type="text" id="firstname"  placeholder=" .... " name="credential"  value="<?= $credential ?>">
                <?php if(isset($credential_err)): ?>
                    <span class="err-message"> <?= $credential_err ?> </span>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="">Mot de passe</label>
                <input type="password" placeholder=" .... " name="password"  value="">
                <span class="err-message"></span>
            </div>

            
            <div class="form-group">
                <input type="submit"  value="Se connecter" name="login" >
            </div>

            <div class="form-group">
                <a href="<?= URL_ROOT ?>/Pages/register">Je n'ai pas de compte ? Créer </a>
            </div>
        </form>
    </div>
        
<?php require APP_ROOT ."/includes/footer.php"  ?>       