<?php
/** @var Flat[] $flats */

use GreenHouse\Models\Flat;
use GreenHouse\Models\FlatType;

?>
<div class="row">
    <div class="box no-padding col-12">
        <div class="box-content">
            <div class="table-wrapper">
                <table class="table <?= empty($flats) ? 'empty' : '' ?>">
                    <tr>
                        <th>Identifiant</th>
                        <th>Nom</th>
                        <th>Id Maison</th>
                        <th>Type d'appartement</th>
                        <th>Niveau de sécurité</th>
                        <th><a class="button" href="<?= route('flat.create.page') ?>" ><i class="fas fa-plus r"></i>Ajouter un appartement</a></th>
                    </tr>
                    <?php foreach ($flats as $flat): ?>
                        <tr>
                            <td><?= $flat->id; ?></td>
                            <td><?= $flat->name; ?></td>
                            <td><?= $flat->house_id; ?></td>
                            <td><?= (new FlatType($flat->flat_type_id))->name ?></td>
                            <td><?= $flat->security_level; ?></td>
                            <td><a class="button" href="<?= route('flat', [$flat->id]) ?>"><i class="far fa-eye r"></i>Modifier</a></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>
</div>