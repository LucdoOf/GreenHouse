<?php
/** @var Room[] $rooms */
/** @var Flat $flat */

use GreenHouse\Models\Flat;
use GreenHouse\Models\Room;
use GreenHouse\Models\RoomType;

?>

<div class="row">
    <div class="box col-12 wr">
        <div class="box-header">
            <span class="box-title">Pièces</span>
            <div class="box-actions">
                <a class="button" onclick="roomsModal.show()">Ajouter</a>
            </div>
        </div>
        <div class="box-content">
            <div class="table-wrapper">
                <table class="table <?= empty($rooms) ? 'empty' : '' ?>">
                    <tr>
                        <th>Nom</th>
                        <th>Type de pièce</th>
                    </tr>
                    <?php foreach ($rooms as $room): ?>
                        <tr>
                            <td><?= $room->name?></td>
                            <td><?= (new RoomType($room->room_type_id))->name ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    let roomsModal;
    window.addEventListener("load", () => {
        roomsModal = new Modal({view_url: '<?= route("flat.add-room", [$flat->id])?>', title: 'Ajouter une pièce'});
        roomsModal.build();
    });
</script>
