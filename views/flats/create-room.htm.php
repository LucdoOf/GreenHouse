<?php
/** @var Flat[] $flats */
/** @var Room[] $rooms */
/** @var Flat $flat */

use GreenHouse\Models\Flat;
use GreenHouse\Models\Room;
?>
<form method="POST" action="<?= route("flat.add-room.post", [$flat->id]) ?>">
    <div class="field">
        <div class="label">Pièces</div>
        <select name="room_id" class="value">
            <option disabled>Sélectionner une pièce</option>
            <?php foreach ($rooms as $room): ?>
                <option value="<?= $room->id; ?>"><?= $room->name; ?> <?= $room->room_type_id; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <input type="submit" value="Ajouter" class="button cta"/>
</form>
