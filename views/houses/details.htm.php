<?php
/** @var House $house */
/** @var Cities[] $cities */
?>
<div class="row">
    <div class="box col-6">
        <div class="box-header">
            <span class="box-title"><?= $house->name; ?></span>
        </div>
        <form method="POST" action="<?= route('house.edit', [$house->id]) ?>">
            <div class="box-content">
                <div class="field">
                    <div class="label">Identifiant</div>
                    <input name="id" class="value" type="text" value="<?= $house->id; ?>"/>
                </div>
                <div class="field">
                    <div class="label">Nom</div>
                    <input name="name" class="value" type="text" value="<?= $house->name; ?>"/>
                </div>
                <div class="field">
                    <div class="label">Code postal</div>
                    <input name="zipcode" class="value" type="text" value="<?= $house->zipcode; ?>"/>
                </div>
                <div class="field">
                    <div class="label">Numéro</div>
                    <input name="number" class="value" type="text" value="<?= $house->number; ?>"/>
                </div>
                <div class="field">
                    <div class="label">Rue</div>
                    <input name="street" class="value" type="text" value="<?= $house->street; ?>"/>
                </div>
                <div class="field">
                    <div class="label">Ville</div>
                    <select name="city_id" class="value">
                        <option disabled>Sélectionner une ville</option>
                        <?php foreach ($cities as $city): ?>
                        <option <?php if($city->id == $house->city_id){echo "selected";} ?> value="<?= $city->id; ?>"><?= $city->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="field">
                    <div class="label">Degré d'isolation</div>
                    <input name="isolation_degree" class="value" type="text" value="<?= $house->isolation_degree; ?>"/>
                </div>
                <div class="field">
                    <div class="label">Classement écologique</div>
                    <input name="eco_level" class="value" type="text" value="<?= $house->eco_level; ?>"/>
                </div>
            </div>
            <div class="box-footer">
                <div class="button-group">
                    <a href="<?= route('house', [$house->id]) ?>" class="button">Annuler</a>
                    <button type="submit" class="button cta">Enregistrer</button>
                </div>
            </div>
        </form>
    </div>
</div>