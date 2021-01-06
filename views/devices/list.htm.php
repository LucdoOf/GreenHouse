<?php
/** @var Device[] $devices
 *  @var Type $types
 *  @var Flat $flats
 */

use GreenHouse\Models\DeviceTypes;
use GreenHouse\Models\Flat;

?>

<div class="row">
    <div class="box no-padding col-12">
        <div class="box-content">
            <div class="table-wrapper">
                <table class="table <?= empty($devices) ? 'empty' : '' ?>">
                    <tr>
                        <th>Identifiant</th>
                        <th>Nom</th>
                        <th>Appartement</th>
                        <th>Position</th>
                        <th>Type d'appareil</th>
                        <th><a href="<?= route('device.create.page') ?>" class="button">Ajouter un appareil</a></th>
                    </tr>
                    <?php foreach ($devices as $device): ?>
                        <tr>
                            <td><?= $device->id; ?></td>
                            <td><?= $device->name; ?></td>
                            <td><a href="<?= route('flat', [$device->flat_id]) ?>" ><?= (new Flat($device->flat_id))->name; ?></a></td>
                            <td><?= $device->location; ?></td>
                            <td><?= (new DeviceTypes($device->device_type_id))->name; ?></td>
                            <td><a class="button" href="<?= route('device', [$device->id]) ?>"><i class="far fa-eye r"></i>Détails</a></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>
</div>
