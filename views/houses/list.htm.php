<?php
/** @var House[] $houses */

use GreenHouse\Models\House;
?>

<div class="row">
    <div class="box no-padding col-12">
        <div class="box-content">
            <div class="table-wrapper">
                <table class="table <?= empty($houses) ? 'empty' : '' ?>">
                    <tr>
                        <th>Identifiant</th>
                        <th>Nom</th>
                        <th>Adresse</th>
                        <th>Degré d'isolation</th>
                        <th>Classement écologique</th>
                        <th><a class="button" href="<?= route('house.create.page') ?>" ><i class="fas fa-plus r"></i>Ajouter une maison</a></th>
                    </tr>
                    <?php foreach ($houses as $house): ?>
                        <tr>
                            <td><?= $house->id; ?></td>
                            <td><?= $house->name; ?></td>
                            <td><?= $house->number;  ?> <?= $house->street;?></td>
                            <td><?= $house->isolation_degree; ?></td>
                            <td><?= $house->eco_level; ?></td>
                            <td><a class="button" href="<?= route('house', [$house->id]) ?>"><i class="far fa-eye r"></i>Détails</a></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>
</div>
