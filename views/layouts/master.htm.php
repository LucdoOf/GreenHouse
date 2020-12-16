<?php
/** @var $content */

use GreenHouse\Core\Auth;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>GreenHouse</title>
    <link rel="stylesheet" href="<?= APPLICATION_PATH ?> /public/res/stylesheets/css/main.css" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <script src="https://kit.fontawesome.com/269a112bad.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?= resource("style/css", "main.css")?>" />
</head>
<body id="master">
    <header>
        <nav>
            <div class="menu">
                <a id="main-logo"><img src="<?= resource("images", "logo.png") ?>"></a>
                <a class="active"><i class="fas fa-house-user r"></i>Maisons</a>
                <a><i class="fas fa-building r"></i>Appartements</a>
                <a><i class="fas fa-cogs r"></i>Configuration</a>
            </div>
            <div class="menu">
                <?php if(Auth::getInstance()->isAuth()): ?>
                    <a class="link" href="#"><i class="fas fa-user r"></i><?= Auth::getInstance()->user->getFullName() ?></a>
                <?php else: ?>
                    <a class="link" href="<?= route('login', ["redirect" => get_called_url()]) ?>"><i class="fas fa-user r"></i>Se connecter</a>
                <?php endif; ?>
            </div>
        </nav>
    </header>
    <div id="app">
        <?= $content; ?>
    </div>
</body>
</html>
