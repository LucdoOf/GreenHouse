<?php
/** @var Flat[] $flats */
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
                        <th>Sécurité</th>
                        <th></th>
                    </tr>
                    <?php foreach ($flats as $flat): ?>
                        <tr>
                            <td><?= $flat->id; ?></td>
                            <td><?= $flat->name; ?></td>
                            <td><?= $flat->house_id; ?></td>
                            <td><?= $flat->flat_type_id; ?></td>
                            <td><?= $flat->security_level; ?></td>
                            <td><a class="button" href="<?= route('flat', [$flat->id]) ?>"><i class="far fa-eye r"></i>Détails</a></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>
</div>