<?php
/** @var $resources Resource */

use GreenHouse\Models\Resource;
?>

<div class="box col-6 no-padding">
    <div class="box-header">
        <div class="box-title">Resources</div>
        <div class="box-actions">
            <div class="button-input">
                <form method="POST" action="<?= route("configuration.resources.create") ?>">
                    <input class="input" name="name" type="text" placeholder="Eau"/>
                    <input class="button" type="submit" value="+"/>
                </form>
            </div>
        </div>
    </div>
    <div class="box-content">
        <div class="table-wrapper">
            <table class="table <?= empty($houses) ? 'empty' : '' ?>">
                <tr>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Valeurs recommandées (min, ideal, max, critical)</th>
                </tr>
                <?php foreach ($resources as $resource): ?>
                    <tr>
                        <td><?= $resource->name; ?></td>
                        <td><?= $resource->description; ?></td>
                        <td><?= $resource->min_value;  ?> < <?= $resource->ideal_value ?> < <?= $resource->max_value; ?> < <?= $resource->critical_value; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>
