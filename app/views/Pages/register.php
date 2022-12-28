<?php require APP_ROOT ."/includes/header.php"  ?>
            
    <div class="form-container">
        <h3 class="">Créer un compte  </h3>
        <form action="<?= URL_ROOT ?>/Pages/register" method="POST">
            <div class="form-group">
                <label for="firstname">Prénom</label>
                <input type="text" id="firstname"  placeholder=" .... " name="firstname"  value="<?= $firstname ?>">
                <?php if(isset($firstname_err)): ?>
                    <span class="err-message"> <?= $firstname_err ?> </span>
                <?php endif; ?>
                
            </div>

            <div class="form-group">
                <label for="">Nom</label>
                <input type="text" placeholder=" .... " name="lastname"  value="<?= $lastname ?>">
                <?php if(isset($lastname_err)): ?>
                    <span class="err-message"> <?= $lastname_err ?> </span>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="">Pseudo</label>
                <input type="text" placeholder=" .... " name="username"  value="<?= $username ?>">
                <?php if(isset($username_err)): ?>
                    <span class="err-message"> <?= $username_err ?> </span>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="">Email</label>
                <input type="text" placeholder=" .... " name="email"  value="<?= $email ?>">
                <?php if(isset($email_err)): ?>
                    <span class="err-message"> <?= $email_err ?> </span>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="">Mot de passe</label>
                <input type="password" placeholder=" .... " name="password"  value="">
                <?php if(isset($password_err)): ?>
                    <span class="err-message"> <?= $password_err ?> </span>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="">Confirmer le mot de passe</label>
                <input type="password" placeholder=" .... " name="password_conf"  value="">
            </div>

            <div class="form-group">
                <input type="submit"  value="Créer" name="submit">
            </div>

            <div class="form-group">
                <a href="<?= URL_ROOT ?>/Pages/login">J'ai déjà un compte !  Se connecter  </a>
            </div>
        </form>
    </div>
        
    <?php require APP_ROOT ."/includes/footer.php"  ?>       