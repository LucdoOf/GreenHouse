<?php
/** @var Room[] $rooms */
?>
<div class="row">
    <div class="box no-padding col-12">
        <div class="box-content">
            <div class="table-wrapper">
                <table class="table <?= empty($rooms) ? 'empty' : '' ?>">
                    <tr>
                        <th>Identifiant</th>
                        <th>Nom</th>
                        <th>Id Maison</th>
                        <th>Type d'appartement</th>
                        <th></th>
                    </tr>
                    <?php foreach ($rooms as $room): ?>
                        <tr>
                            <td><?= $room->id; ?></td>
                            <td><?= $room->name; ?></td>
                            <td><?= $room->flat_id; ?></td>
                            <td><?= $room->room_type_id; ?></td>
                            <td><a class="button" href="<?= route('room', [$room->id]) ?>"><i class="far fa-eye r"></i>Modifier</a></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>
</div>