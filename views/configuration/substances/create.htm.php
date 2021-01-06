<form method="POST" action="<?= route("configuration.substances.create.post") ?>">
    <div class="field">
        <div class="label">Nom</div>
        <div class="value"><input type="text" class="input" name="name" placeholder="Plutonium"/></div>
    </div>
    <div class="field">
        <div class="label">Description</div>
        <div class="value"><textarea name="description" class="textarea" placeholder="Très dangereux, ne pas ingérer"></textarea></div>
    </div>
    <div class="field">
        <div class="label">Valeur minimale d'utilisation recommandée</div>
        <div class="value"><input type="number" name="min_value" class="input" placeholder="0.00"></div>
    </div>
    <div class="field">
        <div class="label">Valeur maximale d'utilisation recommandée</div>
        <div class="value"><input type="number" name="max_value" class="input" placeholder="0.00"></div>
    </div>
    <div class="field">
        <div class="label">Valeur idéale d'utilisation</div>
        <div class="value"><input type="number" name="ideal_value" class="input" placeholder="0.00"></div>
    </div>
    <div class="field">
        <div class="label">Valeur critique d'utilisation</div>
        <div class="value"><input type="number" name="critical_value" class="input" placeholder="0.00"></div>
    </div>
    <input type="submit" value="Ajouter" class="button cta"/>
</form>
