<?php
/** @var RoomType[] $roomTypes */
/** @var Flat $flat */

use GreenHouse\Models\Flat;
use GreenHouse\Models\RoomType;

?>
<form method="POST" action="<?= route("flat.add-room.post", [$flat->id]) ?>">
    <div class="field">
        <div class="label">Type de pièce</div>
        <select name="room_id" class="value">
            <option disabled>Sélectionner une pièce</option>
            <?php foreach ($roomTypes as $roomType): ?>
                <option value="<?= $roomType->id; ?>"><?= $roomType->name; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <input type="submit" value="Ajouter" class="button cta"/>
</form>
