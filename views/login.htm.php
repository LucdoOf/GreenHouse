<?php
/** @var $loginError */
/** @var $redirect */
?>
<div id="flexLogin">
    <div id="titleImg"></div>
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
                <a style="margin-top: 5px" href="<?= route('signup')?>">Inscription</a>
                <input class="button cta" type="submit" id="submit" value="Confirmer" />
            </form>
        </div>
    </div>
</div>
