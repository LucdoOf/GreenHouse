<?php
/** @var Cities[] $cities */
?>
<div class="row">
    <div class="box col-6">
        <div class="box-header">
            <span class="box-title">Ajout d'une maison</span>
        </div>
        <form method="POST" action="<?= route('house.create') ?>">
            <div class="box-content">
                <div class="field">
                    <div class="label">Nom</div>
                    <input name="name" class="value" type="text" value=""/>
                </div>
                <div class="field">
                    <div class="label">Code postal</div>
                    <input name="zipcode" class="value" type="text" value=""/>
                </div>
                <div class="field">
                    <div class="label">Numéro</div>
                    <input name="number" class="value" type="text" value=""/>
                </div>
                <div class="field">
                    <div class="label">Rue</div>
                    <input name="street" class="value" type="text" value=""/>
                </div>
                <div class="field">
                    <div class="label">Ville</div>
                    <select name="city_id" class="value">
                        <option selected disabled>Sélectionner une ville</option>
                        <?php foreach ($cities as $city): ?>
                        <option value="<?= $city->id; ?>"><?= $city->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="field">
                    <div class="label">Degré d'isolation</div>
                    <input name="isolation_degree" class="value" type="text" value=""/>
                </div>
                <div class="field">
                    <div class="label">Classement écologique</div>
                    <input name="eco_level" class="value" type="text" value=""/>
                </div>
            </div>
            <div class="box-footer">
                <div class="button-group">
                    <a href="<?= route('house') ?>" class="button">Annuler</a>
                    <button type="submit" class="button cta">Enregistrer</button>
                </div>
            </div>
        </form>
    </div>
</div>