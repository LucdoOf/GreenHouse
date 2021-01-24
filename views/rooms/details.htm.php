<?php
/** @var Room $room */
?>
<div class="row">
    <div class="box col-12 col-md-6">
        <div class="box-header">
            <span class="box-title"><?= $room->name; ?></span>
        </div>
        <form method="POST" action="<?= route('room.edit', [$room->id]) ?>">
            <div class="box-content">
                <div class="field">
                    <div class="label">Identifiant de la pièce</div>
                    <input name="id" class="value" type="text" disabled value="<?= $room->id; ?>"/>
                </div>
                <div class="field">
                    <div class="label">Nom de la pièce</div>
                    <input name="name" class="value" type="text" value="<?= $room->name; ?>"/>
                </div>
                <div class="field">
                    <div class="label">Identifiant de l'appartement'</div>
                    <input name="house_id" class="value" type="text" value="<?= $room->flat_id; ?>"/>
                </div>
                <div class="field">
                    <div class="label">Type de pièce</div>
                    <input name="type_id" class="value" type="text" value="<?= $room->room_type_id; ?>"/>
                </div>
            </div>
            <div class="box-footer">
                <div class="button-group">
                    <a href="<?= route('room', [$room->id]) ?>" class="button">Annuler</a>
                    <button type="submit" class="button cta">Enregistrer</button>
                </div>
            </div>
        </form>
    </div>
</div>