<?php
/** @var $loginError */
?>
<div id="login">
    <div id="head">
        <h1>Green House</h1>
        <h2>Sign up</h2>
    </div>
    <div id="content">
        <?php if($loginError):?>
            <a id="loginError"><?=$loginError?></a>
        <?php endif;?>
        <form method="post" action="<?= route("auth")?>">
            <input type="email" name="mail" placeholder="this@that.net" />
            <input type="password" name="password" placeholder="letmein" />
            <input type="submit" value="Confirm" />
        </form>
    </div>
</div>
