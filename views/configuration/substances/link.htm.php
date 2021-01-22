<?php
/** @var $deviceType DeviceType */

use GreenHouse\Models\DeviceType;
use GreenHouse\Models\HarmfullSubstance;

?>

<form method="POST" action="<?= route("configuration.device-types.substances.link.post", [$deviceType->id]) ?>">
    <div class="field">
        <div class="label">Taux de production (par heure)</div>
        <div class="value"><input type="number" class="input" name="production_rate" placeholder="20.00"/></div>
    </div>
    <div class="field">
        <div class="label">Substance</div>
        <div class="value">
            <select class="select" name="substance_id">
                <?php foreach (HarmfullSubstance::getAll() as $substance): ?>
                    <option value="<?= $substance->id ?>"><?= $substance->name ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <input type="submit" value="Ajouter" class="button cta"/>
</form>
