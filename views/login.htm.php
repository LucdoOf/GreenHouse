<?php
/** @var $loginError */
/** @var $redirect */
?>
<h1 id="title">Green House</h1>
<div id="login">
    <div id="head">
        <h2 id="signin">Connexion</h2>
    </div>
    <div id="content">
        <?php if($loginError):?>
            <a id="loginError"><?=$loginError?></a>
        <?php endif;?>
        <form method="post" action="<?= route("auth", ["redirect" => $redirect]) ?>">
            <input type="email" name="mail" placeholder="this@that.net" />
            <input type="password" name="password" placeholder="letmein" />
            <a href="<?= route('signup')?>">Inscription</a>
            <input class="button cta" type="submit" id="submit" value="Confirmer" />
        </form>
    </div>
</div>
