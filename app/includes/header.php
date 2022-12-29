<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?= URL_ROOT ?>/assets/css/style.css" rel="stylesheet"  >
    <title><?= SITE_NAME .' - '. $title ?></title>
    
</head>
<body>
        <div class="wrapper">
            <div class="menu">
                <div class="logo">NETVIEW</div>
                <div class="links">
                    <a href="<?= URL_ROOT ?>/Pages/browse">Naviguer</a>
                    <a href="#">Category</a>
                    <a href="<?= URL_ROOT ?>/Shows">TV / Series</a>
                    <a href="<?= URL_ROOT ?>/Movies">Films</a>
                    <?php if(User::isLoggedIn()): ?>
                        <a href="<?= URL_ROOT ?>/Pages/logout">Deeconnexion</a>
                    <?php else: ?>
                        <a href="<?= URL_ROOT ?>/Pages/login">Login</a>
                        <a href="<?= URL_ROOT ?>/Pages/register">Register</a>
                    <?php endif;?>
                </div>
            </div>