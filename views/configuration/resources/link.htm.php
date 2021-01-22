<?php
/** @var $deviceType DeviceType */

use GreenHouse\Models\DeviceType;
use GreenHouse\Models\Resource;
?>

<form method="POST" action="<?= route("configuration.device-types.resources.link.post", [$deviceType->id]) ?>">
    <div class="field">
        <div class="label">Taux de consommation (par heure)</div>
        <div class="value"><input type="number" class="input" name="consumption_rate" placeholder="20.00"/></div>
    </div>
    <div class="field">
        <div class="label">Resource</div>
        <div class="value">
            <select class="select" name="resource_id">
                <?php foreach (Resource::getAll() as $resource): ?>
                    <option value="<?= $resource->id ?>"><?= $resource->name ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <input type="submit" value="Ajouter" class="button cta"/>
</form>
