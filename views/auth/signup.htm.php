<div id="login">
    <div id="head">
        <h2 id="signin">Inscription</h2>
    </div>
    <div id="content">
        <form method="post" action="<?= route("signup") ?>">
            <input type="email" name="email" placeholder="this@that.net" />
            <input type="password" name="password" placeholder="Mot de passe" />
            <input type="password" name="password2" placeholder="Confirmez le mot de passe"/>
            <input type="text" name="firstname" placeholder="Jean" />
            <input type="text" name="lastname" placeholder="Dujardin" />
            <select name="gender">
                <option disabled>Sélectionner un genre</option>
                <option>Homme</option>
                <option>Femme</option>
                <option>Autre</option>
            </select>
            <div class="button-group center">
                <a href="<?= route('login') ?>" class="button" style="margin-top: 15px">Annuler</a>
                <input class="button cta" type="submit" id="submit" value="Confirmer" />
            </div>
        </form>
    </div>
</div>
