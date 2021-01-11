<?php
/** @var FlatType $flat_type
 * @var RoomType[] $room_types
 */

use GreenHouse\Models\FlatType;
use GreenHouse\Models\RoomType;

?>

<div class="menu">
    <div class="menu-title">
        <?= $flat_type->name; ?>
        <div class="button-input">
            <form method="POST" action="<?= route("configuration.linkedTypeRooms.create", [$flat_type->id]) ?>">
                <select name="linked_roomType" class="select">
                    <option disabled>Sélectionner un type de pièce</option>
                    <?php foreach ($room_types as $type): ?>
                        <option value="<?= $type->id; ?>"><?= $type->name; ?></option>
                    <?php endforeach; ?>
                </select>
                <input class="button" type="submit" value="+"/>
            </form>
        </div>
    </div>
    <div class="menu-content">
        <?php foreach ($flat_type->getLinkedRoomTypes() as $roomType): ?>
            <?php include "roomTypes.htm.php"; ?>
        <?php endforeach; ?>
    </div>
</div>

