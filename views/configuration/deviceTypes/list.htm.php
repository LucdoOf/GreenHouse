<?php
/** @var $device_types*/

use GreenHouse\Models\DeviceTypes;
?>

<div class="box no-padding col-6">
    <div class="box-header">
        <div class="box-title">Types d'appareils</div>
        <div class="box-actions">
            <div class="button-input">
                <form method="POST" action="<?= route("configuration.types.create") ?>">
                    <input class="input" name="type_name" type="text" placeholder="Electroménager"/>
                    <input class="button" type="submit" value="+"/>
                </form>
            </div>
        </div>
    </div>
    <div class="box-content">
        <div class="table-wrapper">
            <table class="table <?= empty($devices) ? 'empty' : '' ?>">
                <tr>
                    <th>Identifiant</th>
                    <th>Nom</th>
                </tr>
                <?php foreach ($device_types as $type): ?>
                    <tr>
                        <td><?= $type->id; ?></td>
                        <td><?= $type->name; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>
