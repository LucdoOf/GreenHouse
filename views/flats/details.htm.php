<?php
/** @var Flat $flat */
?>
<div class="row">
    <div class="box col-6">
        <div class="box-header">
            <span class="box-title"><?= $flat->name; ?></span>
        </div>
        <form method="POST" action="<?= route('flat.edit', [$flat->id]) ?>">
            <div class="box-content">
                <div class="field">
                    <div class="label">Identifiant de l'appartement</div>
                    <input name="id" class="value" type="text" disabled value="<?= $flat->id; ?>"/>
                </div>
                <div class="field">
                    <div class="label">Nom de l'appartement</div>
                    <input name="name" class="value" type="text" value="<?= $flat->name; ?>"/>
                </div>
                <div class="field">
                    <div class="label">Identifiant de la maison</div>
                    <input name="house_id" class="value" type="text" value="<?= $flat->house_id; ?>"/>
                </div>
                <div class="field">
                    <div class="label">Type d'appartement</div>
                    <input name="type_id" class="value" type="text" value="<?= $flat->flat_type_id; ?>"/>
                </div>
                <div class="field">
                    <div class="label">Niveau de sécurité</div>
                    <input name="security" class="value" type="text" value="<?= $flat->security_level; ?>"/>
                </div>
            </div>
            <div class="box-footer">
                <div class="button-group">
                    <a href="<?= route('flat', [$flat->id]) ?>" class="button">Annuler</a>
                    <button type="submit" class="button cta">Enregistrer</button>
                </div>
            </div>
        </form>
    </div>
</div>