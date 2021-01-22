<?php
/** @var $device Device */

use GreenHouse\Models\Device;
?>

<div class="box col-6 no-padding">
    <div class="box-header">
        <span class="box-title">Mesures</span>
        <div class="box-actions">
            <form method="post" action="<?= route('device.measures.create', [$device->id]) ?>">
                <input type="text" class="input" name="start_date" placeholder="19/01/2020"/>
                <input type="text" class="input" name="end_date" placeholder="20/01/2020">
                <input type="submit" class="button" value="Ajouter"/>
            </form>
        </div>
    </div>
    <div class="box-content">
        <div class="table-wrapper">
            <table class="table <?= empty($devices) ? 'empty' : '' ?>">
                <tr>
                    <th>Date de début</th>
                    <th>Date de fin</th>
                </tr>
                <?php foreach ($device->getLinkedMeasures() as $measure): ?>
                    <tr>
                        <td><?= $measure->start_date; ?></td>
                        <td><?= $measure->end_date; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>
