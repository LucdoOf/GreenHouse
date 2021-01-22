<?php
/** @var $room_types*/

use GreenHouse\Models\RoomType;
?>

<div class="box no-padding col-6">
    <div class="box-header">
        <div class="box-title">Types de pièces</div>
        <div class="box-actions">
            <div class="button-input">
                <form method="POST" action="<?= route("configuration.room-types.create") ?>">
                    <input class="input" name="room_type_name" type="text" placeholder="Cuisine"/>
                    <input class="button" type="submit" value="+"/>
                </form>
            </div>
        </div>
    </div>
    <div class="box-content">
        <div class="table-wrapper">
            <table class="table <?= empty($rooms) ? 'empty' : '' ?>">
                <tr>
                    <th>Identifiant</th>
                    <th>Nom</th>
                </tr>
                <?php foreach ($room_types as $rtype): ?>
                    <tr>
                        <td><?= $rtype->id; ?></td>
                        <td><?= $rtype->name; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>
