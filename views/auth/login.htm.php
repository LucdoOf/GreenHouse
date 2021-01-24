<?php
/** @var $redirect */
?>
<div id="login">
    <div id="head">
        <h2 id="signin">Connexion</h2>
    </div>
    <div id="content">
        <form method="post" action="<?= route("auth", ["redirect" => $redirect]) ?>">
            <input type="email" name="mail" placeholder="this@that.net" />
            <input type="password" name="password" placeholder="letmein" />
            <a class="link" style="margin-top: 10px; text-align: center;" href="<?= route('signup')?>">Inscription</a>
            <input class="button cta" type="submit" id="submit" value="Confirmer" />
        </form>
    </div>
</div>
