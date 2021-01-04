<?php
    /** @var Device[] $devices */
?>
<div class="row">
    <div class="box no-padding col-12">
        <div class="box-content">
            <div class="table-wrapper">
                <table class="table <?= empty($devices) ? 'empty' : '' ?>">
                    <tr>
                        <th>Identifiant</th>
                        <th>Nom</th>
                        <th>Id Appartement</th>
                        <th>Position</th>
                        <th>Type d'appareil</th>
                        <th></th>
                    </tr>
                    <?php foreach ($devices as $device): ?>
                        <tr>
                            <td><?= $device->id; ?></td>
                            <td><?= $device->name; ?></td>
                            <td><?= $device->flat_id; ?></td>
                            <td><?= $device->location; ?></td>
                            <td><?= $device->device_type_id; ?></td>
                            <td><a class="button" href="<?= route('device', [$device->id]) ?>"><i class="far fa-eye r"></i>Détails</a></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>
</div>
